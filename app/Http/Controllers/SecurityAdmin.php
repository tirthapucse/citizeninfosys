<?php

namespace App\Http\Controllers;

use App\Models\SecurityAdmins;
use App\Models\User;
use App\Models\Tenants;
use App\Models\Homeowners;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SecurityAdmin extends Controller
{
    public function Dashboard()
    {
        $user = Auth::user();
        $securityadmin = SecurityAdmins::where('user_id', $user->id)->first();
        return view('security_admin.dashboard');
    }

    // Handle search functionality
    // public function searchUsers(Request $request)
    // {
    //     // Start query for User model
    //     $query = User::query();

    //     // Search criteria
    //     if ($request->filled('name')) {
    //         $query->where('name', 'like', '%' . $request->name . '%');
    //     }

    //     if ($request->filled('email')) {
    //         $query->where('email', 'like', '%' . $request->email . '%');
    //     }

    //     if ($request->filled('role')) {
    //         $query->where('role', $request->role);
    //     }

    //     // You can search in tenants and homeowners as well
    //     if ($request->filled('national_id')) {
    //         $query->whereHas('tenant', function ($query) use ($request) {
    //             $query->where('national_id', 'like', '%' . $request->national_id . '%');
    //         })
    //             ->orWhereHas('homeowner', function ($query) use ($request) {
    //                 $query->where('national_id', 'like', '%' . $request->national_id . '%');
    //             });
    //     }

    //     if ($request->filled('city')) {
    //         $query->whereHas('tenant', function ($query) use ($request) {
    //             $query->where('city', 'like', '%' . $request->city . '%');
    //         })
    //             ->orWhereHas('homeowner', function ($query) use ($request) {
    //                 $query->where('city', 'like', '%' . $request->city . '%');
    //             });
    //     }

    //     // Execute query to get users
    //     $users = $query->get();

    //     // Pass $users to the view
    //     return view('security_admin.dashboard', compact('users'));
    // }

    // app/Http/Controllers/AdminController.php
    public function searchUsers(Request $request)
    {
        $query = $request->input('search');

        $tenants = Tenants::whereNotNull('full_name') // Ensure full_name exists
            ->where('full_name', 'LIKE', "%{$query}%")
            ->whereHas('user', function ($q) use ($query) {
                $q->where('email', 'LIKE', "%{$query}%");
            })
            ->with(['user:id,email'])
            ->get();

        $homeowners = Homeowners::whereNotNull('full_name')
            ->where('full_name', 'LIKE', "%{$query}%")
            ->whereHas('user', function ($q) use ($query) {
                $q->where('email', 'LIKE', "%{$query}%");
            })
            ->with(['user:id,email'])
            ->get();

        return view('security_admin.search_results', compact('tenants', 'homeowners'));
    }
}
