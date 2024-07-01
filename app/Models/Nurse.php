<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nurse extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_perawat';
    protected $keyType = 'char';
    public $incrementing = false;

    protected $guarded = [''];

    public function getRouteKeyName()
    {
        return 'id_perawat';
    }

    public function user() {
        return $this->belongsTo(User::class, 'id');
    }
}
