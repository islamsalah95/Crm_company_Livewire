<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentSalary extends Controller
{
    public $client;

    public function __construct(Http $client)
    {
        $this->client=$client;
        
    }


    public function pay()
    {
        // $this->client=$client;

        
        
    }

}
