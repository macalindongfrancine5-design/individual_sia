# Inventory System

This is a Laravel-based inventory management system running in a Dockerized environment with laravel version is laravel 10 php 8.2 and database mysql.

---

## Prerequisites

Ensure you have the following installed on your system:

1. [Docker](https://www.docker.com/get-started)
2. [Docker Compose](https://docs.docker.com/compose/)

---

## Installation Guide

### 1. Clone the Project Repository
 Clone the repository:
   ```bash
   git clone https://github.com/adityaajinug/inventory-system.git
   ```

### 2. Navigating project
   
   ```bash
   cd inventory-system
   ```
### 3. Start Docker Containers
  
   ```bash
   docker-compose up -d
   ```
### 4. Run Install Composer 
  ```bash
   docker exec -it inventory_laravel_app bash
   ```
  ```bash
   composer install
   ```
### 5. Setup .env 
Notes : still in bash and do
  ```bash
   cp .env.example .env

   php artisan key:generate
   ```
Notes : if not in bash
  ```bash
   docker exec -it inventory_laravel_app cp .env.example .env

   docker exec -it inventory_laravel_app php artisan key:generate

   ```
if the env not setup db, you can copy paste this
```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=inventory_db
DB_USERNAME=inventory_user
DB_PASSWORD=passworddb
```
### 5. Setup .env 
Notes : still in bash and do
  ```bash
   php artisan migrate --seed
   ```
Notes : if not in bash
  ```bash
   docker exec -it inventory_laravel_app php artisan migrate --seed
   ```
### 6. Access the Application
```
http://localhost:8080
```

## APP Documentation

### Access the API documentation and run in postman

```url
https://documenter.getpostman.com/view/16112273/2sAY55bdpq#4011fc5e-d25a-454d-b587-51b2af7bd878
```

### Guide Answering Questions Related on API doc
#### notes: for created by is admin that id is 1 was creaated by seeder

1. CR untuk data item 
   - Items
      - Get Items
      - Create Items

2. CR untuk data kategori 
   - Categories
      - Get Category
      - Create Category

3. CR Supplier
   - Suppliers
      - Get Suppliers
      - Create Suppliers     

4. Menampilkan ringkasan stok barang termasuk stok total, total nilai stok (harga x
jumlah), dan rata-rata harga barang.
   - Summary
      - Get General Stock    

5. Menampilkan daftar barang yang stoknya di bawah ambang batas tertentu (misalkan
di bawah 5 unit).
   - Items
      -  List Items with limit (notes: hardcode quantity <= 200)

6. Menampilkan laporan barang berdasarkan kategori tertentu.
   - Items
      - Get Items By Category

7. Menampilkan ringkasan per kategori, termasuk jumlah barang per kategori, total
nilai stok tiap kategori, dan rata-rata harga barang dalam kategori tersebut.
   - Summary
      - Category

8. Menampilkan ringkasan barang yang disuplai oleh masing-masing pemasok,
termasuk jumlah barang per pemasok dan total nilai barang yang disuplai.
   - Summary
      - Supplier

9. Menampilkan ringkasan dari keseluruhan sistem, termasuk total jumlah barang, nilai
stok keseluruhan, jumlah kategori, dan jumlah pemasok.
   - Summary
      - All