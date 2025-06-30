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

2. docker-compose up -d --build

3. w kontenerze zaintaluj zależności i zrób migracje

```bash
composer install
php artisan migrate
php artisan serve
```

http://localhost:8000

Powiadomienia e-mail można testować przez logi.
