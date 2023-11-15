<?php

namespace core\http;

class Response
{

    private string $content;

    private int $resultCode;

    /**
     * @param string $content
     * @param int $resultCode
     */
    public function __construct(string $content, int $resultCode)
    {
        $this->content    = $content;
        $this->resultCode = $resultCode;
    }

    public function send(): void
    {
        header(sprintf('HTTP/1.1 %d %s', $this->resultCode, $this->getResultHeader()));

        echo $this->content;
    }

    private function getResultHeader(): string
    {
        $headers = [
            200 => 'Ok',
            404 => 'Not Found'
        ];

        return $headers[$this->resultCode] ?: 'Unknown';
    }
}
