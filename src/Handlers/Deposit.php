<?php

namespace Digitcode\Bwallet\Handlers;

use Digitcode\Bwallet\BwalletClient;

class Deposit extends Base
{
    private $keyword = 'deposit';

    /**
     * CheckBalance constructor.
     * @param int $amount
     * @param string $bank
     * @param string $ownerName
     * @param DigitcodeClient $client
     */
    public function __construct(BwalletClient $client, int $amount, string $bank, string $ownerName)
    {
        parent::__construct($client);
        $this->client->setUrl('/deposit')
            ->setBody([
                'amount' => $amount,
                'Bank' => $bank,
                'owner_name' => $ownerName,
                'sign' => $this->sign($this->keyword)
            ]);
    }
}
