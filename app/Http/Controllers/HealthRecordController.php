<?php

namespace App\Http\Controllers;

use App\Models\HealthRecord;
use Illuminate\Http\Request;
use App\Http\Requests\StoreHealthRecordRequest;
use App\Http\Requests\UpdateHealthRecordRequest;
use App\Response\ApiResponse;


class HealthRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ApiResponse $response, $patientId)
    {
        $record = HealthRecord::where('patient_id', $patientId)->OrderBy('created_at', 'DESC')->get();
        return $response->successResponse($record);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHealthRecordRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHealthRecordRequest $request, ApiResponse $response, $patientId)
    {
        $record = HealthRecord::create(
                array_merge($request->all(), [
                "patient_id" => (int)$patientId
            ])
        );

        return $response->successResponse($record, 'Record successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HealthRecord  $healthRecord
     * @return \Illuminate\Http\Response
     */
    public function show(ApiResponse $response, $healthRecord, $patientId)
    {
        $record = HealthRecord::with('patient')->where('id', $healthRecord)->where('patient_id', (int)$patientId)->first();
        return $response->successResponse($record);

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
    public function destroy(ApiResponse $response, $healthRecord)
    {
            $record = HealthRecord::find($healthRecord);
            $record->delete();
            return $response->successResponse($record, 'Record successfully deleted');

    }
}
