<?php

namespace App\Http\Controllers;

use App\Models\UserApplication;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public UserApplication $userApplication;

    public function __construct($id)
    {
        $this->userApplication = UserApplication::where('user_id', $id)->first();
    }

    public function show()
    {
        return view('dashboard', compact($this->userApplication));
    }

}
