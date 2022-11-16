<?php

namespace App\Http\Controllers;

use App\Repositories\UserApplicationRepository;
use Illuminate\Support\Facades\Route;

class DashboardController extends Controller
{
    public $userApplicationRepository;

    public function __construct(UserApplicationRepository $userApplicationRepository)
    {
        $this->userApplicationRepository = $userApplicationRepository;
    }

    public function show()
    {
        $id = Route::current()->parameter('id');
        $userApplication = $this->userApplicationRepository->findById($id);

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
