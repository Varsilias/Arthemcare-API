<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::all();
        return response()->json([
            'status' => 'OK',
            'error' => false,
            'data' => $patients
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePatientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePatientRequest $request)
    {
        $patient = Patient::create($request->all());
        return response()->json([
            'status' => 'OK',
            'error' => false,
            'message' => 'Patient successfully created',
            'data' => $patient
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        $data = Patient::with('nextOfKins')
                ->with('healthRecords')
                ->with('prescriptons')
                ->with('appointments')
                ->where('id', $patient->id)
                ->get();

        return response()->json([
            'status' => 'OK',
            'error' => false,
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePatientRequest  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        // dd($request->all());
        try {
            $updatedPatient = Patient::find($patient->id);
            $updatedPatient->update($request->all());
            return response()->json([
                'status' => 'OK',
                'error' => false,
                'message' => 'Patient record successfully updated',
                'data' => $updatedPatient
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        try {
            $deletedPatient = Patient::find($patient->id);
            $deletedPatient->delete();
            return response()->json([
                'status' => 'OK',
                'error' => false,
                'message' => 'Patient record successfully deleted',
                'data' => $deletedPatient
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
