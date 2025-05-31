# Aplikasi Klinik - Laravel

Aplikasi manajemen klinik berbasis Laravel. Proyek ini mencakup fitur login, perawatan pasien, pemeriksaan perawat & dokter, serta pengelolaan resep obat.

## 🔧 Langkah Instalasi

Setelah meng-clone repositori ini:

```bash
git clone https://github.com/mthh0308/test.git
cd test
```

1. **Install dependency Laravel**  
   Pastikan kamu sudah install Composer:
   ```bash
   composer install
   ```

2. **Copy file `.env`**
   ```bash
   cp .env.example .env
   ```

3. **Generate APP_KEY**
   ```bash
   php artisan key:generate
   ```

4. **Buat database dengan nama `klinik`**

   Pastikan koneksi database di `.env` disesuaikan:

   ```
   DB_DATABASE=klinik
   DB_USERNAME=root
   DB_PASSWORD= (isi sesuai lokalmu)
   ```

5. **Jalankan migrasi**
   ```bash
   php artisan migrate
   ```

6. **Seed database**
   ```bash
   php artisan db:seed
   ```

   Ini akan membuat akun admin default.

---

## 🔐 Akun Login Admin

- **Email**: `admin@gmail.com`  
- **Password**: `Admin123`

---

## ▶️ Menjalankan Project

```bash
php artisan serve
```

Buka browser dan akses:
```
http://127.0.0.1:8000
```

---

## 📌 Catatan

- Gunakan Laravel versi 8 atau lebih baru
- Pastikan environment sudah include PHP, Composer, dan MySQL

---

Happy coding! 🚀
