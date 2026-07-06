# Documentation

## Prerequisites
1. Docker Desktop
2. Docker Compose
3. Composer
4. Git
5. Postman (for API testing)

---

## Installation & Setup

### 1. Clone the project
```bash 
git clone https://github.com/Amr-Saymeh/laravel-testing-space.git
```
```bash 
cd laravel-testing-space
```
---

### 2. Copy environment file and configure it
```bash 
cp .env.example .env
```
---

### 3. Start Docker containers
```bash 
docker compose up -d
```
---

### 4. Install dependencies while inside the container
```bash 
docker compose exec laravel.test composer install 
```
---

### 5. Generate application key
```bash 
docker compose exec laravel.test php artisan key:generate
```
---

### 6. Rebuild containers
```bash 
docker compose down -v
```
```bash 
docker compose build --no-cache
```
```bash 
docker compose up -d
```
---

### 7. Run migrations
Wait a few seconds after containers start before running this:
```bash 
docker compose exec laravel.test php artisan migrate
```
---

## API Base URL
```bash 
http://127.0.0.1/api
```
---

