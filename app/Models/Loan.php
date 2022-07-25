<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $table = "loans";
    protected $primaryKey = "id";
    protected $fillable = ['humas_name', 'name', 'address', 'phone', 'start_date', 'end_date', 'status'];
}
