<div class="max-w-xl mx-auto bg-slate-800 border border-slate-700 rounded-3xl shadow-2xl overflow-hidden">
    <div class="bg-gradient-to-r from-slate-900 to-slate-800 border-b border-slate-700 p-8 flex justify-between items-center relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="relative z-10">
            <h3 class="text-2xl font-black tracking-tight text-white">Input Nilai</h3>
            <p class="text-slate-400 text-sm font-medium mt-1">Sistem Evaluasi Akademik</p>
        </div>
        <div class="w-14 h-14 bg-slate-800 border border-slate-700 rounded-2xl flex items-center justify-center relative z-10 shadow-inner">
            <i class="fas fa-star text-2xl text-emerald-400"></i>
        </div>
    </div>
    
    <div class="p-8">
        <form action="?p=nilai" method="POST" class="space-y-5">
            <div>
                <label class="block text-sm font-bold text-slate-400 mb-1.5">Mahasiswa</label>
                <select name="nim" required class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3.5 focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 outline-none text-sm text-white font-medium cursor-pointer">
                    <option value="" disabled selected class="text-slate-500">-- Pilih Mahasiswa --</option>
                    <?php foreach($_SESSION['mahasiswa'] as $nim => $mhs): ?>
                        <option value="<?= $nim; ?>"><?= $nim; ?> - <?= $mhs['nama']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-bold text-slate-400 mb-1.5">Mata Kuliah</label>
                <select name="mk_id" required class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3.5 focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 outline-none text-sm text-white font-medium cursor-pointer">
                    <option value="" disabled selected class="text-slate-500">-- Pilih Mata Kuliah --</option>
                    <?php foreach($_SESSION['matakuliah'] as $id => $mk): ?>
                        <option value="<?= $id; ?>"><?= $id; ?> - <?= $mk['nama']; ?> (<?= $mk['sks']; ?> SKS)</option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-400 mb-1.5">Nilai Akhir</label>
                <input type="text" name="skor" required placeholder="A, B+, 85..." class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3.5 focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 outline-none text-sm text-white placeholder-slate-600 uppercase font-black text-lg text-center tracking-widest">
            </div>

            <div class="pt-4">
                <button type="submit" name="add_nilai" class="w-full bg-emerald-500 hover:bg-emerald-600 text-slate-900 font-black py-4 rounded-xl transition-all shadow-lg shadow-emerald-500/20 flex items-center justify-center gap-2">
                    <i class="fas fa-save"></i> Simpan Nilai
                </button>
            </div>
        </form>
    </div>
</div>