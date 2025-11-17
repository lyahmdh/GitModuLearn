<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;

class AdminAppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with('mentor', 'mentee')->get();
        return view('admin.appointments.index', compact('appointments'));
    }

    public function delete($id)
    {
        Appointment::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Appointment deleted.');
    }
}
