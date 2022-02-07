<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Time;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = Appointment::latest()->where('user_id', auth()->user()->id)->get();
        // return view('admin.appointment.index', compact('myAppointments'));
        return view('admin.appointment.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.appointment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'date' => 'required|unique:appointments,date,NULL,id,user_id,' . \Auth::id(),
            'time' => 'required'
        ]);
        $formatDate = date('m-d-Y', strtotime(request('date')));
        $appointment = Appointment::create([
            'user_id' => auth()->user()->id,
            'date' => $formatDate
        ]);
        foreach ($request->time as $time) {
            Time::create([
                'appointment_id' => $appointment->id,
                'time' => $time
                // default status => 0
            ]);
        }

        return redirect()->route('appointment.index')->with('message', 'An appointment created for ' . $request->date);
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
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

    // Check specific date for appointment time
    public function check(Request $request)
    {
        $date = $request->date;
        $appointment = Appointment::where('date', $date)->where('user_id', auth()->user()->id)->first();
        if (!$appointment) {
            return redirect()->to('/appointment')->with('errMessage', 'Appointment time is not available for this date');
        };
        $appointmentId = $appointment->id;
        $times = Time::where('appointment_id', $appointmentId)->get();
        return view('admin.appointment.index', compact('times', 'appointmentId', 'date'));
    }

    // Update app time
    // delete the old time array and create a new time array
    public function updateTime(Request $request)
    {
        $appointmentId = $request->appointmentId;
        $date = Appointment::where('id', $appointmentId)->get('date')->first()->date;
        Time::where('appointment_id', $appointmentId)->delete();
        foreach ($request->time as $time) {
            Time::create([
                'appointment_id' => $appointmentId,
                'time' => $time,
                'status' => 0
            ]);
        }
        return redirect()->route('appointment.index')->with('message', 'Appointment time for ' . $date . ' is updated successfully!');
    }
}
