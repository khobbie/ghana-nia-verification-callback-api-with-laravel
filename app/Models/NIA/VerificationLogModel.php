<?php

namespace App\Models\NIA;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationLogModel extends Model
{
    use HasFactory;

    protected $table = 'nia_callback';

    protected $primaryKey = 'transactionGuid';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $casts = [
        '_person' => 'array',
        '_addresses' => 'array',
        '_contacts' => 'array',
        '_occupations' => 'array',
        '_biometricFeed' => 'array',
        '_binaries' => 'array',
    ];
    // pro

}