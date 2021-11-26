<?php

namespace Digitcode\Bwallet\Handlers;

use Digitcode\Bwallet\BwalletClient;

class CheckBalance extends Base
{
    private $keyword = 'depo';

    /**
     * CheckBalance constructor.
     * @param DigitcodeClient $client
     */
    public function __construct(BwalletClient $client)
    {
        parent::__construct($client);
        $this->client->setUrl('/cek-saldo')
            ->setBody([
                'cmd' => 'deposit',
                'sign' => $this->sign($this->keyword)
            ]);
    }
}
