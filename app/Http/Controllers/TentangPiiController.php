<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sejarah;
use App\Models\Sekila;
use App\Models\StrukturOrganisasi;
use App\Models\Kontak;
use App\Models\KetuaUmum;

class TentangPiiController extends Controller
{
    public function sejarah()
    {
        $sejarah = Sejarah::where('is_active', true)->first();
        $ketuaUmums = KetuaUmum::where('is_active', true)->orderBy('order')->get();
        return view('tentang.sejarah', compact('sejarah', 'ketuaUmums'));
    }

    public function sekilas()
    {
        $sekilas = Sekila::where('is_active', true)->first();
        return view('tentang.sekilas', compact('sekilas'));
    }

    public function struktur()
    {
        $struktur = StrukturOrganisasi::where('is_active', true)->orderBy('order')->get();
        return view('tentang.struktur', compact('struktur'));
    }

    public function kontak()
    {
        $kontak = Kontak::where('is_active', true)->first();
        return view('tentang.kontak', compact('kontak'));
    }
}
