<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poly extends Model
{
    use HasFactory;

    protected $fillable = ['id_poli', 'nama_poli'];

    protected $primaryKey = 'id_poli';
    protected $keyType = 'char';
    public $incrementing = false;

    public function doctor()
    {
        return $this->hasMany(Doctor::class, 'id_poli');
    }

    public function queue()
    {
        return $this->hasMany(Queue::class, 'id_poli');
    }

    public function medicalRecord()
    {
        return $this->hasMany(MedicalRecord::class, 'id_poli');
    }
}