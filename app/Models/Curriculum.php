<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    protected $table = 'curriculums';

    protected $fillable = [
        'name',
        'email',
        'telephone',
        'desired_job_title',
        'scholarity',
        'observations',
    ];
}
