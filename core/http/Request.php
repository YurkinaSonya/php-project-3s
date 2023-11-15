<?php

namespace core\http;

class Request
{

    private array $headers;

    private string $method;

    private string $requestUri;
    private string $url;

    private array $query;

    private string $body;

    /**
     * @param array $headers
     * @param string $method
     * @param string $requestUri
     * @param array $query
     * @param string $body
     */
    public function __construct(array $headers, string $method, string $requestUri, array $query, string $body)
    {
        $this->headers = $headers;
        $this->method = strtoupper($method);
        $this->requestUri = $requestUri;
        $this->url = parse_url($requestUri, PHP_URL_PATH);
        $this->query = $query;
        $this->body = $body;
    }


    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getRequestUri(): string
    {
        return $this->requestUri;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getQuery(): array
    {
        return $this->query;
    }

    public function getQueryParam(string $name, mixed $default = null): mixed
    {
        if (!array_key_exists($name, $this->query)) {
            return $default;
        }
        return $this->query[$name];
    }

    public function getBody(): string
    {
        return $this->body;
    }


}
