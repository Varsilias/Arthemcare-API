<?php

namespace App\Http\Controllers;

use App\Models\HealthRecord;
use Illuminate\Http\Request;
use App\Http\Requests\StoreHealthRecordRequest;
use App\Http\Requests\UpdateHealthRecordRequest;

class HealthRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($patientId)
    {
        $record = HealthRecord::where('patient_id', $patientId)
                    ->OrderBy('created_at', 'DESC')
                    ->get();
        return response()->json([
            'status' => 'OK',
            'error' => false,
            'data' => $record
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHealthRecordRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHealthRecordRequest $request, $patientId)
    {
        $record = HealthRecord::create([
            "temperature" => $request->temperature,
		    "blood_level" => $request->blood_level,
		    "sugar_level"=> $request->sugar_level,
		    "blood_pressure" => $request->blood_pressure,
            "patient_id" => (int)$patientId
        ]);

        return response()->json([
            'status' => 'OK',
            'error' => false,
            'message' => 'Record successfully created',
            'data' => $record
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HealthRecord  $healthRecord
     * @return \Illuminate\Http\Response
     */
    public function show($healthRecord, $patientId)
    {
        $record = HealthRecord::with('patient')->where('id', $healthRecord)->where('patient_id', (int)$patientId)->first();
        return response()->json([
            'status' => 'OK',
            'error' => false,
            'data' => $record
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHealthRecordRequest  $request
     * @param  \App\Models\HealthRecord  $healthRecord
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHealthRecordRequest $request, HealthRecord $healthRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HealthRecord  $healthRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy($healthRecord)
    {
        try {
            $deletedRecord = HealthRecord::find($healthRecord);
            $deletedRecord->delete();
            return response()->json([
                'status' => 'OK',
                'error' => false,
                'message' => 'Record successfully deleted',
                'data' => $deletedRecord
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
