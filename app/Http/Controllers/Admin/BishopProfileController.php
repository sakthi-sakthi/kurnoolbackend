<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BishopProfile;

class BishopProfileController extends Controller
{
    public function index()
    {
        $profile = BishopProfile::all();
        return view('admin.profile.index', compact('profile'));
    }

    public function create()
    {
        $profile = '';
        return view('admin.profile.create', compact('profile'));
    }

}
