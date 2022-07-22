<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absent extends Model
{
    use HasFactory;

    protected $table = "absents";
    protected $primaryKey = "id";
    protected $fillable = ['title', 'total'];

    public function absent_detail()
    {
        return $this->hasMany(AbsentDetail::class, "absent_id", "id");
    }
}
