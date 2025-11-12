<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


<!-- setingan database  -->
Table cabang {
  id integer [primary key]
  nama_cabang varchar
  alamat text
  created_at timestamp
}

Table users {
  id integer [primary key]
  name varchar
  email varchar [unique]
  password varchar
  role enum('admin cianjur selatan','admin cianjur','super admin','kandidat')
  created_at timestamp
  updated_at timestamp
}

Table pendaftaran_kandidat {
  id integer [primary key]
  user_id integer
  foto varchar
  nama varchar
  email varchar
  alamat text
  jenis_kelamin varchar
  no_wa varchar
  cabang_id integer
  kk varchar
  ktp varchar
  bukti_pelunasan varchar
  akte varchar
  izasah varchar
  tanggal_daftar date
  status_berkas enum('MENUNGGU_VERIFIKASI','DITOLAK','DITERIMA') [default: 'MENUNGGU_VERIFIKASI']
  created_at timestamp
}

Table institusi {
  id integer [primary key]
  nama_institusi varchar
  alamat text
  penanggung_jawab varchar
  no_wa varchar
  kuota integer
  created_at timestamp
}

Table penempatan {
  id integer [primary key]
  siswa_id integer
  institusi_id integer
  status enum('INTERVIEW','SUDAH_BERANGKAT','VERIFIKASI_DATA','PENDING','MENUNGGU_JOB_MATCHING','SELESAI','DITOLAK')
  tanggal_update_status timestamp
  tanggal_mulai date
  tanggal_selesai date
  created_at timestamp
}

Table interview {
  id integer [primary key]
  siswa_id integer
  tanggal_interview date
  status_interview enum('PENDING','TERJADWAL','LULUS','TIDAK_LULUS','ULANG_INTERVIEW')
  catatan text
  created_at timestamp
}

Table histori_status {
  id integer [primary key]
  penempatan_id integer
  status varchar
  catatan text
  tanggal_status date
  created_at timestamp
}

Table kandidat {
  id integer [primary key]
  user_id integer
  siswa_id integer
  cabang_id integer
  penempatan_id integer [note: 'optional']
  interview_id integer [note: 'optional']
  status_pendaftaran enum('BARU_DAFTAR','VERIFIKASI','VALID','DITOLAK')
  tanggal_daftar timestamp
  tanggal_interview date [note: 'optional']
  catatan_interview text [note: 'optional']
  created_at timestamp
  updated_at timestamp
}

Table verifikasi_kandidat {
  id integer [primary key]
  kandidat_id integer
  admin_id integer
  status_verifikasi enum('PENDING','DISETUJUI','DITOLAK') [default: 'PENDING']
  password_diberikan varchar [note: 'optional']
  catatan text [note: 'optional']
  tanggal_verifikasi timestamp
  created_at timestamp
}

// Relasi akun dan pendaftaran
Ref: pendaftaran_kandidat.user_id > users.id
Ref: pendaftaran_kandidat.cabang_id > cabang.id

// Relasi kandidat
Ref: kandidat.user_id > users.id
Ref: kandidat.siswa_id > pendaftaran_kandidat.id
Ref: kandidat.cabang_id > cabang.id
Ref: kandidat.penempatan_id > penempatan.id
Ref: kandidat.interview_id > interview.id

// Relasi verifikasi
Ref: verifikasi_kandidat.kandidat_id > kandidat.id
Ref: verifikasi_kandidat.admin_id > users.id

// Relasi penempatan & interview
Ref: penempatan.siswa_id > pendaftaran_kandidat.id
Ref: penempatan.institusi_id > institusi.id
Ref: interview.siswa_id > pendaftaran_kandidat.id
Ref: histori_status.penempatan_id > penempatan.id
