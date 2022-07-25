<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Product;

class LoanDetail extends Model
{
    use HasFactory;

    protected $table = "loan_details";
    protected $primaryKey = "id";
    protected $fillable = ['loan_id', 'product_id', 'quantity'];

    public function product()
    {
        return $this->belongsTo(Product::class, "product_id", "id");
    }
}
