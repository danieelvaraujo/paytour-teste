<?php

namespace App\Repositories;

use App\Models\UserApplication;

class UserApplicationRepository
{
    public function findById($id)
    {
        $application = UserApplication::where('id', $id)->first();

        return $application;
    }
}
