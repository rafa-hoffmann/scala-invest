<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Quotes extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quotes = DB::table('last_quotes')
        ->join('stocks', 'last_quotes.symbol', '=', 'stocks.symbol')
        ->select('stocks.symbol', 'stocks.name', 'last_quotes.price')
        ->get();
        return view('quotes.index',['quotes' => $quotes]);
    }

}
