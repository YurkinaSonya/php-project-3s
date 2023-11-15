<?php

namespace core\http;

class Response
{

    private string $content;

    private int $resultCode;

    private array $headers = [];

    /**
     * @param string $content
     * @param int $resultCode
     */
    public function __construct(string $content, int $resultCode)
    {
        $this->content = $content;
        $this->resultCode = $resultCode;
    }

    public function send(): void
    {
        header(
            sprintf('HTTP/1.1 %d %s', $this->resultCode, $this->getResultHeader()),
            true,
            $this->resultCode
        );
        foreach ($this->headers as $headerName => $headerValue) {
            header($headerName . ': ' . $headerValue);
        }

        echo $this->content;
    }

    public function addHeader(string $name, mixed $value): void
    {
        $this->headers[$name] = $value;
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
