<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Prescription;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePrescriptionRequest;
use App\Http\Requests\UpdatePrescriptionRequest;
use App\Response\ApiResponse;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ApiResponse $response, $patientId)
    {
        $prescription = Prescription::where('patient_id', $patientId)
                    ->OrderBy('created_at', 'DESC')
                    ->get();
        return $response->successResponse($prescription);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePrescriptionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePrescriptionRequest $request, ApiResponse $response, $patientId)
    {
        // dd($request->all());

        $prescription = Prescription::create(
                array_merge($request->all(), [
                "user_id" => Auth::user()->id,
                "patient_id" => (int)$patientId
            ])
        );
        return $response->successResponse($prescription, 'Prescription successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function show(ApiResponse $response, $prescriptionId, $patientId)
    {
        $prescription = Prescription::with('patient')->with('user')->where('id', $prescriptionId)->where('patient_id', (int)$patientId)->first();
        return $response->successResponse($prescription);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function update(Prescription $prescription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApiResponse $response, $prescriptionId)
    {
            $prescription = Prescription::find($prescriptionId);
            $prescription->delete();
            return $response->successResponse($prescription);


    }

}
