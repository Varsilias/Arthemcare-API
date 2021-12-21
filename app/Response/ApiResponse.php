<?php

namespace App\Response;


class ApiResponse {


    public function successResponse($data, ?String $message = '')
    {
        if ($message) {
            return response()->json([
                'status' => 'OK',
                'error' => false,
                'message' => $message,
                'data' => $data
            ]);
        }

        return response()->json([
                'status' => 'OK',
                'error' => false,
                'data' => $data
        ]);

    }

}
