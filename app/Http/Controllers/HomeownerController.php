<?php

namespace App\Http\Controllers;

use App\Models\Homeowners;
use App\Models\Rents;
use App\Models\Tenants;
use App\Models\Properties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeownerController extends Controller
{

    public function updateProfile(Request $request)
    {
        //dd($request->all());
        $user = Auth::user();
        //dd($request->all());
        if ($user->role !== 'homeowner') {
            //dd($request->all());
            return redirect()->route('home')->with('error', 'Unauthorized action.');
        }

        $request->validate([
            'full_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'national_id' => 'required|string|max:10',
            'nid_front_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nid_back_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'passport_number' => 'nullable|string|max:50',
            'gender' => 'required|string|in:male,female,other',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'profession' => 'required|string|max:100',
            'marital_status' => 'required|string|max:50',
            'religion' => 'required|string|max:50',
        ]);

        try {
            $homeowner = Homeowners::where('user_id', $user->id)->first();
            if (empty($homeowner)) {
                $homeowner = new Homeowners();
                $homeowner->create([
                    'user_id' => $user->id,
                    'full_name' => $request->full_name,
                    'image' => $request->file('image') ? $request->file('image')->store(public_path('uploads/profile')) : $homeowner->image,
                    'national_id' => $request->national_id,
                    'nid_front_image' => $request->file('nid_front_image') ? $request->file('nid_front_image')->store('homeowners') : $homeowner->nid_front_image,
                    'nid_back_image' => $request->file('nid_back_image') ? $request->file('nid_back_image')->store('homeowners') : $homeowner->nid_back_image,
                    'passport_number' => $request->passport_number,
                    'gender' => $request->gender,
                    'address' => $request->address,
                    'city' => $request->city,
                    'profession' => $request->profession,
                    'marital_status' => $request->marital_status,
                    'religion' => $request->religion,
                ]);
            } else {
                $homeowner->update([
                    'full_name' => $request->full_name,
                    'image' => $request->file('image') ? $request->file('image')->store('homeowners') : $homeowner->image,
                    'national_id' => $request->national_id,
                    'nid_front_image' => $request->file('nid_front_image') ? $request->file('nid_front_image')->store('homeowners') : $homeowner->nid_front_image,
                    'nid_back_image' => $request->file('nid_back_image') ? $request->file('nid_back_image')->store('homeowners') : $homeowner->nid_back_image,
                    'passport_number' => $request->passport_number,
                    'gender' => $request->gender,
                    'address' => $request->address,
                    'city' => $request->city,
                    'profession' => $request->profession,
                    'marital_status' => $request->marital_status,
                    'religion' => $request->religion,
                ]);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }


        return redirect()->route('homeowner.dashboard')->with('success', 'Profile updated successfully.');
    }

    public function viewFullProfile()
    {
        $user = Auth::user();
        $homeowner = Homeowners::where('user_id', $user->id)->first();
        return view('homeowner.view', compact('homeowner'));
    }

    public function searchTenant(Request $request)
    {
        $search = $request->search;
        $tenants = Tenants::where('full_name', 'LIKE', "%{$search}%")
            ->orWhere('id', 'LIKE', "%{$search}%")
            ->get();

        $user = Auth::user();
        $homeowner = Homeowners::where('user_id', $user->id)->first();
        $properties = Properties::where('homeowner_id', $homeowner->id)->get();

        return view('homeowner.rental', compact('tenants', 'properties'));
    }

    public function sentRequest(Request $request)
    {
        $tenant_id = $request->tenant_id;
        $property_id = $request->property_id;
        $rent = Rents::where('tenant_id', $tenant_id)->where('status', true)->first();

        if ($rent) {
            return redirect()->back()->with('error', 'Already Active in Rent');
        } else {
            // Check if any existing inactive rent exists and delete it
            Rents::where('tenant_id', $tenant_id)->where('status', false)->delete();

            // Create a new rent request
            Rents::create(['tenant_id' => $tenant_id, 'property_id' => $property_id, 'status' => false]);
        }
        return redirect()->route('homeowner.rental')->with('success', 'Sent Successfully.');
    }

    public function rental()
    {
        $user = Auth::user();
        $homeowner = Homeowners::where('user_id', $user->id)->first();
        $properties = Properties::where('homeowner_id', $homeowner->id)->get();

        return view('homeowner.rental', compact('properties'));
    }
}
