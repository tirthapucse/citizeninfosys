<?php

namespace App\Http\Controllers;

use App\Models\Tenants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TenantController extends Controller
{
    public function tenantDashboard()
    {
        $user = Auth::user();
        $tenant = Tenants::where('user_id', $user->id)->first();
        return view('tenant.dashboard', compact('tenant')); // Ensure this view exists

    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        if ($user->role !== 'tenant') {
            return redirect()->route('home')->with('error', 'Unauthorized action.');
        }

        $request->validate([
            'full_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'national_id' => 'nullable|max:10',
            'nid_front_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nid_back_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'passport_number' => 'nullable|max:20',
            'phone' => 'nullable|regex:/^(\+88)?01[3-9]\d{8}$/', // Bangladesh phone format
            'gender' => 'nullable|in:male,female,other',
            'user_type' => 'nullable|in:with-family,sublet,mess-member',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'marital_status' => 'nullable|string|max:50',
            'religion' => 'nullable|string|max:50',
            'profession' => 'nullable|string|max:100',
        ]);

        try {
            $tenant = Tenants::where('user_id', $user->id)->first();
            if (is_null($tenant)) { // Check if tenant exists
                $tenant = new Tenants();
                $tenant->create([
                    'user_id' => $user->id,
                    'full_name' => $request->full_name,
                    'image' => $request->file('image') ? $request->file('image')->store(public_path('uploads/profile')) : null,
                    'national_id' => $request->national_id,
                    'nid_front_image' => $request->file('nid_front_image') ? $request->file('nid_front_image')->store('homeowners') : null,
                    'nid_back_image' => $request->file('nid_back_image') ? $request->file('nid_back_image')->store('homeowners') : null,
                    'passport_number' => $request->passport_number,
                    'gender' => $request->gender,
                    'address' => $request->address,
                    'city' => $request->city,
                    'profession' => $request->profession,
                    'marital_status' => $request->marital_status,
                    'religion' => $request->religion,
                ]);
            } else {
                $tenant->update([
                    'full_name' => $request->full_name,
                    'image' => $request->file('image') ? $request->file('image')->store('homeowners') : $tenant->image,
                    'national_id' => $request->national_id,
                    'nid_front_image' => $request->file('nid_front_image') ? $request->file('nid_front_image')->store('homeowners') : $tenant->nid_front_image,
                    'nid_back_image' => $request->file('nid_back_image') ? $request->file('nid_back_image')->store('homeowners') : $tenant->nid_back_image,
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

        return redirect()->route('tenant.dashboard')->with('success', 'Profile updated successfully.');
    }
}
