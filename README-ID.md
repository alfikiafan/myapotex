# MyApotex

[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](https://opensource.org/licenses/MIT)

MyApotex adalah aplikasi manajemen apotek yang dibangun menggunakan Laravel. Aplikasi ini menyediakan fitur-fitur untuk mempermudah proses manajemen obat, data pengguna, transaksi penjualan, dan pengelolaan akun.

## Pilih Bahasa
[English](README.md) | [Bahasa Indonesia](README-ID.md)

## 🌟 Fitur

- **Login**: Fitur login yang dapat digunakan admin dan kasir untuk masuk ke dalam sistem.
- **Logout**: Fitur logout yang dapat digunakan admin dan kasir untuk keluar dari sistem.
- **Data Obat**: Fitur berisi informasi mengenai data obat yang berisi nama, merek, kategori, stok/kuantitas, diskon, dan harga.
- **Pencarian Obat**: Fitur pencarian data obat yang dapat digunakan admin dan kasir untuk melakukan filter atau pencarian data obat berdasarkan keyword yang diinginkan.
- **Manajemen Data Obat**: Fitur edit/manipulasi data obat yang dapat digunakan admin untuk menambahkan data obat baru, mengedit data obat, dan menghapus data obat yang diinginkan.
- **Data Akun**: Fitur berisi informasi mengenai data akun semua pengguna yang berisi nama, email, role, dan tanggal bergabung.
- **Pencarian Akun**: Fitur pencarian data akun semua pengguna yang dapat digunakan admin untuk melakukan filter atau pencarian data akun semua pengguna berdasarkan keyword yang diinginkan.
- **Manajemen Data Akun**: Fitur edit/manipulasi data akun semua pengguna yang dapat digunakan admin untuk menambahkan data akun baru dan menghapus data akun yang diinginkan.
- **Transaksi Penjualan**: Fitur melihat transaksi penjualan yang dapat digunakan admin untuk melihat transaksi penjualan apa saja yang terjadi.
- **Buat Transaksi Penjualan**: Fitur membuat transaksi penjualan yang dapat digunakan kasir untuk menambahkan transaksi penjualan baru.
- **Edit Profil**: Fitur edit profil yang dapat digunakan admin dan kasir untuk melihat informasi profil dan melakukan perubahan pada nama, email, dan password.

## ⚙️ Instalasi

Berikut adalah langkah-langkah untuk menginstal MyApotex di lingkungan lokal Anda:

1. Clone repositori ini ke dalam direktori lokal Anda:

```
git clone https://github.com/username/repo.git
```
atau download repositori ini dalam bentuk zip.

2. Pindah ke direktori proyek:

```
cd MyApotex
```

3. Salin file `.env.example` menjadi `.env`:

```
cp .env.example .env
```

4. Atur konfigurasi database di file `.env` sesuai dengan lingkungan Anda.

5. Jalankan perintah berikut untuk menginstal dependensi PHP:

```
composer install
```

6. Generate kunci aplikasi:

```
php artisan key:generate
```

7. Jalankan migrasi dan pengisian data awal:

```
php artisan migrate --seed
```

8. Jalankan server pengembangan Laravel:

```
php artisan serve
```

9. Buka browser dan akses `http://localhost:8000` untuk melihat aplikasi MyApotex.

## 🙌 Kredit

MyApotex dibangun menggunakan beberapa sumber daya dan library, termasuk:

- [Laravel](https://laravel.com)
- [Faker](https://fakerphp.github.io)
- [jQuery](https://jquery.com)
- [Corporate UI](https://www.creative-tim.com/product/corporate-ui-dashboard)

## 👨‍💻 Tim Pengembang

- [Alfiki Diastama Afan Firdaus](https://github.com/alfikiafan)
- [Afif Nur Fauzi](https://github.com/alscheift)
- [Faiz Fathoni](https://github.com/faizfathoni)
- [Hafidh Muhammad Akbar](https://github.com/hafidhmuhammadakbar)

## 🚀 Versi

**Versi saat ini: 1.0.0**

## 📄 Lisensi

MyApotex dilisensikan di bawah [MIT License](https://opensource.org/licenses/MIT).