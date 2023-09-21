<?php

namespace SmartMessage\Services;

use SmartMessage\SmartMessageAdapter;

class CampaignService extends SmartMessageAdapter
{
    const PREFIX = "/campaign/transactional";

    protected function getPrefix()
    {
        return self::PREFIX;
    }

    public function sendSms(array $requestBody = null)
    {
        return $this->httpPost(
            "/sms/send",
            $requestBody
        );
    }
}
