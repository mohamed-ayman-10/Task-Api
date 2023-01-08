<?php

namespace App\Http\Controllers\Api;

trait ApiResponse
{

    public function ApiResponse($status = 'Null', $data = 'Null', $msg = 'Null')
    {
        return response()->json([
            'status' => $status,
            'data' => $data,
            'msg' => $msg
        ]);
    }
}
