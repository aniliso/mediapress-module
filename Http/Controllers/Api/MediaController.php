<?php

namespace Modules\Mediapress\Http\Controllers\Api;

use Embed\Embed;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class MediaController extends Controller
{
    public function video(Request $request)
    {
        try {
            $info = Embed::create($request->get('video'));
            $info = [
                'image' => $info->getImage(),
                'video' => $info->getCode()
            ];
            return response()->json([
                'success' => true,
                'data'    => $info
            ], Response::HTTP_OK);
        }
        catch (\Exception $exception)
        {
            return response()->json([
                'success' => true,
                'message' => $exception->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
