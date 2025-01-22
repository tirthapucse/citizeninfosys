<?php

namespace App\Http\Controllers;

use App\Models\Properties;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = Properties::where('homeowner_id', Auth::user()->homeowner->id)->get();
        return view('homeowner.property', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('homeowner.property');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'building_image' => 'nullable|image', // Validate image upload
            'holding_number' => 'nullable|string',
            'holding_tax_number' => 'nullable|string',
            'google_map_link' => 'nullable|url',
            'total_flat' => 'nullable|string',
            'total_floor' => 'nullable|string',
        ]);

        $property = new Properties();
        $property->homeowner_id = Auth::user()->homeowner->id;
        $property->building_image = $request->building_image;
        $property->holding_number = $request->holding_number;
        $property->holding_tax_number = $request->holding_tax_number;
        $property->google_map_link = $request->google_map_link;
        $property->total_flat = $request->total_flat;
        $property->total_floor = $request->total_floor;


        if ($request->hasFile('building_image')) {
            $property->building_image = $request->file('building_image')->store('building_images');
        }

        $property->save();

        return redirect()->route('property.index')->with('success', 'Property created successfully!');
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $property = Properties::findOrFail($id);
        return view('properties.edit', compact('property'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'homeowner_id' => 'required|exists:homeowners,id', // Ensure the homeowner exists
            'building_image' => 'nullable|image', // Validate image upload
            'holding_number' => 'nullable|string',
            'holding_tax_number' => 'nullable|string',
            'google_map_link' => 'nullable|url',
            'total_flat' => 'nullable|string',
            'total_floor' => 'nullable|string',
        ]);

        $property = Properties::findOrFail($id);
        $property->building_image = $request->building_image;
        $property->holding_number = $request->holding_number;
        $property->holding_tax_number = $request->holding_tax_number;
        $property->google_map = $request->google_map;
        $property->total_flat = $request->total_flat;
        $property->total_floor = $request->total_floor;

        if ($request->hasFile('building_image')) {
            $property->building_image = $request->file('building_image')->store('building_images');
        }

        $property = Properties::findOrFail($id);
        $property->update($request->all());

        return redirect()->route('property.index')->with('success', 'Property updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $property = Properties::findOrFail($id);
        $property->delete();

        return redirect()->route('property.index')->with('success', 'Property deleted successfully!');
    }
}
