<?php

namespace App\Http\Controllers;

use App\Models\FinanceRequests;
use App\Models\FuelPartner;
use App\Models\ImportRequest;
use App\Models\KycVerification;
use App\Models\RentalBooking;
use App\Models\RoadsideProvider;
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
        /*
    |--------------------------------------------------------------------------
    | Basic Validation
    |--------------------------------------------------------------------------
    */

        $request->validate([
            'name' => 'required|string|max:255',

            'email' => 'required|email|unique:users,email',

            'phone' => 'required|string|max:30',

            'password' => 'required|string|min:6|confirmed',

            'role' => 'required|in:customer,vendor,roadside_provider,fuel_partner',

            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'country_id' => 'required|exists:countries,id',
        ]);


        /*
    |--------------------------------------------------------------------------
    | Vendor Validation
    |--------------------------------------------------------------------------
    */

        if ($request->role === 'vendor') {

            $request->validate([

                'vendor_type' => 'required|in:service,dealer,rental,car_importer',

                'business_name' => 'required|string|max:255',

                'trade_license' => 'nullable|string|max:255',

                'address' => 'nullable|string',

                'city' => 'nullable|string|max:100',

                'country' => 'nullable|string|max:100',

                'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ]);
        }


        /*
    |--------------------------------------------------------------------------
    | Roadside Provider Validation
    |--------------------------------------------------------------------------
    */

        if ($request->role === 'roadside_provider') {

            $request->validate([

                'company_name' => 'required|string|max:255',

                'provider_type' => [
                    'required',
                    'in:tow_truck,mechanic,mobile_mechanic,battery_service,fuel_delivery,roadside_company'
                ],

                'provider_phone' => 'required|string|max:30',

                'latitude' => 'nullable|numeric|between:-90,90',

                'longitude' => 'nullable|numeric|between:-180,180',

            ]);
        }


        /*
    |--------------------------------------------------------------------------
    | Fuel Partner Validation
    |--------------------------------------------------------------------------
    */

        if ($request->role === 'fuel_partner') {

            $request->validate([

                'fuel_company_name' => 'required|string|max:255',

                'license_number' => 'nullable|string|max:255',

                'license_expiry' => 'nullable|date',

                'fuel_phone' => 'required|string|max:30',

                'fuel_email' => 'nullable|email|max:255',

                'fuel_address' => 'nullable|string',

                'fuel_city' => 'nullable|string|max:100',

                'fuel_latitude' => 'nullable|numeric|between:-90,90',

                'fuel_longitude' => 'nullable|numeric|between:-180,180',

            ]);
        }


        /*
    |--------------------------------------------------------------------------
    | Database Transaction
    |--------------------------------------------------------------------------
    */

        DB::beginTransaction();

        try {

            /*
        |--------------------------------------------------------------------------
        | Profile Picture
        |--------------------------------------------------------------------------
        */

            $profilePicture = null;

            if ($request->hasFile('profile_picture')) {

                $profilePicture = $request
                    ->file('profile_picture')
                    ->store('users/profile', 'public');
            }


            /*
        |--------------------------------------------------------------------------
        | Create User
        |--------------------------------------------------------------------------
        */

            $user = User::create([

                'name' => $request->name,

                'email' => $request->email,

                'phone' => $request->phone,

                'password' => Hash::make($request->password),

                'role' => $request->role,

                'avatar' => $profilePicture,

                'country_id' => $request->country_id,
            ]);


            /*
        |--------------------------------------------------------------------------
        | Vendor Partner
        |--------------------------------------------------------------------------
        */

            if ($request->role === 'vendor') {

                $logo = null;

                if ($request->hasFile('logo')) {

                    $logo = $request
                        ->file('logo')
                        ->store('vendors/logos', 'public');
                }


                Vendor::create([

                    'user_id' => $user->id,

                    'vendor_type' => $request->vendor_type,

                    'business_name' => $request->business_name,

                    'trade_license' => $request->trade_license,

                    'address' => $request->address,

                    'city' => $request->city,

                    'country' => $request->country,

                    'logo' => $logo,

                ]);
            }


            /*
        |--------------------------------------------------------------------------
        | Roadside Assistance Partner
        |--------------------------------------------------------------------------
        */

            if ($request->role === 'roadside_provider') {

                RoadsideProvider::create([

                    'user_id' => $user->id,

                    'company_name' => $request->company_name,

                    'phone' => $request->provider_phone,

                    'provider_type' => $request->provider_type,

                    'latitude' => $request->latitude,

                    'longitude' => $request->longitude,

                    // Admin verification required
                    'is_verified' => 0,

                    // Initially available
                    'is_available' => 1,

                    'rating' => 0.00,

                ]);
            }


            /*
        |--------------------------------------------------------------------------
        | Fuel Partner
        |--------------------------------------------------------------------------
        */

            //dd('complete');

            if ($request->role === 'fuel_partner') {

                FuelPartner::create([

                    'user_id' => $user->id,

                    'company_name' => $request->fuel_company_name,

                    'license_number' => $request->license_number,

                    'license_expiry' => $request->license_expiry,

                    'phone' => $request->fuel_phone,

                    'email' => $request->fuel_email,

                    'address' => $request->fuel_address,

                    'city' => $request->fuel_city,

                    'latitude' => $request->fuel_latitude,

                    'longitude' => $request->fuel_longitude,

                    // Default commission
                    'commission_rate' => 10,

                    // Admin approval required
                    'status' => 'pending',

                ]);
            }


            /*
        |--------------------------------------------------------------------------
        | Commit Transaction
        |--------------------------------------------------------------------------
        */

            DB::commit();


            /*
        |--------------------------------------------------------------------------
        | Login User
        |--------------------------------------------------------------------------
        */

            auth()->login($user);


            /*
        |--------------------------------------------------------------------------
        | Success Message
        |--------------------------------------------------------------------------
        */

            $message = match ($request->role) {

                'roadside_provider' =>
                'Roadside Assistance Partner registration submitted. Waiting for admin verification.',

                'vendor' =>
                'Vendor Partner account created successfully.',

                'fuel_partner' =>
                'Fuel Partner registration submitted. Waiting for admin approval.',

                default =>
                'Customer account created successfully.',
            };


            /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

            return redirect()
                ->route('home')
                ->with('success', $message);
        } catch (\Throwable $e) {

            /*
        |--------------------------------------------------------------------------
        | Rollback
        |--------------------------------------------------------------------------
        */

            DB::rollBack();


            return back()
                ->withInput()
                ->with(
                    'error',
                    'Registration failed: ' . $e->getMessage()
                );
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
        } else if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'role' => 'roadside_provider',
        ], $request->boolean('remember'))) {

            $request->session()->regenerate();

            return redirect()->route('partner.roadside.dashboard')
                ->with('success', 'Login successful.');
        } else if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'role' => 'fuel_partner',
        ], $request->boolean('remember'))) {

            $request->session()->regenerate();

            return redirect()->route('fuel.partner.dashboard')
                ->with('success', 'Login successful.');
        } else if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'role' => 'fuel_driver',
        ], $request->boolean('remember'))) {

            $request->session()->regenerate();

            return redirect()->route('fuel.driver.dashboard')
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
