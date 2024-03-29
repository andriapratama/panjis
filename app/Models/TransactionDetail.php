<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $table = "transaction_details";
    protected $primaryKey = "id";
    protected $fillable = ["transaction_id", "name", "sub_total"];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, "transaction_id", "id");
    }
}
