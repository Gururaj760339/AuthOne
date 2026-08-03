<?php

namespace App\Http\Controllers;

use App\Models\FinanceRequests;
use App\Models\ImportRequest;
use App\Models\KycVerification;
use App\Models\RentalBooking;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([

            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'phone'      => 'nullable|string|max:20',
            'password'   => 'required|string|min:8',
            'role'       => 'required|in:customer,vendor,admin',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',


            // Vendor validation only
            'vendor_type' => 'required_if:role,vendor|nullable|in:workshop,car_wash,dealer,rental,spare_parts',
            'business_name' => 'required_if:role,vendor|nullable|string|max:255',
            'trade_license' => 'required_if:role,vendor|nullable|string|max:255',
            'address' => 'required_if:role,vendor|nullable|string|max:255',
            'city' => 'required_if:role,vendor|nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ]);

        DB::beginTransaction();

        try {
            // Profile Upload
            $avatar = null;

            if ($request->hasFile('profile_picture')) {

                $avatar = $request->file('profile_picture')
                    ->store('profiles', 'public');
            }

            // Create User
            $user = User::create([
                'name' => $validated['first_name'] . ' ' . $validated['last_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'password' => Hash::make($validated['password']),
                'avatar' => $avatar,
                'role' => $validated['role'],
            ]);


            if ($validated['role'] == 'vendor') {

                $logo = null;

                if ($request->hasFile('logo')) {

                    $logo = $request->file('logo')
                        ->store('vendors', 'public');
                }

                Vendor::create([
                    'user_id' => $user->id,
                    'vendor_type' => $validated['vendor_type'],
                    'business_name' => $validated['business_name'],
                    'owner_name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'logo' => $logo,
                    'trade_license' => $validated['trade_license'],
                    'address' => $validated['address'],
                    'city' => $validated['city'],
                    'country' => $validated['country'] ?? 'UAE',
                    'opening_time' => '09:00:00',
                    'closing_time' => '18:00:00',
                    'status' => 'pending',
                ]);
            }

            DB::commit();

            Auth::login($user);

            return redirect('/')
                ->with('success', 'Registration completed successfully.');
        } catch (\Exception $e) {


            DB::rollBack();


            return back()
                ->withInput()
                ->withErrors([
                    'error' => $e->getMessage()
                ]);
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'role' => 'customer',
        ], $request->boolean('remember'))) {

            $request->session()->regenerate();

            return redirect('/')
                ->with('success', 'Login successful.');
        }

        if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'role' => 'admin',
        ], $request->boolean('remember'))) {

            $request->session()->regenerate();

            return redirect()->route('admin.dashboard')
                ->with('success', 'Login successful.');
        } else if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'role' => 'vendor',
        ], $request->boolean('remember'))) {

            $request->session()->regenerate();

            return redirect()->route('vendor.dashboard')
                ->with('success', 'Login successful.');
        } else if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'role' => 'vendor',
        ], $request->boolean('remember'))) {

            $request->session()->regenerate();

            return redirect()->route('vendor.dashboard')
                ->with('success', 'Login successful.');
        } else if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'role' => 'finance_partner',
        ], $request->boolean('remember'))) {

            $request->session()->regenerate();

            return redirect()->route('finance.partner.dashboard')
                ->with('success', 'Login successful.');
        }

        return back()
            ->withErrors([
                'email' => 'Invalid email or password.',
            ])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')
            ->with('success', 'Logged out successfully.');
    }

    public function showAdminPanelUser()
    {
        $users = User::simplePaginate(10);
        $total_user = User::count();

        return view('admin.users.all_users_show', compact('total_user', 'users'));
    }

    public function userPanel()
    {
        $setting = Setting::first();
        return view('home', compact('setting'));
    }

    public function aboutPage()
    {
        $setting = Setting::first();
        return view('about', compact('setting'));
    }

    public function addUserForm()
    {
        return view('admin.users.add_user');
    }

    public function adminPanelAddUser(Request $request)
    {
        $request->validate([

            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,customer,vendor,finance_partner'

        ]);

        $avatar = null;

        if ($request->hasFile('avatar')) {

            $avatar = $request->file('avatar')
                ->store('avatars', 'public');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'avatar' => $avatar,
            'role' => $request->role,
            'password' => Hash::make($request->password)
        ]);

        return redirect()
            ->route('admin.users')
            ->with('success', 'User created successfully');
    }

    public function myProfile()
    {
        $setting = Setting::first();
        $kyc = KycVerification::where('user_id', Auth::id())->first();
        $user = auth()->user();
        $bookingCount = RentalBooking::where('user_id', auth()->id())->count();
        $financeCount = FinanceRequests::where('user_id', auth()->id())->count();
        $importCount = ImportRequest::where('user_id', auth()->id())->count();

        return view('customer.profile_dashboard', compact(
            'user',
            'bookingCount',
            'financeCount',
            'importCount',
            'kyc',
            'setting'
        ));
    }
}
