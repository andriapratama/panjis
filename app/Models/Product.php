<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";
    protected $primaryKey = "id";
    protected $fillable = ['name', 'quantity', 'unit'];

    public function loan_detail()
    {
        return $this->hasMany(LoanDetail::class, "product_id", "id");
    }
}
