<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::orderBy('region')
            ->orderBy('name')
            ->get();

        return view('admin.countries.index', compact('countries'));
    }

    public function create()
    {
        return view('admin.countries.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'code' => 'required|string|size:2|unique:countries,code',
            'iso3' => 'nullable|string|size:3',
            'phone_code' => 'nullable|string|max:10',

            'currency_code' => 'required|string|size:3',
            'currency_symbol' => 'nullable|string|max:10',

            'default_locale' => 'required|string|max:10',
            'timezone' => 'nullable|string|max:100',

            'region' => 'required|in:GCC,Egypt,North Africa',

            'vat_rate' => 'required|numeric|min:0|max:100',

            'is_active' => 'nullable|boolean',
        ]);

        $validated['code'] = strtoupper($validated['code']);
        $validated['currency_code'] =
            strtoupper($validated['currency_code']);

        $validated['is_active'] =
            $request->boolean('is_active');

        Country::create($validated);

        return redirect()
            ->route('admin.countries.index')
            ->with('success', 'Country added successfully.');
    }

    public function edit(Country $country)
    {
        return view(
            'admin.countries.edit',
            compact('country')
        );
    }

    public function update(Request $request, Country $country)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',

            'code' => 'required|string|size:2|unique:countries,code,' .
                $country->id,

            'iso3' => 'nullable|string|size:3',
            'phone_code' => 'nullable|string|max:10',

            'currency_code' => 'required|string|size:3',
            'currency_symbol' => 'nullable|string|max:10',

            'default_locale' => 'required|string|max:10',
            'timezone' => 'nullable|string|max:100',

            'region' => 'required|in:GCC,Egypt,North Africa',

            'vat_rate' => 'required|numeric|min:0|max:100',

            'is_active' => 'nullable|boolean',
        ]);

        $validated['code'] = strtoupper($validated['code']);
        $validated['currency_code'] =
            strtoupper($validated['currency_code']);

        $validated['is_active'] =
            $request->boolean('is_active');

        $country->update($validated);

        return redirect()
            ->route('admin.countries.index')
            ->with('success', 'Country updated successfully.');
    }

    public function destroy(Country $country)
    {
        $country->delete();

        return back()
            ->with('success', 'Country deleted successfully.');
    }
}