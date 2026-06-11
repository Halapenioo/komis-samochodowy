<?php

namespace App\Http\Controllers;

use App\Models\ServiceAppointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceAppointmentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_name' => 'required|string|max:255',
            'appointment_date' => 'required|date|after:today',
            'description' => 'required|string',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->serviceAppointments()->create($validated);

        return redirect()->back()->with('success', 'Wizyta w warsztacie została pomyślnie zarezerwowana!');
    }

    public function update(Request $request, ServiceAppointment $appointment)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($appointment->user_id !== Auth::id() && $user->role !== 'admin') {
            abort(403);
        }

        if ($user->role === 'admin') {
            $request->validate(['status' => 'required|string|in:nowe,w_naprawie,gotowe']);
            $appointment->update(['status' => $request->status]);
        }

        return redirect()->back()->with('success', 'Status naprawy został zaktualizowany.');
    }

    public function destroy(ServiceAppointment $appointment)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($appointment->user_id !== Auth::id() && $user->role !== 'admin') {
            abort(403);
        }

        $appointment->delete();
        return redirect()->back()->with('success', 'Wizyta w warsztacie została odwołana.');
    }
}
