<?php

namespace App\Http\Controllers;

use App\Models\UserApplication;
use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;
class UpdateApplicationController extends Controller
{
    public function show()
    {
        return view('update-application');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'min:3',
            'telephone' => 'integer',
            'desired_job_title' => 'string'
        ]);

        $updated = UserApplication::find($id);

        $updated->name = $request->name ?? $updated->name;
        $updated->email = $updated->email;
        $updated->telephone = $request->telephone ?? $updated->telephone;
        $updated->desired_job_title = $request->desired_job_title ?? $updated->desired_job_title;
        $updated->scholarity = $request->scholarity ?? $updated->scholarity;
        $updated->observations = $request->observations  ?? $updated->observations;
        $updated->ip_address = $updated->ip_address;
        $updated->user_id = $updated->user_id;

        $updated->save();

        return response()->json([
            'success' => true,
            'message' => 'User application updated.',
            'data' => $updated
        ], Response::HTTP_OK);
    }
}
