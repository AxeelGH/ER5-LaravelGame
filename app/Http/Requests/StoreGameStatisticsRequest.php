<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class StoreGameStatisticsRequest extends FormRequest
{
    public function authorize(): bool
    {
        Log::info('Data test');
        return true;
    }

    public function rules(): array
    {
        Log::info('array');
        return [
            'session_id' => 'required|uuid',
            'player_id' => 'required|integer',
            'started_at' => 'required|date',
            'finished_at' => 'required|date',
            'result' => 'required|string',
            'final_score' => 'required|integer',
            'level_reached' => 'required|integer',
            'enemies_killed' => 'required|integer',
            'damage_done' => 'required|integer',
            'damage_taken' => 'required|integer',
            'successful_retreats' => 'required|integer',
            'failed_retreats' => 'required|integer',
        ];
    }
}