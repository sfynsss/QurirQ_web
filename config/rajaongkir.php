<?php

return [
    /*
     * Atur API key yang dibutuhkan untuk mengakses API Raja Ongkir.
     * Dapatkan API key dengan mengakses halaman panel akun Anda.
     */
    // 'api_key' => env('RAJAONGKIR_API_KEY', 'some32charstring'),

    /*
     * Atur tipe akun sesuai paket API yang Anda pilih di Raja Ongkir.
     * Pilihan yang tersedia: ['starter', 'basic', 'pro'].
     */
    // 'package' => env('RAJAONGKIR_PACKAGE', 'basic'),
    'end_point_api' => env('RAJAONGKIR_ENDPOINT', 'http://rajaongkir.com/api/starter'),
    'api_key' => env('RAJAONGKIR_KEY', 'SomeRandomString'),
];
