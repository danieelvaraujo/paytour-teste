<?php

namespace App\Http\Controllers;

use App\Mail\SuccessApplication;
use App\Models\Curriculum;
use App\Models\UserApplication;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use Symfony\Component\HttpFoundation\Response;

class UserApplicationController extends Controller
{
    public function show()
    {
        return view('send-application');
    }

    public function send(Request $request)
    {

        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'telephone' => 'required',
            'desired_job_title' => 'required|string',
            'scholarity' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'desired_job_title' => $request->desired_job_title,
            'scholarity' => $request->scholarity,
            'observations' => $request->observations,
            'ip_address' => $request->ip(),
            'user_id' => $request->user_id
        ];

        $application = UserApplication::create($data);

        if ($request->file()) {
            $this->upload($request);
        }

        Mail::to($request->email)->send(new SuccessApplication($application));

        return response()->json([
            'success' => true,
            'message' => 'Application sended sucessfully',
            'data' => $application
        ], Response::HTTP_OK);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'mimes:doc,docx,pdf|max:1024',
        ]);

        $filename = $request->file('file')->getClientOriginalName();
        $request->file('file')->storeAs('curriculums', $filename);

        if (!isset($request->applicant_id)) {
            $applicant = UserApplication::where('email', $request->email)->first();
        }

        $curriculum = Curriculum::create([
            'name' => $request->name,
            'filename' => $filename,
            'applicant_id' => $request->applicant_id ?? $applicant->id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Curriculum saved sucessfully',
            'data' => $curriculum
        ], Response::HTTP_OK);
    }
}
