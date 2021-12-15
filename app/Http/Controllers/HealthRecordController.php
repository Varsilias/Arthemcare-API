<?php

namespace App\Http\Controllers;

use App\Models\HealthRecord;
use App\Http\Requests\StoreHealthRecordRequest;
use App\Http\Requests\UpdateHealthRecordRequest;

class HealthRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHealthRecordRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHealthRecordRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HealthRecord  $healthRecord
     * @return \Illuminate\Http\Response
     */
    public function show(HealthRecord $healthRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HealthRecord  $healthRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(HealthRecord $healthRecord)
    {
        //
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
    public function destroy(HealthRecord $healthRecord)
    {
        //
    }
}
