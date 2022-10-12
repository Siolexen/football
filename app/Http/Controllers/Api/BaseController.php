<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Facades\Response;

class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result)
    {
        $response = $result;

        return response()->json($response, 200);
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponseCode($code = 204)
    {
        return Response::noContent($code);
    }

    /**
     * success response full method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendFullResponse($message, $code = 200, $data = null)
    {
        $response = [
            'code'    => $code,
            'status'  => 'success',
            'message' => $message,
        ];

        if (isset($data) && !empty($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, $code);
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $code = 404, $errors = [])
    {
        $response = [
            'code'    => $code,
            'status'  => 'error',
            'message' => $error,
        ];

        if (!empty($errors)) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $code);
    }
}
