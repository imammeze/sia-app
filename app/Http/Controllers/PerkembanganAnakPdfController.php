<?php

namespace App\Http\Controllers;

use App\Models\PerkembanganAnak;
use App\Models\KategoriCapaian;
use Barryvdh\DomPDF\Facade\Pdf;

class PerkembanganAnakPdfController extends Controller
{
    public function __invoke(PerkembanganAnak $perkembanganAnak)
    {
        $perkembanganAnak->load([
            'pesertaDidik.kelas',
            'guru',
            'nilaiPerkembangan.capaianPembelajaran.kategoriCapaian',
        ]);

        // Group nilai by kategori capaian
        $kategoriCapaians = KategoriCapaian::with(['capaianPembelajaran' => function ($q) {
            $q->orderBy('urutan');
        }])->orderBy('urutan')->get();

        // Build a lookup: capaian_pembelajaran_id => tingkat_capaian
        $nilaiLookup = $perkembanganAnak->nilaiPerkembangan
            ->pluck('tingkat_capaian', 'capaian_pembelajaran_id')
            ->toArray();

        $pdf = Pdf::loadView('pdf.perkembangan-anak', [
            'data' => $perkembanganAnak,
            'kategoriCapaians' => $kategoriCapaians,
            'nilaiLookup' => $nilaiLookup,
        ]);

        $pdf->setPaper('A4', 'portrait');

        $namaFile = 'Laporan_Perkembangan_' . str_replace(' ', '_', $perkembanganAnak->pesertaDidik->nama_lengkap) . '_' . $perkembanganAnak->semester . '.pdf';

        return $pdf->stream($namaFile);
    }
}
