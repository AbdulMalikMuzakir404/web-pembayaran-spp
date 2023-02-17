<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nisn',
        'tgl_dibayar',
        'bln_dibayar',
        'thn_dibayar',
        'jumlah_bayar',
        'spp_id',
        'user_id',
        'status_pembayaran'
    ];

    protected $hidden = [
        'user_id',
    ];
}