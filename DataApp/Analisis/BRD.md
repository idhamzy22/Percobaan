*# **Dokumen Persyaratan Bisnis (BRD)*  
### *Proyek:* Sistem Simpan Pinjam Komik di Perpustakaan  
*Versi:* 1.0
*Tanggal:* 14 November 2024  

---

## *1. Tujuan Proyek*
- *Objektif*: Sistem ini dirancang untuk mempermudah admin dalam mengelola data perpustakaan secara menyeluruh dan memberikan staf akses terbatas untuk mengelola data buku, peminjaman, pengembalian, dan data pengunjung.

---

## *2. Fitur Utama*

### *Untuk Staff*
- *Pengelolaan Buku*: Menambah, memperbarui, dan menghapus data buku.
- *Peminjaman dan Pengembalian Buku*: Mencatat peminjaman, pengembalian, dan keterlambatan.
- *Manajemen Pengunjung*: Mencatat dan melihat data kunjungan pengunjung. 

### *Untuk Admin*
- *Manajemen Pengguna*: Mengelola akun dan hak akses staf.
- *Pengelolaan Buku*: Menambah, memperbarui, dan menghapus data buku.
- *Peminjaman dan Pengembalian Buku*: Mencatat peminjaman, pengembalian, dan keterlambatan.
- *Manajemen Pengunjung*: Mencatat dan melihat data kunjungan pengunjung.

---

## *3. Persyaratan Fungsional*

### *Sistem Login*
- *Akses Berdasarkan Peran*: Admin memiliki akses penuh ke semua fitur, sedangkan staf memiliki akses terbatas pada fitur pengelolaan buku, peminjaman dan pengembalian, serta manajemen pengunjung.

### *Pengelolaan Buku*
- *Admin & Staff*: Menambah, mengedit, dan menghapus data buku di perpustakaan.

### *Pengelolaan Pengunjung*
- *Staff*: Mencatat dan melihat data kunjungan pengunjung untuk pelaporan harian dan bulanan.

---

## *4. Persyaratan Non-Fungsional*

- *Kemudahan Penggunaan*: Antarmuka yang ramah pengguna untuk admin dan staf.
- *Keamanan*: Hanya admin yang dapat mengelola pengguna dan melihat semua laporan, sedangkan staf hanya dapat mengakses data pengunjung dan buku sesuai hak akses yang diberikan.
- *Performa*: Sistem yang responsif untuk memastikan pengelolaan buku, peminjaman, dan data pengunjung berlangsung tanpa hambatan.

---

## **5. Model, Migrasi, Seeder, dan Resource yang Perlu Dibuat Pada Container docker exec -it sample bash**

### *Books*
- *Model*: Books. Menyimpan data lengkap buku, seperti judul, pengarang, penerbit, dan status ketersediaan.
- *Migration*: Struktur tabel berikut ini akan dibuat pada database:
  - id: bigint UNSIGNED (Primary Key)
  - title: varchar(255) - Judul buku
  - author: varchar(255) - Pengarang
  - publisher: varchar(255) - Penerbit
  - available: boolean - Status ketersediaan
  - created_at: timestamp - Waktu data dibuat
  - updated_at: timestamp - Waktu data diubah
- *Seeder*: Data buku awal untuk pengujian.
- *Resource*: Endpoint API untuk data buku, dapat diakses oleh admin dan staf.

### *Visitors*
- *Model*: visitors. Menyimpan data lengkap pengunjung, seperti nama, tanggal kunjungan, dan informasi kontak.
- *Migration*: Struktur tabel berikut ini akan dibuat pada database:
  - id: bigint UNSIGNED (Primary Key) - ID unik untuk setiap pengunjung.
  - name: varchar(255) - Nama pengunjung.
  - visit_date: date - Tanggal kunjungan.
  - contact: varchar(255) - Informasi kontak pengunjung (opsional).
  - created_at: timestamp - Waktu data dicatat.
  - updated_at: timestamp - Waktu data diubah.
