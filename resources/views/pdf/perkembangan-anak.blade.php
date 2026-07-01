<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Capaian Pembelajaran</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Times New Roman', serif;
            font-size: 11pt;
            color: #000;
            line-height: 1.4;
        }

        .page {
            padding: 20px 30px;
        }

        /* ===== HEADER ===== */
        .header {
            text-align: center;
            margin-bottom: 15px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .header h1 {
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        .header h2 {
            font-size: 12pt;
            font-weight: bold;
            text-transform: uppercase;
        }

        /* ===== INFO PESERTA DIDIK ===== */
        .info-table {
            width: 100%;
            margin-bottom: 15px;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 2px 5px;
            vertical-align: top;
            font-size: 11pt;
        }

        .info-table .label {
            width: 180px;
            font-weight: normal;
        }

        .info-table .separator {
            width: 15px;
            text-align: center;
        }

        .info-table .value {
            font-weight: normal;
            border-bottom: 1px dotted #000;
        }

        /* ===== TABEL CAPAIAN ===== */
        .capaian-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            font-size: 10pt;
        }

        .capaian-table th,
        .capaian-table td {
            border: 1px solid #000;
            padding: 4px 6px;
            vertical-align: middle;
        }

        .capaian-table thead th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }

        .capaian-table .no-col {
            width: 40px;
            text-align: center;
        }

        .capaian-table .capaian-col {
            text-align: left;
        }

        .capaian-table .tingkat-col {
            width: 35px;
            text-align: center;
        }

        .kategori-row td {
            font-weight: bold;
            background-color: #f9f9f9;
        }

        .checkmark {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14pt;
            font-weight: bold;
        }

        /* ===== FOTO ===== */
        .foto-section {
            margin-bottom: 15px;
            page-break-inside: avoid;
        }

        .foto-section h3 {
            font-size: 11pt;
            font-weight: bold;
            margin-bottom: 8px;
            text-align: center;
            padding: 5px;
            border: 1px solid #000;
            background-color: #f0f0f0;
        }

        .foto-container {
            display: table;
            width: 100%;
        }

        .foto-item {
            display: table-cell;
            width: 33.33%;
            padding: 5px;
            text-align: center;
            vertical-align: top;
        }

        .foto-item img {
            max-width: 100%;
            max-height: 180px;
            border: 1px solid #ccc;
        }

        /* ===== KOMENTAR ===== */
        .komentar-section {
            margin-bottom: 15px;
            page-break-inside: avoid;
        }

        .komentar-section h3 {
            font-size: 11pt;
            font-weight: bold;
            text-align: center;
            padding: 5px;
            border: 1px solid #000;
            border-bottom: none;
            background-color: #f0f0f0;
        }

        .komentar-box {
            border: 1px solid #000;
            padding: 10px 15px;
            min-height: 80px;
            font-size: 11pt;
            line-height: 1.6;
        }

        /* ===== TTD ===== */
        .ttd-section {
            margin-top: 20px;
            width: 100%;
        }

        .ttd-section td {
            vertical-align: top;
            padding: 5px;
        }

        .ttd-left {
            width: 50%;
            text-align: center;
        }

        .ttd-right {
            width: 50%;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="page">
        <!-- HEADER -->
        <div class="header">
            <h1>Laporan Capaian Pembelajaran</h1>
            <h2>Pendidikan Anak Usia Dini</h2>
        </div>

        <!-- INFO PESERTA DIDIK -->
        <table class="info-table">
            <tr>
                <td class="label">Nama Peserta Didik</td>
                <td class="separator">:</td>
                <td class="value">{{ $data->pesertaDidik->nama_lengkap ?? '-' }}</td>
                <td class="label" style="width: 120px;">Tinggi Badan</td>
                <td class="separator">:</td>
                <td class="value" style="width: 100px;">{{ $data->tinggi_badan ? $data->tinggi_badan . ' cm' : '-' }}</td>
            </tr>
            <tr>
                <td class="label">Kelompok/Kelas</td>
                <td class="separator">:</td>
                <td class="value">{{ $data->pesertaDidik->kelas->nama_kelas ?? '-' }}</td>
                <td class="label">Berat Badan</td>
                <td class="separator">:</td>
                <td class="value">{{ $data->berat_badan ? $data->berat_badan . ' kg' : '-' }}</td>
            </tr>
            <tr>
                <td class="label">Tahun Pelajaran</td>
                <td class="separator">:</td>
                <td class="value">{{ $data->tahun_ajaran ?? '-' }}</td>
                <td class="label">Semester</td>
                <td class="separator">:</td>
                <td class="value">{{ ucfirst($data->semester ?? '-') }}</td>
            </tr>
            <tr>
                <td class="label">Guru Penilai</td>
                <td class="separator">:</td>
                <td class="value" colspan="4">{{ $data->guru->nama_lengkap ?? '-' }}</td>
            </tr>
        </table>

        <!-- TABEL CAPAIAN PEMBELAJARAN -->
        @php
            $romawi = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X'];
            $kategoriIndex = 0;
        @endphp

        @foreach ($kategoriCapaians as $kategori)
            @php
                $hasNilai = false;
                foreach ($kategori->capaianPembelajaran as $cp) {
                    if (isset($nilaiLookup[$cp->id])) {
                        $hasNilai = true;
                        break;
                    }
                }
            @endphp

            @if ($hasNilai)
                <div style="font-weight: bold; margin-top: 15px; margin-bottom: 5px; font-size: 11pt;">
                    {{ $romawi[$kategoriIndex] ?? ($kategoriIndex + 1) }}. {{ $kategori->nama_kategori }}
                </div>

                <table class="capaian-table">
                    <thead>
                        <tr>
                            <th rowspan="2" class="no-col">NO.</th>
                            <th rowspan="2" class="capaian-col">CAPAIAN PEMBELAJARAN</th>
                            <th colspan="4">TINGKAT PENCAPAIAN</th>
                        </tr>
                        <tr>
                            <th class="tingkat-col">BB</th>
                            <th class="tingkat-col">MB</th>
                            <th class="tingkat-col">BSH</th>
                            <th class="tingkat-col">BSB</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($kategori->judul_capaian)
                            <tr class="kategori-row">
                                <td class="no-col"></td>
                                <td colspan="5">{{ $kategori->judul_capaian }}</td>
                            </tr>
                        @endif

                        @php $itemNo = 1; @endphp
                        @foreach ($kategori->capaianPembelajaran as $cp)
                            @if (isset($nilaiLookup[$cp->id]))
                                @php $tingkat = $nilaiLookup[$cp->id]; @endphp
                                <tr>
                                    <td class="no-col">{{ $itemNo }}.</td>
                                    <td class="capaian-col">{{ $cp->deskripsi }}</td>
                                    <td class="tingkat-col">
                                        @if ($tingkat === 'BB') <span class="checkmark">✓</span> @endif
                                    </td>
                                    <td class="tingkat-col">
                                        @if ($tingkat === 'MB') <span class="checkmark">✓</span> @endif
                                    </td>
                                    <td class="tingkat-col">
                                        @if ($tingkat === 'BSH') <span class="checkmark">✓</span> @endif
                                    </td>
                                    <td class="tingkat-col">
                                        @if ($tingkat === 'BSB') <span class="checkmark">✓</span> @endif
                                    </td>
                                </tr>
                                @php $itemNo++; @endphp
                            @endif
                        @endforeach
                    </tbody>
                </table>
                @php $kategoriIndex++; @endphp
            @endif
        @endforeach

        <!-- FOTO PERKEMBANGAN ANAK -->
        @if (!empty($data->foto_kegiatan) && count($data->foto_kegiatan) > 0)
            <div class="foto-section">
                <h3>Foto Perkembangan Anak</h3>
                <div class="foto-container">
                    @foreach ($data->foto_kegiatan as $foto)
                        @php
                            $fotoPath = storage_path('app/private/' . $foto);
                        @endphp
                        @if (file_exists($fotoPath))
                            <div class="foto-item">
                                <img src="data:image/{{ pathinfo($fotoPath, PATHINFO_EXTENSION) }};base64,{{ base64_encode(file_get_contents($fotoPath)) }}" alt="Foto Kegiatan">
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif

        <!-- RINGKASAN KEHADIRAN -->
        <div class="komentar-section">
            <h3>Ringkasan Kehadiran</h3>
            @php
                $hadir = \App\Models\Absensi::where('peserta_didik_id', $data->peserta_didik_id)->where('status', 'hadir')->count();
                $sakit = \App\Models\Absensi::where('peserta_didik_id', $data->peserta_didik_id)->where('status', 'sakit')->count();
                $izin = \App\Models\Absensi::where('peserta_didik_id', $data->peserta_didik_id)->where('status', 'izin')->count();
                $alpa = \App\Models\Absensi::where('peserta_didik_id', $data->peserta_didik_id)->where('status', 'alpa')->count();
            @endphp
            <table class="capaian-table" style="margin-bottom: 0;">
                <thead>
                    <tr>
                        <th>Hadir</th>
                        <th>Sakit</th>
                        <th>Izin</th>
                        <th>Alpa</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align: center;">{{ $hadir }} hari</td>
                        <td style="text-align: center;">{{ $sakit }} hari</td>
                        <td style="text-align: center;">{{ $izin }} hari</td>
                        <td style="text-align: center;">{{ $alpa }} hari</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- KOMENTAR GURU -->
        <div class="komentar-section">
            <h3>Komentar Guru — {{ ucfirst($data->semester ?? '') }}</h3>
            <div class="komentar-box">
                {{ $data->komentar_guru ?? '-' }}
            </div>
        </div>

        <!-- TANDA TANGAN -->
        <table class="ttd-section">
            <tr>
                <td class="ttd-left">
                    Mengetahui,<br>
                    Kepala Sekolah<br><br><br><br><br>
                    (................................)
                </td>
                <td class="ttd-right">
                    Guru Kelas<br><br><br><br><br><br>
                    ({{ $data->guru->nama_lengkap ?? '................................' }})
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
