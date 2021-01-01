<?php

/*
 *   Created on: Jan 1, 2021   11:15:26 AM
 */

namespace App\Http;

class JsonRpcResponse
{

    const JSON_RPC_VERSION = '2.0';

    public static function success($result, string $id = null)
    {
        return [
           'jsonrpc' => self::JSON_RPC_VERSION,
           'result' => $result,
           'id' => $id,
        ];
    }

    public static function error($errorMessage, $id = null, $errorCode = null)
    {
        return [
           'jsonrpc' => self::JSON_RPC_VERSION,
           'error' => [
              'message' => $errorMessage,
              /**
               * time всегда больше зарезервированных значений стандартом, 
               * по нему можно в логах искать.
               * Иначе возрващать  в рамках -32000 to -32099 и в приложении реальном их определять заранее
               */
//              'code' => $errorCode ?: time()
              'code' => $errorCode ?: rand(-32000, -32099)
           ],
           'id' => $id,
        ];
    }

}
