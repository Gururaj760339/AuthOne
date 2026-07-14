<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Faq;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Setting;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function showService()
    {
        $services = Service::with('serviceCategory')
            ->latest()
            ->get();

        return view('admin.service.services', compact('services'));
    }

    public function showMaintenanceCustomer()
    {
        $services = Service::with('serviceCategory')
            ->whereHas('serviceCategory', function ($query) {
                $query->where('slug', 'workshops-maintenance');
            })
            ->latest()
            ->get();

        $booking = Booking::whereHas('service.serviceCategory', function($query){  
            $query->where('slug', 'workshops-maintenance');
        })
        ->where('user_id', Auth::id())->first();

        $testimonials = Testimonial::get();

        $faqs = Faq::limit(3)->get();

        $setting = Setting::first();

        return view('workshops_and_maintenance', compact('setting', 'faqs', 'testimonials', 'booking', 'services'));
    }

    public function showCarWashCustomer()
    {
        $services = Service::with('serviceCategory')
            ->whereHas('serviceCategory', function ($query) {
                $query->where('slug', 'car-wash-services');
            })
            ->latest()
            ->get();

        $booking = Booking::whereHas('service.serviceCategory', function($query){  
            $query->where('slug', 'car-wash-services');
        })->first();

        $testimonials = Testimonial::get();

        $faqs = Faq::limit(3)->get();

        $setting = Setting::first();

        return view('car_wash', compact('setting', 'faqs', 'testimonials', 'booking', 'services'));
    }

    public function serviceCreate()
    {
        $categories = ServiceCategory::get();

        return view('admin.service.add_service', compact('categories'));
    }

    public function serviceStore(Request $request)
    {
        $request->validate([
            'service_category_id' => 'required|exists:service_categories,id',
            'title'               => 'required|max:255|unique:services,title',
            'price'               => 'required|numeric|min:0',
            'duration'            => 'required|max:100',
            'description'         => 'required',
            'image'               => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'              => 'required|',
        ]);

        $image = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('services', 'public');
        }

        Service::create([
            'service_category_id' => $request->service_category_id,
            'title'               => $request->title,
            'slug'                => Str::slug($request->title),
            'price'               => $request->price,
            'duration'            => $request->duration,
            'description'         => $request->description,
            'image'               => $image,
            'status'              => $request->status,
        ]);

        return redirect()
            ->route('admin.service')
            ->with('success', 'Service Added Successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $service = Service::findOrFail($id);

        $service->status = $request->status;
        $service->save();

        return back()->with('success', 'Status Updated Successfully');
    }

    public function deleteCategory($id)
    {
        $service = Service::findOrFail($id);

        if ($service->image && file_exists(public_path('storage/' . $service->image))) {
            unlink(public_path('storage/' . $service->image));
        }

        $service->delete();

        return back()->with('success', 'Service Deleted Successfully');
    }
}
