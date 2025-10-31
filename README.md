# 🌿 Aplikasi Bank Sampah Berbasis Web

Aplikasi ini merupakan sistem **Kalkulator & Manajemen Bank Sampah** berbasis **PHP dan MySQL**, yang dirancang untuk membantu pengelolaan data jenis sampah serta perhitungan nilai ekonominya secara digital dan efisien.

---
Cara Instalasi:
1. Jalankan Laragon / XAMPP, klik Start All.
2. Letakkan folder "bank-sampah" ke dalam C:\laragon\www\
3. Buka phpMyAdmin → buat database dengan nama bank_sampah_db
4. Import file bank_sampah_db.sql
5. Buka di browser:
   http://localhost/bank-sampah/user/
6. Login Admin:
   http://localhost/bank-sampah/admin/
   Username: admin
   Password: admin123

## 🚀 Fitur Utama

### 👥 **Sisi User**
- Menghitung nilai sampah berdasarkan **jenis dan berat (Kg)**  
- Rekomendasi otomatis dengan **JavaScript interaktif**  
- Tampilan responsif (mobile friendly) menggunakan **Bootstrap 5**

### 🔐 **Sisi Admin**
- Login aman menggunakan session PHP  
- CRUD Jenis Sampah (Tambah, Edit, Hapus, Upload Foto)  
- Preview foto sebelum disimpan  
- Validasi otomatis harga & berat  
- Logout  

---

## 🛠️ **Teknologi yang Digunakan**
| Komponen | Teknologi |
|-----------|------------|
| Bahasa | PHP 8.x |
| Database | MySQL |
| Frontend | HTML5, CSS3, Bootstrap 5 |
| Interaktivitas | JavaScript |
| Server Lokal | Laragon / XAMPP |

---

## 🧩 **Struktur Folder**
