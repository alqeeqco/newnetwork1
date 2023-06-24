<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = ['city' , 'fill_name' , 'phone' , 'email' , 'employer' , 'salary' , 'job_duration' , 'total_liabilities' , 'agree_terms'];
}
