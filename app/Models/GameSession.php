<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\GameCombatStat;
use Illuminate\Support\Str;

class GameSession extends Model
{
    const CREATED_AT = 'created_at';
    const UPDATED_AT = null;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'player_id',
        'started_at',
        'finished_at',
        'result',
        'final_score',
        'level_reached',
    ];

    protected $casts = [
        'started_at'  => 'datetime',
        'finished_at' => 'datetime',
        'final_score' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(User::class, 'player_id');
    }

    public function combatStats(): HasOne{

        return $this->hasOne(GameCombatStat::class, 'session_id');
    }


}