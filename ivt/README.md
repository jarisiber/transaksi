# Inven Jaris

Aplikasi inventaris barang menggunakan Framework Laravel 10.

Beberapa CRUD menggunakan modal dan AJAX untuk pengambilan data agar mengurangi penggunaan pindah halaman.

### Prasyarat

Berikut beberapa hal yang perlu diinstal terlebih dahulu:

-   Composer (https://getcomposer.org/)
-   PHP ^8.1
-   MySQL
-   XAMPP

Jika Anda menggunakan XAMPP, untuk PHP dan MySQL sudah menjadi 1 (bundle) di dalam aplikasi XAMPP

### Fitur

- CRUD Data Barang
- Import/export excel barang
- Print barang (seluruh/individual)
- CRUD Data Perolehan
- CRUD Data Ruangan
- CRUD Data Pengguna
- Pengaturan Profil
- Send email notification
- Send message between users
- Tickets
- Tickets notifications
- 

### Langkah-langkah instalasi

-   Install seluruh packages yang dibutuhkan

```bash
$ composer install
```

-   Siapkan database dan atur file .env sesuai dengan konfigurasi Anda

-   Masukan nama aplikasi pada konfigurasi .env untuk menampilkan nama aplikasi pada print barang. Berikan tanda kutip jika nama aplikasi mengandung spasi

Contoh:

```
NAMA_SEKOLAH="APP OCP"
```

-   Jika sudah, migrate seluruh migrasi dan seeding data

```bash
$ php artisan migrate --seed
```

-   Jalankan local server

```
$ php artisan serve
```

-   User default aplikasi untuk login

Administrator

```
Email       : jaris@mail.com
Password    : secret
```

Admin

```
Email       : admin@mail.com
Password    : secret
```

### Dibuat dengan

-   [Laravel](https://laravel.com) - Web Framework

Color identity:
--color-1: #383838;
--color-light: #07cf5e;

### NOTE

Untuk menambahkan menu:
1. add menu pada components/layout (Coding)
2. tambahkan menu di tabel permission (DB)
3. tambahkan menu pada peran dan hak ases (di app)

### Patern Development

php artisan make:migration create_posts_table	\\create post migration gunakan s atau es
                                                \\definisikan tabelnya
php artisan migrate
php artisan make:seeder PostSeeder				\\Make Post Seeder
php artisan db:seed --class=PostSeeder			\\Insert data Post Seeder
php artisan make:model Post						\\create Post model
php artisan make:controller PostController		\\create Post controller

Tambah Kolom
------------
php artisan make:migration add_new_column_to_users_table --table=users		\\migration add new column to table
php artisan migrate

php artisan serve --host 192.168.1.102 --port 8001
php artisan serve --host 10.101.56.95 --port 8001

Fiture
------
cache query
cache template

Debugbar for Laravel
--------------------
activate:
.env -> APP_DEBUG=true
php artisan config:cache

NOTE : Tgl akurat adalah tanggal pada modal bukan pada DB


Final Step: Server Cron Job
The last step is ensuring your server runs the Laravel scheduler every minute. You must set up a single Cron job on your server (Linux/cPanel) that executes the following command every minute:

* * * * * cd /path-to-your-laravel-app && php artisan schedule:run >> /dev/null 2>&1