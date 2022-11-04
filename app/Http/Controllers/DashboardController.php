<?php

namespace App\Http\Controllers;

use App\Models\UserApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class DashboardController extends Controller
{
    public UserApplication $userApplication;

    public function __construct()
    {
        $id = Route::current()->parameter('id');
        $this->userApplication = UserApplication::where('user_id', $id)->first();
    }

    public function show($id)
    {
        return view('dashboard', compact($this->userApplication));
    }

}
