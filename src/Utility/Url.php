<?php

namespace SmartMessage\Utility;

class Url
{
    public static function generate($prefix, $endpoint, array $params = null)
    {
        $url = $prefix.$endpoint;
        if ($params) {
            $url .= Url::queryBuilder($params);
        }
        return $url;
    }

    public static function queryBuilder(array $params = null)
    {
        if ($params == null) {
            return '';
        }
        return '?' . str_replace('+', '%20', http_build_query($params));
    }
}
