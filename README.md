# AntriSehat

AntriSehat adalah aplikasi appointment booking klinik berbasis Laravel untuk Deliverable D3 MVP mata kuliah Rekayasa Perangkat Lunak.

## Deskripsi

Pasien dapat melihat dokter aktif, melihat jadwal praktik, melakukan booking appointment, memperoleh nomor antrean, melihat riwayat, dan membatalkan appointment yang masih pending. Admin klinik dapat mengelola data dokter, jadwal praktik, dan status appointment pasien.

## Tujuan D3 MVP

Membangun aplikasi klinik sederhana yang stabil, dapat dijalankan lokal, terintegrasi database SQLite, memiliki alur utama pasien dan admin, data dummy, dokumentasi, serta test case manual untuk demo.

## Tech Stack

- Laravel
- PHP
- Blade Template
- Tailwind CSS
- Eloquent ORM
- SQLite
- Laravel Migration & Seeder
- Laravel session-based authentication manual
- Composer
- npm + Vite
- GitHub

## Fitur Pasien

1. Registrasi akun pasien
2. Login dan logout
3. Dashboard pasien
4. Melihat daftar dokter aktif
5. Melihat jadwal praktik dokter
6. Booking appointment
7. Mendapat nomor antrean otomatis
8. Melihat riwayat appointment
9. Membatalkan appointment dengan status pending

## Fitur Admin

1. Login dan logout admin
2. Dashboard admin
3. CRUD data dokter
4. CRUD jadwal praktik dokter
5. Melihat daftar appointment pasien
6. Mengonfirmasi appointment pending
7. Membatalkan appointment pending/confirmed
8. Mengubah appointment confirmed menjadi completed

## Struktur Folder Penting

```text
app/Models
app/Http/Controllers
app/Http/Middleware/RoleMiddleware.php
database/migrations
database/seeders/DatabaseSeeder.php
resources/views/layouts/app.blade.php
resources/views/auth
resources/views/patient
resources/views/admin
routes/web.php
```

## Cara Instalasi

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
```

## Setup .env SQLite

Pastikan file `database/database.sqlite` tersedia. Pada `.env`, gunakan konfigurasi berikut:

```env
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=
```

Jika file SQLite belum ada:

```bash
php -r "file_exists('database/database.sqlite') || touch('database/database.sqlite');"
```

## Migration dan Seeder

```bash
php artisan migrate:fresh --seed
```

Seeder membuat:

- 1 admin dummy
- 2 pasien dummy
- 5 dokter
- 8 jadwal praktik
- 3 appointment contoh

## Menjalankan Aplikasi

Terminal 1:

```bash
npm run dev
```

Terminal 2:

```bash
php artisan serve
```

Buka aplikasi di:

```text
http://127.0.0.1:8000
```

## Akun Dummy

Admin:

```text
Email: admin@antrisehat.com
Password: admin123
```

Pasien:

```text
Email: pasien@antrisehat.com
Password: pasien123
```

## Alur Demo

### Demo Pasien

1. Buka `/login`.
2. Login sebagai pasien dummy.
3. Buka dashboard pasien.
4. Klik menu Dokter.
5. Pilih salah satu dokter dan lihat jadwal.
6. Klik Booking pada salah satu jadwal.
7. Isi tanggal appointment dan keluhan.
8. Submit booking.
9. Lihat nomor antrean pada halaman riwayat.
10. Batalkan appointment jika status masih pending.

### Demo Admin

1. Logout pasien.
2. Login sebagai admin dummy.
3. Buka dashboard admin.
4. Kelola dokter melalui menu Dokter.
5. Kelola jadwal praktik melalui menu Jadwal.
6. Buka menu Appointment.
7. Konfirmasi appointment pending.
8. Ubah appointment confirmed menjadi completed atau cancelled.

## Test Case Manual

| No | Skenario | Langkah | Hasil Diharapkan |
|---|---|---|---|
| 1 | Login pasien valid | Login dengan `pasien@antrisehat.com / pasien123` | Masuk ke `/dashboard` |
| 2 | Login admin valid | Login dengan `admin@antrisehat.com / admin123` | Masuk ke `/admin/dashboard` |
| 3 | Login gagal | Masukkan password salah | Muncul error email/password salah |
| 4 | Register pasien | Isi form register dengan email baru | Akun dibuat dan masuk dashboard pasien |
| 5 | Validasi email unique | Register dengan email yang sudah ada | Muncul error validasi unique |
| 6 | Lihat dokter | Pasien buka `/doctors` | Daftar dokter aktif tampil |
| 7 | Lihat jadwal dokter | Klik Lihat Jadwal | Jadwal praktik dokter tampil |
| 8 | Booking appointment | Isi tanggal dan keluhan | Appointment pending dibuat dan nomor antrean tampil |
| 9 | Kuota penuh | Booking melebihi kuota jadwal/tanggal sama | Muncul error “Kuota jadwal sudah penuh.” |
| 10 | Cancel appointment pasien | Pasien cancel appointment pending miliknya | Status berubah menjadi cancelled |
| 11 | Proteksi role pasien | Pasien buka `/admin/dashboard` | Redirect ke `/dashboard` |
| 12 | Proteksi role admin | Admin buka `/dashboard` | Redirect ke `/admin/dashboard` |
| 13 | CRUD dokter | Admin tambah/edit/hapus dokter | Data dokter berubah sesuai aksi |
| 14 | CRUD jadwal | Admin tambah/edit/hapus jadwal | Data jadwal berubah sesuai aksi |
| 15 | Confirm appointment | Admin confirm appointment pending | Status menjadi confirmed |
| 16 | Complete appointment | Admin complete appointment confirmed | Status menjadi completed |
| 17 | Cancel appointment admin | Admin cancel appointment pending/confirmed | Status menjadi cancelled |

## Informasi GitHub dan Trello

- GitHub repository: `https://github.com/DanishAlfarisy/AntriSehat.git`
- Trello Scrum board: isi dengan link board Trello tim setelah dibuat.

Contoh list Trello Scrum sederhana:

1. Product Backlog
2. Sprint Backlog
3. In Progress
4. Review/Testing
5. Done

Contoh kartu backlog:

- Setup Laravel project
- Setup SQLite migration
- Auth pasien/admin
- Booking appointment
- Admin CRUD dokter
- Admin CRUD jadwal
- Admin kelola appointment
- README dan test case manual
