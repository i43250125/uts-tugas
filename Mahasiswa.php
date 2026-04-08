<?php
class Mahasiswa extends User implements CetakLaporan {
    private $nilai = [];

    public function getRole() {
        return "Mahasiswa";
    }

    public function tambahNilai($mkId, $angka) {
        $this->nilai[$mkId] = $angka;
    }

    public function getNilai() {
        return $this->nilai;
    }

    // RUMUS UNTUK MENGHITUNG RATA-RATA IPK
    public function hitungIPK($daftarMK) {
        if (empty($this->nilai)) return 0;
        $totalBobot = 0;
        $totalSKS = 0;

        foreach ($this->nilai as $mkId => $skor) {
            if (isset($daftarMK[$mkId])) {
                $sks = $daftarMK[$mkId]['sks'];
                $point = $this->konversiGradeKePoint($skor);
                $totalBobot += ($point * $sks);
                $totalSKS += $sks;
            }
        }
        return $totalSKS > 0 ? round($totalBobot / $totalSKS, 2) : 0;
    }

    private function konversiGradeKePoint($skor) {
        // Jika input berupa huruf (A, B+, B, C, dst)
        $skorStr = strtoupper(trim((string)$skor));
        if ($skorStr === 'A') return 4.0;
        if ($skorStr === 'B+' || $skorStr === 'B') return 3.0;
        if ($skorStr === 'C+' || $skorStr === 'C') return 2.0;
        if ($skorStr === 'D') return 1.0;
        if ($skorStr === 'E') return 0;

        // Jika input berupa angka
        $skorNum = (float)$skor;
        if ($skorNum >= 85) return 4.0;
        if ($skorNum >= 75) return 3.0;
        if ($skorNum >= 65) return 2.0;
        if ($skorNum >= 50) return 1.0;
        return 0;
    }

    public function cetak() {
        return "Mencetak Kartu Hasil Studi (KHS) untuk: " . $this->nama;
    }
}