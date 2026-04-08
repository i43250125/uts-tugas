<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="bg-slate-800 border border-slate-700 rounded-3xl shadow-lg p-6 lg:col-span-1 h-fit relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-emerald-400 to-teal-500"></div>
        <div class="flex items-center gap-3 mb-6 mt-2">
            <div class="w-10 h-10 rounded-xl bg-slate-700 text-emerald-400 flex items-center justify-center border border-slate-600"><i class="fas fa-user-plus"></i></div>
            <h3 class="text-lg font-black text-white">Tambah Mhs</h3>
        </div>
        <form action="?p=mahasiswa" method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-bold text-slate-400 mb-1.5">NIM</label>
                <input type="text" name="nim" required placeholder="Contoh: 10123001" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 outline-none text-sm text-white placeholder-slate-600 font-medium transition-all">
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-400 mb-1.5">Nama Lengkap</label>
                <input type="text" name="nama" required placeholder="Masukkan nama..." class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 outline-none text-sm text-white placeholder-slate-600 font-medium transition-all">
            </div>
            <button type="submit" name="add_mhs" class="w-full bg-emerald-500 hover:bg-emerald-600 text-slate-900 font-black py-3 rounded-xl transition-all text-sm mt-4 shadow-lg shadow-emerald-500/20">
                Simpan Mahasiswa
            </button>
        </form>
    </div>

    <div class="bg-slate-800 border border-slate-700 rounded-3xl shadow-lg lg:col-span-2 flex flex-col overflow-hidden">
        <div class="p-6 border-b border-slate-700 flex justify-between items-center bg-slate-800/50">
            <h3 class="text-lg font-black text-white">Database Mahasiswa</h3>
            <span class="bg-slate-900 border border-slate-700 text-emerald-400 text-xs font-black px-3 py-1.5 rounded-lg"><?= count($_SESSION['mahasiswa']); ?> Data</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead class="bg-slate-900/50 border-b border-slate-700 text-slate-400 uppercase tracking-wider text-[10px] font-black">
                    <tr>
                        <th class="px-6 py-4 w-16">No</th>
                        <th class="px-6 py-4">NIM</th>
                        <th class="px-6 py-4">Nama Lengkap</th>
                        <th class="px-6 py-4 text-center w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/50 text-slate-300">
                    <?php if (empty($_SESSION['mahasiswa'])): ?>
                        <tr><td colspan="4" class="px-6 py-12 text-center text-slate-500 font-medium">Data mahasiswa masih kosong</td></tr>
                    <?php else: ?>
                        <?php $no=1; foreach($_SESSION['mahasiswa'] as $nim => $mhs): ?>
                        <tr class="hover:bg-slate-700/30 transition-colors">
                            <td class="px-6 py-4 text-slate-500 font-bold"><?= $no++; ?></td>
                            <td class="px-6 py-4 font-black text-emerald-400"><?= $nim; ?></td>
                            <td class="px-6 py-4 font-medium"><?= $mhs['nama']; ?></td>
                            <td class="px-6 py-4 text-center">
                                <a href="?p=mahasiswa&del_mhs=<?= $nim; ?>" onclick="return confirm('Yakin hapus data ini?')" class="w-8 h-8 inline-flex items-center justify-center rounded-lg bg-rose-500/10 text-rose-400 hover:bg-rose-500 hover:text-white transition-colors" title="Hapus">
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