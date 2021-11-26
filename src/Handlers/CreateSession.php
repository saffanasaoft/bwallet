<?php

namespace Digitcode\Bwallet\Handlers;

use Digitcode\Bwallet\BwalletClient;

class CreateSession extends Base {

    /**
     * Create Session constructor.
     * @param BwalletClient $client
     */
    public function __construct(BwalletClient $client, string $phone, string $password)
    {
        parent::__construct($client);

        $body = [
            'phone'     => $phone,
            'password'  => $password
        ];

        $this->client->setUrl('/session')->setBody($body);
    }
}