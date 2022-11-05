<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserApplication extends Model
{
    protected $table = 'user_applications';

    protected $fillable = [
        'name',
        'email',
        'telephone',
        'desired_job_title',
        'scholarity',
        'observations',
        'ip_address',
        'user_id'
    ];

    public function curriculum()
    {
        return $this->hasOne(Curriculum::class, 'applicant_id');
    }
}
