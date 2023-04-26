<?php


declare(strict_types=1);

namespace Core;

class HttpClient
{
    private ?\CurlHandle $client = null;
    private ?string $url = null;
    private ?array $query = null;
    private ?string $uri = null;
    private ?string $body = null;
    private ?array $header = null;

    public static function create(): self
    {
        return new self();
    }

    public function setClient(?\CurlHandle $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function setQuery(?array $query): self
    {
        $this->query = $query;

        return $this;
    }

    public function setUri(?string $uri): self
    {
        $this->uri = $uri;

        return $this;
    }

    public function setBody(?string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function setHeader(?array $header): self
    {
        $this->header = $header;

        return $this;
    }

    public function request(string $method)
    {
        $url = $this->url ?? '' . $this->uri ?? '' . ($this->query) ? http_build_query($this->query) : '';
        $this->client = curl_init($url);

        curl_setopt($this->client, CURLOPT_HTTPHEADER, $this->header);
        curl_setopt($this->client, CURLOPT_POST, $method != 'GET');
        curl_setopt($this->client, CURLOPT_POSTFIELDS, $this->body);

        return curl_exec($this->client);
    }
}