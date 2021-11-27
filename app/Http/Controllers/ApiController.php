<?php

namespace App\Http\Controllers;

class ApiController extends Controller
{

    /**
     * responseError: response error msg and error code
     *
     * @param mixed $msg
     * @param mixed $statusCode
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseError($msg = "", $statusCode = 404)
    {
        return response()->json(["msg" => $msg], $statusCode);
    }

    /**
     * responseSuccess: response success msg and success code
     *
     * @param mixed $msg
     * @param mixed $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseSuccess($msg = "", $statusCode = 200)
    {
        return response()->json(["msg" => $msg], $statusCode);
    }
}
