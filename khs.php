<div class="mb-8 bg-slate-800 border border-slate-700 p-4 rounded-3xl shadow-lg flex flex-col sm:flex-row items-center gap-4 print:hidden">
    <div class="w-12 h-12 bg-slate-700 border border-slate-600 rounded-xl flex items-center justify-center text-emerald-400 shrink-0">
        <i class="fas fa-search text-lg"></i>
    </div>
    <form action="" method="GET" class="flex-1 flex flex-col sm:flex-row gap-3 w-full">
        <input type="hidden" name="p" value="khs">
        <select name="cari_nim" class="flex-1 bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 outline-none text-sm text-white font-medium cursor-pointer">
            <option value="" disabled selected>-- Pilih Mahasiswa Untuk Cetak KHS --</option>
            <?php foreach($_SESSION['mahasiswa'] as $nim => $mhs): ?>
                <option value="<?= $nim; ?>" <?= (isset($_GET['cari_nim']) && $_GET['cari_nim'] == $nim) ? 'selected' : ''; ?>>
                    <?= $nim; ?> - <?= $mhs['nama']; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-slate-900 px-8 py-3 rounded-xl text-sm font-black transition-all shadow-lg shadow-emerald-500/20 whitespace-nowrap">
            Tampilkan KHS
        </button>
    </form>
</div>

<?php if (isset($_GET['cari_nim']) && isset($_SESSION['mahasiswa'][$_GET['cari_nim']])): 
    $nim_aktif = $_GET['cari_nim'];
    $mhs_aktif = $_SESSION['mahasiswa'][$nim_aktif];
