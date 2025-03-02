# Course System

```
docker-compose up -d
docker-compose exec -it course bash
# 進入 bash 之後
composer install
cp .env.example .env
php artisan key:generate
```
