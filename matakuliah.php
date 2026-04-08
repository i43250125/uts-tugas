<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="bg-slate-800 border border-slate-700 rounded-3xl shadow-lg p-6 lg:col-span-1 h-fit relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-teal-400 to-cyan-500"></div>
        <div class="flex items-center gap-3 mb-6 mt-2">
            <div class="w-10 h-10 rounded-xl bg-slate-700 text-teal-400 flex items-center justify-center border border-slate-600"><i class="fas fa-book-medical"></i></div>
            <h3 class="text-lg font-black text-white">Tambah MK</h3>
        </div>
        <form action="?p=matakuliah" method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-bold text-slate-400 mb-1.5">Kode MK</label>
                <input type="text" name="mk_id" required placeholder="Contoh: MK04" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500 outline-none text-sm text-white placeholder-slate-600 uppercase font-bold transition-all">
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-400 mb-1.5">Nama Mata Kuliah</label>
                <input type="text" name="mk_nama" required placeholder="Contoh: Algoritma" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500 outline-none text-sm text-white placeholder-slate-600 font-medium transition-all">
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-400 mb-1.5">SKS</label>
                <select name="mk_sks" required class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500 outline-none text-sm text-white font-medium cursor-pointer transition-all">
                    <option value="1">1 SKS</option>
                    <option value="2">2 SKS</option>
                    <option value="3" selected>3 SKS</option>
                    <option value="4">4 SKS</option>
                    <option value="6">6 SKS</option>
                </select>
            </div>
            <button type="submit" name="add_mk" class="w-full bg-teal-500 hover:bg-teal-600 text-slate-900 font-black py-3 rounded-xl transition-all text-sm mt-4 shadow-lg shadow-teal-500/20">
                Simpan Mata Kuliah
            </button>
        </form>
    </div>

    <div class="bg-slate-800 border border-slate-700 rounded-3xl shadow-lg lg:col-span-2 flex flex-col overflow-hidden">
        <div class="p-6 border-b border-slate-700 flex justify-between items-center bg-slate-800/50">
            <h3 class="text-lg font-black text-white">Daftar Mata Kuliah</h3>
            <span class="bg-slate-900 border border-slate-700 text-teal-400 text-xs font-black px-3 py-1.5 rounded-lg"><?= count($_SESSION['matakuliah']); ?> MK</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead class="bg-slate-900/50 border-b border-slate-700 text-slate-400 uppercase tracking-wider text-[10px] font-black">
                    <tr>
                        <th class="px-6 py-4 w-16">No</th>
                        <th class="px-6 py-4">Kode MK</th>
                        <th class="px-6 py-4">Nama Mata Kuliah</th>
                        <th class="px-6 py-4 text-center">SKS</th>
                        <th class="px-6 py-4 text-center w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/50 text-slate-300">
                    <?php if (empty($_SESSION['matakuliah'])): ?>
                        <tr><td colspan="5" class="px-6 py-12 text-center text-slate-500 font-medium">Belum ada data mata kuliah</td></tr>
                    <?php else: ?>
                        <?php $no=1; foreach($_SESSION['matakuliah'] as $id => $mk): ?>
                        <tr class="hover:bg-slate-700/30 transition-colors">
                            <td class="px-6 py-4 text-slate-500 font-bold"><?= $no++; ?></td>
                            <td class="px-6 py-4 font-black"><span class="bg-slate-900 border border-slate-700 text-teal-400 px-2.5 py-1 rounded-md text-xs"><?= $id; ?></span></td>
                            <td class="px-6 py-4 font-medium"><?= $mk['nama']; ?></td>
                            <td class="px-6 py-4 text-center"><span class="font-black text-white"><?= $mk['sks']; ?></span></td>
                            <td class="px-6 py-4 text-center">
                                <a href="?p=matakuliah&del_mk=<?= $id; ?>" onclick="return confirm('Yakin hapus MK ini?')" class="w-8 h-8 inline-flex items-center justify-center rounded-lg bg-rose-500/10 text-rose-400 hover:bg-rose-500 hover:text-white transition-colors" title="Hapus">
                                    <i class="fas fa-trash-alt text-xs"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>