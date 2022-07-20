<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = "transactions";
    protected $primaryKey = "id";
    protected $fillable = ["user_id", "title", "status", "total"];

    public function transaction_detail()
    {
        return $this->hasMany(TransactionDetail::class, "transaction_id", "id");
    }
}
