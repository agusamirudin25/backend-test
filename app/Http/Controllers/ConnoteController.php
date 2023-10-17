<?php

namespace App\Http\Controllers;

use App\Models\Connote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ConnoteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try {
            $data = Connote::query()
            ->paginate(10);
            return response()->json([
                'status' => true,
                'message' => 'Success get connotes',
                'connotes' => $data
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 400);
        }
    }
}
