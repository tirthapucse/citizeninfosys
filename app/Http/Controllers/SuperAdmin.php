<?php

namespace App\Http\Controllers;

use App\Models\SuperAdmins;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SuperAdmin extends Controller
{
    public function Dashboard()
    {
        $user = Auth::user();
        $superadmin = SuperAdmins::where('user_id', $user->id)->first();
        return view('super_admin.dashboard');
    }
}
