<?php

namespace SmartMessage\Utility;

use SmartMessage\SmartMessageResponse;

class Curl
{
    const READ_TIMEOUT = 150;
    const CONNECT_TIMEOUT = 15;

    public static function get($url, array $headers)
    {
        return self::request($url, array(
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_CONNECTTIMEOUT => self::CONNECT_TIMEOUT,
            CURLOPT_TIMEOUT => self::READ_TIMEOUT,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
        ));
    }

    public static function post($url, array $headers, $content)
    {
        return self::request($url, array(
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_CONNECTTIMEOUT => self::CONNECT_TIMEOUT,
            CURLOPT_TIMEOUT => self::READ_TIMEOUT,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POSTFIELDS => $content ? json_encode($content) : '',
        ));
    }

    public static function put($url, array $headers, $content)
    {
        return self::request($url, array(
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_CONNECTTIMEOUT => self::CONNECT_TIMEOUT,
            CURLOPT_TIMEOUT => self::READ_TIMEOUT,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POSTFIELDS => json_encode($content),
        ));
    }

    public static function delete($url, array $headers)
    {
        return self::request($url, array(
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_CONNECTTIMEOUT => self::CONNECT_TIMEOUT,
            CURLOPT_TIMEOUT => self::READ_TIMEOUT,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
        ));
    }

    private static function request($url, $options)
    {
        try {
            $request = curl_init($url);
            curl_setopt_array($request, $options);
            $data = curl_exec($request);
            if ($data === false) {
                throw new \Exception(curl_error($request), curl_errno($request));
            }
            curl_close($request);

            $response = new SmartMessageResponse(
                true,
                200,
                null,
                json_decode($data, true)
            );
        } catch (\Exception $exception) {
            $response = new SmartMessageResponse(
                false,
                $exception->getCode(),
                $exception->getMessage(),
                []
            );
        }
        return $response;
    }
}
