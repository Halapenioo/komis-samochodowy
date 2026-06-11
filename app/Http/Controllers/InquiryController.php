<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    // Zapisuje zapytanie wysłane przez klienta z formularza publicznego
    public function store(Request $request, Car $car)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'type' => 'required|string|in:zapytanie,jazda_probna',
            'message' => 'required|string',
        ]);

        $car->inquiries()->create($validated);

        return redirect()->back()->with('success', 'Twoje zgłoszenie zostało pomyślnie wysłane! Pracownik komisu skontaktuje się z Tobą najszybciej jak to możliwe.');
    }

    // Wyświetla listę wszystkich otrzymanych wiadomości w Panelu Admina
    public function index()
    {
        $inquiries = Inquiry::with('car')->latest()->get();
        return view('inquiries.index', compact('inquiries'));
    }

    // Aktualizuje status zgłoszenia (np. z 'nowe' na 'w toku')
    public function updateStatus(Request $request, Inquiry $inquiry)
    {
        $request->validate([
            'status' => 'required|string|in:nowe,w_toku,zamkniete',
        ]);

        $inquiry->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status wiadomości został zaktualizowany.');
    }
}
