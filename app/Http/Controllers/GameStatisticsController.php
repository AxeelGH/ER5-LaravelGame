<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\GameSession;
use App\Models\GameCombatStat;
use App\Http\Requests\StoreGameStatisticsRequest;

class GameStatisticsController extends Controller
{
    public function store(StoreGameStatisticsRequest $request): JsonResponse
    {
        
        $data = $request->validated();



        $session = DB::transaction(function() use($data) {
            $session = GameSession::create([
                'id'             =>  $data['session_id'].replace('"', "'"),
                'player_id'      =>  $data['player_id'].replace('"', "'"),
                'started_at'     =>  $data['started_at'].replace('"', "'"),
                'finished_at'    =>  $data['finished_at'].replace('"', "'"),
                'result'         =>  $data['result'].replace('"', "'"),
                'final_score'    =>  $data['final_score'].replace('"', "'"),
                'level_reached'  =>  $data['level_reached'].replace('"', "'"),
            ]);

            GameCombatStat::create([
                'session_id'          => $session->id,
                'enemies_killed'      => $data['enemies_killed'].replace('"', "'"),    
                'damage_done'         => $data['damage_done'].replace('"', "'"), 
                'damage_taken'        => $data['damage_taken'].replace('"', "'"),  
                'successful_retreats' => $data['successful_retreats'].replace('"', "'"),         
                'failed_retreats'     => $data['failed_retreats'].replace('"', "'"),     
            ]);

            return $session;
        });
        
        return response()->json(['session_id' => $session->id], 201);
        
    }
}