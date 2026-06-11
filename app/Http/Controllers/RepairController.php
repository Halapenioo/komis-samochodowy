<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class RepairController extends Controller
{
    public function create(Car $car)
    {
        return view('repairs.create', compact('car'));
    }

    public function store(Request $request, Car $car)
    {
        $validated = $request->validate([
            'repair_date' => 'required|date',
            'mileage_at_repair' => 'required|integer|min:0',
            'replaced_part_name' => 'required|string|max:255',
            'oem_number' => 'nullable|string|max:255',
            'part_status' => 'required|string|max:255',
            'part_cost' => 'nullable|numeric|min:0',
            'labor_cost' => 'nullable|numeric|min:0',
        ]);

        $car->repairs()->create($validated);

        return redirect()->route('dashboard')->with('success', 'Naprawa oraz ewidencja części zostały dodane!');
    }
}
