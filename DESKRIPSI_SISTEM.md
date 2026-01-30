# DESKRIPSI UMUM SISTEM
## Aplikasi Platform Pembelajaran dan Ekskul Digital

---

## 1. PENDAHULUAN

Sistem ini merupakan sebuah platform web terpadu yang dirancang untuk mengelola berbagai kegiatan pembelajaran dan ekstrakurikuler secara digital. Platform ini mengintegrasikan fitur-fitur modern seperti e-learning, manajemen acara, podcast, dan sistem pembayaran dalam satu ekosistem yang kohesif.

---

## 2. VISI DAN MISI

**Visi:**
Menyediakan platform pembelajaran digital yang komprehensif dan mudah diakses untuk mendukung pengembangan kompetensi peserta dalam berbagai bidang.

**Misi:**
- Memfasilitasi pembelajaran digital melalui kursus online (e-course)
- Mengelola kegiatan dan acara pendidikan secara efisien
- Menyediakan konten pembelajaran melalui podcast dan media interaktif
- Membangun komunitas pembelajaran yang aktif dan kolaboratif
- Mengintegrasikan sistem pembayaran untuk transaksi kursus premium

---

## 3. FITUR-FITUR UTAMA SISTEM

### 3.1 Manajemen Pengguna
- **Registrasi dan Otentikasi**: Sistem pendaftaran pengguna dengan validasi email
- **Reset Password**: Fitur pemulihan password melalui link reset email
- **Profil Pengguna**: Pengelolaan data dan informasi pribadi pengguna
- **Sistem Peran**: Implementasi role-based access control (RBAC) untuk membedakan antara pengguna biasa dan admin

### 3.2 E-Course (Pembelajaran Digital)
- **Katalog Kursus**: Daftar lengkap kursus yang tersedia dengan berbagai kategori
- **Kategori Kursus**: Pengelompokan kursus berdasarkan topik (Komik, Film & Konten Kreator, Robotik, dll)
- **Detail Kursus**: Informasi lengkap tentang setiap kursus termasuk deskripsi, harga, dan konten
- **Enrollment Kursus**: Pendaftaran pengguna ke kursus dengan pelacakan status
- **Konten Pembelajaran**: Materi pembelajaran terstruktur dalam bentuk lessons dan modules
- **Tingkat Kesulitan**: Sistem level kursus untuk mengidentifikasi target learner
- **Sistem Harga**: Dukungan harga original, harga diskon, dan pricing dinamis

### 3.3 Sistem Keranjang dan Pembayaran
- **Shopping Cart**: Fitur tambah ke keranjang untuk kursus
- **Manajemen Keranjang**: Kemampuan update, hapus, dan clear keranjang
- **Coupon/Promo**: Sistem kupon diskon untuk transaksi
- **Order Management**: Pembuatan dan pelacakan pesanan
- **Order Items**: Rincian item dalam setiap pesanan
- **Sistem Pembayaran**: Integrasi dengan payment gateway untuk pemrosesan transaksi
- **Riwayat Pesanan**: Pencatatan lengkap riwayat pembelian pengguna

### 3.4 Event Management
- **Daftar Acara**: Katalog lengkap acara dan kegiatan yang akan diadakan
- **Detail Acara**: Informasi lengkap tentang tanggal, tempat, dan deskripsi acara
- **Penjadwalan**: Sistem scheduling untuk mengelola jadwal acara
- **Pendaftaran Acara**: Mekanisme pendaftaran peserta untuk acara

### 3.5 Podcast dan Konten Media
- **Katalog Podcast**: Daftar podcast yang tersedia untuk diakses pengguna
- **Detail Podcast**: Informasi lengkap tentang podcast termasuk deskripsi dan durasi
- **Streaming Content**: Kemampuan memutar podcast secara langsung

### 3.6 Komunitas
- **Komunitas**: Ruang diskusi dan kolaborasi antar pengguna
- **Anggota Komunitas**: Pengelolaan keanggotaan dan role dalam komunitas
- **Interaksi Sosial**: Fitur untuk berbagi pengalaman dan saling mendukung

### 3.7 Fitur Tambahan
- **Search**: Pencarian global untuk menemukan kursus, acara, dan konten lainnya
- **Testimonial**: Ulasan dan testimoni dari pengguna
- **Post/Blog**: Fitur publikasi artikel dan berita
- **File Management**: Pengelolaan file-file pembelajaran
- **Notifikasi**: Sistem notifikasi untuk update penting

---

## 4. ARSITEKTUR SISTEM

### 4.1 Stack Teknologi

