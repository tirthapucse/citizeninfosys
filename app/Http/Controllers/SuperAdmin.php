<?php

namespace App\Http\Controllers;

use App\Models\Homeowners;
use App\Models\Properties;
use App\Models\Rents;
use App\Models\SuperAdmins;
use App\Models\Tenants;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SuperAdmin extends Controller
{
    public function Dashboard()
    {
        $user = Auth::user();
        $superadmin = SuperAdmins::where('user_id', $user->id)->first();
        $totalUsers = User::count();
        $totalOwners = Homeowners::count();
        $totalTenants = Tenants::count();
        $totalProperty = Properties::count();
        return view('super_admin.dashboard', compact('totalUsers', 'totalOwners', 'totalTenants', 'totalProperty'));
    }

    public function listUsers()
    {
        $users = User::all(); // Retrieve all users
        return view('super_admin.users', compact('users'));
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id); // Find the user by ID
        $user->delete(); // Delete the user

        return redirect()->route('superadmin.users')->with('success', 'User deleted successfully!');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('super_admin.edit_user', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|string|in:tenant,homeowner',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect()->route('superadmin.users')->with('success', 'User updated successfully!');
    }

    public function editTenant($id)
    {
        $tenant = Tenants::findOrFail($id);
        return view('super_admin.edit_tenant', compact('tenant'));
    }

    public function updateTenant(Request $request, $id)
    {
        $tenant = Tenants::findOrFail($id);
        $request->validate([
            'full_name' => 'required|string|max:255',
            'national_id' => 'nullable|string|max:10',
            'passport_number' => 'nullable|string|max:50',
            'gender' => 'nullable|string|in:male,female,other',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'profession' => 'nullable|string|max:100',
            'marital_status' => 'nullable|string|max:50',
            'religion' => 'nullable|string|max:50',
        ]);

        $tenant->update($request->all());

        return redirect()->route('superadmin.users')->with('success', 'Tenant updated successfully!');
    }

    public function editHomeowner($id)
    {
        $homeowner = Homeowners::findOrFail($id);
        return view('super_admin.edit_homeowner', compact('homeowner'));
    }

    public function updateHomeowner(Request $request, $id)
    {
        $homeowner = Homeowners::findOrFail($id);
        $request->validate([
            'full_name' => 'required|string|max:255',
            'national_id' => 'required|string|max:10',
            'passport_number' => 'nullable|string|max:50',
            'gender' => 'required|string|in:male,female,other',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'profession' => 'required|string|max:100',
            'marital_status' => 'required|string|max:50',
            'religion' => 'required|string|max:50',
        ]);

        $homeowner->update($request->all());

        return redirect()->route('superadmin.users')->with('success', 'Homeowner updated successfully!');
    }

    public function activeUserList()
    {
        $rents = Rents::with(['property.homeowner', 'tenant'])
            ->where('status', true)
            ->get();
        return view('super_admin.activeuser', compact('rents'));
    }

    public function listProperties()
    {
        $properties = Properties::with('homeowner')->get(); // Retrieve all properties with homeowner details
        return view('super_admin.properties', compact('properties'));
    }

    public function deleteProperty($id)
    {
        $property = Properties::findOrFail($id); // Find the property by ID
        $property->delete(); // Delete the property

        return redirect()->route('superadmin.properties')->with('success', 'Property deleted successfully!');
    }

    // Show the edit form for a property
    public function editProperty($id)
    {
        $property = Properties::findOrFail($id); // Find the property by ID
        return view('super_admin.edit_property', compact('property'));
    }

    // Update the property
    public function updateProperty(Request $request, $id)
    {
        $request->validate([
            'building_name' => 'nullable|string|max:255',
            'building_address' => 'nullable|string|max:255',
            'building_image' => 'nullable|image',
            'holding_number' => 'nullable|string',
            'holding_tax_number' => 'nullable|string',
            'google_map_link' => 'nullable|url',
            'total_flat' => 'nullable|string',
            'total_floor' => 'nullable|string',
        ]);

        $property = Properties::findOrFail($id);

        // Update the property fields
        $property->building_name = $request->building_name;
        $property->building_address = $request->building_address;
        $property->holding_number = $request->holding_number;
        $property->holding_tax_number = $request->holding_tax_number;
        $property->google_map_link = $request->google_map_link;
        $property->total_flat = $request->total_flat;
        $property->total_floor = $request->total_floor;

        // Handle image upload
        if ($request->hasFile('building_image')) {
            $property->building_image = $request->file('building_image')->store('building_images');
        }

        $property->save();

        return redirect()->route('superadmin.properties')->with('success', 'Property updated successfully!');
    }
}
