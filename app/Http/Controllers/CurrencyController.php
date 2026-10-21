<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Switch user currency and store in session.
     */
    public function setCurrency(Request $request, string $currency)
    {
        $currency = strtoupper($currency);
        $supported = config('currency.supported', ['UGX', 'USD', 'EUR', 'GBP']);

        if (in_array($currency, $supported, true)) {
            session(['currency' => $currency]);
        }

        return redirect()->back();
    }
}
