<?php

namespace App\Http\Controllers;

use App\Models\Tenants;
use App\Models\Rents;
use App\Models\Properties;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TenantController extends Controller
{
    public function tenantDashboard()
    {
        $user = Auth::user();
        // if (!$user->verified) {
        //     return redirect()->back()->with('error', 'User not verified!');
        // }
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
                    'phone' => $request->phone,
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
                    'phone' => $request->phone,
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

    public function viewFullProfile()
    {
        $user = Auth::user();
        $tenant = Tenants::with('rent.property')->where('user_id', $user->id)->first();

        $qrCode = null;
        if ($user->verified) {
            // Prepare the data for QR Code
            $qrData = [
                "Tenant Name" => $tenant->full_name,
                "National ID" => $tenant->national_id,
                "Phone" => $tenant->phone,
                "Address" => $tenant->address,
                "City" => $tenant->city,
                "Profession" => $tenant->profession,
            ];

            // Check if rent and property exist before adding location details
            if (!empty($tenant->rent) && !empty($tenant->rent->property)) {
                if (!empty($tenant->rent->property->building_address)) {
                    $qrData["Current Location"] = $tenant->rent->property->building_address;
                }
                if (!empty($tenant->rent->property->building_name)) {
                    $qrData["Building Name"] = $tenant->rent->property->building_name;
                }
            }

            $qrCode = QrCode::size(200)->generate(json_encode($qrData, JSON_PRETTY_PRINT));
        }

        return view('tenant.view', compact('tenant', 'qrCode'));
    }



    public function searchTenant(Request $request)
    {
        $search = $request->search;
        $tenants = Tenants::where('full_name', 'LIKE', "%{$search}%")
            ->orWhere('id', 'LIKE', "%{$search}%")
            ->get();

        return response($tenants);
    }

    public function rentalRequests()
    {
        $user = Auth::user();
        if (!$user->verified) {
            return redirect()->back()->with('error', 'User not verified!');
        }
        $tenant = Tenants::where('user_id', $user->id)->first();

        // Fetch rental requests for the logged-in tenant
        $rentalRequests = Rents::where('tenant_id', $tenant->id)
            ->where('status', false) // Only show pending requests
            ->with('property.homeowner') // Eager load homeowner details
            ->get();

        return view('tenant.request', compact('rentalRequests'));
    }

    public function acceptRequest(Request $request)
    {
        $tenant_id = $request->tenant_id;
        $property_id = $request->property_id;
        $rent = Rents::where('tenant_id', $tenant_id)
            ->where('status', false)
            ->where('property_id', $property_id)->first();
        if ($rent) {
            $rent->status = true;
            $rent->save();
        } else {
            return redirect()->back()->with('error', 'There is no rent request');
        }
        return redirect()->route('tenant.requests')->with('success', 'Request Accepted Successfully.');
    }
}
