# **Dokumen Analisis Sistem**  
## *Proyek:* Sistem Simpan Pinjam Komik di Perpustakaan  
*Versi:* 1.0  
*Tanggal:* 14 November 2024  

---

## **1. Tujuan Sistem**  
Sistem ini bertujuan untuk:  
1. Mempermudah admin dalam mengelola data perpustakaan secara menyeluruh.  
2. Memberikan staf akses terbatas untuk mengelola data buku, peminjaman, pengembalian, dan data pengunjung.  

---

## **2. Fitur Utama Sistem**  

### **Admin**  
- **Manajemen Pengguna**: Membuat, mengedit, dan menghapus pengguna (staf).  
- **Pengelolaan Buku**: Menambah, memperbarui, dan menghapus data buku di perpustakaan.  
- **Manajemen Peminjaman**: Mencatat data peminjaman dan pengembalian buku, termasuk menghitung denda keterlambatan.  
- **Manajemen Pengunjung**: Mencatat dan melihat data kunjungan pengunjung.  

### **Staf**  
- **Pengelolaan Buku**: Menambah, memperbarui, dan menghapus data buku.  
- **Manajemen Peminjaman**: Mencatat peminjaman dan pengembalian buku.  
- **Manajemen Pengunjung**: Mencatat dan melihat data kunjungan pengunjung.  

---

## **3. Persyaratan Sistem**  

### **Persyaratan Fungsional**  
1. **Sistem Login**  
   - Hak akses berdasarkan peran (Admin dan Staf).  
   - Admin memiliki akses penuh ke semua fitur.  
   - Staf memiliki akses terbatas ke fitur tertentu.  

2. **Pengelolaan Buku**  
   - Admin dan staf dapat menambah, mengedit, dan menghapus data buku.  

3. **Pengelolaan Peminjaman dan Pengembalian**  
   - Admin dan staf dapat mencatat peminjaman, pengembalian, dan keterlambatan buku.  

4. **Pengelolaan Pengunjung**  
   - Staf dapat mencatat dan melihat data kunjungan pengunjung.  

### **Persyaratan Non-Fungsional**  
1. **Kemudahan Penggunaan**  
   - Sistem harus memiliki antarmuka yang ramah pengguna untuk admin dan staf.  

2. **Keamanan**  
   - Hanya admin yang dapat mengelola pengguna.  
   - Akses staf terbatas pada data buku, pengunjung, dan peminjaman.  

3. **Performa**  
   - Sistem harus responsif dan dapat menangani pengelolaan data tanpa hambatan.  

---

## **4. Struktur Data dan Implementasi Teknis**  

### **Model dan Migrasi**  

#### *Books*  
- **Atribut Tabel**:  
  - `id`: Primary Key  
  - `title`: Judul buku  
  - `author`: Pengarang  
  - `publisher`: Penerbit  
  - `available`: Status ketersediaan buku  
  - `created_at`, `updated_at`: Timestamp  

- **Seeder**: Menyediakan data awal buku untuk pengujian.  

#### *Visitors*  
- **Atribut Tabel**:  
  - `id`: Primary Key  
  - `name`: Nama pengunjung  
  - `visit_date`: Tanggal kunjungan  
  - `contact`: Informasi kontak pengunjung  
  - `created_at`, `updated_at`: Timestamp  

- **Seeder**: Menyediakan data awal pengunjung untuk pengujian.  

#### *Borrowings*  
- **Atribut Tabel**:  
  - `id`: Primary Key  
  - `visitor_id`: ID pengunjung  
  - `name`: Nama pengunjung  
  - `book_id`: ID buku  
  - `borrow_date`: Tanggal peminjaman  
  - `return_date`: Tanggal pengembalian  
  - `late_fees`: Denda keterlambatan  

- **Seeder**: Menyediakan data awal peminjaman untuk pengujian.  

#### *Permissions*  
- Permissions menggunakan **Spatie Laravel Permission**, dengan atribut:  
  - `id`: Primary Key  
  - `name`: Nama permission (contoh: manage_books).  
  - `guard_name`: Guard untuk permission (default: web).  

---

## **5. Hak Akses (Permissions)**  

### **Admin**  
1. **manage_users**: Mengelola akun staf.  
2. **manage_books**: Menambah, memperbarui, dan menghapus data buku.  
3. **manage_borrowings**: Mencatat peminjaman, pengembalian, dan keterlambatan.  
4. **manage_visitors**: Melihat dan mengelola data kunjungan pengunjung.  

### **Staf**  
1. **manage_books**: Menambah, memperbarui, dan menghapus data buku.  
2. **manage_borrowings**: Mencatat peminjaman dan pengembalian buku.  
3. **manage_visitors**: Mencatat dan melihat data pengunjung.  

---

## **6. Changelog**  

| **Versi** | **Tanggal**  | **Penulis**       | **Deskripsi**           |  
|-----------|--------------|-------------------|-------------------------|  
| 1.0       | 14-11-2024   | Aqla Harun R J    | Draft dokumen awal      |  

--- 
