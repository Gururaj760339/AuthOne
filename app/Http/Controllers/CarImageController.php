<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarImageController extends Controller
{
    public function showCarImage()
    {

        $images = CarImage::with('car')->latest()->get();

        return view('admin.car_images.car_images_show', compact('images'));
    }

    public function addCarImage()
    {
        $cars = Car::get();
        return view('admin.car_images.add_car_images', compact('cars'));
    }

    public function storeCarImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $car = $request->car_id;

        $image = $request->file('image')->store('cars', 'public');

        CarImage::create([
            'car_id' => $car,
            'image' => $image,
        ]);

        return back()->with('success', 'Image uploaded successfully.');
    }

    public function deleteCarImage($id)
    {
        $carImage = CarImage::where('id', $id)->first();
        if (Storage::disk('public')->exists($carImage->id)) {
            Storage::disk('public')->delete($carImage->id);
        }

        $carImage->delete();

        return back()->with('success', 'Image deleted successfully.');
    }
}