**Backend:**
- Framework: Laravel 12.x
- PHP Version: ^8.2
- Database: MySQL/MariaDB
- ORM: Eloquent

**Frontend:**
- Build Tool: Vite 7.x
- Styling: Tailwind CSS 4.x
- JavaScript Framework: Vanilla JS / Axios
- Package Manager: npm

**Tools & Libraries:**
- Spatie Permission: Manajemen role dan permission
- Intervention Image: Manipulasi dan optimasi gambar
- Laravel Sanctum: API token authentication
- Laravel Telescope: Debugging dan monitoring
- Pusher: Real-time event broadcasting
- PHPUnit: Testing framework

### 4.2 Struktur Folder Aplikasi

```
app/
├── Console/          # Command line commands
├── Http/
│   ├── Controllers/  # Logic handling requests
│   ├── Requests/     # Form validation requests
│   └── Api/         # API controllers
├── Mail/            # Email classes
├── Models/          # Database models
├── Notifications/   # Notification classes
├── Providers/       # Service providers
└── Services/        # Business logic services

database/
├── migrations/      # Database schema migrations
├── factories/       # Model factories untuk testing
└── seeders/        # Database seeders

resources/
├── views/          # Blade template files
├── css/            # Stylesheet files
└── js/             # JavaScript files

routes/
├── web.php         # Web routes
├── api.php         # API routes
└── console.php     # Console commands

config/
├── app.php         # Application configuration
├── database.php    # Database configuration
├── mail.php        # Email configuration
├── auth.php        # Authentication configuration
└── ...            # Konfigurasi lainnya

public/
├── index.php       # Application entry point
├── css/            # Published CSS assets
├── js/             # Published JS assets
└── images/         # Static images
```

---

## 5. MODEL DATA DAN ENTITAS UTAMA

### 5.1 Entity Relationship Diagram (Data Model)

Aplikasi menggunakan 25 model utama yang saling berelasi:

| Model | Deskripsi |
|-------|-----------|
| **User** | Pengguna sistem (students, instructors, admins) |
| **Category** | Kategori untuk kursus dan konten |
| **Ecourse** | Kursus online yang ditawarkan |
| **EcourseLesson** | Lesson/materi dalam satu ecourse |
| **EcourseEnrollment** | Data pendaftaran pengguna ke ecourse |
| **CourseCard** | Card/modul pembelajaran dalam ecourse |
| **CourseContent** | Konten terstruktur dari course card |
| **Cart** | Keranjang belanja pengguna |
| **CartItem** | Item individual dalam keranjang |
| **Order** | Pesanan/transaksi pembelian |
| **OrderItem** | Item individual dalam pesanan |
| **Coupon** | Kode promo dan diskon |
| **Payment** | Record pembayaran/transaksi |
| **Event** | Acara/event yang diselenggarakan |
| **Schedule** | Jadwal untuk event dan kursus |
| **Podcast** | Konten podcast yang tersedia |
| **Post** | Artikel atau blog post |
| **Community** | Komunitas pengguna |
| **CommunityMember** | Anggota dalam komunitas |
| **Profile** | Profil extended pengguna |
| **Testimonial** | Ulasan dari pengguna |
| **Notification** | Notifikasi sistem |
| **File** | File yang diupload untuk kursus |
| **School** | Data institusi/sekolah |
| **ServiceArea** | Area layanan geografis |

### 5.2 Relasi Antar Model

```
User
├── has many EcourseEnrollment
├── has many Cart
├── has many Order
├── has many Post
├── has many CommunityMember
├── has one Profile
└── has many Notification

Ecourse
├── belongs to Category
├── has many EcourseLesson
├── has many EcourseEnrollment
├── has many CourseCard
├── has many OrderItem
└── has many CartItem

Category
└── has many Ecourse

EcourseLesson
└── belongs to Ecourse

EcourseEnrollment
├── belongs to User
├── belongs to Ecourse
└── has many CourseContent (progress tracking)

Order
├── belongs to User
├── has many OrderItem
└── has many Payment

Event
└── has many Schedule

Community
└── has many CommunityMember

CommunityMember
└── belongs to Community
```

---

## 6. FITUR-FITUR DETAIL

### 6.1 Sistem Pembelajaran (E-Course)

**Tipe Kursus:**
1. **Komik**: Kursus berbasis konten komik interaktif
2. **Film & Konten Kreator**: Pembelajaran melalui video dan produksi konten
3. **Robotik**: Kursus teknis untuk robotika dan engineering
4. **Kursus Umum**: Kategori kursus lainnya

