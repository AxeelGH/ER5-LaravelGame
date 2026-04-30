<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GameCombatStat extends Model
{
    protected $primaryKey = 'session_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'session_id',
        'enemies_killed',
        'damage_done',
        'damage_taken',
        'succesful_retreats',
        'failed_retreats',
    ];

    protected $casts = [
        'enemies_killed'       => 'integer',
        'damage_done'          => 'integer',
        'damage_taken'         => 'integer',
        'succesful_retreats'   => 'integer',
        'failed_retreats'      => 'integer',
    ];

    public function session(): BelongsTo
    {
        return $this->belongsTo(GameSession::class, 'session_id');
    }
}