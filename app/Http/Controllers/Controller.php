<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sendResponse($notif, $msg, $data = NULL, $code = NULL)
    {
        return response()->json([
            'notif' => $notif,
            'message' => $msg,
            'data' => $data,
            'code' => $code,
        ]);
    }
}
