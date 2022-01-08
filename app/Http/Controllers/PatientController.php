<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Response\ApiResponse;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ApiResponse $response)
    {
        $patients = Patient::all();
        return $response->successResponse($patients);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePatientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePatientRequest $request, ApiResponse $response)
    {
        $patient = Patient::create($request->all());
        return $response->successResponse($patient, 'Patient successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(ApiResponse $response, Patient $patient)
    {
        $patient = Patient::with('nextOfKins')
                ->with('healthRecords')
                ->with('prescriptions')
                ->with('appointments')
                ->where('id', $patient->id)
                ->get();
        return $response->successResponse($patient);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePatientRequest  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePatientRequest $request, ApiResponse $response, Patient $patient)
    {
            $patient = Patient::find($patient->id);
            $patient->update($request->all());
            return $response->successResponse($patient, 'Patient record successfully updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApiResponse $response, Patient $patient)
    {
        $patient = Patient::find($patient->id);
        $patient->delete();
        return $response->successResponse($patient, 'Patient record successfully deleted');

    }
}
