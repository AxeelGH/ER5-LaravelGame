<?php
namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\GameSession;
use App\Http\Requests\StoreGameStatisticsRequest;

class GameStatisticsController extends Controller
{
    public function store(StoreGameStatisticsRequest $request): JsonResponse
    {
        $data = $request->validated();

        try {
            $session = DB::transaction(function () use ($data) {

                $sessionId = (string) $data['session_id'];

                $session = GameSession::create([
                    'id'            => $sessionId,
                    'player_id'     => $data['player_id'],
                    'started_at'    => $data['started_at'],
                    'finished_at'   => $data['finished_at'],
                    'result'        => $data['result'],
                    'final_score'   => $data['final_score'],
                    'level_reached' => $data['level_reached'],
                ]);


                $session->combatStats()->create([
                    'enemies_killed'      => $data['enemies_killed'],
                    'damage_done'         => $data['damage_done'],
                    'damage_taken'        => $data['damage_taken'],
                    'successful_retreats' => $data['successful_retreats'],
                    'failed_retreats'     => $data['failed_retreats'],
                ]);

                return $session;
            });

            return response()->json(['session_id' => $session->id], 201);

        } catch (\Throwable $e) {
            Log::error('Failed to store game stats', [
                'error'   => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'trace'   => $e->getTraceAsString()
            ]);

            return response()->json([
                'message' => 'Error al guardar las estadísticas de la partida.',
                'detail'  => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }
}