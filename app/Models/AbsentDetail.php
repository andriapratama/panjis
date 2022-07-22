<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsentDetail extends Model
{
    use HasFactory;

    protected $table = "absent_details";
    protected $primaryKey = "id";
    protected $fillable = ['absent_id', 'member_id', 'status'];

    public function absent()
    {
        return $this->belongsTo(Absent::class, "absent_id", "id");
    }

    public function member()
    {
        return $this->belongsTo(Member::class, "member_id", "id");
    }
}
