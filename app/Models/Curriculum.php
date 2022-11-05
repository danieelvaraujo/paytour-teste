<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    protected $table = 'curriculums';

    protected $fillable = [
        'name',
        'filename',
        'applicant_id'
    ];

    public function user_application(){
        return $this->belongsTo('App\Models\UserApplication');
    }
}
