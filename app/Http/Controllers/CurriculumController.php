<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    public function send(Request $request)
    {
        $data = $request->validate([
            'name' => 'bail|required|min:3',
            'email' => 'bail|required|email',
            'telephone' => 'required',
            'desired_job_title' => 'bail|required|string',
            'scholarity' => 'required',
            'observations' => 'string',
        ]);

        $curriculum = Curriculum::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Curriculum created sucessfully',
            'data' => $curriculum
        ], Response::HTTP_OK);
    }
}
