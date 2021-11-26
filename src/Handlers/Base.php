<?php

namespace Digitcode\Bwallet\Handlers;

use Digitcode\Bwallet\BwalletClient;

class Base
{
    protected $client;

    /**
     * Base constructor.
     * @param DigitcodeClient $client
     */
    protected function __construct(BwalletClient $client)
    {
        $this->client = $client;
    }

    public function sign(string $keyword)
    {
        return md5(config('bwallet.username') . config('bwallet.key') . $keyword);
    }

    public function perform()
    {
        return $this->client->run();
    }
}
