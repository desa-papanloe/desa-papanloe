<?php
// database/seeders/ContentSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Berita;
use App\Models\Agenda;
use App\Models\Layanan;
use Carbon\Carbon;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedBerita();
        $this->seedAgenda();
    }

    private function seedBerita()
    {
        $beritaData = [
            [
                'judul' => 'Pembangunan Jalan Desa Papanloe Tahap II Dimulai',
                'slug' => 'pembangunan-jalan-desa-papanloe-tahap-ii-dimulai',
                'excerpt' => 'Pemerintah Desa Papanloe memulai pembangunan jalan tahap II untuk meningkatkan akses transportasi warga.',
                'konten' => '<p>Desa Papanloe, Bantaeng - Pemerintah Desa Papanloe secara resmi memulai pembangunan jalan tahap II yang merupakan kelanjutan dari program pembangunan infrastruktur desa tahun 2024.</p><p>Kepala Desa Papanloe menyampaikan bahwa pembangunan ini merupakan prioritas utama untuk meningkatkan akses transportasi dan mendukung perekonomian masyarakat desa.</p><p>"Dengan adanya jalan yang baik, diharapkan akses warga untuk berbagai kegiatan ekonomi dan sosial menjadi lebih mudah," ujar Kepala Desa.</p>',
                'kategori' => 'pembangunan',
                'status' => 'published',
                'is_featured' => true,
                'published_at' => now()->subDays(2),
                'views' => 245,
                'created_by' => 2,
                'updated_by' => 2,
            ],
            [
                'judul' => 'Program Posyandu Balita Desa Papanloe Raih Penghargaan Terbaik',
                'slug' => 'program-posyandu-balita-desa-papanloe-raih-penghargaan-terbaik',
                'excerpt' => 'Posyandu Balita Desa Papanloe meraih penghargaan sebagai posyandu terbaik tingkat kecamatan.',
                'konten' => '<p>Posyandu Balita Desa Papanloe berhasil meraih penghargaan sebagai posyandu terbaik tingkat kecamatan dalam program pembinaan kesehatan ibu dan anak tahun 2024.</p><p>Penghargaan ini diberikan berdasarkan penilaian terhadap kelengkapan program, tingkat partisipasi masyarakat, dan kualitas pelayanan kesehatan.</p><p>Kepala Puskesmas setempat mengapresiasi dedikasi kader posyandu dan partisipasi aktif masyarakat Desa Papanloe dalam program kesehatan.</p>',
                'kategori' => 'kesehatan',
                'status' => 'published',
                'is_featured' => false,
                'published_at' => now()->subDays(5),
                'views' => 189,
                'created_by' => 3,
                'updated_by' => 3,
            ],
            [
                'judul' => 'Pelatihan Digital Marketing untuk UMKM Desa Papanloe',
                'slug' => 'pelatihan-digital-marketing-untuk-umkm-desa-papanloe',
                'excerpt' => 'Dinas Koperasi dan UMKM mengadakan pelatihan digital marketing untuk meningkatkan kemampuan pelaku usaha lokal.',
                'konten' => '<p>Dalam upaya meningkatkan kemampuan pelaku UMKM di Desa Papanloe, Dinas Koperasi dan UMKM Kabupaten Bantaeng mengadakan pelatihan digital marketing.</p><p>Pelatihan ini diikuti oleh 30 pelaku UMKM dari berbagai sektor usaha seperti kuliner, kerajinan, dan pertanian.</p><p>Materi pelatihan meliputi penggunaan media sosial untuk promosi, teknik fotografi produk, dan strategi penjualan online.</p><p>"Kami berharap dengan pelatihan ini, UMKM di desa dapat meningkatkan penjualan dan memperluas jangkauan pasar," kata narasumber.</p>',
                'kategori' => 'ekonomi',
                'status' => 'published',
                'is_featured' => true,
                'published_at' => now()->subDays(7),
                'views' => 312,
                'created_by' => 2,
                'updated_by' => 2,
            ],
            [
                'judul' => 'Gotong Royong Pembersihan Lingkungan Jelang Hari Kemerdekaan',
                'slug' => 'gotong-royong-pembersihan-lingkungan-jelang-hari-kemerdekaan',
                'excerpt' => 'Warga Desa Papanloe bergotong royong membersihkan lingkungan dalam persiapan peringatan Hari Kemerdekaan RI.',
                'konten' => '<p>Dalam rangka mempersiapkan peringatan Hari Kemerdekaan RI ke-79, warga Desa Papanloe mengadakan gotong royong pembersihan lingkungan.</p><p>Kegiatan yang diikuti oleh ratusan warga dari berbagai RT/RW ini meliputi pembersihan selokan, penataan taman desa, dan pengecatan fasilitas umum.</p><p>Kepala Desa mengapresiasi semangat gotong royong masyarakat dan berharap tradisi ini terus dijaga sebagai warisan budaya bangsa.</p>',
                'kategori' => 'sosial',
                'status' => 'published',
                'is_featured' => false,
                'published_at' => now()->subDays(10),
                'views' => 156,
                'created_by' => 3,
                'updated_by' => 3,
            ],
        ];

        foreach ($beritaData as $data) {
            Berita::create($data);
        }

        echo "✅ ContentSeeder: 4 berita created successfully!\n";
    }

    private function seedAgenda()
    {
        $agendaData = [
            [
                'judul' => 'Rapat Koordinasi RT/RW Bulan Agustus',
                'slug' => 'rapat-koordinasi-rt-rw-bulan-agustus',
                'deskripsi' => 'Rapat koordinasi bulanan antara pengurus RT/RW dengan pemerintah desa untuk membahas program kerja dan kegiatan masyarakat.',
                'kategori' => 'rapat',
                'status' => 'aktif',
                'prioritas' => 'normal',
                'tanggal_mulai' => now()->addDays(3)->setTime(9, 0),
                'tanggal_selesai' => now()->addDays(3)->setTime(12, 0),
                'waktu_mulai' => '09:00:00',
                'waktu_selesai' => '12:00:00',
                'tempat' => 'Kantor Desa Papanloe',
                'alamat_lengkap' => 'Jl. Poros Desa Papanloe, Bantaeng, Sulawesi Selatan',
                'penyelenggara' => 'Pemerintah Desa Papanloe',
                'target_peserta' => 'Ketua RT/RW, Perangkat Desa, Tokoh Masyarakat',
                'contact_person' => 'Sekretaris Desa',
                'contact_phone' => '081234567890',
                'perlu_pendaftaran' => false,
                'is_featured' => true,
                'created_by' => 2,
                'updated_by' => 2,
            ],
            [
                'judul' => 'Pelatihan Kewirausahaan untuk Pemuda Desa',
                'slug' => 'pelatihan-kewirausahaan-untuk-pemuda-desa',
                'deskripsi' => 'Pelatihan kewirausahaan khusus untuk pemuda desa dalam rangka mengembangkan potensi ekonomi lokal.',
                'kategori' => 'pelatihan',
                'status' => 'aktif',
                'prioritas' => 'tinggi',
                'tanggal_mulai' => now()->addDays(7)->setTime(8, 0),
                'tanggal_selesai' => now()->addDays(7)->setTime(16, 0),
                'waktu_mulai' => '08:00:00',
                'waktu_selesai' => '16:00:00',
                'tempat' => 'Balai Desa Papanloe',
                'alamat_lengkap' => 'Jl. Poros Desa Papanloe, Bantaeng, Sulawesi Selatan',
                'penyelenggara' => 'Dinas Pemuda dan Olahraga Bantaeng',
                'target_peserta' => 'Pemuda usia 18-35 tahun',
                'kapasitas_peserta' => 50,
                'jumlah_pendaftar' => 23,
                'perlu_pendaftaran' => true,
                'batas_pendaftaran' => now()->addDays(5),
                'contact_person' => 'Karang Taruna Desa',
                'contact_phone' => '081234567891',
                'biaya' => 0,
                'is_featured' => true,
                'created_by' => 2,
                'updated_by' => 2,
            ],
            [
                'judul' => 'Sosialisasi Program Bantuan Sosial 2024',
                'slug' => 'sosialisasi-program-bantuan-sosial-2024',
                'deskripsi' => 'Sosialisasi program bantuan sosial pemerintah untuk tahun 2024 kepada masyarakat Desa Papanloe.',
                'kategori' => 'sosialisasi',
                'status' => 'aktif',
                'prioritas' => 'normal',
                'tanggal_mulai' => now()->addDays(14)->setTime(14, 0),
                'tanggal_selesai' => now()->addDays(14)->setTime(17, 0),
                'waktu_mulai' => '14:00:00',
                'waktu_selesai' => '17:00:00',
                'tempat' => 'Masjid Al-Ikhlas Desa Papanloe',
                'alamat_lengkap' => 'Jl. Masjid Desa Papanloe, Bantaeng, Sulawesi Selatan',
                'penyelenggara' => 'Dinas Sosial Kabupaten Bantaeng',
                'target_peserta' => 'Seluruh warga Desa Papanloe',
                'contact_person' => 'Kepala Desa',
                'contact_phone' => '081234567892',
                'perlu_pendaftaran' => false,
                'is_featured' => false,
                'created_by' => 3,
                'updated_by' => 3,
            ],
        ];

        foreach ($agendaData as $data) {
            Agenda::create($data);
        }

        echo "✅ ContentSeeder: 3 agenda created successfully!\n";
    }
}