<?php

namespace App\Http\Controllers;

use App\Models\UserApplication;
use Illuminate\Support\Facades\Route;

class DashboardController extends Controller
{
    public $id;
    public $userApplication;

    public function __construct()
    {
        $id = Route::current()->parameter('id');
        $this->userApplication = UserApplication::where('user_id', $id)->first();
    }

    public function show()
    {
        $userApplication = $this->userApplication;

        return view('dashboard', compact('userApplication'));
    }

    public function download()
    {
        $file = $this->userApplication->curriculum()->first()->filename;
        return response()->download(
            storage_path('/app/curriculums/'. $file)
        );
    }
}
