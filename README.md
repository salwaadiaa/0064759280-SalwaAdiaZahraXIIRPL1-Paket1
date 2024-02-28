Tutorial installasi:

1. git clone https://github.com/salwaadiaa/0064759280-SalwaAdiaZahraXIIRPL1-Paket1.git
2. composer install / composer update
3. npm install 
4. npm run dev
5. copy file .env.example dan rename jadi .env
6. buat database dan konfigurasi di file .env
7. php artisan migrate:fresh --seed
8. php artisan key:generate
9. php artisan serve

Login untuk admin:
admin@mail.com
password

Login untuk user:
user@mail.com
password

<div class="col-lg-6">
                    <div class="card mt-4">
                        <div class="card-body">
                            <h5 class="card-title">Total Buku Ter Favorite</h5>
                            <div style="height: 400px; width: 100%;">
                                <canvas id="BukuChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                 $totalDenda = Peminjaman::where('status_peminjaman', 'Sudah Kembali')
                ->sum('denda');

            $peminjamanPerTanggal = Peminjaman::select(DB::raw('DATE(tanggal_peminjaman) as tanggal'), DB::raw('COUNT(*) as total'))
                ->groupBy('tanggal')
                ->get();
                
            $bukusQuery = Buku::leftJoin('ulasan_bukus', 'bukus.buku_id', '=', 'ulasan_bukus.buku_id')
                ->select('bukus.*', DB::raw('COUNT(ulasan_bukus.ulasan_id) as jumlah_ulasan'), DB::raw('AVG(ulasan_bukus.rating) as rating_rata_rata'))
                ->groupBy('bukus.buku_id')
                ->orderBy('jumlah_ulasan', 'desc')
                ->orderBy('rating_rata_rata', 'desc')
                ->get();

            $bukusQuery = Buku::count();
            $totalBuku = Buku::count();
            $totalKategoriBuku = KategoriBuku::count();
            $totalPeminjaman = Peminjaman::count();
            $jumlahUlasan = UlasanBuku::count();

            return view('dashboard.index-admin', compact('totalBuku', 'totalKategoriBuku', 'totalPeminjaman', 'peminjamanPerTanggal', 'totalDenda', 'jumlahUlasan', 'bukusQuery'));

public function index(Request $request)
    {
        $categories = KategoriBuku::all();

        $selectedCategory = $request->input('category');

        $bukusQuery = Buku::leftJoin('ulasan_bukus', 'bukus.buku_id', '=', 'ulasan_bukus.buku_id')
            ->select('bukus.*', DB::raw('COUNT(ulasan_bukus.ulasan_id) as jumlah_ulasan'), DB::raw('AVG(ulasan_bukus.rating) as rating_rata_rata'))
            ->groupBy('bukus.buku_id')
            ->orderBy('jumlah_ulasan', 'desc')
            ->orderBy('rating_rata_rata', 'desc');

        if ($selectedCategory) {
            $bukusQuery->where('bukus.kategori_id', $selectedCategory);
        }

        $bukus = $bukusQuery->paginate(10);

        foreach ($bukus as $buku) {
            $buku->best_seller = ($buku->jumlah_ulasan >= 3);
        }

        return view('dashboard.buku.index', compact('bukus', 'categories', 'selectedCategory'));
    }