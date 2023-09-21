<?php

namespace SmartMessage\Services;

use SmartMessage\SmartMessageAdapter;

class AuthenticateService extends SmartMessageAdapter
{
    const PREFIX = "/identityapi/openId";

    protected function getPrefix()
    {
        return self::PREFIX;
    }

    public function login(array $requestBody = null)
    {
        return $this->httpPost(
            "/user/authenticate",
            $requestBody
        );
    }
}
