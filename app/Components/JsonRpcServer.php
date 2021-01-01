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
use Illuminate\Support\Arr;

class JsonRpcServer
{

    public function handle(Request $request, Controller $controller)
    {
        $errorCode = null;
        
        /**
         * на случай если будет ошибка в парсинге
         */
        $contentId = null;
        
        try
        {
            $content = json_decode($request->getContent(), true);

            if (empty($content)) {

                /**
                 * Согласно спецификации
                 */
                $errorCode = -32700;
                throw new Exception('Parse error json-rpc request', 500);
            }


            $contentId = Arr::get($content, 'id');

            $methodName = str_replace('.', '_', $content['method']);


            $result = $controller->{$methodName}(...[$content['params']]);

            return JsonRpcResponse::success($result, $contentId);
        }
        catch (Exception $e)
        {
            return JsonRpcResponse::error($e->getMessage(), $contentId,
                        $errorCode);
        }
    }

}
