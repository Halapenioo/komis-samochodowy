<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $query = Car::query();

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('brand', 'like', '%' . $request->search . '%')
                  ->orWhere('model', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        if ($request->filled('year_min')) {
            $query->where('production_year', '>=', $request->year_min);
        }
        if ($request->filled('year_max')) {
            $query->where('production_year', '<=', $request->year_max);
        }

        if ($request->filled('engine_min')) {
            $query->where('engine_capacity', '>=', $request->engine_min);
        }
        if ($request->filled('engine_max')) {
            $query->where('engine_capacity', '<=', $request->engine_max);
        }

        if ($request->filled('mileage_min')) {
            $query->where('current_mileage', '>=', $request->mileage_min);
        }
        if ($request->filled('mileage_max')) {
            $query->where('current_mileage', '<=', $request->mileage_max);
        }

        if ($request->filled('power_min')) {
            $query->where('engine_power', '>=', $request->power_min);
        }
        if ($request->filled('power_max')) {
            $query->where('engine_power', '<=', $request->power_max);
        }

        if ($request->filled('fuel_type') && $request->fuel_type !== 'Wszystkie') {
            $query->where('fuel_type', $request->fuel_type);
        }
        if ($request->filled('drive_type') && $request->drive_type !== 'Wszystkie') {
            $query->where('drive_type', $request->drive_type);
        }
        if ($request->filled('transmission') && $request->transmission !== 'Wszystkie') {
            $query->where('transmission', $request->transmission);
        }

        if ($request->filled('generation') && $request->generation !== 'Wszystkie') {
            $query->where('generation', $request->generation);
        }

        if ($request->filled('origin_country') && $request->origin_country !== 'Wszystkie') {
            $query->where('origin_country', $request->origin_country);
        }

        if ($request->has('is_accident_free')) {
            $query->where('is_accident_free', true);
        }

        $cars = $query->latest()->get();

        $brands = Car::select('brand')->distinct()->orderBy('brand')->pluck('brand');

        return view('cars.index', compact('cars', 'brands'));
    }

    public function show(Car $car)
    {
        $car->load(['inspections', 'repairs', 'images']);
        return view('cars.show', compact('car'));
    }

    public function create()
    {
        return view('cars.create');
    }

    public function store(Request $request)
    {
        // Polskie komunikaty błędów
        $messages = [
            'vin.required' => 'Numer VIN jest wymagany.',
            'vin.string' => 'Numer VIN musi być ciągiem znaków.',
            'vin.size' => 'Numer VIN musi składać się z dokładnie 17 znaków.',
            'vin.unique' => 'Ten numer VIN został już wprowadzony dla innego auta w bazie.',
            'required' => 'To pole jest wymagane.',
            'integer' => 'Wprowadzona wartość musi być liczbą całkowitą.',
            'date' => 'Wprowadzona wartość musi być poprawną datą.',
            'min' => 'Wartość nie może być mniejsza niż :min.',
            'max' => 'Wartość nie może być większa niż :max.',
            'image' => 'Wgrany plik musi być poprawnym zdjęciem.',
            'mimes' => 'Dozwolone formaty plików to: jpeg, png, jpg, webp.',
            'gallery.*.image' => 'Wszystkie pliki w galerii muszą być zdjęciami.',
            'gallery.*.mimes' => 'Zdjęcia w galerii muszą mieć format: jpeg, png, jpg, webp.',
            'gallery.*.max' => 'Rozmiar pojedynczego zdjęcia w galerii nie może przekraczać 2MB.',
        ];

        $validated = $request->validate([
            'vin' => 'required|string|size:17|unique:cars',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'generation' => 'required|string|max:255',
            'production_year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'first_registration_date' => 'nullable|date',
            'price' => 'required|integer|min:0',
            'engine_capacity' => 'required|integer|min:0',
            'engine_power' => 'required|integer|min:0',
            'engine_code' => 'nullable|string|max:255',
            'fuel_type' => 'required|string',
            'transmission' => 'required|string',
            'drive_type' => 'required|string',
            'current_mileage' => 'required|integer|min:0',
            'usage_description' => 'required|string',
            'previous_owners_count' => 'required|integer|min:0',
            'origin_country' => 'required|string|max:255',
            'accident_description' => 'nullable|string',
            'status' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], $messages);

        $validated['is_accident_free'] = $request->has('is_accident_free');

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('cars', 'public');
        }

        $car = Car::create($validated);

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $path = $image->store('cars/gallery', 'public');
                $car->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('dashboard')->with('success', 'Nowy samochód oraz jego galeria zostały pomyślnie dodane!');
    }

    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        // Polskie komunikaty błędów
        $messages = [
            'vin.required' => 'Numer VIN jest wymagany.',
            'vin.string' => 'Numer VIN musi być ciągiem znaków.',
            'vin.size' => 'Numer VIN musi składać się z dokładnie 17 znaków.',
            'vin.unique' => 'Ten numer VIN został już wprowadzony dla innego auta w bazie.',
            'required' => 'To pole jest wymagane.',
            'integer' => 'Wprowadzona wartość musi być liczbą całkowitą.',
            'date' => 'Wprowadzona wartość musi być poprawną datą.',
            'min' => 'Wartość nie może być mniejsza niż :min.',
            'max' => 'Wartość nie może być większa niż :max.',
            'image' => 'Wgrany plik musi być poprawnym zdjęciem.',
            'mimes' => 'Dozwolone formaty plików to: jpeg, png, jpg, webp.',
            'gallery.*.image' => 'Wszystkie pliki w galerii muszą być zdjęciami.',
            'gallery.*.mimes' => 'Zdjęcia w galerii muszą mieć format: jpeg, png, jpg, webp.',
            'gallery.*.max' => 'Rozmiar pojedynczego zdjęcia w galerii nie może przekraczać 2MB.',
        ];

        $validated = $request->validate([
            'vin' => 'required|string|size:17|unique:cars,vin,' . $car->id,
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'generation' => 'required|string|max:255',
            'production_year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'first_registration_date' => 'nullable|date',
            'price' => 'required|integer|min:0',
            'engine_capacity' => 'required|integer|min:0',
            'engine_power' => 'required|integer|min:0',
            'engine_code' => 'nullable|string|max:255',
            'fuel_type' => 'required|string',
            'transmission' => 'required|string',
            'drive_type' => 'required|string',
            'current_mileage' => 'required|integer|min:0',
            'usage_description' => 'required|string',
            'previous_owners_count' => 'required|integer|min:0',
            'origin_country' => 'required|string|max:255',
            'accident_description' => 'nullable|string',
            'status' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], $messages);

        $validated['is_accident_free'] = $request->has('is_accident_free');

        if ($request->hasFile('image')) {
            if ($car->image_path) Storage::disk('public')->delete($car->image_path);
            $validated['image_path'] = $request->file('image')->store('cars', 'public');
        }

        $car->update($validated);

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $path = $image->store('cars/gallery', 'public');
                $car->images()->create(['image_path' => $path]);
            }
        }

        if ($request->has('delete_images')) {
            $imagesToDelete = CarImage::whereIn('id', $request->delete_images)->get();
            foreach ($imagesToDelete as $img) {
                Storage::disk('public')->delete($img->image_path);
                $img->delete();
            }
        }

        return redirect()->route('dashboard')->with('success', 'Dane samochodu zostały zaktualizowane!');
    }

    public function destroy(Car $car)
    {
        if ($car->image_path) Storage::disk('public')->delete($car->image_path);
        foreach($car->images as $img) {
            Storage::disk('public')->delete($img->image_path);
        }
        $car->delete();
        return redirect()->route('dashboard')->with('success', 'Samochód usunięty.');
    }
}
