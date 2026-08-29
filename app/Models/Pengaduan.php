<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Permission\Models\Role;

class Pengaduan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'role_id',
        'nomor_pengaduan',
        'isi_pengaduan',
        'foto',
        'status',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'role_id' => 'integer',
        'nomor_pengaduan' => 'string',
        'isi_pengaduan' => 'string',
        'foto' => 'string',
        'status' => 'string',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
