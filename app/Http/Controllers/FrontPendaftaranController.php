<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;

class FrontPendaftaranController extends Controller
{
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

        $datePrefix = now()->format('dmY'); 
        $lastPendaftaran = Pendaftaran::whereDate('created_at', now()->today())
                            ->orderBy('id', 'desc')
                            ->first();

        if ($lastPendaftaran) {
            $lastNumber = (int) substr($lastPendaftaran->no_pendaftaran, -3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        $no_pendaftaran = 'REG-' . $datePrefix . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        $data = $request->except('_token');
        $data['no_pendaftaran'] = $no_pendaftaran;
        $data['status'] = 'pending';
        $data['tanggal_daftar'] = now();

        Pendaftaran::create($data);

        return redirect()->back()->with('success', 'Pendaftaran berhasil dikirim! Silakan tunggu informasi dari Admin kami.');
    }
}