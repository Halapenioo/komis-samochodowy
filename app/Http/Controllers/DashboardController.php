<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Review;
use App\Models\ServiceAppointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // DODANO: Import fasady Auth

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user(); // ZMIENIONO: Użycie Auth::user() zamiast auth()->user()

        // Jeśli użytkownik jest administratorem – obsługa filtrów i sortowania
        if ($user && $user->can('is_staff')) {

            // --- MODUŁ 1: Filtrowanie Samochodów (Marka i Status) ---
            $carsQuery = Car::query();

            if ($request->has('car_brand') && $request->car_brand != '') {
                $carsQuery->where('brand', 'LIKE', '%' . $request->car_brand . '%');
            }
            if ($request->has('car_status') && $request->car_status != '') {
                $carsQuery->where('status', $request->car_status);
            }
            $cars = $carsQuery->get();

            // --- MODUŁ 2: Sortowanie Opinii (Rosnąco / Malejąco po gwiazdkach) ---
            $reviewsQuery = Review::with('user');
            $reviewOrder = $request->get('review_sort', 'desc');
            $reviewsQuery->orderBy('rating', $reviewOrder);
            $reviews = $reviewsQuery->get();

            // --- MODUŁ 3: Filtrowanie Warsztatu (Marka/Model auta i data) ---
            $appointmentsQuery = ServiceAppointment::with('user');

            if ($request->has('app_car') && $request->app_car != '') {
                $appointmentsQuery->where('car_name', 'LIKE', '%' . $request->app_car . '%');
            }
            if ($request->has('app_date') && $request->app_date != '') {
                $appointmentsQuery->whereDate('appointment_date', $request->app_date);
            }
            $appointments = $appointmentsQuery->get();

            return view('dashboard', compact('cars', 'reviews', 'appointments'));
        }

        // --- SEKCJA DLA ZWYKŁEGO KLIENTA ---
        $myReviews = Review::where('user_id', $user->id)->get();
        $myAppointments = ServiceAppointment::where('user_id', $user->id)->get();

        return view('dashboard', compact('myReviews', 'myAppointments'));
    }
}
