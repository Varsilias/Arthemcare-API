<?php

namespace App\Http\Controllers;

use App\Models\NextOfKin;
use App\Http\Requests\StoreNextOfKinRequest;
use App\Http\Requests\UpdateNextOfKinRequest;
use App\Models\Patient;

class NextOfKinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        $nextOfKins = NextOfKin::where('patient_id', $patient->id)->get();
        return response()->json([
            'status' => 'OK',
            'error' => false,
            'data' => $nextOfKins
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNextOfKinRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNextOfKinRequest $request, $patientId)
    {
        // dd($patientId);
        $nextOfKin = NextOfKin::create([
            "firstname" => $request->firstname,
            "lastname" => $request->lastname,
            "DOB" =>  $request->DOB,
            "gender" =>  $request->gender,
            "phone_number" =>  $request->phone_number,
            "email" =>  $request->email,
            "patient_id" => (int)$patientId
        ]);

        return response()->json([
            'status' => 'OK',
            'error' => false,
            'message' => 'Next Of Kin successfully created',
            'data' => $nextOfKin
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NextOfKin  $nextOfKin
     * @return \Illuminate\Http\Response
     */
    public function show($nextOfKin, $patientId)
    {
        // dd($nextOfKin, $patientId);
                // dd($nextOfKin, $patientId);
        $data = NextOfKin::with('patient')->where('id', $nextOfKin)->where('patient_id', (int)$patientId)->first();

        return response()->json([
            'status' => 'OK',
            'error' => false,
            'data' => $data
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNextOfKinRequest  $request
     * @param  \App\Models\NextOfKin  $nextOfKin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNextOfKinRequest $request, $nextOfKin)
    {
        try {
            $updatedNok = NextOfKin::find($nextOfKin);
            $updatedNok->update($request->all());
            return response()->json([
                'status' => 'OK',
                'error' => false,
                'message' => 'Next Of Kin record successfully updated',
                'data' => $updatedNok
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NextOfKin  $nextOfKin
     * @return \Illuminate\Http\Response
     */
    public function destroy($nextOfKin)
    {
        try {
            $deletedNok = NextOfKin::find($nextOfKin);
            $deletedNok->delete();
            return response()->json([
                'status' => 'OK',
                'error' => false,
                'message' => 'Next Of Kin successfully deleted',
                'data' => $deletedNok
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
