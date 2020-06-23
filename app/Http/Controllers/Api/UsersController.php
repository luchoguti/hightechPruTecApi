<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\User;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\Response
     */
    public function index()
    {
       return UserResource::collection (User::with ('ForeignKeyCreditCarts')->get ());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;
        $user->id = Uuid::uuid ();
        $user->names = $request[1]['names'];
        $user->last_names = $request[1]['last_names'];
        $user->email = $request[1]['email'];
        $user->type_identification = $request[1]['type_identification_id'];
        $user->number_identification = $request[1]['number_identification'];
        $user->id_credit_card = $request[0]['id_credit_card'];
        $user->password = bcrypt($request[1]['password']);
        $user->save();
        return response()->json([
            'message' => 'Successfully created user!'
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
        return UserResource::collection (
            User::with ('ForeignKeyCreditCarts')
                ->selectRaw (DB::raw ('*,CONVERT(type_identification, SIGNED) as type_identification_id'))
                ->where ('id','=',$id)
                ->get ()
        );
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
        User::query ()->where ('id','=',$id)->update ([
            'names'=>$request[1]['names'],
            'last_names'=> $request[1]['last_names'],
            'email'=>$request[1]['email'],
            'type_identification'=>$request[1]['type_identification_id'],
            'number_identification'=>$request[1]['number_identification'],
            'id_credit_card'=>$request[0]['id_credit_card']
        ]);
        $dataResponse['status'] = 201;
        $dataResponse['message'] = "User update success.";
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
        User::query ()->where ('id','=',$id)->delete ();
        return response()->json('successfully deleted');
    }
}
