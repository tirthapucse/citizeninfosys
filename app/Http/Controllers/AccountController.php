<?php

namespace App\Http\Controllers;

use App\Models\Homeowners;
use App\Models\User;
use App\Models\Tenants; // Import the Tenants model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    // Show the registration form
    public function register()
    {
        return view("account.register");
    }

    // Process the registration
    public function processRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:5',
            'password_confirmation' => 'required',
            'role' => 'required|in:tenant,homeowner'
        ]);

        if ($validator->fails()) {
            return redirect()->route('account.register')->withInput()->withErrors($validator);
        }

        //dd($request->all());

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        //dd($user);

        // If the role is 'tenant', create an entry in the `tenants` table
        if ($request->role === 'tenant') {
            Tenants::create([
                'user_id' => $user->id,
                // Default data for tenant's profile (can be updated later)
                // 'image' => null,
                // 'national_id' => null,
                // 'nid_front_image' => null,
                // 'nid_back_image' => null,
                // 'passport_number' => null,
                // 'phone' => null,
                // 'gender' => null,
                // 'user_type' => null,
                // 'address' => null,
                // 'city' => null,
                // 'marital_status' => null,
                // 'religion' => null,
                // 'profession' => null,
            ]);
        }

        // Redirect to the login page after registration
        return redirect()->route('account.login')->with('success', 'Registration successful. Please login.');
    }

    // Show the login form
    public function login()
    {
        return view("account.login");
    }

    // Authenticate the user and redirect to their dashboard
    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            // dd($validator);
            return redirect()->route('account.login')->withInput()->withErrors($validator);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            // Redirect based on role
            switch ($user->role) {
                case 'tenant':
                    return redirect()->route('tenant.dashboard')->with('success', 'Welcome to Tenant Dashboard!');
                case 'homeowner':
                    return redirect()->route('homeowner.dashboard')->with('success', 'Welcome to Homeowner Dashboard!');
                case 'security_admin':
                    return redirect()->route('security_admin.dashboard')->with('success', 'Welcome to Security Admin Dashboard!');
                case 'super_admin':
                    return redirect()->route('super_admin.dashboard')->with('success', 'Welcome to Super Admin Dashboard!');

                default:
                    return redirect()->route('account.login')->with('error', 'Unable to determine role, please login again.');
            }
        } else {
            return redirect()->route('account.login')->with('error', 'Invalid credentials. Please try again.');
        }
    }

    // Show profile page
    public function profile()
    {
        $user = Auth::user();
        return view('account.profile', compact('user'));
    }


    // Homeowner dashboard
    public function homeownerDashboard()
    {
        $user = Auth::user();
        $homeowner = Homeowners::where('user_id', $user->id)->first();
        return view('homeowner.dashboard', compact('homeowner')); // Ensure this view exists
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('account.login');
    }

    public function verifyUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'tenant' || $user->role === 'homeowner') {
            $user->update(['verified' => true]);
        }

        return back()->with('success', 'User verified successfully.');
    }
}
