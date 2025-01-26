<?php

namespace App\Http\Controllers;

use App\Models\Homeowners;
use App\Models\Properties;
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
}
