<?php

// config/whatsapp.php

return [
    /*
    |--------------------------------------------------------------------------
    | WhatsApp Configuration
    |--------------------------------------------------------------------------
    |
    | Konfigurasi untuk fitur WhatsApp Lapor PakDe
    | Ubah nomor sesuai dengan nomor resmi Desa Papanloe
    |
    */

    // Nomor WhatsApp resmi Desa Papanloe
    'phone_number' => env('WHATSAPP_PHONE_NUMBER', '081234567890'),

    // Template pesan default
    'templates' => [
        'report' => [
            'title' => 'LAPORAN WARGA DESA PAPANLOE',
            'icon' => '🏛️',
            'fields' => [
                'date' => true,
                'time' => true,
                'reporter_data' => true,
                'report_details' => true,
                'location' => true,
                'description' => true,
                'attachments' => true,
            ]
        ],
        
        'info' => [
            'title' => 'DESA PAPANLOE - INFORMASI',
            'icon' => '🏛️',
            'greeting' => 'Assalamu\'alaikum Warahmatullahi Wabarakatuh',
        ],
        
        'complaint' => [
            'title' => 'PENGADUAN WARGA DESA PAPANLOE',
            'icon' => '📢',
            'urgent' => true,
        ]
    ],

    // Konfigurasi tampilan
    'ui' => [
        'show_notification' => true,
        'notification_duration' => 3000,
        'open_in_new_tab' => true,
        'tracking_enabled' => true,
    ],

    // Jam operasional (opsional untuk notifikasi)
    'operating_hours' => [
        'enabled' => false,
        'timezone' => 'Asia/Makassar',
        'days' => [
            'monday' => ['08:00', '16:00'],
            'tuesday' => ['08:00', '16:00'],
            'wednesday' => ['08:00', '16:00'],
            'thursday' => ['08:00', '16:00'],
            'friday' => ['08:00', '11:30'],
            'saturday' => null, // Libur
            'sunday' => null,   // Libur
        ],
        'holiday_message' => 'Kantor desa sedang tutup. Pesan Anda akan direspon pada jam kerja.',
    ],

    // Auto-reply messages (jika menggunakan WhatsApp Business API)
    'auto_replies' => [
        'enabled' => false,
        'welcome_message' => 'Terima kasih telah menghubungi Desa Papanloe. Pesan Anda akan segera kami respon.',
        'office_hours_message' => 'Terima kasih atas laporan Anda. Tim kami akan merespon pada jam kerja (Senin-Kamis: 08:00-16:00, Jumat: 08:00-11:30).',
    ]
];