<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CurriculumController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'telephone' => 'required',
            'desired_job_title' => 'required|string',
            'scholarity' => 'required',
        ]);

        $curriculum = Curriculum::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Curriculum created sucessfully',
            'data' => $curriculum
        ], Response::HTTP_OK);
    }
}
