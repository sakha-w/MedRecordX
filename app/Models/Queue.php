<?php

namespace App\Models;

use App\Models\Poly;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Queue extends Model
{
    use HasFactory;

    protected $guarded = ['id_antrian'];
    protected $primaryKey = 'id_antrian';

    protected $with = ['patient', 'poly'];

    public function getRouteKeyName()
    {
        return 'id_antrian';
    }

    public function patient() {
        return $this->belongsTo(Patient::class, 'id_pasien');
    }

    public function poly() {
        return $this->belongsTo(Poly::class, 'id_poli');
    }
}