- *Seeder*: Data pengunjung awal untuk pengujian.
- *Resource*: Endpoint API untuk data pengunjung, dikelola oleh admin staf.

### *Borrowings*
- *Model*: Borrowings. Mencatat data peminjaman, seperti ID pengunjung (NIK), nama pengunjung, ID buku, tanggal peminjaman, dan tanggal pengembalian.
- *Migration*: Struktur tabel berikut ini akan dibuat pada database:
  - id: bigint UNSIGNED (Primary Key)
  - visitor_id: bigint - ID pengunjung
  - name: varchar(255) - Nama pengunjung
  - book_id: bigint - ID buku
  - borrow_date: date - Tanggal peminjaman
  - return_date: date - Tanggal pengembalian
  - late_fees: decimal(10,2) - Denda keterlambatan
- *Seeder*: Data peminjaman awal untuk pengujian.
- *Resource*: Endpoint API untuk data peminjaman, dikelola oleh admin dan staf.
  
### *Permissions*
- *Model*: Permission. digunakan untuk menyimpan data permissions dengan atribut berikut:
  - id: Primary key dari permission.
  - name: Nama dari permission (contoh: manage_books).
  - guard_name: Guard untuk permission (default: web).
  
- *Seeder*: PermissionsSeeder, bertugas menambahkan permissions dan menetapkannya ke role admin dan staf

#### Mengapa Migration Permissions Tidak Dibuat? 

Karena saat membuat proyek baru dengan perintah composer create-project --prefer-dist raugadh/fila-starter ., migrasi untuk tabel permissions sudah disediakan oleh spatie/laravel-permission. Paket ini secara otomatis mengatur tabel dan kolom yang diperlukan untuk permissions dan roles, sehingga tidak perlu membuat migrasi permissions secara manual.

---

## *6. Analisis Permissions untuk Staf dan Admin*

Pada proyek aplikasi pengelolaan buku perpustakaan ini, permissions diperlukan untuk membatasi akses staf terhadap fitur yang sesuai dengan peran mereka, sementara admin memiliki akses penuh ke seluruh sistem. Permissions ini memastikan staf hanya dapat mengakses dan mengelola data buku, peminjaman, pengembalian, dan pengunjung sesuai dengan hak yang diberikan, sedangkan admin dapat mengelola seluruh sistem termasuk pengelolaan pengguna.

### *Permissions yang Diperlukan*

1. *Permissions untuk Admin*
   - manage_users: Mengizinkan admin untuk mengelola akun staf, menambah, mengedit, dan menghapus pengguna.
   - manage_books: Mengizinkan admin untuk menambah, mengedit, dan menghapus data buku di perpustakaan.
   - manage_borrowings: Mengizinkan admin untuk mengelola data peminjaman dan pengembalian buku, serta denda keterlambatan.
   - manage_visitors: Mengizinkan admin untuk melihat dan mengelola data kunjungan pengunjung.

2. *Permissions untuk Staf*
   - manage_books: Mengizinkan staf untuk menambah, mengedit, dan menghapus data buku di perpustakaan.
   - manage_borrowings: Mengizinkan staf untuk mencatat peminjaman dan pengembalian buku, serta denda keterlambatan.
   - manage_visitors: Mengizinkan staf untuk mencatat dan melihat data kunjungan pengunjung.

### *Implementasi Model dan Seeder untuk Permissions*

#### **Model: Permission**

Model Permission disediakan oleh paket Spatie Laravel Permission. Model ini akan menyimpan data permissions dengan atribut berikut:
- id: Primary key dari permission.
- name: Nama dari permission (contoh: manage_books).
- guard_name: Guard untuk permission (default: web).

#### *Seeder: PermissionsSeeder*
Seeder PermissionsSeeder akan digunakan untuk membuat dan menetapkan permissions kepada role admin dan staf.

---

## *Changelog*

| Versi | Tanggal       | Penulis         | Deskripsi                          |
|-------|---------------|-----------------|------------------------------------|
| 1.0   | 14-11-2024    | Aqla Harun R J  | Draft dokumen awal                 |

---