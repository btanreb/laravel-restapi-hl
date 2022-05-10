## Uruchomienie projektu

1. Należy uruchomić dockera
    - docker-compose up -d
2. W kontenerze apache-php wykonać polecenie
    - cd project
    - composer install
    - cp .env.example .env
    - php artisan key:generate
3. Zdefiniować następujące wartości w pliku .env
    ```
    DB_CONNECTION=mysql
    DB_HOST=db
    DB_PORT=3306
    DB_DATABASE=hrlink
    DB_USERNAME=root
    DB_PASSWORD=michal
    ```
4. Wykonać migrację tabel
    - php artisan migrate
5. Uzupełnić tabele testowymi danymi
    - php artisan db:seed
6. Adres API
    - http://localhost:82/
7. Adres bazy (phpmyadmin)
    - http://localhost:8281/

## Rejestracja użytkownika
1. endpoint http://localhost:82/api/register
    query:
        - name
        - email
        - password
        - password_confirmation
2. Po założeniu konta kopiujemy otrzymany token
3. W celu dostępu do autoryzowanych endpointów api, wklejamy token jak Auth Bearer Token

## Logowanie użytkownika
1. endpoint http://localhost:82/api/login
    query:
        - email
        - password
2. Po zalogowaniu kopiujemy token

## Wylogowanie użytkownika
1. endpoint http://localhost:82/api/logout
2. Przekazujemy token jako Auth Bearer Token
3. Zostajemy wylogowani, a token jest usuwany z bazy

## Dostępne endpointy API

```
Dostęp publiczny:
/api/login [GET] - zalogowanie użytkownika (otrzymanie tokenu)
/api/register [POST] - rejestracja użytkownika (otrzymanie tokenu)

/api/products [GET] - zwraca wszystkie produkty

Dostęp autoryzowany:
/api/logout [POST] - wylogowanie użytkownika (zniszczenie tokenu)

/api/products [POST] - dodaje nowy produkt
/api/products/{id} [GET] - zwraca produkt o podanym ID
/api/products/{id} [PUT] - aktualizuje produkt o podanym ID
/api/products/{id} [DEL] - usuwa produkt o podanym ID
```
