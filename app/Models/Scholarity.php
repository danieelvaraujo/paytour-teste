<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scholarity extends Model
{
    protected $table = 'scholarity';

    protected $fillable = [
        'title',
        'value',
    ];
}
