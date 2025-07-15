# TODO App - Laravel

## Opis

Aplikacja na rzecz rekrutacji do Junior PHP Developer - Grupa RBR do zarządzania zadaniami z rejestracją, logowaniem, wysyłką maila i możliwością generowania publicznych linków do zadań.

---

## Uruchomienie Docker

1. Sklonuj repozytorium:

```bash
git clone https://github.com/ProgramistaDawidMajchrzak/todo-rbr
cd todo-rbr
```
2. zbuduj kontener i zainstaluj zaleznosci
```bash
docker-compose up -d --build
```
3. zainstaluj zaleznosci
```bash
npm install
npm run build
composer install
```
5. utworz .env file
```bash
cp .env.example .env
php artisan key:generate
```
6. zrób migracje
```bash
php artisan migrate
php artisan serve
```

http://localhost:8000

Powiadomienia e-mail można testować przez logi.
