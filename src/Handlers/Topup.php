<?php

namespace Digitcode\Bwallet\Handlers;

use Digitcode\Bwallet\BwalletClient;

class Topup extends Base
{
    /**
     * CheckBalance constructor.
     * @param string $buyerSkuCode
     * @param string $customerNo
     * @param string $refId
     * @param string $msg
     * @param DigitcodeClient $client
     */
    public function __construct(BwalletClient $client, string $buyerSkuCode, string $customerNo, string $refId, string $msg)
    {
        parent::__construct($client);

        $body = [
            'buyer_sku_code' => $buyerSkuCode,
            'customer_no' => $customerNo,
            'ref_id' => $refId,
            'sign' => $this->sign($refId)
        ];

        if ($msg) {
            $body['msg'] = $msg;
        }

        $this->client->setUrl('/transaction')
            ->setBody($body);
    }
}
