<?php

namespace SmartMessage;

class SmartMessageResponse
{
    private $success;

    private $code;

    private $message;

    private $data;

    public function __construct(
        $success,
        $code,
        $message,
        $data
    )
    {
        $this->success = $success;
        $this->code = $code;
        $this->message = $message;
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function isSuccess()
    {
        return $this->success;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    public function find($key)
    {
        if (is_array($this->data)) {
            if (isset($this->data[$key])) {
                return $this->data[$key];
            } else {
                return null;
            }
        }
        return null;
    }
}