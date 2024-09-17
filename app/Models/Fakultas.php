<?php

namespace App\Models;

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProdiController;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'nama'
    ];

    public function prodi()
    {
        return $this->belongsTo(ProdiController::class, 'id');
    }
}
