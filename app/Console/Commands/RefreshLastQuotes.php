<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Stock;
use App\Models\LastQuote;
use Carbon\Carbon;

class RefreshLastQuotes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:refreshPrices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh stocks last price';

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
     * @return int
     */
    public function handle()
    {
        $stocks = Stock::all();
        $quotes = LastQuote::all();
        $c = curl_init(); //Initialize a cURL session
        curl_setopt($c, CURLOPT_HEADER, 0);  //Set an option for a cURL transfer
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1); //Set an option for a cURL transfer
        $count = 0;  
        $k = random_int(0,1) == 1 ? "DDIBTY359Y3G6Y7W" : "32MNTBD8X0ZE1HNQ";
        echo $k;                         
        foreach ($stocks as $stock){
            if($count == 5){
                break;
            }
            $lastQuote = null;
            foreach($quotes as $quote){
                if($quote->symbol == $stock->symbol){
                    $lastQuote = $quote;
                    break;
                }
            }
            if(!empty($lastQuote) &&  $lastQuote->updated_at > Carbon::today()->addHours(-12)){
                continue;
            }
            set_time_limit(30);
            curl_setopt($c, CURLOPT_URL, "https://www.alphavantage.co/query?function=GLOBAL_QUOTE&symbol=".$stock->symbol.".SAO&apikey=".$k);
            $response = curl_exec ($c);
            $data = json_decode($response, true);

            if(!isset($data["Global Quote"])){
                $count++;
                continue;
            }
            if(!count($data["Global Quote"])){
                $count++;
                continue;
            }
            $price = $data['Global Quote']['05. price'];
            if(empty($lastQuote)){
                $lastQuote = new LastQuote;
            }
            $previousClose = $data['Global Quote']['08. previous close'];
            $lastQuote->symbol = $stock->symbol;
            $lastQuote->price = $price;
            $lastQuote->previous_close = $previousClose;
            $lastQuote->change = $lastQuote->price - $previousClose;
            $lastQuote->change_percent = (($lastQuote->price / $lastQuote->previous_close) - 1) * 100;
            $lastQuote->save();
            $count++;
        }
        curl_close($c);  //Close a cURL session
        return 0;
    }
}
