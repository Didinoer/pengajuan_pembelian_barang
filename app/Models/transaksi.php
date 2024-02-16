<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';

    public function transaksi_item(){
        return $this ->hasMany(transaksi_item::class, 'id_transaksi', 'id');
    }
    public function User(){
        return $this ->belongsTo(User::class, 'user_id', 'id');
    }
}
