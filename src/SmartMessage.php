<?php

namespace SmartMessage;

use SmartMessage\Services\AuthenticateService;
use SmartMessage\Services\CampaignService;

class SmartMessage
{
    const BASE_URL = "https://api.smartmessage.com";

    private $account;

    public function __construct(array $options)
    {
        $this->setAccount($options);
    }

    private function setAccount($options)
    {
        $this->account = new SmartMessageAccount($options);
        if ($this->account->getAccessToken() == null) {
            $response = $this->authenticate()->login($options);
            if ($response->isSuccess()) {
                $this->account->setAccessToken($response->find('accessToken'));
            }
        }
    }

    public function authenticate()
    {
        return new AuthenticateService($this->account);
    }

    public function campaign()
    {
        return new CampaignService($this->account);
    }
}
