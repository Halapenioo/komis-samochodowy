# 🚗 UczciwyKomis PRO - System CRM i Zarządzania Flotą

Kompleksowy system webowy stworzony dla małych i średnich komisów samochodowych. Aplikacja centralizuje procesy zarządzania ofertami pojazdów, historią serwisową, pomiarami powłoki lakierniczej oraz zgłoszeniami klientów z poziomu jednej, zintegrowanej platformy.

![Screenshot z aplikacji - np. strona główna lub panel admina](link-do-zdjecia-lub-relatywna-sciezka)

## 🌟 Główne funkcjonalności

### 👤 Dla Klienta (Gość)
* **Katalog Pojazdów:** Przejrzysta lista dostępnych aut z możliwością szybkiego podglądu zdjęć.
* **Zaawansowane Filtrowanie:** Możliwość precyzyjnego wyszukiwania po marce, cenie, roczniku, pojemności silnika, przebiegu, rodzaju paliwa, skrzyni biegów i statusie "bezwypadkowy".
* **Karta Pojazdu (Raport):** Dostęp do szczegółowych danych technicznych oraz wizualizacji grubości powłoki lakierniczej (z podziałem na każdy element karoserii) w mikronach.
* **Formularz Kontaktowy:** Wbudowany formularz na karcie każdego pojazdu do szybkiego wysyłania zapytań o ofertę lub rezerwacji jazdy próbnej.
* **Responsywność:** W pełni funkcjonalny interfejs na urządzeniach mobilnych.

### 🛡️ Dla Administratora (Pracownik Komisu)
* **Panel Zarządzania Flotą:** Pełny moduł CRUD (Dodawanie, Edycja, Usuwanie) ofert z rygorystyczną walidacją formularzy po stronie serwera (m.in. sprawdzanie długości numeru VIN).
* **Zarządzanie Mediami:** Zoptymalizowany system wgrywania zdjęć głównych oraz dodatkowych galerii na serwer.
* **Moduł Skrzynki CRM:** Centralne miejsce odbioru zapytań od klientów. System automatycznie wiąże wiadomość klienta z konkretnym pojazdem z bazy, umożliwiając łatwą zmianę statusu obsługi (Nowe -> W kontakcie -> Zamknięte).
* **Raporty Lakiernicze i Naprawy:** Możliwość dodawania i ewidencjonowania pomiarów grubości lakieru oraz historii wymiany części eksploatacyjnych (z polityką niezmienności historycznej).

---

## 🛠️ Architektura Bazy Danych
Aplikacja opiera się na relacyjnej bazie danych SQLite z wykorzystaniem relacji `One-To-Many`. Główne encje to:
* `cars` (Główna tabela pojazdów)
* `inquiries` (Zgłoszenia CRM przypisane do aut - *Cascade Delete*)
* `inspections` (Raporty powłoki lakierniczej)
* `repairs` (Ewidencja wymienianych części)

---

## 💻 Technologie

Projekt został zbudowany w oparciu o najnowsze standardy branżowe:
* **Backend:** PHP 8.x, Laravel Framework
* **Baza Danych:** SQLite 3 (z możliwością bezbolesnej migracji na PostgreSQL/MySQL)
* **Frontend:** Blade Templating, Tailwind CSS 3, Alpine.js
* **Zarządzanie pakietami:** Composer (PHP) & NPM (Node.js)

---

## 🚀 Instrukcja Instalacji (Środowisko Lokalne)

### 1. Wymagania wstępne
Do uruchomienia projektu potrzebujesz zainstalowanych:
* PHP >= 8.2
* Composer
* Node.js & NPM
* Git

### 2. Proces instalacji

```bash
# 1. Klonowanie repozytorium
git clone [https://github.com/TwojLogin/uczciwy-komis-pro.git](https://github.com/TwojLogin/uczciwy-komis-pro.git)
cd uczciwy-komis-pro

# 2. Instalacja zależności backendowych (PHP)
composer install

# 3. Instalacja zależności frontendowych (NPM)
npm install
npm run build

# 4. Konfiguracja środowiska
cp .env.example .env
# W systemie Windows użyj: copy .env.example .env

# 5. Generowanie klucza aplikacji
php artisan key:generate

# 6. Tworzenie struktury bazy danych i ładowanie danych testowych
php artisan migrate:fresh --seed

# 7. Tworzenie dowiązania (symlink) do przechowywania przesyłanych zdjęć
php artisan storage:link
