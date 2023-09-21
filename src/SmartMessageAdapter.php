<?php

namespace SmartMessage;

use SmartMessage\Utility\Curl;

class SmartMessageAdapter
{
    const PREFIX = "/";

    private $account;

    public function __construct(SmartMessageAccount $account)
    {
        $this->account = $account;
    }

    protected function getPrefix() {
        return self::PREFIX;
    }

    protected function httpGet($path, $headers = null) {
        $url = $this->prepareUrl($path);
        $headers = $this->prepareHeaders($headers, $path);

        return Curl::get($url, $headers);
    }

    protected function httpPost($path, $request = null, $headers = null)
    {
        $url = $this->prepareUrl($path);
        $headers = $this->prepareHeaders($headers, $path, $request);

        return Curl::post($url, $headers, $request);
    }

    protected function httpPut($path, $request, $headers = null)
    {
        $url = $this->prepareUrl($path);
        $headers = $this->prepareHeaders($headers, $path, $request);

        return Curl::put($url, $headers, $request);
    }

    protected function httpDelete($path, $headers = null)
    {
        $url = $this->prepareUrl($path);
        $headers = $this->prepareHeaders($headers, $path);

        return Curl::delete($url, $headers);
    }

    private function prepareHeaders($headers, $path, $request = null)
    {
        if ($headers == null) {
            $headers = array(
                "Accept: application/json",
                "content-type: application/json"
            );
        }
        if ($this->account->getAccessToken()) {
            $headers[] = "Authorization: Bearer {$this->account->getAccessToken()}";
        }

        return $headers;
    }

    private function prepareUrl($path)
    {
        return SmartMessage::BASE_URL.$this->getPrefix().trim($path);
    }
}