?>
<div class="bg-slate-800 border border-slate-700 rounded-3xl shadow-2xl overflow-hidden print:bg-white print:shadow-none print:border-none print:text-slate-900">
    
    <div class="border-b border-slate-700 print:border-slate-300 p-8 sm:p-10 flex flex-col sm:flex-row justify-between items-start sm:items-center bg-slate-900/50 print:bg-transparent gap-4">
        <div>
            <div class="flex items-center gap-3 mb-1">
                <i class="fas fa-award text-2xl text-emerald-500 print:text-slate-800"></i>
                <h2 class="text-2xl font-black text-white print:text-black tracking-tight uppercase">Kartu Hasil Studi</h2>
            </div>
            <p class="text-slate-400 print:text-slate-600 text-sm font-bold ml-9">Semester Ganjil 2025/2026</p>
        </div>
        <div class="text-right print:hidden">
            <button onclick="window.print()" class="text-slate-300 hover:text-white bg-slate-700 border border-slate-600 hover:bg-slate-600 text-sm font-bold flex items-center gap-2 px-5 py-2.5 rounded-xl transition-all shadow-sm">
                <i class="fas fa-print"></i> Print Dokumen
            </button>
        </div>
    </div>

    <div class="p-8 sm:p-10 pb-4">
        <div class="bg-slate-900/50 print:bg-slate-50 rounded-2xl p-6 border border-slate-700 print:border-slate-200">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-10 gap-y-4 text-sm">
                <div class="flex border-b border-slate-700 print:border-slate-200 pb-2">
                    <div class="text-slate-500 font-bold w-32">NIM</div>
                    <div class="text-white print:text-black font-black">: <?= $nim_aktif; ?></div>
                </div>
                <div class="flex border-b border-slate-700 print:border-slate-200 pb-2">
                    <div class="text-slate-500 font-bold w-32">Program Studi</div>
                    <div class="text-white print:text-black font-bold">: Bisnis Digital</div>
                </div>
                <div class="flex border-b border-slate-700 print:border-slate-200 pb-2 sm:border-none sm:pb-0">
                    <div class="text-slate-500 font-bold w-32">Nama Lengkap</div>
                    <div class="text-emerald-400 print:text-black font-black uppercase">: <?= $mhs_aktif['nama']; ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="p-8 sm:p-10 pt-4">
        <div class="border border-slate-700 print:border-slate-300 rounded-2xl overflow-hidden">
            <table class="w-full text-left text-sm border-collapse">
                <thead class="bg-slate-900 print:bg-slate-100 text-slate-300 print:text-slate-800">
                    <tr>
                        <th class="px-5 py-4 font-bold border-r border-slate-700 print:border-slate-300 w-12 text-center uppercase tracking-wider text-[11px]">No</th>
                        <th class="px-5 py-4 font-bold border-r border-slate-700 print:border-slate-300 uppercase tracking-wider text-[11px]">Kode MK</th>
                        <th class="px-5 py-4 font-bold border-r border-slate-700 print:border-slate-300 uppercase tracking-wider text-[11px]">Mata Kuliah</th>
                        <th class="px-5 py-4 font-bold border-r border-slate-700 print:border-slate-300 text-center uppercase tracking-wider text-[11px]">SKS</th>
                        <th class="px-5 py-4 font-bold text-center uppercase tracking-wider text-[11px]">Nilai Akhir</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700 print:divide-slate-200 text-slate-200 print:text-slate-800">
                    <?php 
                    $no = 1; 
                    $total_sks = 0;
                    $ipk_akhir = 0;

                    $mhsObj = new Mahasiswa($mhs_aktif['nama'], $nim_aktif);

                    if (empty($mhs_aktif['nilai'])): 
                    ?>
                        <tr><td colspan="5" class="px-5 py-8 text-center text-slate-500 font-medium">Belum ada nilai yang diinputkan.</td></tr>
                    <?php else: 
                        foreach($mhs_aktif['nilai'] as $mkId => $nilai): 
                            if(isset($_SESSION['matakuliah'][$mkId])):
                                $mk = $_SESSION['matakuliah'][$mkId];
                                $total_sks += $mk['sks'];
                                
                                $mhsObj->tambahNilai($mkId, $nilai);
                    ?>
                        <tr class="bg-slate-800 print:bg-white">
                            <td class="px-5 py-4 text-center text-slate-500 print:text-slate-600 font-bold border-r border-slate-700 print:border-slate-200"><?= $no++; ?></td>
                            <td class="px-5 py-4 font-black border-r border-slate-700 print:border-slate-200 text-xs"><?= $mkId; ?></td>
                            <td class="px-5 py-4 font-medium border-r border-slate-700 print:border-slate-200"><?= $mk['nama']; ?></td>
                            <td class="px-5 py-4 text-center font-bold border-r border-slate-700 print:border-slate-200"><?= $mk['sks']; ?></td>
                            <td class="px-5 py-4 text-center font-black text-emerald-400 print:text-slate-900 text-base"><?= $nilai; ?></td>
                        </tr>
                    <?php 
                            endif;
                        endforeach; 
                        
                        $ipk_akhir = $mhsObj->hitungIPK($_SESSION['matakuliah']);
                    endif; 
                    ?>
                </tbody>
                <tfoot class="bg-slate-900/50 print:bg-slate-50 font-bold border-t-2 border-slate-700 print:border-slate-300 text-slate-300 print:text-slate-900">
                    <tr>
                        <td colspan="3" class="px-5 py-4 text-right border-r border-slate-700 print:border-slate-300 uppercase text-xs tracking-wider">Total SKS Diambil :</td>
                        <td class="px-5 py-4 text-center border-r border-slate-700 print:border-slate-300 text-lg font-black"><?= $total_sks; ?></td>
                        <td class="px-5 py-4 text-center text-slate-500 print:text-slate-500 text-xs font-medium">VALID</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="px-5 py-4 text-right border-r border-slate-700 print:border-slate-300 uppercase text-xs tracking-wider text-slate-400">Indeks Prestasi Kumulatif (IPK) :</td>
                        <td colspan="2" class="px-5 py-4 text-center text-2xl font-black text-emerald-400 print:text-black">
                            <?= number_format($ipk_akhir, 2); ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="mt-16 flex justify-end">
            <div class="text-center">
                <p class="text-sm font-medium text-slate-500 print:text-slate-600 mb-16">Jember, <?= date('d M Y'); ?><br>Ketua Program Studi</p>
                <p class="text-base font-black text-white print:text-black underline decoration-emerald-500 print:decoration-slate-400 decoration-2 underline-offset-4">Lukman Hakim, S.Kom, M.Kom.</p>
                <p class="text-xs font-bold text-slate-500 print:text-slate-500 mt-1.5 uppercase tracking-wider">NIDN. 0123456789</p>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>