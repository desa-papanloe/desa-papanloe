<?php

namespace App\Helpers;

use Carbon\Carbon;

class WhatsAppHelper
{
    /**
     * Get WhatsApp phone number from config
     */
    public static function getPhoneNumber(): string
    {
        $phone = config('whatsapp.phone_number');
        
        // Format phone number
        $phone = preg_replace('/\D/', '', $phone);
        
        // Add country code if not present
        if (!str_starts_with($phone, '62')) {
            if (str_starts_with($phone, '0')) {
                $phone = '62' . substr($phone, 1);
            } else {
                $phone = '62' . $phone;
            }
        }
        
        return $phone;
    }

    /**
     * Generate report template message
     */
    public static function generateReportTemplate(array $data = []): string
    {
        $config = config('whatsapp.templates.report');
        $currentDate = Carbon::now()->setTimezone('Asia/Makassar');
        
        $template = "{$config['icon']} *{$config['title']}*\n\n";
        
        if ($config['fields']['date']) {
            $template .= "📅 Tanggal: " . $currentDate->locale('id')->translatedFormat('l, d F Y') . "\n";
        }
        
        if ($config['fields']['time']) {
            $template .= "⏰ Waktu: " . $currentDate->format('H:i') . " WITA\n\n";
        }
        
        if ($config['fields']['reporter_data']) {
            $template .= "👤 *Data Pelapor:*\n";
            $template .= "Nama: " . ($data['name'] ?? '') . "\n";
            $template .= "NIK: " . ($data['nik'] ?? '') . "\n";
            $template .= "Alamat: " . ($data['address'] ?? '') . "\n\n";
        }
        
        if ($config['fields']['report_details']) {
            $template .= "📋 *Detail Laporan:*\n";
            $template .= "Jenis Laporan: " . ($data['type'] ?? '[ Pilih: Infrastruktur / Pelayanan / Keamanan / Lingkungan / Lainnya ]') . "\n\n";
        }
        
        if ($config['fields']['location']) {
            $template .= "Lokasi Kejadian: " . ($data['location'] ?? '') . "\n\n";
        }
        
        if ($config['fields']['description']) {
            $template .= "Deskripsi Masalah: " . ($data['description'] ?? '') . "\n\n\n";
        }
        
        if ($config['fields']['attachments']) {
            $template .= "📸 *Lampiran:* \n";
            $template .= "[ Foto/Dokumen akan dikirim terpisah jika ada ]\n\n";
        }
        
        $template .= "---\n";
        $template .= "*Terima kasih telah melaporkan kepada Perangkat Desa Papanloe. Laporan Anda akan segera ditindaklanjuti.*\n\n";
        $template .= "🏢 Kantor Desa Papanloe\n";
        $template .= "📍 Jl. Poros Bantaeng - Bulukumba, Kec. Pa'jukukang";
        
        return $template;
    }

    /**
     * Generate info template message
     */
    public static function generateInfoTemplate(array $data = []): string
    {
        $config = config('whatsapp.templates.info');
        
        $template = "{$config['icon']} *{$config['title']}*\n\n";
        $template .= $config['greeting'] . "\n\n";
        $template .= "Saya ingin menanyakan tentang:\n\n";
        $template .= ($data['question'] ?? '[ Tulis pertanyaan atau informasi yang ingin ditanyakan ]') . "\n\n";
        $template .= "Terima kasih 🙏\n\n";
        $template .= "---\n";
        $template .= "🏢 Kantor Desa Papanloe\n";
        $template .= "📍 Kec. Pa'jukukang, Kab. Bantaeng";
        
        return $template;
    }

    /**
     * Generate complaint template message
     */
    public static function generateComplaintTemplate(array $data = []): string
    {
        $config = config('whatsapp.templates.complaint');
        $currentDate = Carbon::now()->setTimezone('Asia/Makassar');
        
        $template = "{$config['icon']} *{$config['title']}*\n";
        
        if ($config['urgent']) {
            $template .= "🚨 *PENGADUAN MENDESAK*\n\n";
        }
        
        $template .= "📅 Tanggal: " . $currentDate->locale('id')->translatedFormat('l, d F Y') . "\n";
        $template .= "⏰ Waktu: " . $currentDate->format('H:i') . " WITA\n\n";
        
        $template .= "👤 *Data Pengadu:*\n";
        $template .= "Nama: " . ($data['name'] ?? '') . "\n";
        $template .= "NIK: " . ($data['nik'] ?? '') . "\n";
        $template .= "No. HP: " . ($data['phone'] ?? '') . "\n";
        $template .= "Alamat: " . ($data['address'] ?? '') . "\n\n";
        
        $template .= "📢 *Detail Pengaduan:*\n";
        $template .= "Kategori: " . ($data['category'] ?? '[ Pilih kategori pengaduan ]') . "\n";
        $template .= "Lokasi: " . ($data['location'] ?? '') . "\n";
        $template .= "Deskripsi: " . ($data['description'] ?? '') . "\n\n";
        
        $template .= "🎯 *Harapan Penyelesaian:*\n";
        $template .= ($data['expectation'] ?? '[ Jelaskan harapan penyelesaian ]') . "\n\n";
        
        $template .= "---\n";
        $template .= "*Pengaduan Anda akan segera ditindaklanjuti oleh perangkat desa.*\n\n";
        $template .= "🏢 Kantor Desa Papanloe\n";
        $template .= "📞 Hotline: " . self::getPhoneNumber();
        
        return $template;
    }

    /**
     * Generate WhatsApp URL
     */
    public static function generateWhatsAppUrl(string $message, string $phoneNumber = null): string
    {
        $phone = $phoneNumber ?? self::getPhoneNumber();
        $encodedMessage = urlencode($message);
        
        return "https://wa.me/{$phone}?text={$encodedMessage}";
    }

    /**
     * Check if office is open
     */
    public static function isOfficeOpen(): bool
    {
        if (!config('whatsapp.operating_hours.enabled')) {
            return true;
        }
        
        $now = Carbon::now()->setTimezone(config('whatsapp.operating_hours.timezone'));
        $dayName = strtolower($now->englishDayOfWeek);
        $currentTime = $now->format('H:i');
        
        $schedule = config("whatsapp.operating_hours.days.{$dayName}");
        
        if (!$schedule) {
            return false; // Holiday
        }
        
        [$openTime, $closeTime] = $schedule;
        
        return $currentTime >= $openTime && $currentTime <= $closeTime;
    }

    /**
     * Get office status message
     */
    public static function getOfficeStatusMessage(): ?string
    {
        if (!config('whatsapp.operating_hours.enabled')) {
            return null;
        }
        
        if (!self::isOfficeOpen()) {
            return config('whatsapp.operating_hours.holiday_message');
        }
        
        return null;
    }

    /**
     * Format phone number for display
     */
    public static function formatPhoneForDisplay(string $phone): string
    {
        $phone = preg_replace('/\D/', '', $phone);
        
        if (str_starts_with($phone, '62')) {
            $phone = '0' . substr($phone, 2);
        }
        
        // Format: 0812-3456-7890
        return preg_replace('/(\d{4})(\d{4})(\d{4})/', '$1-$2-$3', $phone);
    }

    /**
     * Get JavaScript config for frontend
     */
    public static function getJavaScriptConfig(): array
    {
        return [
            'phoneNumber' => self::getPhoneNumber(),
            'displayPhone' => self::formatPhoneForDisplay(config('whatsapp.phone_number')),
            'ui' => config('whatsapp.ui'),
            'officeOpen' => self::isOfficeOpen(),
            'officeStatusMessage' => self::getOfficeStatusMessage(),
        ];
    }
}