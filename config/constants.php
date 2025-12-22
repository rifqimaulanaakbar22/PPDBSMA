<?php
// Application Constants

// Status Pendaftaran
define('STATUS_DRAFT', 'draft');
define('STATUS_PENDING', 'pending');
define('STATUS_VERIFIKASI', 'verifikasi');
define('STATUS_TERVERIFIKASI', 'terverifikasi');
define('STATUS_DITOLAK', 'ditolak');
define('STATUS_DITERIMA', 'diterima');
define('STATUS_TIDAK_DITERIMA', 'tidak_diterima');
define('STATUS_DAFTAR_ULANG', 'daftar_ulang');

// Jalur Pendaftaran
define('JALUR_ZONASI', 'zonasi');
define('JALUR_AFIRMASI', 'afirmasi');
define('JALUR_PRESTASI', 'prestasi');
define('JALUR_MUTASI', 'mutasi');

// File Upload Limits
define('MAX_FILE_SIZE', 2 * 1024 * 1024); // 2MB
define('ALLOWED_IMAGE_TYPES', ['jpg', 'jpeg', 'png']);
define('ALLOWED_DOC_TYPES', ['pdf', 'jpg', 'jpeg', 'png']);

// Kuota Percentages
define('KUOTA_ZONASI_PERSEN', 50);
define('KUOTA_AFIRMASI_PERSEN', 15);
define('KUOTA_PRESTASI_PERSEN', 30);
define('KUOTA_MUTASI_PERSEN', 5);
