<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SPP extends Model
{
    use HasFactory;
    protected $table='spp';
    protected $primaryKey='id';
    protected $fillable = [
        'tahun',
        'nominal',

    ];

    //relasi dengan data siswa
    public function siswas()
    {
        return $this->hasMany(Student::class);
    }
}
