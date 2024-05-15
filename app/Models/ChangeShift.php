<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangeShift extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'email',
        'emp_name',
        'emp_no',
        'position',
        'actual_cs',
        'cs_from',
        'cs_to',
        'reason'
    ];

}
