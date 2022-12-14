<?php

namespace App\Http\Controllers;

use App\Mail\SuccessApplication;
use App\Models\Curriculum;
use App\Models\Scholarity;
use App\Models\UserApplication;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use Symfony\Component\HttpFoundation\Response;

class UserApplicationController extends Controller
{
    public $rules = [
        'name' => 'required|min:3|max:32',
        'email' => 'required|email',
        'telephone' => 'required|min:10|max:11',
        'desired_job_title' => 'required|string',
        'scholarity' => 'required',
    ];

    public function show()
    {
        $scholarities = Scholarity::get();

        return view('send-application', compact('scholarities'));
    }

    public function send(Request $request)
    {
        $request->validate($this->rules);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'desired_job_title' => $request->desired_job_title,
            'scholarity' => $request->scholarity,
            'observations' => $request->observations,
            'ip_address' => $request->ip(),
            'user_id' => Auth::user()->id
        ];

        $application = UserApplication::create($data);

        if ($request->file()) {
            $this->upload($request);
        }

        Mail::to($request->email)->send(new SuccessApplication($application));

        return redirect()->to('dashboard/' . $application->id)->with('success', 'Aplicação enviada com sucesso.');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'mimes:doc,docx,pdf|max:1024',
        ]);

        $application = UserApplication::where('email', Auth::user()->email)->first();

        $filename = str_replace(' ', '-', strtolower(Auth::user()->name)) . '-cv.';
        $extension = $request->file('file')->getClientOriginalExtension();
        $fileToUpload = $filename . $extension;

        $request->file('file')->storeAs('curriculums', $fileToUpload);

        Curriculum::create([
            'name' => Auth::user()->name,
            'filename' => $fileToUpload,
            'applicant_id' => $application->id
        ]);

        return redirect()->to('dashboard/' . $application->id)->with('success', 'Currículo enviado com sucesso.');
    }
}
