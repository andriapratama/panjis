<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryDetail extends Model
{
    use HasFactory;

    protected $table = "gallery_detail";
    protected $primaryKey = "id";
    protected $fillable = ["gallery_id", "name", 'path'];
}
