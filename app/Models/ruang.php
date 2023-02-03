<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ruang extends Model
{
    use HasFactory;

    protected $fillable = [
      'nama_kelas',
      'kopetensi_keahlian'
    ];
}