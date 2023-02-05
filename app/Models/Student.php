<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table='student';
    protected $primaryKey='id';
    protected $fillable = [
        'nisn',
        'nis',
        'nama',
        'id_kelas',
        'email',
        'alamat',
        'no_telp',
        'id_spp',

    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function spps()
    {
        return $this->belongsTo(SPP::class);
    }
}
