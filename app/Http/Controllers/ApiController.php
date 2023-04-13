<?php

namespace App\Http\Controllers;


// use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    


    public function stripe_create_api(Request $request)
    {

        Log::notice("create");
        Log::notice($request);

    }


    public function stripe_cancel_api(Request $request)
    {
            Log::notice("cencel");
            Log::notice($request);
    }

    public function stripe_failed_api(Request $request) {

            Log::notice("failed");
            Log::notice($request);
    }
    
}
