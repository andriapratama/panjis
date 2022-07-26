<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteDetail extends Model
{
    use HasFactory;

    protected $table = "note_details";
    protected $primaryKey = "id";
    protected $fillable = ['note_id', 'content', 'status'];
}
