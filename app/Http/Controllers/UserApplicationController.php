<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use App\Models\UserApplication;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserApplicationController extends Controller
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

        $application = UserApplication::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Application sended sucessfully',
            'data' => $application
        ], Response::HTTP_OK);
    }

    public function upload(Request $request)
    {
        $filename = $request->file('file')->getClientOriginalName();
        $request->file('file')->storeAs('curriculums', $filename);

        $curriculum = Curriculum::create([
            'name' => $request->name,
            'filename' => $filename,
            'applicant_id' => $request->applicant_id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Curriculum saved sucessfully',
            'data' => $curriculum
        ], Response::HTTP_OK);
    }
}
