<?php

namespace Digitcode\Bwallet\Commands;

use Illuminate\Console\Command;
use Digitcode\Bwallet\Exceptions\DigitcodeException;
use Digitcode\Bwallet\Bwallet;
use Digitcode\Bwallet\Exceptions\BwalletException;

class TopupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bwallet:topup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transaksi prabayar Bwallet:';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $buyerSkuCode = $this->ask('Product SKU:');
        $customerNo = $this->ask('Customer No:');
        $refId = $this->ask('Reference ID:');

        $this->info("You will do `$buyerSkuCode` topup to `$customerNo` with reference ID `$refId`");
        if ($this->confirm('Do you wish to continue?')) {
            try {
                $response = Bwallet::topup($buyerSkuCode, $customerNo, $refId);
                $status = $response->data->status;
                $message = $response->data->message;

                if ($message) {
                    $this->info($message);
                }

                $this->info("Request Success with status `$status`");
            } catch (BwalletException $ex) {
                $response = json_decode($ex->getMessage());
                $this->info("Request failed with message `$response->message` and rc `$response->response_code`");
            }
        }
    }
}
