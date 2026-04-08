<?php
session_start();

require_once 'classes/CetakLaporan.php';
require_once 'classes/User.php';
require_once 'classes/Mahasiswa.php';
require_once 'classes/Dosen.php';

if (isset($_GET['action']) && $_GET['action'] == 'reset') {
    unset($_SESSION['mahasiswa']);
    unset($_SESSION['matakuliah']);
    header("Location: index.php?p=dashboard&msg=reset");
    exit;
}

if (!isset($_SESSION['mahasiswa'])) {
    $_SESSION['mahasiswa'] = [];
}
if (!isset($_SESSION['matakuliah'])) {
    $_SESSION['matakuliah'] = [
        'MK01' => ['nama' => 'Pemograman Berorientasi Objek', 'sks' => 3],
        'MK02' => ['nama' => 'Desain Grafis', 'sks' => 4],
        'MK03' => ['nama' => 'Kewarganegaraan', 'sks' => 3]
    ];
}

$message = "";

if (isset($_GET['msg']) && $_GET['msg'] == 'reset') {
    $message = "Semua data berhasil di-reset ke pengaturan awal!";
}

if (isset($_POST['add_mhs'])) {
    $id = $_POST['nim'];
    $nama = $_POST['nama'];
    $_SESSION['mahasiswa'][$id] = ['nama' => $nama, 'nilai' => []];
    $message = "Mahasiswa $nama berhasil ditambahkan!";
}

if (isset($_POST['add_mk'])) {
    $id = strtoupper($_POST['mk_id']);
    $nama = $_POST['mk_nama'];
    $sks = (int)$_POST['mk_sks'];
    $_SESSION['matakuliah'][$id] = ['nama' => $nama, 'sks' => $sks];
    $message = "Mata Kuliah $nama berhasil ditambahkan!";
}

if (isset($_GET['del_mk'])) {
    $id = $_GET['del_mk'];
    unset($_SESSION['matakuliah'][$id]);
    $message = "Mata Kuliah berhasil dihapus!";
}

if (isset($_GET['del_mhs'])) {
    $id = $_GET['del_mhs'];
    if(isset($_SESSION['mahasiswa'][$id])) {
        unset($_SESSION['mahasiswa'][$id]);
        $message = "Data mahasiswa berhasil dihapus!";
    }
}

if (isset($_POST['add_nilai'])) {
    $nim = $_POST['nim'];
    $mkId = $_POST['mk_id'];
    $skor = $_POST['skor'];
    if (isset($_SESSION['mahasiswa'][$nim])) {
        $_SESSION['mahasiswa'][$nim]['nilai'][$mkId] = $skor;
        $message = "Nilai berhasil diupdate!";
    }
}

