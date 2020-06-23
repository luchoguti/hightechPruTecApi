<?php

namespace App\Http\Controllers\Api;

use App\CreditCard;
use App\Http\Controllers\Controller;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;

class CreditCardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CreditCard::query ()->paginate (10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataExpiration = explode ('/',$request->expiry_card);
        $newExpiration = '20'.$dataExpiration[1].'-'.$dataExpiration[0].'-01';
        $date = date('Y-m-d', strtotime($newExpiration));
        $newId = Uuid::uuid ();
        $creditCard = new CreditCard();
        $creditCard->id = $newId;
        $creditCard->card_holder_name = $request->name_card;
        $creditCard->card_number = $request->number_card;
        $creditCard->cvc = $request->security_card;
        $creditCard->expiration_card = $date;
        $creditCard->save();
        return response()->json([
            'message' => 'Successfully created credit card!',
            'uuid'=>$creditCard->id
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return CreditCard::query ()->where ('id','=',$id)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dataExpiration = explode ('/',$request->expiry_card);
        $newExpiration = '20'.$dataExpiration[1].'-'.$dataExpiration[0].'-01';
        $date = date('Y-m-d', strtotime($newExpiration));
        CreditCard::query ()->where ('id','=',$id)->update ([
            'card_holder_name'=> $request->name_card,
            'card_number'=> $request->number_card,
            'cvc'=>$request->security_card,
            'expiration_card'=>$date
        ]);
        $dataResponse['status'] = 201;
        $dataResponse['uuid'] = $id;
        $dataResponse['message'] = "Credit Card update success.";
        return response()->json($dataResponse, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CreditCard::query ()->where ('id','=',$id)->delete ();
        return response()->json('successfully deleted');
    }
}
