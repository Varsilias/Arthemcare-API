<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Prescription;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePrescriptionRequest;
use App\Http\Requests\UpdatePrescriptionRequest;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($patientId)
    {
        $prescription = Prescription::where('patient_id', $patientId)
                    ->OrderBy('created_at', 'DESC')
                    ->get();
        return response()->json([
            'status' => 'OK',
            'error' => false,
            'data' => $prescription
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePrescriptionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePrescriptionRequest $request, $patientId)
    {
        // dd($request->all());

        $prescription = Prescription::create([
            "prescription" => $request->prescription,
		    "comment_by_doctor" => $request->comment_by_doctor,
		    "user_id" => Auth::user()->id,
            "patient_id" => (int)$patientId
        ]);

        return response()->json([
            'status' => 'OK',
            'error' => false,
            'message' => 'Prescription successfully created',
            'data' => $prescription
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function show($prescription, $patientId)
    {
        $prescription = Prescription::with('patient')->with('user')->where('id', $prescription)->where('patient_id', (int)$patientId)->first();
        return response()->json([
            'status' => 'OK',
            'error' => false,
            'data' => $prescription
        ]);
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
    public function destroy($prescription)
    {
        try {
            $deletedPrescription = Prescription::find($prescription);
            $deletedPrescription->delete();
            return response()->json([
                'status' => 'OK',
                'error' => false,
                'message' => 'Prescription successfully deleted',
                'data' => $deletedPrescription
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
