<?php
// app/Http/Controllers/ProfileController.php (Public)

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display profil desa page
     */
    public function profil()
    {
        return view('public.profile.profil');
    }

    /**
     * Display visi misi page
     */
    public function visiMisi()
    {
        return view('public.profile.visi-misi');
    }

    /**
     * Display struktur organisasi page
     */
    public function struktur()
    {
        return view('public.profile.struktur');
    }

    /**
     * Display sejarah desa page
     */
    public function sejarah()
    {
        return view('public.profile.sejarah');
    }

    /**
     * Display geografis page
     */
    public function geografis()
    {
        return view('public.profile.geografis');
    }

    /**
     * Display demografis page
     */
    public function demografis()
    {
        return view('public.profile.demografis');
    }
}