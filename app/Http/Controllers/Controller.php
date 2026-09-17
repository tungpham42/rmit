<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

/**
 * Shared JSON response helpers so every controller returns a consistent envelope
 * without repeating response()->json(...) boilerplate (DRY).
 */
abstract class Controller
{
    protected function ok(mixed $data = null, int $status = 200): JsonResponse
    {
        return response()->json(['data' => $data], $status);
    }

    protected function created(mixed $data = null): JsonResponse
    {
        return $this->ok($data, 201);
    }

    protected function noContent(): JsonResponse
    {
        return response()->json(null, 204);
    }
}
