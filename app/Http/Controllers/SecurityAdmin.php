<?php

namespace App\Http\Controllers;

use App\Models\SecurityAdmins;
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
}
