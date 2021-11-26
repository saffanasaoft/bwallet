<?php

namespace Digitcode\Bwallet\Handlers;

use Digitcode\Bwallet\BwalletClient;

class InquiryPLN extends Base
{
    /**
     * CheckBalance constructor.
     * @param string $customerNo
     * @param DigitcodeClient $client
     */
    public function __construct(BwalletClient $client, string $customerNo)
    {
        parent::__construct($client);
        $this->client->setUrl('/transaction')
            ->setBody([
                'commands' => 'pln-subscribe',
                'customer_no' => $customerNo
            ]);
    }
}
