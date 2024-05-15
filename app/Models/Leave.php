<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'email',
        'emp_name',
        'emp_no',
        'position',
        'status_leave',
        'l_from',
        'l_to',
        'reason'
    ];
}
