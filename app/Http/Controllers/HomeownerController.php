<?php

namespace App\Http\Controllers;

use App\Models\Homeowners;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeownerController extends Controller
{
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'homeowner') {
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

        $homeowner = Homeowners::where('user_id', $user->id)->firstOrFail();

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

        return redirect()->route('homeowner.dashboard')->with('success', 'Profile updated successfully.');
    }
}
