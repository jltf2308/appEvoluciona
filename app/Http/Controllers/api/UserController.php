<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Person as ResourcesPerson;
use App\Http\Resources\User as ResourcesUser;
use App\Http\Resources\UserCollection;
use App\Models\Company;
use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return response()->json([
            'users'=> new UserCollection($user)
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        
        $person = new Person();
        $person->first_name = $request[0]['first_name'];
        $person->last_name =$request[0]['last_name'];
        $person->register_number = $request[0]['register_number'];
        $person->email = $request[0]['email'];
        $person->position = $request[0]['position'];
        $person->type = $request[0]['type'];
        $person->company_id = $request[0]['company_id'];
        $person->save();

        $user = new User();
        $user->email = $request[1]['userEmail'];
        $user->password = bcrypt($request[1]['password']);
        $user->person_id = $person->id;
        $user->save();
        return response()->json([
            "person" => new ResourcesPerson($person)
        ], response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $user = User::find($request->user()->id);
        return response()->json([
            'user'=> new ResourcesUser($user)
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getUsersCompany($companyId)
    {
        $people = Person::where('type', '!=', 'Professional')->where('company_id', $companyId)->with('user')->get();
        $users = $people->map(function ($item, $key) {
            return $item->user;
        });
        return response()->json([
            'users'=> new UserCollection($users)
        ], Response::HTTP_OK);
    }
}
