<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // KROK 1: Dodana fasada Auth

class ReviewController extends Controller
{
    /**
     * Zapisuje nową opinię klienta w bazie danych.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        Review::create([
            'user_id' => Auth::id(), // Zamiana z auth()->id()
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return redirect()->route('dashboard')->with('success', 'Dziękujemy! Twoja opinia została pomyślnie dodana.');
    }

    /**
     * Wyświetla formularz edycji opinii.
     */
    public function edit(Review $review)
    {
        // Bezpieczeństwo: Edytować może tylko autor danej opinii
        if ($review->user_id !== Auth::id()) { // Zamiana z auth()->id()
            abort(403, 'Nie masz uprawnień do edycji tej opinii.');
        }

        return view('reviews.edit', compact('review'));
    }

    /**
     * Zapisuje zaktualizowaną opinię w bazie danych.
     */
    public function update(Request $request, Review $review)
    {
        // Bezpieczeństwo: Aktualizować może tylko autor danej opinii
        if ($review->user_id !== Auth::id()) { // Zamiana z auth()->id()
            abort(403, 'Nie masz uprawnień do modyfikacji tej opinii.');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $review->update($validated);

        return redirect()->route('dashboard')->with('success', 'Twoja opinia została pomyślnie zaktualizowana!');
    }

    /**
     * Usuwa opinię z bazy danych.
     */
   public function destroy(Review $review)
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        // ZMIANA TUTAJ: 'admin_reviews' zamiast 'admin'
        if (($user && $user->can('admin_reviews')) || $review->user_id === Auth::id()) {
            $review->delete();
            return redirect()->route('dashboard')->with('success', 'Opinia została pomyślnie usunięta.');
        }

        abort(403, 'Nie masz uprawnień do usunięcia tej opinii.');
    }
}
