<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Response\ApiResponse;


class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ApiResponse $response, $patientId)
    {
        $appointment = Appointment::where('patient_id', $patientId)->OrderBy('created_at', 'DESC')->get();
        return $response->successResponse($appointment);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAppointmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAppointmentRequest $request, ApiResponse $response, $patientId)
    {
        $appointment = Appointment::create([
            "scheduled_at" => $request->scheduled_at,
		    "user_id" => $request->user_id,
            "patient_id" => (int)$patientId
        ]);
        return $response->successResponse($appointment, 'Appointment successfully created');

    }

    public function getAppointmentHistory(ApiResponse $response)
    {
        // dd(Auth::user()->getRoleNames()[0]);
        $appointment = Appointment::where('user_id', Auth::user()->id)
                        ->OrderBy('scheduled_at', 'DESC')
                        ->with('patient')
                        ->with('user')
                        ->get();
        return $response->successResponse($appointment);

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAppointmentRequest  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
