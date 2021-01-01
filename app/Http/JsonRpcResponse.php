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
            'result'  => $result,
            'id'      => $id,
        ];
    }

    public static function error($error)
    {
        return [
            'jsonrpc' => self::JSON_RPC_VERSION,
            'error'  => $error,
            'id'      => null,
        ];
    }
}