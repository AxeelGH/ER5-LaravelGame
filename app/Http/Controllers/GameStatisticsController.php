<?php
namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\GameSession;
use App\Http\Requests\StoreGameStatisticsRequest;
use App\Models\GameCombatStat;

class GameStatisticsController extends Controller
{
public function store(StoreGameStatisticsRequest $request): JsonResponse
{
    $data = $request->validated();

    try {
        $session = DB::transaction(function () use ($data) {

            $session = GameSession::create([
                'id'            => (string) $data['session_id'],
                'player_id'     => $data['player_id'],
                'started_at'    => $data['started_at'],
                'finished_at'   => $data['finished_at'],
                'result'        => $data['result'],
                'final_score'   => $data['final_score'],
                'level_reached' => $data['level_reached'],
            ]);

            GameCombatStat::create([
                'session_id'          => $session->id,
                'enemies_killed'      => $data['enemies_killed'],
                'damage_done'         => $data['damage_done'],
                'damage_taken'        => $data['damage_taken'],
                'successful_retreats' => $data['successful_retreats'],
                'failed_retreats'     => $data['failed_retreats'],
            ]);

            return $session;
        });

        return response()->json([
            'success' => true,
            'session_id' => $session->id
        ], 201);

    } catch (\Throwable $e) {

        return response()->json([
            'success' => false,
            'message' => 'SESSION ERROR',
            'error' => $e->getMessage()
        ], 500);
    }
}
}