<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($patientId)
    {
        $appointment = Appointment::where('patient_id', $patientId)
                    ->OrderBy('created_at', 'DESC')
                    ->get();
        return response()->json([
            'status' => 'OK',
            'error' => false,
            'data' => $appointment
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAppointmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAppointmentRequest $request, $patientId)
    {
        $appointment = Appointment::create([
            "scheduled_at" => $request->scheduled_at,
		    "user_id" => Auth::user()->id,
            "patient_id" => (int)$patientId
        ]);

        return response()->json([
            'status' => 'OK',
            'error' => false,
            'message' => 'Appointment successfully created',
            'data' => $appointment
        ]);
    }

    public function getAppointmentHistory()
    {
        // dd(Auth::user()->getRoleNames()[0]);
        $appointment = Appointment::where('user_id', Auth::user()->id)
                        ->with('patient')->with('user')->get();
        return response()->json([
            'status' => 'OK',
            'error' => false,
            'data' => $appointment
        ]);
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
