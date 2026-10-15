# PartyFinder

PartyFinder je spletna aplikacija za odkrivanje, ustvarjanje in pridruževanje zabavam ter drugim dogodkom. Uporabnikom omogoča pregled razpoložljivih zabav, upravljanje lastnih dogodkov in povezovanje z drugimi udeleženci.

Projekt je bil izdelan kot praktična demonstracija razvoja moderne spletne aplikacije z uporabo ogrodja Laravel.

## Ključne funkcionalnosti

- Registracija in prijava uporabnikov
- Pregled javno dostopnih zabav
- Ustvarjanje novih zabav
- Urejanje in brisanje lastnih zabav
- Pridružitev zabavi
- Odjava od zabave
- Upravljanje uporabniškega profila
- Avtentikacija in zaščita uporabniških funkcionalnosti
- Relacija med uporabniki in zabavami
- Prilagodljiv uporabniški vmesnik

## Uporabljene tehnologije

### Backend

- PHP 8.2+
- Laravel 12
- Laravel Eloquent ORM
- Laravel Breeze
- SQLite ali druga podprta relacijska podatkovna baza

### Frontend

- Blade
- Tailwind CSS
- Alpine.js
- Vite
- Axios

### Orodja za razvoj

- Composer
- npm
- Pest / PHPUnit
- Laravel Artisan

## Arhitektura aplikacije

Aplikacija uporablja Laravelovo MVC arhitekturo:

- **Models** – podatkovni modeli in relacije
- **Views** – uporabniški vmesnik, izdelan z Blade predlogami
- **Controllers** – poslovna logika in obdelava zahtevkov
- **Routes** – definiranje javnih in zaščitenih spletnih poti
- **Migrations** – struktura podatkovne baze
- **Seeders** – začetni testni podatki

## Namestitev in zagon

### Zahteve

Pred namestitvijo moraš imeti nameščeno:

- PHP 8.2 ali novejši
- Composer
- Node.js in npm
- Podatkovno bazo, na primer SQLite

### 1. Kloniranje repozitorija

```bash
git clone https://github.com/nihadajdaroski/partyfinder.git
cd partyfinder
```

### 2. Namestitev odvisnosti

```bash
composer install
npm install
```

### 3. Konfiguracija okolja

Kopiraj datoteko `.env.example` v `.env` in ustvari aplikacijski ključ:

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Nastavitev podatkovne baze

Če uporabljaš SQLite, ustvari datoteko podatkovne baze:

```bash
touch database/database.sqlite
```

V datoteki `.env` nastavi:

```env
DB_CONNECTION=sqlite
```

### 5. Migracije in testni podatki

```bash
php artisan migrate --seed
```

### 6. Zagon razvojnega okolja

V prvem terminalu zaženi Laravel strežnik:

```bash
php artisan serve
```

V drugem terminalu zaženi Vite:

```bash
npm run dev
```

Aplikacija bo privzeto dostopna na `http://127.0.0.1:8000`.

## Uporabni ukazi

```bash
# Laravel razvojni strežnik
php artisan serve

# Vite razvojni način
npm run dev

# Izgradnja frontend datotek
npm run build

# Ponastavitev podatkovne baze in ponovno sejanje
php artisan migrate:fresh --seed

# Zagon testov
php artisan test
```

## Primer uporabniškega toka

1. Uporabnik ustvari račun ali se prijavi.
2. Na začetni strani pregleda razpoložljive zabave.
3. Odpre podrobnosti izbrane zabave.
4. Zabavi se pridruži ali jo zapusti.
5. Ustvari lahko tudi svojo zabavo.
6. Svoje zabave lahko kasneje ureja ali odstrani.

## Cilj projekta

Glavni cilj projekta je bil izdelati funkcionalno spletno platformo, ki povezuje uporabnike na podlagi skupnih interesov za druženje in dogodke.

Pri razvoju sem se osredotočil predvsem na:

- delo z uporabniško avtentikacijo,
- izdelavo CRUD funkcionalnosti,
- povezovanje modelov z Eloquent ORM,
- zaščito poti z middleware-i,
- delo z migracijami in seederji,
- izdelavo dinamičnega uporabniškega vmesnika,
- organizacijo Laravel projekta po MVC principu.

## Možne izboljšave

V prihodnosti bi bilo mogoče dodati:

- iskanje in filtriranje zabav,
- razvrščanje po lokaciji in datumu,
- zemljevid dogodkov,
- sistem ocen in komentarjev,
- obvestila uporabnikom,
- nalaganje slik zabav,
- klepet med udeleženci,
- moderiranje vsebine,
- API za mobilno aplikacijo.

## Avtor

**Nihad Ajdaroski**

- GitHub: [@nihadajdaroski](https://github.com/nihadajdaroski)
- Repozitorij: [github.com/nihadajdaroski/partyfinder](https://github.com/nihadajdaroski/partyfinder)

## Licenca

Projekt je namenjen izobraževalni in portfolijski predstavitvi.
