<?php

/*
 *   Created on: Dec 31, 2020   11:04:32 AM
 */

namespace App\Components;

;

use App\Http\JsonRpcResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class JsonRpcServer
{

    public function handle(Request $request, Controller $controller)
    {



        try
        {
            $content = json_decode($request->getContent(), true);



            if (empty($content)) {

                throw new Exception('Parse error json-rpc request', 500);
            }

            $methodName = str_replace('.', '_', $content['method']);

            $result = $controller->{$methodName}(...[$content['params']]);

            return JsonRpcResponse::success($result, $content['id']);
        }
        catch (Exception $e)
        {
            return JsonRpcResponse::error($e->getMessage());
        }
    }

}
