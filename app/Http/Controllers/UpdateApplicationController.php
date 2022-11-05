<?php

namespace App\Http\Controllers;

use App\Models\Scholarity;
use App\Models\UserApplication;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Symfony\Component\HttpFoundation\Response;
class UpdateApplicationController extends Controller
{
    public UserApplication $applicationToUpdate;
    public $scholarities;

    public function __construct()
    {

        $id = Route::current()->parameter('id');

        $this->scholarities = Scholarity::get();
        $this->applicationToUpdate = UserApplication::find($id);
    }

    public function show()
    {
        $application = $this->applicationToUpdate;
        $scholarities = $this->scholarities;
        return view('update-application', compact('application', 'scholarities'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'min:3',
            'telephone' => 'integer',
            'desired_job_title' => 'string'
        ]);

        $this->applicationToUpdate->name = $request->name ?? $this->applicationToUpdate->name;
        $this->applicationToUpdate->email = $this->applicationToUpdate->email;
        $this->applicationToUpdate->telephone = $request->telephone ?? $this->applicationToUpdate->telephone;
        $this->applicationToUpdate->desired_job_title = $request->desired_job_title ?? $this->applicationToUpdate->desired_job_title;
        $this->applicationToUpdate->scholarity = $request->scholarity ?? $this->applicationToUpdate->scholarity;
        $this->applicationToUpdate->observations = $request->observations  ?? $this->applicationToUpdate->observations;
        $this->applicationToUpdate->ip_address = $this->applicationToUpdate->ip_address;
        $this->applicationToUpdate->user_id = $this->applicationToUpdate->user_id;

        $this->applicationToUpdate->save();

        return response()->json([
            'success' => true,
            'message' => 'User application this->applicationToUpdate.',
            'data' => $this->applicationToUpdate
        ], Response::HTTP_OK);
    }
}
