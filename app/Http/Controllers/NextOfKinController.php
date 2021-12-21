<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\NextOfKin;
use App\Response\ApiResponse;
use App\Http\Requests\StoreNextOfKinRequest;
use App\Http\Requests\UpdateNextOfKinRequest;

class NextOfKinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ApiResponse $response, Patient $patient)
    {
        $nextOfKins = NextOfKin::where('patient_id', $patient->id)->get();
        return $response->successResponse($nextOfKins);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNextOfKinRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNextOfKinRequest $request, ApiResponse $response, $patientId)
    {
        // dd($patientId);
        $nextOfKin = NextOfKin::create(array_merge($request->all(), [
            "patient_id" => (int)$patientId
        ]));
        return $response->successResponse($nextOfKin, 'Next Of Kin successfully created');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NextOfKin  $nextOfKin
     * @return \Illuminate\Http\Response
     */
    public function show(ApiResponse $response, $nextOfKin, $patientId)
    {
        // dd($nextOfKin, $patientId);
                // dd($nextOfKin, $patientId);
        $data = NextOfKin::with('patient')->where('id', $nextOfKin)->where('patient_id', (int)$patientId)->first();
        return $response->successResponse($data);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNextOfKinRequest  $request
     * @param  \App\Models\NextOfKin  $nextOfKin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNextOfKinRequest $request, ApiResponse $response, $nextOfKin)
    {
            $data = NextOfKin::find($nextOfKin);
            $data->update($request->all());
            return $response->successResponse($data);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NextOfKin  $nextOfKin
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApiResponse $response, $nextOfKin)
    {
            $data = NextOfKin::find($nextOfKin);
            $data->delete();
            return $response->successResponse($data);


    }
}
