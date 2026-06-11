<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class InspectionController extends Controller
{
    public function create(Car $car)
    {
        return view('inspections.create', compact('car'));
    }

    public function store(Request $request, Car $car)
    {
        $messages = [
            'required' => 'To pole jest wymagane do wygenerowania raportu lakieru.',
            'integer' => 'Grubość lakieru oraz przebieg muszą być podane w postaci liczb.',
            'date' => 'Wprowadź prawidłowy format daty.',
        ];

        $validated = $request->validate([
            'last_inspection_date' => 'required|date',
            'mileage_at_inspection' => 'required|integer',
            'next_inspection_date' => 'nullable|date',
            'insurance_expiry_date' => 'nullable|date',
            'paint_thickness_hood' => 'required|integer',
            'paint_thickness_roof' => 'required|integer',
            'paint_thickness_front_bumper' => 'required|integer',
            'paint_thickness_rear_bumper' => 'required|integer',
            'paint_thickness_front_left_fender' => 'required|integer',
            'paint_thickness_front_left_door' => 'required|integer',
            'paint_thickness_rear_left_door' => 'required|integer',
            'paint_thickness_rear_left_fender' => 'required|integer',
            'paint_thickness_front_right_fender' => 'required|integer',
            'paint_thickness_front_right_door' => 'required|integer',
            'paint_thickness_rear_right_door' => 'required|integer',
            'paint_thickness_rear_right_fender' => 'required|integer',
            'known_defects' => 'nullable|string',
        ], $messages);

        $car->inspections()->create($validated);

        return redirect()->route('dashboard')->with('success', 'Szczegółowy raport powłoki lakierniczej został zapisany w bazie floty!');
    }
}
