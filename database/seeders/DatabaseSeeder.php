<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Car;
use App\Models\Review;
use App\Models\ServiceAppointment;
use App\Models\Inspection;
use App\Models\Repair;
use App\Models\Inquiry;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Użytkownicy i Role (RBAC)
        User::create(['name' => 'Główny Moderator', 'email' => 'moderator@komis.pl', 'password' => Hash::make('password'), 'role' => 'moderator']);

        $users = [
            User::create(['name' => 'Bartłomiej Sereda', 'email' => 'Bartek@wp.pl', 'password' => Hash::make('password'), 'role' => 'admin_cars']),
            User::create(['name' => 'Michał Mytych', 'email' => 'Michal@wp.pl', 'password' => Hash::make('password'), 'role' => 'admin_reviews']),
            User::create(['name' => 'Oskar Guła', 'email' => 'Oskar@wp.pl', 'password' => Hash::make('password'), 'role' => 'admin_repairs']),
            User::create(['name' => 'Jan Kowalski', 'email' => 'Jan@wp.pl', 'password' => Hash::make('password'), 'role' => 'user']),
            User::create(['name' => 'Anna Nowak', 'email' => 'Anna@wp.pl', 'password' => Hash::make('password'), 'role' => 'user']),
        ];

        // 2. Prawdziwe dane samochodów (z przypisanymi na sztywno zdjęciami)
        $carsData = [
            ['Audi', 'A4', 'B9', 2021, 'Diesel', 'Automatyczna', '4x4', 85000, 145000, 'cars/audi_a4.jpg'],
            ['Toyota', 'Corolla', 'XII', 2023, 'Hybryda', 'Automatyczna', 'Na przednie koła', 15000, 115000, 'cars/toyota.jpg'],
            ['BMW', 'Seria 5', 'G30', 2019, 'Benzyna', 'Automatyczna', '4x4', 120000, 160000, 'cars/bmw.jpg'],
            ['Audi', '80', 'B4', 1994, 'Diesel', 'Manualna', 'Na przednie koła', 490000, 8000, 'cars/audi_80.jpg'],
            ['Volkswagen', 'Passat', 'B8', 2018, 'Diesel', 'Manualna', 'Na przednie koła', 190000, 75000, null],
            ['Skoda', 'Octavia', 'IV', 2022, 'Benzyna', 'Manualna', 'Na przednie koła', 45000, 99000, null],
            ['Mercedes-Benz', 'Klasa E', 'W213', 2020, 'Diesel', 'Automatyczna', 'Tylny napęd', 110000, 180000, null],
            ['Volvo', 'XC60', 'II', 2021, 'Hybryda', 'Automatyczna', '4x4', 60000, 195000, null],
            ['Ford', 'Focus', 'MK4', 2019, 'Benzyna', 'Manualna', 'Na przednie koła', 130000, 62000, null],
            ['Kia', 'Sportage', 'V', 2023, 'Benzyna', 'Automatyczna', '4x4', 20000, 135000, null],
            ['Hyundai', 'Tucson', 'NX4', 2022, 'Hybryda', 'Automatyczna', '4x4', 35000, 142000, null],
            ['Opel', 'Astra', 'L', 2023, 'Benzyna', 'Manualna', 'Na przednie koła', 12000, 89000, null],
            ['Mazda', '6', 'GJ', 2018, 'Benzyna', 'Automatyczna', 'Na przednie koła', 140000, 78000, null],
            ['Renault', 'Megane', 'IV', 2020, 'Diesel', 'Manualna', 'Na przednie koła', 155000, 55000, null],
            ['Peugeot', '3008', 'P84', 2021, 'Diesel', 'Automatyczna', 'Na przednie koła', 95000, 110000, null],
        ];

        foreach ($carsData as $data) {
            Car::create([
                'brand' => $data[0], 'model' => $data[1], 'generation' => $data[2], 'production_year' => $data[3],
                'first_registration_date' => $data[3] . '-05-10', 'vin' => strtoupper(bin2hex(random_bytes(8))),
                'engine_capacity' => 2000, 'engine_power' => 150, 'engine_code' => 'XYZ123',
                'fuel_type' => $data[4], 'transmission' => $data[5], 'drive_type' => $data[6],
                'current_mileage' => $data[7], 'previous_owners_count' => 1, 'origin_country' => 'Polska',
                'status' => 'gotowy do sprzedaży', 'is_accident_free' => true, 'price' => $data[8],
                'image_path' => $data[9],
                'usage_description' => 'Zadbany egzemplarz, serwisowany w ASO, bez wkładu własnego.'
            ]);
        }

        // 3. Historia Lakieru i Napraw
        $showcaseCars = Car::take(4)->get();

        foreach ($showcaseCars as $car) {
            // Generowanie raportu lakierniczego
            Inspection::create([
                'car_id' => $car->id,
                'last_inspection_date' => date('Y-m-d', strtotime('-2 months')),
                'next_inspection_date' => date('Y-m-d', strtotime('+10 months')),
                'insurance_expiry_date' => date('Y-m-d', strtotime('+5 months')),
                'mileage_at_inspection' => $car->current_mileage - rand(500, 1500),
                'paint_thickness_hood' => rand(110, 130),
                'paint_thickness_roof' => rand(110, 130),
                'paint_thickness_front_bumper' => rand(110, 140),
                'paint_thickness_rear_bumper' => rand(110, 140),
                'paint_thickness_front_left_fender' => rand(110, 130),
                'paint_thickness_front_left_door' => rand(110, 130),
                'paint_thickness_rear_left_door' => rand(110, 130),
                'paint_thickness_rear_left_fender' => rand(110, 130),
                'paint_thickness_front_right_fender' => rand(110, 130),
                'paint_thickness_front_right_door' => rand(110, 130),
                'paint_thickness_rear_right_door' => rand(110, 130),
                'paint_thickness_rear_right_fender' => rand(110, 130),
                'known_defects' => 'Stan powłoki lakierniczej fabryczny. Drobne zarysowania eksploatacyjne.',
            ]);

            // Naprawa 1
            Repair::create([
                'car_id' => $car->id,
                'repair_date' => date('Y-m-d', strtotime('-5 months')),
                'mileage_at_repair' => $car->current_mileage - rand(5000, 10000),
                'replaced_part_name' => 'Tarcze i klocki hamulcowe (przód)',
                'oem_number' => 'OEM-' . strtoupper(bin2hex(random_bytes(4))),
                'part_status' => 'Oryginał (ASO)',
                'part_cost' => rand(450, 750),
                'labor_cost' => rand(200, 350),
            ]);

            // Naprawa 2
            Repair::create([
                'car_id' => $car->id,
                'repair_date' => date('Y-m-d', strtotime('-1 months')),
                'mileage_at_repair' => $car->current_mileage - rand(100, 1000),
                'replaced_part_name' => 'Wymiana oleju silnikowego + komplet filtrów',
                'oem_number' => 'FIL-' . strtoupper(bin2hex(random_bytes(4))),
                'part_status' => 'Zamiennik Premium',
                'part_cost' => rand(250, 380),
                'labor_cost' => rand(120, 180),
            ]);
        }

        // 4. Prawdziwe opinie
        $opinions = [
            'Super komis, everything professionally handled.', 'Auto zgodne z opisem, bardzo polecam.',
            'Bardzo miła obsługa, wszystko wyjaśnione rzetelnie.', 'Ceny konkurencyjne, auto w stanie idealnym.',
            'Jestem bardzo zadowolony z zakupu. Szybka finalizacja.', 'Profesjonalne podejście do klienta, polecam.',
            'Samochód sprawdzony na stacji diagnostycznej, wszystko ok.', 'Wszystko w najlepszym porządku.',
            'Serwis godny polecenia, przejrzysta historia pojazdu.', 'Kolejny zakup w tym komisie i znowu pełen sukces.',
            'Szybko, sprawnie i bez ukrytych wad.', 'Auto wyczyszczone, przygotowane do jazdy.',
            'Dobre doradztwo przy wyborze modelu.', 'Wszystko zgodnie z umową, polecam każdemu.',
            'Pełna dokumentacja i przejrzysta historia serwisowa.'
        ];

        // 5. Prawdziwe zgłoszenia serwisowe warsztatu
        $repairsList = [
            'Wymiana oleju i filtrów', 'Serwis klimatyzacji', 'Wymiana klocków hamulcowych',
            'Diagnostyka komputerowa silnika', 'Wymiana rozrządu', 'Ustawienie zbieżności',
            'Wymiana opon na letnie', 'Przegląd rejestracyjny', 'Naprawa zawieszenia',
            'Wymiana płynu chłodniczego', 'Wymiana świec zapłonowych', 'Czyszczenie wtryskiwaczy',
            'Naprawa wydechu', 'Wymiana piór wycieraczek', 'Sprawdzenie szczelności układu'
        ];

        $opinionIndex = 0;
        $repairIndex = 0;

        foreach ($users as $user) {
            for ($i = 0; $i < 3; $i++) {
                Review::create([
                    'user_id' => $user->id,
                    'rating' => rand(3, 5),
                    'comment' => $opinions[$opinionIndex++],
                ]);
            }

            for ($i = 0; $i < 3; $i++) {
                $randomCar = $carsData[array_rand($carsData)];
                $specificCarName = $randomCar[0] . ' ' . $randomCar[1];

                ServiceAppointment::create([
                    'user_id' => $user->id,
                    'car_name' => $specificCarName,
                    'appointment_date' => date('Y-m-d', strtotime('+' . rand(1, 30) . ' days')),
                    'description' => $repairsList[$repairIndex++],
                    'status' => ['nowe', 'w_naprawie', 'gotowe'][rand(0, 2)],
                ]);
            }
        }

        // 6. Zgłoszenia z formularza CRM (Zaktualizowana kolumna 'type' oraz poprawne statusy)
        if (isset($showcaseCars[0])) {
            Inquiry::create([
                'car_id' => $showcaseCars[0]->id,
                'name' => 'Tomasz Kaczmarek',
                'email' => 'tomasz.kaczmarek@poczta.onet.pl',
                'phone' => '500 123 456',
                'type' => 'zapytanie',
                'message' => 'Dzień dobry, czy cena za to Audi podlega jeszcze negocjacji? Czy macie do niego drugi komplet opon zimowych?',
                'status' => 'nowe',
            ]);
        }

        if (isset($showcaseCars[1])) {
            Inquiry::create([
                'car_id' => $showcaseCars[1]->id,
                'name' => 'Ewelina Wiśniewska',
                'email' => 'ewelina88@gmail.com',
                'phone' => '600 789 012',
                'type' => 'jazda_probna',
                'message' => 'Jestem bardzo zainteresowana tą hybrydą. Czy jest możliwość umówienia się na jazdę próbną w najbliższą sobotę w godzinach porannych?',
                'status' => 'nowe',
            ]);
        }

        if (isset($showcaseCars[2])) {
            Inquiry::create([
                'car_id' => $showcaseCars[2]->id,
                'name' => 'Kamil Glik',
                'email' => 'kamil.g@firma.pl',
                'phone' => null,
                'type' => 'zapytanie',
                'message' => 'Czy mogą Państwo przesłać bardziej szczegółowy raport VIN dla tego BMW na ten adres email?',
                'status' => 'w_toku',
            ]);
        }

        if (isset($showcaseCars[3])) {
            Inquiry::create([
                'car_id' => $showcaseCars[3]->id,
                'name' => 'Piotr Zając',
                'email' => 'piotrek.zajac@interia.pl',
                'phone' => '700 888 999',
                'type' => 'jazda_probna',
                'message' => 'Klasyk! Chętnie przyjadę go obejrzeć na żywo i posłuchać jak silnik pracuje. Będę jutro po 16:00.',
                'status' => 'nowe',
            ]);
        }
    }
}
