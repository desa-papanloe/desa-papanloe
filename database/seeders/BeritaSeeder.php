<?php
// database/seeders/BeritaSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Berita;
use App\Models\Admin;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan ada admin untuk created_by
        $admin = Admin::first();
        if (!$admin) {
            $admin = Admin::create([
                'name' => 'Administrator',
                'email' => 'admin@desa.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'is_active' => true,
            ]);
        }

        $sampleBerita = [
            [
                'judul' => 'Pembangunan Jalan Desa Tahap 2 Dimulai',
                'konten' => '<p>Pemerintah desa dengan bangga mengumumkan dimulainya pembangunan jalan desa tahap 2 yang akan menghubungkan wilayah timur dan barat desa. Proyek ini diharapkan dapat meningkatkan aksesibilitas dan perekonomian masyarakat.</p>

<p>Kepala Desa menyampaikan bahwa proyek ini merupakan bagian dari program pembangunan infrastruktur desa yang berkelanjutan. "Kami berkomitmen untuk terus meningkatkan kualitas infrastruktur desa demi kemajuan bersama," ujarnya.</p>

<h3>Detail Proyek</h3>
<ul>
<li>Panjang jalan: 2.5 kilometer</li>
<li>Lebar jalan: 4 meter</li>
<li>Anggaran: Rp 1.2 miliar</li>
<li>Target selesai: 6 bulan</li>
</ul>

<p>Masyarakat diharapkan dapat bersabar selama proses pembangunan berlangsung dan ikut menjaga kelancaran proyek ini.</p>',
                'kategori' => 'pembangunan',
                'status' => 'published',
                'is_featured' => true,
                'views' => rand(100, 500),
            ],
            [
                'judul' => 'Program Vaksinasi COVID-19 Dosis Ketiga',
                'konten' => '<p>Dalam rangka meningkatkan kekebalan masyarakat terhadap COVID-19, Puskesmas setempat akan mengadakan program vaksinasi dosis ketiga (booster) untuk seluruh warga desa.</p>

<p>Program ini akan dilaksanakan di Balai Desa dengan protokol kesehatan yang ketat. Seluruh warga yang telah mendapatkan vaksin dosis kedua minimal 6 bulan yang lalu diimbau untuk mengikuti program ini.</p>

<h3>Jadwal Vaksinasi</h3>
<ul>
<li>Tanggal: 15-20 Januari 2025</li>
<li>Waktu: 08.00 - 15.00 WIB</li>
<li>Tempat: Balai Desa</li>
<li>Syarat: Membawa KTP dan kartu vaksin</li>
</ul>',
                'kategori' => 'kesehatan',
                'status' => 'published',
                'is_featured' => false,
                'views' => rand(50, 200),
            ],
            [
                'judul' => 'Pelatihan Komputer untuk Remaja Desa',
                'konten' => '<p>Karang Taruna bekerja sama dengan Dinas Komunikasi dan Informatika mengadakan pelatihan komputer dasar untuk remaja desa. Program ini bertujuan untuk meningkatkan literasi digital generasi muda.</p>

<p>Pelatihan akan mencakup penggunaan aplikasi perkantoran, internet sehat, dan keterampilan digital lainnya yang diperlukan di era modern ini.</p>

<p>Seluruh remaja usia 15-25 tahun diundang untuk berpartisipasi dalam program ini secara gratis.</p>',
                'kategori' => 'pendidikan',
                'status' => 'published',
                'is_featured' => true,
                'views' => rand(80, 300),
            ],
            [
                'judul' => 'Gotong Royong Membersihkan Sungai Desa',
                'konten' => '<p>Warga desa bergotong royong membersihkan sungai yang melintasi desa dari sampah dan sedimentasi. Kegiatan ini dilakukan setiap bulan untuk menjaga kelestarian lingkungan.</p>

<p>Kepala RT mengajak seluruh warga untuk berpartisipasi aktif dalam menjaga kebersihan lingkungan, khususnya area sungai yang merupakan sumber kehidupan bersama.</p>',
                'kategori' => 'lingkungan',
                'status' => 'published',
                'is_featured' => false,
                'views' => rand(30, 150),
            ],
            [
                'judul' => 'Bantuan Sosial untuk Keluarga Kurang Mampu',
                'konten' => '<p>Pemerintah desa menyalurkan bantuan sosial berupa sembako dan uang tunai kepada 50 keluarga kurang mampu. Program ini merupakan bagian dari upaya pengentasan kemiskinan di tingkat desa.</p>

<p>Bantuan disalurkan langsung oleh Kepala Desa didampingi perangkat desa lainnya dengan menerapkan protokol kesehatan yang ketat.</p>',
                'kategori' => 'sosial',
                'status' => 'published',
                'is_featured' => false,
                'views' => rand(60, 250),
            ]
        ];

        foreach ($sampleBerita as $index => $data) {
            $data['slug'] = Str::slug($data['judul']);
            $data['excerpt'] = Str::limit(strip_tags($data['konten']), 200);
            $data['meta_description'] = Str::limit(strip_tags($data['konten']), 155);
            $data['published_at'] = Carbon::now()->subDays(rand(1, 30));
            $data['created_by'] = $admin->id;
            $data['updated_by'] = $admin->id;
            
            Berita::create($data);
        }
    }
}