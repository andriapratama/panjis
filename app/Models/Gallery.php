<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $table = "galleries";
    protected $primaryKey = "id";
    protected $fillable = ["title", "desc"];

    public function gallery_detail()
    {
        return $this->hasMany(GalleryDetail::class, "gallery_id", "id");
    }
}
