<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_rekmed';
    protected $guarded = ['id_rekmed'];

    public function getRouteKeyName()
    {
        return 'id_rekmed';
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'id_pasien');
    }

    public function poly()
    {
        return $this->belongsTo(Poly::class, 'id_poli');
    }

    public function doctor()
    {
         return $this->belongsTo(Doctor::class, 'id_dokter');
    }

    public function getCreatedAtAtAttribute($value)
    {
        return $this->patient ? $this->patient->created_at : $value;
    }

    public function getUpdatedAtAttribute($value)
    {
        return $this->patient ? $this->patient->updated_at : $value;
    }

}