<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Doctor extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_dokter';
    protected $keyType = 'char';
    public $incrementing = false;

    protected $guarded = [''];
    protected $with = ['poly'];

    public function getRouteKeyName()
    {
        return 'id_dokter';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function poly()
    {
        return $this->belongsTo(Poly::class, 'id_poli');
    }

    public function medicalRecord()
    {
        return $this->hasMany(MedicalRecord::class, 'id_dokter');
    }
}