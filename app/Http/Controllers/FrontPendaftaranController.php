<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PendaftaranService;

class FrontPendaftaranController extends Controller
{
    protected $pendaftaranService;

    public function __construct(PendaftaranService $pendaftaranService)
    {
        $this->pendaftaranService = $pendaftaranService;
    }

    public function index()
    {
        return view('pendaftaran');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'nullable|digits:16',
        ], [
            'nik.digits' => 'NIK harus 16 digit',
        ]);

        $this->pendaftaranService->registerPendaftaran($request->all());

        return redirect()->back()->with('success', 'Pendaftaran berhasil dikirim! Silakan tunggu informasi dari Admin kami.');
    }
}