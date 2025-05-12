````markdown
# Kelon

**Kelon** adalah aplikasi kelas online berbasis Laravel yang dirancang untuk memfasilitasi proses belajar mengajar secara digital. Aplikasi ini memungkinkan pengelolaan kelas, materi, pengguna, dan interaksi antara pengajar dan peserta secara efisien.

## Fitur

- **Manajemen Kelas**: Buat dan kelola berbagai kelas online.
- **Pengelolaan Materi**: Unggah dan atur materi pembelajaran untuk tiap kelas.
- **Sistem Pengguna**: Dukungan multi-role untuk admin, pengajar, dan peserta.
- **Dockerized**: Instalasi dan setup mudah dengan `docker-compose`.
- **Manajemen Aset Modern**: Kompilasi aset frontend menggunakan Vite.

## Prasyarat

Sebelum memulai, pastikan Anda telah menginstal:

- PHP >= 8.1
- Composer
- Docker & Docker Compose
- Node.js & npm

## Instalasi

1. **Klon repositori ini:**

   ```bash
   git clone https://github.com/agungdh/kelon.git
   cd kelon
````

2. **Salin file `.env` dan sesuaikan konfigurasi:**

   ```bash
   cp .env.example .env
   ```

3. **Bangun dan jalankan kontainer Docker:**

   ```bash
   docker-compose up -d
   ```

4. **Instal dependensi PHP dengan Composer:**

   ```bash
   docker-compose exec app composer install
   ```

5. **Generate application key:**

   ```bash
   docker-compose exec app php artisan key:generate
   ```

6. **Jalankan migrasi database:**

   ```bash
   docker-compose exec app php artisan migrate
   ```

7. **Instal dependensi frontend dan kompilasi aset:**

   ```bash
   npm install
   npm run dev
   ```

## Struktur Direktori

* `app/` - Logika aplikasi dan model.
* `bootstrap/` - File bootstrap Laravel.
* `config/` - Konfigurasi aplikasi.
* `database/` - Migrasi dan seeder.
* `public/` - Entry point aplikasi.
* `resources/` - View dan aset frontend.
* `routes/` - Definisi rute.
* `storage/` - File yang dihasilkan aplikasi.
* `tests/` - Pengujian aplikasi.

## Kontribusi

Kontribusi sangat terbuka! Silakan fork repositori ini dan ajukan pull request untuk perbaikan atau penambahan fitur.

## Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).
