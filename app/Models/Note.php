<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $table = "notes";
    protected $primaryKey = "id";
    protected $fillable = ['date', 'title', 'total_member'];

    public function note_detail()
    {
        return $this->hasMany(NoteDetail::class, "note_id", "id");
    }
}