$page = isset($_GET['p']) ? $_GET['p'] : 'dashboard';
$allowed_pages = ['dashboard', 'mahasiswa', 'matakuliah', 'nilai', 'khs'];
if (!in_array($page, $allowed_pages)) {
    $page = 'dashboard';
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAKAD Dark Premium</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #0f172a; } /* bg-slate-900 */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #475569; }
        
        /* Floating layout fixes */
        .app-container { height: 100vh; display: flex; padding: 1rem; gap: 1rem; }
    </style>
</head>
<body class="text-slate-300 antialiased overflow-hidden">

    <div class="app-container">
        <aside class="w-64 bg-slate-800 rounded-3xl border border-slate-700/50 flex-col hidden md:flex shadow-2xl overflow-hidden shrink-0">
            <div class="h-20 flex items-center px-6 border-b border-slate-700/50 bg-slate-800/50">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center text-slate-900 mr-3 shadow-lg shadow-emerald-500/20">
                    <i class="fas fa-leaf text-lg"></i>
                </div>
                <span class="text-white text-xl font-black tracking-wide">SIAKAD<span class="text-emerald-400">.</span></span>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <p class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-4">Main Menu</p>
                
                <a href="?p=dashboard" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 <?php echo $page == 'dashboard' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 shadow-inner' : 'text-slate-400 hover:bg-slate-700/50 hover:text-slate-200'; ?>">
                    <i class="fas fa-chart-pie w-5 text-center"></i> 
                    <span class="font-bold text-sm">Dashboard</span>
                </a>
                
                <a href="?p=mahasiswa" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 <?php echo $page == 'mahasiswa' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 shadow-inner' : 'text-slate-400 hover:bg-slate-700/50 hover:text-slate-200'; ?>">
                    <i class="fas fa-users w-5 text-center"></i> 
                    <span class="font-bold text-sm">Data Mahasiswa</span>
                </a>
                
                <a href="?p=matakuliah" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 <?php echo $page == 'matakuliah' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 shadow-inner' : 'text-slate-400 hover:bg-slate-700/50 hover:text-slate-200'; ?>">
                    <i class="fas fa-book-open w-5 text-center"></i> 
                    <span class="font-bold text-sm">Mata Kuliah</span>
                </a>
                
                <p class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest mt-8 mb-4">Academic</p>
                
                <a href="?p=nilai" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 <?php echo $page == 'nilai' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 shadow-inner' : 'text-slate-400 hover:bg-slate-700/50 hover:text-slate-200'; ?>">
                    <i class="fas fa-star w-5 text-center"></i> 
                    <span class="font-bold text-sm">Input Nilai</span>
                </a>
                
                <a href="?p=khs" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 <?php echo $page == 'khs' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 shadow-inner' : 'text-slate-400 hover:bg-slate-700/50 hover:text-slate-200'; ?>">
                    <i class="fas fa-file-invoice w-5 text-center"></i> 
                    <span class="font-bold text-sm">Cetak KHS</span>
                </a>
            </nav>

            <div class="p-4 border-t border-slate-700/50 bg-slate-800">
                <a href="?action=reset" onclick="return confirm('PENTING: MENGHAPUS SEMUA DATA?')" class="flex items-center justify-center gap-2 w-full bg-rose-500/10 hover:bg-rose-500 text-rose-400 hover:text-white border border-rose-500/20 px-4 py-3 rounded-xl transition-all duration-300 font-bold text-xs uppercase tracking-wider mb-2">
                    <i class="fas fa-power-off"></i> Reset System
                </a>
            </div>
        </aside>

        <main class="flex-1 flex flex-col min-w-0 relative h-full">
            
            <header class="h-20 bg-slate-800/80 backdrop-blur-xl border border-slate-700/50 rounded-3xl mb-4 flex items-center justify-between px-6 lg:px-8 shrink-0 shadow-lg z-10">
                <div class="flex items-center gap-4">
                    <button class="md:hidden text-slate-400 hover:text-emerald-400 transition-colors">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <h1 class="text-xl lg:text-2xl font-black text-white capitalize tracking-tight">
                        <?php echo str_replace('_', ' ', $page); ?>
                    </h1>
                </div>

                <div class="flex items-center gap-5">
                    <div class="hidden sm:block text-right border-r border-slate-600 pr-5">
                        <div class="text-[10px] font-black text-emerald-400 uppercase tracking-widest">Active Session</div>
                        <div class="text-sm font-bold text-slate-200">Administrator</div>
                    </div>
                    <div class="h-10 w-10 rounded-xl bg-slate-700 border border-slate-600 flex items-center justify-center text-slate-300 font-black shadow-sm relative">
                        <i class="fas fa-user"></i>
                        <span class="absolute -top-1 -right-1 w-3 h-3 bg-emerald-500 border-2 border-slate-800 rounded-full"></span>
                    </div>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto rounded-3xl custom-scroll">
                
                <?php if ($message): ?>
                <div class="mb-6 bg-slate-800 border border-emerald-500/30 rounded-2xl p-4 flex items-center justify-between shadow-lg shadow-emerald-500/5 transition-all">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-emerald-500/10 flex items-center justify-center shrink-0">
                            <i class="fas fa-check text-emerald-400"></i>
                        </div>
                        <p class="text-sm font-bold text-emerald-50"><?php echo $message; ?></p>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-slate-400 hover:text-white transition-colors focus:outline-none bg-slate-700/50 hover:bg-slate-700 w-8 h-8 rounded-full flex items-center justify-center">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <?php endif; ?>

                <div class="w-full pb-10">
                    <?php include "views/{$page}.php"; ?>
                </div>

            </div>
        </main>
    </div>

</body>
</html>