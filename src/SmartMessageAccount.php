<?php

namespace SmartMessage;

class SmartMessageAccount
{
    private $email;

    private $password;

    private $clientId;

    private $clientSecret;

    private $accessToken;

    public function __construct(array $options = null)
    {
        if ($options != null) {
            isset($options['email']) && $this->email = $options['email'];
            isset($options['password']) && $this->password = $options['password'];
            isset($options['clientId']) && $this->clientId = $options['clientId'];
            isset($options['clientSecret']) && $this->clientSecret = $options['clientSecret'];
            isset($options['accessToken']) && $this->accessToken = $options['accessToken'];
        }
    }

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param mixed $accessToken
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }
}