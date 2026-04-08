<?php
$jml_mhs = count($_SESSION['mahasiswa']);
$jml_mk = count($_SESSION['matakuliah']);
?>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
    <div class="bg-slate-800 rounded-3xl border border-slate-700 shadow-sm p-6 flex items-center gap-5 hover:border-emerald-500/30 transition-colors">
        <div class="w-14 h-14 rounded-2xl bg-emerald-500/10 flex items-center justify-center text-emerald-400 shrink-0 border border-emerald-500/20">
            <i class="fas fa-users text-2xl"></i>
        </div>
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total Mahasiswa</p>
            <p class="text-3xl font-black text-white mt-1"><?= $jml_mhs; ?></p>
        </div>
    </div>

    <div class="bg-slate-800 rounded-3xl border border-slate-700 shadow-sm p-6 flex items-center gap-5 hover:border-teal-500/30 transition-colors">
        <div class="w-14 h-14 rounded-2xl bg-teal-500/10 flex items-center justify-center text-teal-400 shrink-0 border border-teal-500/20">
            <i class="fas fa-book-open text-2xl"></i>
        </div>
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Mata Kuliah</p>
            <p class="text-3xl font-black text-white mt-1"><?= $jml_mk; ?></p>
        </div>
    </div>

    <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-3xl border border-slate-700 shadow-xl p-6 flex flex-col justify-center relative overflow-hidden text-white md:col-span-2 lg:col-span-1">
        <div class="absolute -right-6 -top-6 w-32 h-32 bg-emerald-500/10 rounded-full blur-2xl"></div>
        <div class="absolute -left-6 -bottom-6 w-32 h-32 bg-teal-500/10 rounded-full blur-2xl"></div>
        
        <div class="relative z-10">
            <span class="px-2.5 py-1 bg-slate-700/50 border border-slate-600 rounded-md text-[10px] font-bold tracking-widest text-emerald-400 uppercase mb-3 inline-block">System Online</span>
            <h3 class="text-xl font-black mb-1 text-white">Selamat Datang! 👋</h3>
            <p class="text-slate-400 text-sm font-medium">Sistem Informasi Akademik versi Dark Mode beroperasi optimal.</p>
        </div>
        <i class="fas fa-shield-alt absolute right-4 bottom-4 text-6xl text-slate-700/30"></i>
    </div>
</div>