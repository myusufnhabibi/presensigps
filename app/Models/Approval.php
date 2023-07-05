<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;
    protected $table = 'pengajuan_izin';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nik',
        'izin',
        'tgl_izin',
        'keterangan',
        'status'
    ];
}
