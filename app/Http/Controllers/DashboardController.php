<?php

namespace App\Http\Controllers;

use App\Models\UserApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class DashboardController extends Controller
{
    public $id;

    public function __construct()
    {
        $this->id = Route::current()->parameter('id');
    }

    public function show()
    {
        $userApplication = UserApplication::where('user_id', $this->id)
            ->first();

        return view('dashboard', compact('userApplication'));
    }

}
