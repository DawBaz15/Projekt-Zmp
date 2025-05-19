# API Systemu Magazynu
REST API do systemu informatycznego zarządzającego pracą magazynu, wykonane w PHP na Frameworku Laravel. Projekt w ramach zajęć zaawansowanych metod programowania na uczelni Collegium Witelona Uczelnia Państwowa prowadzonych przez mgr inż. Krzysztofa Rewaka.

# Uruchomienie
Aplikacja jest skonteneryzowana. Do uruchomienia przejdź do ścieżki aplikacji w terminalu Dockera i wpisz:
```
docker compose up -d
```
Przy pierwszym uruchomieniu zainstaluj wszystkie zależności:
```
cd laravel; composer install
```
Jeśli routy nie ustawiły się automatycznie, wejdź w kontener warehouse-laravel > Exec i wpisz:
```
service apache2 restart
```

# Dokumentacja OpenAPI
[Dokumentacja OpenAPI projektu.](https://github.com/DawBaz15/Projekt-Zmp/blob/master/laravel/openapi.yaml)