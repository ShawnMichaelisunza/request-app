<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Halfday extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'email',
        'emp_name',
        'emp_no',
        'position',
        'actual_hd',
        'hd_from',
        'hd_to',
        'reason'
    ];
}
