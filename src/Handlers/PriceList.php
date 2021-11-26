<?php

namespace Digitcode\Bwallet\Handlers;

use Digitcode\Bwallet\BwalletClient;

class PriceList extends Base
{
    private $keyword = 'pricelist';

    /**
     * PriceList constructor.
     * @param string $buyerSkuCode
     * @param DigitcodeClient $client
     */
    public function __construct(BwalletClient $client, string $buyerSkuCode)
    {
        parent::__construct($client);

        $body = [
            'cmd' => 'prepaid',
            'sign' => $this->sign($this->keyword)
        ];

        if ($buyerSkuCode) {
            $body['code'] = $buyerSkuCode;
        }

        $this->client->setUrl('/price-list')
            ->setBody($body);
    }
}
