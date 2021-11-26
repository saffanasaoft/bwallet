<?php

namespace Digitcode\Bwallet;

use Digitcode\Bwallet\Exceptions\BwalletException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class BwalletClient {

    protected $client, $url, $body;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->body = [
            'username' => config('bwallet.username'),
        ];
    }

    public function setUrl(string $url)
    {
        $this->url = $url;
        return $this;
    }

    public function setBody(array $body)
    {
        $this->body = array_merge($this->body, $body);
        return $this;
    }

    protected function url()
    {
        return config('bwallet.base_url') . $this->url;
    }

    protected function options()
    {
        return ['json' => $this->body];
    }

    public function run()
    {
        try {
            $requestContent = [
                'headers' => [
                    'Accept'        => 'application/json',
                    'Content-Type'  => 'application/json',
                ],
                $this->options()
            ];

            $response = $this->client->post($this->url(), $requestContent);

        } catch (RequestException $ex) {

            $response = $ex->getResponse();
            $body = json_decode($response->getBody());
            if (isset($body->data)) {
                throw BwalletException::requestFailed($body->data->rc, $body->data->message, $ex->getCode());
            } else {
                throw BwalletException::requestFailed('-', $ex->getMessage(), $ex->getCode());
            }
        }

        return json_decode($response->getBody());
    }

}