**Alur Pembelajaran:**
```
Browse Course → View Details → Add to Cart → Checkout → Enroll → Learn
                                                            ↓
                                               Access Lessons & Content
                                                    ↓
                                           Track Progress & Completion
```

**Progress Tracking:**
- Pencatatan lesson yang telah ditonton
- Status enrollment (active/completed)
- Tracking konten pembelajaran yang sudah selesai
- Sistem lock untuk konten yang belum dapat diakses

### 6.2 Sistem E-Commerce (Kursus Premium)

**Alur Pembelian:**
```
Add to Cart → Update Qty → Apply Coupon → Checkout → Payment → Order Created
                                              ↓
                                         Generate Invoice
                                              ↓
                                       Access Enrolled Course
```

**Fitur:**
- Multiple items dalam satu keranjang
- Diskon berbasis kupon
- Payment tracking dan confirmation
- Otomatis enrollment setelah pembayaran

### 6.3 Event Management

**Fitur Acara:**
- Publish acara dengan deskripsi detail
- Penjadwalan multi-sesi
- Pendaftaran peserta dengan konfirmasi
- Tracking peserta yang terdaftar

### 6.4 Sistem Notifikasi & Komunikasi

**Jenis Notifikasi:**
- Email verification pada registrasi
- Password reset notifications
- Order confirmation emails
- Event reminder notifications
- System announcements

---

## 7. AUTHENTIKASI DAN AUTORISASI

### 7.1 Authentikasi

- **Email & Password**: Login menggunakan kredensial email/password
- **Email Verification**: Validasi email untuk keamanan akun
- **Password Reset**: Fitur lupa password dengan reset token
- **Session Management**: Pengelolaan sesi pengguna

### 7.2 Autorisasi (RBAC)

Menggunakan Spatie Permission dengan struktur:
- **User Roles**: admin, instructor, student, moderator
- **Permissions**: Fine-grained kontrol akses
- **Super Admin**: Akses penuh ke semua fitur

### 7.3 Middleware & Security

- Guest middleware untuk halaman publik
- Auth middleware untuk halaman protected
- Permission middleware untuk role-based access
- CSRF protection
- XSS protection

---

## 8. API ENDPOINTS

### 8.1 Authentication Routes
- `POST /login` - Login pengguna
- `POST /register` - Registrasi pengguna baru
- `GET /password/forgot` - Form lupa password
- `POST /password/email` - Send reset email
- `GET /password/reset/{token}` - Form reset password
- `POST /password/reset` - Process password reset

### 8.2 E-Course Routes
- `GET /ecourse` - Daftar semua kursus
- `GET /ecourse/{id}` - Detail kursus
- `POST /ecourse/{id}/add-to-cart` - Tambah ke keranjang
- `GET /ecourse/komik` - Kursus kategori komik
- `GET /ecourse/robotik` - Kursus kategori robotik
- `GET /course-film-konten-kreator` - Kursus film & konten kreator

### 8.3 Cart Routes
- `GET /cart` - Lihat keranjang
- `GET /cart-data` - Data keranjang (AJAX)
- `PATCH /cart/update/{id}` - Update item
- `DELETE /cart/remove/{id}` - Hapus item
- `DELETE /cart/clear` - Kosongkan keranjang

### 8.4 Event Routes
- `GET /events` - Daftar acara
- `GET /events/{event}` - Detail acara

### 8.5 Podcast Routes
- `GET /podcasts` - Daftar podcast
- `GET /podcasts/{podcast}` - Detail podcast

### 8.6 Search Route
- `GET /search` - Pencarian global

---

## 9. TEKNOLOGI KEAMANAN

### 9.1 Keamanan Database
- Prepared statements (Eloquent ORM)
- Password hashing menggunakan bcrypt
- Input validation & sanitization

### 9.2 Keamanan Web
- CSRF token protection
- SQL Injection prevention
- XSS attack prevention
- HTTPS support
- Rate limiting (jika dikonfigurasi)

### 9.3 API Security
- Token-based authentication (Sanctum)
- CORS (Cross-Origin Resource Sharing)
- API rate limiting

---

## 10. ALUR PROSES BISNIS UTAMA

### 10.1 Alur Registrasi & Verifikasi Email

```
User Fill Form
     ↓
Validate Input
     ↓
Create User Account (password hashed)
     ↓
Send Verification Email
     ↓
User Click Verification Link
     ↓
Mark Email as Verified
     ↓
Account Ready to Use
```

### 10.2 Alur Pembelian Kursus

