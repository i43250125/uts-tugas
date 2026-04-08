<?php
class Dosen extends User implements CetakLaporan {
    private $npp;

    public function __construct($nama, $id, $npp) {
        parent::__construct($nama, $id);
        $this->npp = $npp;
    }

    public function getRole() {
        return "Dosen Pengajar";
    }

    public function cetak() {
        return "Mencetak Laporan Beban Kerja Dosen (BKD) untuk: " . $this->nama;
    }
}