<?php

namespace App\Http\Controllers;


use Hyperpay\ConnectIn\Models\Transaction;
use App\Http\Controllers\Controller;
use Hyperpay\ConnectIn\ConnectIn;
use Hyperpay\ConnectIn\Requests\ConnectInRequest;
use Illuminate\Http\Request;

class ConnectInController extends Controller
{

    /**
     *
     *  recive ACI request and return response to ACI
     *
     * @param Hyperpay\ConnectIn\Requests\ConnectInRequest
     *
     * @return Hyperpay\ConnectIn\Requests\ConnectInRequest::response
     */

    public function payment(ConnectInRequest $request)
    {

        // conver request object to array of params
        $data = $request->all();
        extract($data);
        // Extract UUID from ACI request to asign it to a new transaction
        $data['UUID'] = $customParameters['UUID'];
        $transaction = Transaction::create($data);

        $connectIn = new ConnectIn($data);
        $connectIn->setRedirect(["url" =>   route('inquiry' , $transaction->id) , "parameters" => []]);
        return $connectIn->response(ConnectIn::CREATED);
    }

    /**
     * Handle refund
     *
     * @param Illuminate\Http\Request $request
     * @param Hyperpay\ConnectIn\Models\Transaction $transaction
     */

    public function refund(Request $request, $transaction)
    {
        //
    }
}