```
Browse Courses
     ↓
Add to Cart
     ↓
Review Cart
     ↓
Apply Coupon (optional)
     ↓
Proceed to Checkout
     ↓
Select Payment Method
     ↓
Payment Processing
     ↓
Payment Verification
     ↓
Create Order Record
     ↓
Auto-Enroll to Course
     ↓
Access Course Materials
```

### 10.3 Alur Pembelajaran Kursus

```
View Course Lessons
     ↓
Open Lesson Content
     ↓
Watch/Read Material
     ↓
Mark as Complete
     ↓
Progress Tracked
     ↓
Unlock Next Lesson
     ↓
Complete All Lessons
     ↓
Certificate Ready
```

---

## 11. BASIS DATA

### 11.1 Tabel Utama

**Users Table**
- Primary data pengguna
- Email, password (hashed), email verification
- Timestamps (created_at, updated_at)

**Courses Table (ecourses)**
- ID, title, description, category_id
- Price, original_price, discount
- Level, slug, image
- Content dan lesson management

**Enrollments Table (ecourse_enrollments)**
- User_id, ecourse_id, enrollment_date
- Status (active, completed, dropped)
- Progress tracking

**Orders & OrderItems**
- Transaksi pembelian lengkap
- Multiple items per order
- Status tracking (pending, paid, processed, failed)

**Carts & CartItems**
- Session-based shopping cart
- Multiple items per user
- Update quantity functionality

**Events**
- Event details dan scheduling
- Event registration
- Schedule management

**Payments**
- Transaction records
- Payment method
- Amount, status, timestamp

**Podcasts**
- Podcast metadata
- Episodes
- Streaming content

---

## 12. INTEGRASI EKSTERNAL

### 12.1 Email Service
- SMTP untuk pengiriman email
- Notifikasi otomatis
- Email verification
- Password reset emails
- Order confirmation

### 12.2 Payment Gateway
- Integrasi dengan sistem pembayaran
- Transaction verification
- Invoice generation

### 12.3 Real-time Features (Optional)
- Pusher untuk real-time notifications
- Live updates untuk event registrations

---

## 13. FITUR ADMIN/DASHBOARD

### 13.1 Admin Controllers & Functions

**CourseController (Admin)**
- Create, read, update, delete kursus
- Manage pricing dan discount
- Publish/unpublish courses
- Manage lessons dan content

**EventController (Admin)**
- Manage events
- Schedule management
- View registrations

**UserManagement**
- View all users
- Manage roles & permissions
- Reset password utility
- User activity monitoring

**OrderManagement**
- View all orders
- Track payment status
- Process refunds
- Export order data

---

## 14. SKALABILITAS DAN PERFORMA

### 14.1 Optimisasi Database
- Indexed columns untuk query cepat
- Lazy loading vs eager loading
- Query optimization

### 14.2 Caching Strategy
- Laravel cache system
- Redis support
- Pagination untuk list data

### 14.3 Frontend Performance
- Vite asset bundling
- Minification dan compression
- CSS Tailwind optimization

---

## 15. DEPLOYMENT & HOSTING

### 15.1 Requirements
- PHP 8.2+
- MySQL/MariaDB
- Composer
- Node.js & npm
- Extensi: curl, gd, mbstring, openssl, pdo_mysql

### 15.2 Installation Steps
```bash
1. composer install
2. npm install
3. Copy .env.example ke .env
4. php artisan key:generate
5. Setup database di .env
6. php artisan migrate
7. php artisan seed (optional)
8. npm run build / npm run dev
```

---

## 16. PEMELIHARAAN & MONITORING

### 16.1 Logging
- Laravel logging system
- Error tracking via logs
- Database query logging (development)

### 16.2 Monitoring
- Laravel Telescope (development)
- Email log testing
- Performance monitoring

---

## 17. KESIMPULAN

Sistem ini merupakan platform pembelajaran digital yang komprehensif dengan arsitektur yang scalable dan maintainable. Menggunakan teknologi terkini (Laravel 12, Tailwind CSS, Vite), sistem ini dirancang untuk mendukung:

✓ Pembelajaran digital melalui berbagai format (text, video, podcast)
✓ Sistem e-commerce untuk kursus premium
✓ Manajemen event dan kegiatan
✓ Komunitas pengguna yang interaktif
✓ Keamanan dan autentikasi yang robust
✓ User experience yang modern dan responsive

Platform ini dapat dikembangkan lebih lanjut dengan fitur-fitur tambahan seperti:
- Live streaming classes
- Interactive quizzes dan assessment
- Certification system
- Advanced analytics & reporting
- Mobile application
- AI-powered recommendations

---

**Dokumen ini dapat diperbarui sesuai dengan perkembangan fitur sistem.**
