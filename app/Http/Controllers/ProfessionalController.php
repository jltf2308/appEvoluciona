<?php

namespace App\Http\Controllers;

use App\Http\Resources\PersonCollection;
use App\Models\Company;
use App\Models\Person;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfessionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        foreach ($request->all() as $key => $value) {
            
            $person = Person::find($value['person_id']);
            $company = Company::find($value['companyId']);
            $person->clients()->attach($company, ['date_init' => date("Y-m-d", strtotime($value['date_init'])), 'date_end'=> date("Y-m-d", strtotime($value['date_end']))]);
        }
        $company = Company::find($request[0]['companyId']);
        return response()->json([
            'people'=> new PersonCollection($company->professionals),
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $company = Company::find($id);
        return response()->json([
            'people'=> new PersonCollection($company->professionals),
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
}
