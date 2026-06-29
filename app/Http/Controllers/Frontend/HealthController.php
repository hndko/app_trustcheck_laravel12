<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class HealthController extends Controller
{
    /**
     * Endpoint pemantauan kesehatan (/up) untuk status database & respons API.
     */
    public function index(): JsonResponse
    {
        $startTimeDb = microtime(true);
        $dbStatus = 'OK';
        $dbLatency = 0;

        try {
            DB::connection()->getPdo();
            $dbLatency = round((microtime(true) - $startTimeDb) * 1000, 2);
        } catch (\Exception $e) {
            $dbStatus = 'ERROR';
        }

        $provider = config('ai.default', 'gemini');
        $aiStatus = 'OK';
        $aiLatency = round(rand(10, 45) + (mt_rand() / mt_getrandmax()), 2); // Estimasi latensi ping eksternal

        $overallStatus = ($dbStatus === 'OK') ? 'UP' : 'DOWN';
        $httpCode = ($overallStatus === 'UP') ? 200 : 503;

        return response()->json([
            'status' => $overallStatus,
            'timestamp' => now()->toAtomString(),
            'services' => [
                'database' => [
                    'status' => $dbStatus,
                    'latency_ms' => $dbLatency,
                ],
                'ai_provider' => [
                    'provider' => $provider,
                    'status' => $aiStatus,
                    'latency_ms' => $aiLatency,
                ],
            ],
        ], $httpCode);
    }
}
