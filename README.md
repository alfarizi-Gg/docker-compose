# Docker Compose untuk PHP & MySQL

Repositori ini menyediakan setup sederhana untuk menjalankan aplikasi PHP dengan MySQL menggunakan Docker Compose.

## Memulai

### 1. Clone Repository
```sh
https://github.com/alfarizi-Gg/docker-compose.git
cd docker-compose
```

### 2. Konfigurasi `docker-compose.yml`
Pastikan `docker-compose.yml` memiliki layanan berikut:
```yaml
version: "3.8"

services:
  app:
    build: .
    container_name: php_app
    ports:
      - "8080:80"
    volumes:
      - ./src:/var/www/html
    depends_on:
      - db

  db:
    image: mysql:8.0
    container_name: mysql_db
    restart: always
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: mydatabase
      MYSQL_USER: user
      MYSQL_PASSWORD: password
    ports:
      - "3306:3306"
    volumes:
      - mysql_data:/var/lib/mysql

  phpmyadmin:
    image: phpmyadmin/phpmyadmin
    container_name: phpmyadmin
    restart: always
    ports:
      - "8081:80"
    environment:
      PMA_HOST: db
      MYSQL_ROOT_PASSWORD: root
    depends_on:
      - db

volumes:
  mysql_data:
```

### 3. Bangun dan Jalankan Container
```sh
docker-compose up -d --build
```

### 4. Periksa Container yang Berjalan
```sh
docker ps
```
Pastikan container sedang berjalan.

### 5. Akses Aplikasi
Buka browser dan kunjungi:
```
http://localhost:8000
```

## Mengecek Database MySQL
### 1. Akses Container MySQL
```sh
docker exec -it mysql_db mysql -u user -p
```
Masukkan password (`password`) ketika diminta.

### 2. Pilih Database
```sql
USE mydatabase;
```

### 3. Tampilkan Tabel
```sql
SHOW TABLES;
```

## Mengunggah Image ke Docker Hub
### 1. Login ke Docker Hub
```sh
docker login
```
Masukkan kredensial Docker Hub.

### 2. Tandai Image
```sh
docker tag php_app:latest alfarizi17/php_app:latest
```

### 3. Push ke Docker Hub
```sh
docker push alfarizi17/php_app:latest
```

### 4. Tarik dan Jalankan dari Docker Hub (di Komputer Lain)
```sh
docker pull alfarizi17/php_app:latest
docker run -d -p 8080:80 alfarizi17/php_app:latest
```

## Menghentikan dan Menghapus Container
Untuk menghentikan container yang berjalan:
```sh
docker-compose down
```
Untuk menghapus semua volume (termasuk database MySQL):
```sh
docker-compose down -v
```

## Lisensi
Proyek ini dilisensikan di bawah MIT License.

