-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 24, 2024 at 10:42 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ujicoba-pp`
--

-- --------------------------------------------------------

--
-- Table structure for table `bukus`
--

CREATE TABLE `bukus` (
  `buku_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penulis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerbit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_terbit` year NOT NULL,
  `stok` int NOT NULL DEFAULT '0',
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kategori_id` bigint UNSIGNED NOT NULL,
  `sinopsis` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bukus`
--

INSERT INTO `bukus` (`buku_id`, `judul`, `penulis`, `penerbit`, `tahun_terbit`, `stok`, `gambar`, `created_at`, `updated_at`, `kategori_id`, `sinopsis`) VALUES
('BUKU-0001', 'Tentang Kamu', 'Tere Liye', 'Republika', 2020, 4, '1708749738.jpg', '2024-02-23 11:41:29', '2024-02-24 08:45:50', 1, 'Tentang Kamu menceritakan perjuangan Zaman Zulkarnaen, seorang pengacara muda dari Thompson & Co. Suatu hari, Zaman dipanggil atasannya untuk menyelesaikan sebuah kasus hukum klien. Kasus tersebut adalah persoalan harta warisan yang ditinggalkan kliennya yang belum lama meninggal dunia.'),
('BUKU-0002', 'Septihan', 'Poppi Pertiwi', 'Coconut Books', 2020, 5, '1708749747.jpeg', '2024-02-24 03:41:37', '2024-02-24 04:42:27', 1, 'Septihan merupakan novel yang mengangkat kisah remaja yang dibalut dengan asmara dan persahabatan. Kisah dalam novel ini berfokus pada kehidupan dua karakter utama yaitu Septian Aidan Nugroho dan Jihan Halana. Septian adalah tokoh yang digambarkan sebagai sosok yang pendiam dan dingin, Walau demikian, Ia merupakan salah satu siswa tercerdas sehingga ia pun menjadi murid kebanggaan dan kesayangan para guru di SMA Ganesha. Karena kecerdasannya, Ia juga seringkali mewakili sekolahnya di perlombaan dan mengashilkan prestasi yang membanggakan. Tidak hanya itu, Septian juga merupakan seorang Bendahara di geng Ravispa yang bersikan murid-murid paling pemberani dan nakal di sekolah. Karakter lain bernama Jihan digambarkan sebagai sosok gadis yang ekspresif dan aktif. Di balik parasnya yang rupawan, Ia juga merupakan gadis yang keras kepala yang bisa dilihat dari kegigihannya selama 3 tahun dalam mengejar cinta Septian. Secara garis besar, cerita dalam novel ini lebih memusatkan pada usaha Jihan untuk menaklukkan hati seorang Septian yang dingin, cuek, dan jutek. Di sisi lain, Septian sangat menjauhi tipe-tipe orang ekspresif seperti Jihan.'),
('BUKU-0003', 'Galaksi', 'Poppi Pertiwi', 'Coconut Books', 2021, 3, '1708749758.jpg', '2024-02-24 03:43:26', '2024-02-24 04:42:38', 1, 'Novel ini mengisahkan Galaksi Aldebaran yang seorang ketua geng Ravispa. Geng tersebut merupakan geng paling gagah dan pemberani.\r\n\r\nDan geng ini merupakan tempat berkumpulnya anak-anak nakal dan pemberontak murid-murid SMA Ganesha.\r\n\r\nDan geng tersebut sering berselisih paham dengan geng SMA sebelah yaitu Geng Avegar geng miliki SMA Kencana.'),
('BUKU-0004', 'Mariposa', 'Luluk Hf', 'Coconut Books', 2018, 3, '1708747193.jpg', '2024-02-24 03:45:47', '2024-02-24 03:59:53', 1, 'Novel Mariposa berkisah tentang perjuangan seorang gadis bernama Natasha Kay Loovi atau Acha dalam mengejar seorang laki-laki yang sulit didekati seperti kupu-kupu. Acha sendiri digambarkan sebagai seorang gadis SMA berparas cantik dan pintar. Pertemuan pertamannya dengan Iqbal di sebuah camp olimpiade membuatnya jatuh hati pada sosok laki-laki itu. Iqbal bukan berasal dari sekolah yang sama dengannya. Berkat informasi dari sahabatnya, Amanda, Acha berhasil mengetahui sekolah Iqbal, yaitu SMA Arwana. Acha kemudian bertekad mengejar Iqbal dengan pindah ke SMA Arwana. Beruntung, karena Acha dan Iqbal adalah siswa berprestasi, keduanya dipilih menjadi perwakilan sekolah untuk mengikuti olimpiade sains tingkat nasional. Ini menjadi kesempatan bagus bagi Acha untuk lebih dekat dengan Iqbal, karena keduanya harus mengikuti bimbingan bersama selama tiga bulan menjelang kompetisi. Kendati demikian, untuk mendapatkan hati Iqbal bukan perkara mudah. Sosok Iqbal terlalu dingin dan tidak pernah membuka hati dengan perempuan manapun. Di mata Acha, Iqbal seperti kupu-kupu mariposa yang selalu lari ketika didekati. Namun, Acha merupakan sosok yang tidak kenal lelah dan terus mencoba mendekati Iqbal dengan berbagai cara. Mulai dari mendekatkan diri dengan sahabat Iqbal hingga memberi Iqbal sekotak kue keju. Sayangnya, berbagai usaha Acha justru membuat Iqbal kesal dan menyebutnya sebagai perempuan murahan. Bisakah Acha meluluhkan hati Iqbal?'),
('BUKU-0005', 'Memori', 'Sirhayani', 'Crasindo', 2019, 3, '1708749993.jpg', '2024-02-24 03:51:22', '2024-02-24 04:46:33', 1, 'Pertemuan Amanda dan Athaya membuat Amanda berpikir bahwa cowok itu adalah seseorang yang pernah hadir di hidupnya semasa kecil dulu. Athaya juga berpikir sama tentang Amanda. Namun, mereka tidak akrab dan menjalani kehidupan masing-masing di SMA.\r\n\r\nHingga akhirnya di tahun kedua di SMA, Amanda dan Athaya mukai dekat karena pertemuan mereka di suatu malam. Mereka menghabiskan waktu berjam-jam tanpa menguak masa lalu. Kedekatan itu pula yang membuat Amanda dan Athaya yakin dengan perasaan mereka masing-masing.\r\n\r\nNamun, kehadiran Gia dan satu keinginan papa Athaya membuat Athaya harus memilih pilihan yang menjadi penentu masa depannya nanti.'),
('BUKU-0006', 'Komik Muslimah', 'Dhiba Anisa Umarghanies', 'Anak Kita', 2014, 5, '1708750037.jpg', '2024-02-24 03:57:04', '2024-02-24 04:47:17', 2, 'Duo Nisa dan Aini datang!\r\n\r\nEh...tapi...tunggu...siapa sih mereka?\r\nNisa dan Aini adalah dua orang sahabat.\r\nHari-hari mereka mungkin sama dengan kamu:\r\nBelajar, bersilaturahim dengan teman, jalan-jalan, de el el...\r\nSebagai sahabat, mereka juga saling berbagi informasi, saling mengingatkan, dan sama-sama berusaha menjadi muslimah yang lebih baik.\r\nYuk, kita kenalan dengan mereka Dan sama-sama belajar untuk jadi lebih baik!'),
('BUKU-0007', 'New Crayon Shinchan 1', 'Yoshito Usui', 'Elex Media Komputindo', 2021, 2, '1708750318.jpg', '2024-02-24 04:51:58', '2024-02-24 04:51:58', 2, 'Komik New Crayon Shinchan 1 ini sangat cocok bagi Anda yang menyukai genre slice of life dan komedi. Komik ini diringkas dengan bahasa yang ringan dan alur cerita yang sederhana sehingga mudah dipahami oleh para pembaca. Selain itu, komik ini menyajikan cerita yang seru dan menarik sehingga dapat dibaca oleh segala kalangan. Komik New Crayon Shinchan 1 ini juga memiliki ilustrasi dan gambar yang menarik untuk dibaca dan dikoleksi.\r\nCrayon Shinchan kembali lagi dengan judul fresh, “New Crayon Shinchan”! Ikuti petualangan-petualangan baru Crayon Shinchan bersama keluarga dan teman-temannya yang semakin seru dan kocak! Kali ini, Shinchan sekeluarga lagi-lagi merencanakan wisata murah karena bonus papa dipotong. Tapi, dengan anggaran yang terbatas, mama dan papa malah membayangkan liburan mewah ke Amerika Serikat! Wah, pada akhirnya mereka berlibur di mana, ya? Yuk simak dan baca kelanjutan ceritanya di dalam komik ini dan temukan cerita menarik lainnya bersama Shinchan!'),
('BUKU-0008', 'Komik Next G Rumahku Surgaku', 'Putri Aisyah Maharani & Rika, Dkk', 'Muffin Graphics', 2017, 5, '1708750480.jpg', '2024-02-24 04:54:40', '2024-02-24 04:54:40', 2, 'Sejak pulang dari rumah temannya, Adik terus saja merajuk minta dibuatkan kamar tidur yang lebih luas. Ia iri dengan kamar teman-temannya yang luas dan penuh boneka. Ibu dan ayah sampai harus memberi penjelasan supaya Adik mau mulai bersyukur. Kira-kira, mau tidak ya, Adik mendengar nasihat ayah dan ibu?'),
('BUKU-0009', 'Mahir Matematika SD/MI Kelas 4,5, & 6', 'Annisa Eprila Annisa Eprila Fauziah, M.Pd.', 'Bmedia', 2024, 2, '1708750930.jpg', '2024-02-24 05:02:10', '2024-02-24 05:05:32', 3, 'Buku Mahir Matematika ala Bimbel SD/MI Kelas 4. 5, & 6 ini disusun dengan tujuan membantu siswa mengatasi kesulitan-kesulitan mengerjakan soal dengan cara pembahasan soal bertahap dan trik ala bimbel. Di buku ini, penulis ingin membantu siswa belajar matematika dengan trik-trik tertentu sehingga terasa lebih mudah dalam memahami tipe soal. Untuk mencapai hal tersebut, siswa kelas 4,5, dan 6 yang ingin belajar matematika tentu juga membutuhkan ringkasan materi penting. Dilengkapi dengan contoh dan latihan soal untuk siswa agar dapat berlatih dan menguji pemahamannya.'),
('BUKU-0010', 'Bahasa Jepang : Simple & Easy Cepat Kuasai', 'TIM JAPANESE LANGUAGE CENTRE', 'Caesar Media Pustaka', 2023, 5, '1708751088.jpg', '2024-02-24 05:04:48', '2024-02-24 05:04:48', 3, 'SIMPLE & EASY CEPAT KUASAI BAHASA JEPANG\r\n\r\nBuku ini merupakan buku wajib yang harus dimiliki para pemula yang ingin belajar bahasa Jepang. Kenapa? Karena buku ini disusun dengan penyampaian materi yang simpel dan mudah, urut, serta sistematis.\r\n\r\nMateri-materi yang dikupas dalam buku ini antara lain tentang kaidah bahasa Jepang yang disampaikan dengan penjelasan simpel dan mudah. Dilanjutkan dengan materi tentang pengenalan ragam kosakata populer bahasa Jepang yang sering digunakan, tak lupa diberikan pula materi percakapan bahasa Jepang sehari-hari yang merupakan aplikasi dari dua materi sebelumnya. Dengan penyampaian materi secara berurutan seperti ini, belajar bahasa Jepang akan terasa lebih mudah, khususnya bagi pemula, pemahamannya pun akan lebih cepat dikuasai.'),
('BUKU-0011', 'Malioboro at Midnight', 'Skysphire', 'Bukune', 2023, 8, '1708751357.jpg', '2024-02-24 05:09:17', '2024-02-24 10:07:35', 1, 'Tengah malam bagi kebanyakan orang adalah waktu terbaik untuk beristirahat dan tidur lelap. Tapi untuk Serana Nighita, itu adalah waktu untuk menangisi hidup dan meratapi hubungannya dengan sang penyanyi terkenal, Jan Ichard. Popularitas membawa lelaki itu jauh darinya, Ichard di Jakarta, meninggalkan Sera di Jogja.\r\n\r\nBagi Sera, tengah malam selalu menakutkan.\r\n\r\nNamun, semua berubah setelah Malioboro Hartigan tidak sengaja mendobrak pintu kamarnya pada sebuah malam. Malio datang dan menawarkan pertemanan agar Sera tidak sendiri, agar Sera bisa berbagi sedihnya.\r\n\r\nLantas bagaimana dengan hubungan Sera dan Jan Ichard yang semakin rumit? Dan benarkah tanpa sadar, Malio sudah menjadi \'Midnight\' terbaik Sera?'),
('BUKU-0012', 'Kiprah Politik Soekarno', 'Yonita Yulia Yalinda', 'Anak Hebat Indonesia', 2024, 4, '1708751719.jpg', '2024-02-24 05:15:19', '2024-02-24 05:15:19', 4, 'Di buku ini, kita akan memasuki perjalanan hidup yang luar biasa dari seorang anak kecil bernama Soekarno hingga ia berhasil memperjuangkan kemerdekaan dan menjadi presiden pertama Republik Indonesia. Dengan semangat yang tak tergoyahkan, Soekarno melewati masa kecilnya yang sederhana dengan tekad untuk membebaskan bangsanya dari penjajahan yang berabad-abad lamanya.\r\n\r\nBuku ini akan membawa kita menjelajahi setiap tahap perjuangannya hingga proklamasi kemerdekaan Indonesia pada tahun 1945. Buku ini juga menceritakan akibat dari karier politik yang dilaluinya pada masa penjajahan, yaitu pengasingan.\r\n\r\nSoekarno dikenal sebagai seorang orator ulung. Kepiawaiannya dalam berpidato ini jugalah yang membuatnya sukses dalam karier politik. Selain membahas kiprah politik Soekarno di dalam negeri, buku ini juga membahas kiprah politiknya di dunia internasional. Soekarno menjadi tokoh yang dikenal dan disegani di luar negeri saat menjadi presiden Indonesia.'),
('BUKU-0013', 'Resep Snack MPASI Cegah Stunting', 'Margaret M Sugondo, Florence Sukmawati Jaya', 'Gramedia Pustaka Utama', 2024, 5, '1708764776.jpg', '2024-02-24 08:52:56', '2024-02-24 08:52:56', 5, 'Buku in akan membuat moms and dads ingin memasak di dapur rumah untuk si kecil karena bahan-bahannya simpel, menggunakan alat-alat masak yang biasanya ada di rumah, bahan mudah didapat dan diolah serta dapat dibuat dalam waktu yg cukup singkat.'),
('BUKU-0014', 'Andin`S Kitchen Makan Minum Nyemil', 'ANDINI PUTRI PRIBADINI', 'Wahyu Media', 2023, 3, '1708765093.jpg', '2024-02-24 08:58:13', '2024-02-24 10:38:03', 5, 'ANEKA RESEP SEHARI-HARI BERBAHAN DASAR: AYAM, DAGING, SEAFOOD, SAYURAN ANEKA RESEP JAJANAN NUSANTARA ANEKA RESEP JAJANAN MANCANEGARA ANEKA RESEP DESSERT DAN MINUMAN SEGAR\r\n\r\nBuku ini sangat lengkap memuat aneka resep masakan sehari-berbahan dasar ayam, daging, seafood, dan sayuran. Selain itu ada resep jajanan nusantara & mancanegara, minuman, dan dessert yang hanya lezat, tetapi juga simple pembuatannya dengan bahan yang mudah didapatkan. Resep-resep di buku ini sudah teruji dengan banyaknya followers yang sudah me-recook-nya dan puas dengan hasilnya.'),
('BUKU-0015', 'Inspirasi Desain Interior Modern', 'Andie A. Wicaksono, Dimas Kharisma Y., & Suparno Sastra M', 'Griya Kreasi', 2019, 5, '1708767084.jpg', '2024-02-24 09:31:24', '2024-02-24 09:31:24', 6, 'Buku ini juga menyajikan beragam inspirasi desain dan penataan interior bernuansa modern. Harapannya buku ini, bisa menjadi sebuah pedoman agar suasana interior dalam rumah menjadi nyaman ditempati, sehingga bermanfaat bagi para pembaca.\r\nSelamat membaca!'),
('BUKU-0016', 'Photoshop, Lightroom, dan CorelDraw', 'Jubilee Enterprise', 'Elex Media Komputindo', 2018, 5, '1708767189.jpg', '2024-02-24 09:33:09', '2024-02-24 09:33:09', 6, 'Semua desainer grafis, editor foto, maupun fotografer wajib mengenal ketiga software tersebut jika ingin sukses di karir maupun hobi. Buku Photoshop, Lightroom, dan CorelDraw yang disusun oleh Jubilee Enterprise ini adalah buku yang tepat bagi anda yang tertarik mempelajari ketiga perangkat lunak tersebut. Buku ini memberi pengantar kepada Anda untuk mengenal secara cepat Photoshop, Lightroom, maupun CorelDraw.\r\n\r\nSyarat membaca buku ini adalah Anda memiliki:\r\n- Adobe Photoshop minimal versi CS4\r\n- Adobe Photoshop Lightroom minimal versi 5\r\n- CorelDraw minimal versi X5.\r\n\r\nSemoga Anda bisa menjadi desainer grafis, fotografer, dan editor foto yang sukses setelah membaca buku ini!'),
('BUKU-0017', 'Kompilasi Superlengkap Lagu Wajib Nasional & Daerah', 'Tim Redaksi', 'Scritto Books Publisher', 2017, 5, '1708769072.jpg', '2024-02-24 09:35:15', '2024-02-24 10:04:32', 7, 'Kompilasi Superlengkap Lagu Wajib Nasional & Daerah'),
('BUKU-0018', 'Best Lagu Pop Viral : 15 Lagu Viral untuk Piano dan Gitar', 'Mahardhika Kusumo Simbolon', 'Anak Hebat Indonesia', 2024, 3, '1708767414.jpg', '2024-02-24 09:36:54', '2024-02-24 09:36:54', 7, 'Dari 15 lagu yang disajikan di sini, 13 merupakan lagu populer Indonesia terbaru dan 2 sisanya merupakan lagu Barat yang sudah sangat familiar di level internasional. Lagu lagu tersebut disajikan apa adanya dalam terbitan ini, yakni mengikuti tangga nada dan tempo yang digunakan oleh penyanyi aslinya. Iringan yang ditawarkan di sini juga berpatokan pada irama lagu aslinya yang disederhanakan agar para pembaca dapat menyesuaikan dengan format penampilan yang dikehendaki masing-masing.'),
('BUKU-0019', 'Dongeng 100 Kota', 'Suprapti & Temu Penulis Yogyakarta', 'Laksana', 2019, 5, '1708767970.jpg', '2024-02-24 09:46:10', '2024-02-24 09:46:10', 8, 'Kota-kota di Indonesia memiliki dongeng yang menarik dan penuh teladan. Dongeng-dongeng itu sejak zaman dulu hingga sekarang tetap diceritakan dari mulut ke mulut, dari buku ke buku. Buku ini berisi 100 dongeng yang diceritakan kembali oleh para penulis Temu Penulis Yogyakarta.\r\n\r\nAda dongeng Ayam dan Ikan Tongkol dari Pekanbaru, dongeng Batu Kuwung dari Serang, dongeng Gajah Merik dari Lebong, dongeng Tukang Taking dari Palangkaraya, dongeng Batu Berdaun dari Ambon, dan masih banyak dongeng lainnya.\r\n\r\nBuku dongeng ini sangat menarik karena anak-anak akan mengenal kota-kota di Indonesia dan dongeng di kota tersebut. Yuk, membaca dongeng bersama-sama! Jangan lupa mengajak teman-temanmu, ya.'),
('BUKU-0020', 'Cerita Anak Binatang: Burung Hantu', 'Nabila Anwar', 'Tiga Serangkai', 2020, 4, '1708768085.jpg', '2024-02-24 09:48:05', '2024-02-24 09:48:05', 8, 'Jalinan keakraban orangtua dan anak salah satunya dapat dilakukan dengan bercerita. Sebelum tidur, orangtua dapat menceritakan kisah-kisah yang menarik untuk si kecil. Secara tidak langsung, dengan mendengarkan cerita, anak-anak akan melatih kemampuan bahasanya. Dari mendengar itulah, mereka lama-lama jadi tahu arti mengenai banyak kata, dan memperkaya kosa kata mereka. Serta memungkinkan anak-anak untuk berlatih \'bertanya\'. Jika dipancing dengan pertanyaan, mereka juga akan belajar \'menjawab\'. Dengan kata lain mereka belajar berkomunikasi. Tak hanya itu, buku cerita juga dapat membantu anak untuk berimajinasi untuk perkembangan daya pikirnya. Untuk itu, orangtua harus pintar-pintar memilih cerita, agar anak tertarik dan tidak bosan.'),
('BUKU-0021', 'Pendidikan Pancasila Dan Kewarganegaraan SMA/SMK Kelas 10', 'Abdul Waidl, Ali Usman, Ahmad Asroni, Hatim Gazali danTedi Kholiluddin', 'Pusat Kurikulum dan Perbukuan Kemendikbud', 2022, 8, '1708768609.jpg', '2024-02-24 09:56:25', '2024-02-24 09:56:49', 3, 'Pendidikan Pancasila dan Kewarganegaraan (PPKn) merupakan salah satu mata pelajaran wajib untuk semua jenjang pendidikan di Indonesia, mulai dari tingkat SD sampai SMA. PPKn mengemban amanah untuk menumbuhkembangkan nilai-nilai Pancasila setiap anak bangsa Indonesia. Sebuah amanah yang sangat mulia—pada satu sisi—dan tidak ringan, pada sisi yang lain. Melalui mata pelajaran PPKn ini, peserta didik diharapkan tidak hanya memahami sebuah konsep maupun teori dan sejarah tentang Pancasila dan kewarganegaraan. Lebih dari itu, PPKn diharapkan menjadi wahana edukatif dalam mengembangkan peserta didik menjadi manusia yang memiliki rasa kebangsaan dan cinta tanah air.'),
('BUKU-0022', 'Berorientasi Objek Menggunakan PHP', 'PROF. DR. IR. RIRI FITRI SARI, M.M., M.SC., DTM, SMIEEE', 'Andi Offset', 2021, 5, '1708768981.jpg', '2024-02-24 10:03:01', '2024-02-24 10:36:32', 3, 'Buku Rekayasa Perangkat Lunak Berbasis Objek Menggunakan PHP ini dibuat untuk digunakan pada program studi Teknik Komputer, Ilmu Komputer, Teknik Elektro, Teknik Informatika disekitar tahun kedua perkuliahan dengan beban sebanyak 3 SKS. Buku ini disertai contoh penggunaan tools dalam mempelajari siklus hidup perangkat lunak. Pada buku ini juga dipaparkan sejarah mengapa kita sampai pada bentuk rekayasa perangkat lunak seperti sekarang ini. Pembuatan program perangkat lunak merupakan teknologi yang sangat cepat berkembang, mengingat berkembangnya infrastruktur dan perangkat keras yang tersedia.'),
('BUKU-0023', 'Kartu Mainstream Si Juki: Biru', 'Pionicon', 'Elex Media Komputindo', 2018, 5, '1708770523.jpg', '2024-02-24 10:28:43', '2024-02-24 10:28:43', 2, 'Kartu Mainstream Si Juki: Biru');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_bukus`
--

CREATE TABLE `kategori_bukus` (
  `kategori_id` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_bukus`
--

INSERT INTO `kategori_bukus` (`kategori_id`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Novel', '2024-02-23 11:40:30', '2024-02-23 11:40:30'),
(2, 'Komik', '2024-02-24 03:55:43', '2024-02-24 03:55:43'),
(3, 'Pendidikan', '2024-02-24 05:01:02', '2024-02-24 05:01:02'),
(4, 'Biografi', '2024-02-24 05:13:57', '2024-02-24 05:13:57'),
(5, 'Resep & Masakan', '2024-02-24 08:51:39', '2024-02-24 08:51:39'),
(6, 'Desain', '2024-02-24 09:30:17', '2024-02-24 09:30:17'),
(7, 'Musik', '2024-02-24 09:34:33', '2024-02-24 09:34:33'),
(8, 'Dongeng', '2024-02-24 09:44:16', '2024-02-24 09:44:16');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_buku_relasis`
--

CREATE TABLE `kategori_buku_relasis` (
  `kategoribuku_id` bigint UNSIGNED NOT NULL,
  `kategori_id` bigint UNSIGNED NOT NULL,
  `buku_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `koleksi_pribadis`
--

CREATE TABLE `koleksi_pribadis` (
  `koleksi_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buku_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(23, '2024_02_05_095526_add_tanggal_pengembalian_sebenarnya_to_peminjamen_table', 1),
(46, '2024_02_05_101658_add_late_return_penalty_to_peminjamen_table', 2),
(113, '2014_10_12_000000_create_users_table', 3),
(114, '2014_10_12_100000_create_password_resets_table', 3),
(115, '2019_08_19_000000_create_failed_jobs_table', 3),
(116, '2019_12_14_000001_create_personal_access_tokens_table', 3),
(117, '2024_01_14_060849_create_bukus_table', 3),
(118, '2024_01_14_061504_create_koleksi_pribadis_table', 3),
(119, '2024_01_14_063700_create_peminjamen_table', 3),
(120, '2024_01_14_064348_create_ulasan_bukus_table', 3),
(121, '2024_01_14_064951_create_kategori_bukus_table', 3),
(122, '2024_01_14_065415_create_kategori_buku_relasis_table', 3),
(123, '2024_01_14_083426_add_kategori_id_to_bukus', 3),
(124, '2024_02_23_183149_add_sinopsis_to_bukus_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peminjamen`
--

CREATE TABLE `peminjamen` (
  `peminjaman_id` bigint UNSIGNED NOT NULL,
  `user_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buku_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `tanggal_pengembalian` date DEFAULT NULL,
  `status_peminjaman` enum('Dipinjam','Sudah Kembali') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Dipinjam',
  `denda` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjamen`
--

INSERT INTO `peminjamen` (`peminjaman_id`, `user_id`, `buku_id`, `tanggal_peminjaman`, `tanggal_pengembalian`, `status_peminjaman`, `denda`, `created_at`, `updated_at`) VALUES
(1, 'US-0003', 'BUKU-0001', '2024-02-17', '2024-02-22', 'Sudah Kembali', '20000.00', '2024-02-23 11:46:19', '2024-02-24 08:45:50'),
(2, 'US-0003', 'BUKU-0011', '2024-02-18', '2024-02-23', 'Sudah Kembali', '10000.00', '2024-02-24 05:16:15', '2024-02-24 10:07:30'),
(3, 'US-0004', 'BUKU-0011', '2024-02-18', '2024-02-23', 'Sudah Kembali', '10000.00', '2024-02-24 05:24:41', '2024-02-24 10:07:33'),
(4, 'US-0005', 'BUKU-0011', '2024-02-18', '2024-02-23', 'Sudah Kembali', '10000.00', '2024-02-24 05:26:30', '2024-02-24 10:07:35'),
(5, 'US-0004', 'BUKU-0022', '2024-02-19', '2024-02-24', 'Sudah Kembali', '0.00', '2024-02-24 10:05:32', '2024-02-24 10:07:37'),
(6, 'US-0003', 'BUKU-0022', '2024-02-19', '2024-02-24', 'Sudah Kembali', '0.00', '2024-02-24 10:33:20', '2024-02-24 10:34:12'),
(7, 'US-0006', 'BUKU-0022', '2024-02-20', '2024-02-25', 'Sudah Kembali', '0.00', '2024-02-24 10:36:04', '2024-02-24 10:36:32'),
(8, 'US-0006', 'BUKU-0014', '2024-02-20', '2024-02-25', 'Sudah Kembali', '0.00', '2024-02-24 10:37:19', '2024-02-24 10:38:03');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ulasan_bukus`
--

CREATE TABLE `ulasan_bukus` (
  `ulasan_id` bigint UNSIGNED NOT NULL,
  `user_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buku_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ulasan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int NOT NULL,
  `peminjaman_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ulasan_bukus`
--

INSERT INTO `ulasan_bukus` (`ulasan_id`, `user_id`, `buku_id`, `ulasan`, `rating`, `peminjaman_id`, `created_at`, `updated_at`) VALUES
(1, 'US-0003', 'BUKU-0001', 'bukunya bagus banget', 4, 1, '2024-02-23 11:46:55', '2024-02-23 11:46:55'),
(5, 'US-0004', 'BUKU-0011', 'BUKUNYA BAGUS BANGET, BIKIN BAPER', 5, 3, '2024-02-24 10:08:52', '2024-02-24 10:08:52'),
(6, 'US-0004', 'BUKU-0022', 'BUKUNYA BAGUS, NGEBANTU BUAT BIKIN PROGRAM PAKE PHP', 5, 5, '2024-02-24 10:09:19', '2024-02-24 10:09:19'),
(7, 'US-0005', 'BUKU-0011', 'alurnya bikin banyak kupu\' diperut', 4, 4, '2024-02-24 10:11:33', '2024-02-24 10:11:33'),
(8, 'US-0003', 'BUKU-0011', 'covernya cantik, isinya juga cantik', 5, 2, '2024-02-24 10:12:40', '2024-02-24 10:12:40'),
(9, 'US-0003', 'BUKU-0022', 'bukunya ngebantu banget buat yg mau belajar php', 4, 6, '2024-02-24 10:35:16', '2024-02-24 10:35:16'),
(10, 'US-0006', 'BUKU-0022', 'Buar kalian yg mau belejar oop baca aja buku ini ya, ngebantu banget asli', 4, 7, '2024-02-24 10:37:04', '2024-02-24 10:37:04'),
(11, 'US-0006', 'BUKU-0014', 'Kalian juga kalau mau belajar masak jangan lupa dibaca buku yg ini', 4, 8, '2024-02-24 10:38:43', '2024-02-24 10:38:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','petugas','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `name`, `alamat`, `email`, `email_verified_at`, `password`, `remember_token`, `role`, `avatar`, `created_at`, `updated_at`) VALUES
('A001', 'admin', 'admin', 'rumah', 'admin@mail.com', NULL, '$2y$10$9zWFgS59RKgLldxlDgY7Y.Bstjyh9bJXjiqD2kpHXAbZy77IKEmEe', NULL, 'admin', 'avatar.png', NULL, NULL),
('P001', 'petugas', 'petugas', 'rumah', 'petugas@mail.com', NULL, '$2y$10$pcvHn0vQqj5dWkkeqblZROmpOFQCgf566fENaZURmAr2TTnvcTtKS', NULL, 'petugas', 'avatar.png', NULL, NULL),
('US-0003', 'salwa', 'Salwa', 'tajur', 'salwa@gmail.com', NULL, '$2y$10$WWbh2Pdpah8L8Jbl4sGeaOrTkhfSed4CYkvkh7f0E/kZecaPakpVW', NULL, 'user', 'avatar.png', '2024-02-23 11:43:28', '2024-02-24 10:34:46'),
('US-0004', 'nadillaww', 'Nadila Zari Fani', 'Agus Tailor', 'nadilazarifani@gmail.com', NULL, '$2y$10$9SI7idbgLc7FWl2UDl86RubrlCBc.wT82ZwH.4HpqaKkIvsLHfChG', NULL, 'user', 'avatar.png', '2024-02-24 05:24:12', '2024-02-24 05:24:12'),
('US-0005', 'anandananda', 'Ananda Nuraini', 'Rancamaya', 'anandanuraini@gmail.com', NULL, '$2y$10$e2Lt8Xe/h90OUlrdnYva5.iT4idUk4VxIfK7oNAeDoLHhIIXIsAyS', NULL, 'user', 'avatar.png', '2024-02-24 05:26:23', '2024-02-24 05:26:23'),
('US-0006', 'Ilma', 'Ilma Awaliah', 'Balubur Sari', 'ilmaawaliah@gmail.com', NULL, '$2y$10$k8x58z/zEvCb2eQrCQJKMOWfmwKiDXTAg9WxZ8McOH.rQRRoIHvfG', NULL, 'user', 'avatar.png', '2024-02-24 10:35:57', '2024-02-24 10:35:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bukus`
--
ALTER TABLE `bukus`
  ADD PRIMARY KEY (`buku_id`),
  ADD KEY `bukus_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kategori_bukus`
--
ALTER TABLE `kategori_bukus`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `kategori_buku_relasis`
--
ALTER TABLE `kategori_buku_relasis`
  ADD PRIMARY KEY (`kategoribuku_id`),
  ADD KEY `kategori_buku_relasis_kategori_id_foreign` (`kategori_id`),
  ADD KEY `kategori_buku_relasis_buku_id_foreign` (`buku_id`);

--
-- Indexes for table `koleksi_pribadis`
--
ALTER TABLE `koleksi_pribadis`
  ADD PRIMARY KEY (`koleksi_id`),
  ADD KEY `koleksi_pribadis_user_id_foreign` (`user_id`),
  ADD KEY `koleksi_pribadis_buku_id_foreign` (`buku_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `peminjamen`
--
ALTER TABLE `peminjamen`
  ADD PRIMARY KEY (`peminjaman_id`),
  ADD KEY `peminjamen_user_id_foreign` (`user_id`),
  ADD KEY `peminjamen_buku_id_foreign` (`buku_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `ulasan_bukus`
--
ALTER TABLE `ulasan_bukus`
  ADD PRIMARY KEY (`ulasan_id`),
  ADD KEY `ulasan_bukus_user_id_foreign` (`user_id`),
  ADD KEY `ulasan_bukus_buku_id_foreign` (`buku_id`),
  ADD KEY `ulasan_bukus_peminjaman_id_foreign` (`peminjaman_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori_bukus`
--
ALTER TABLE `kategori_bukus`
  MODIFY `kategori_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kategori_buku_relasis`
--
ALTER TABLE `kategori_buku_relasis`
  MODIFY `kategoribuku_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `koleksi_pribadis`
--
ALTER TABLE `koleksi_pribadis`
  MODIFY `koleksi_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `peminjamen`
--
ALTER TABLE `peminjamen`
  MODIFY `peminjaman_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ulasan_bukus`
--
ALTER TABLE `ulasan_bukus`
  MODIFY `ulasan_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bukus`
--
ALTER TABLE `bukus`
  ADD CONSTRAINT `bukus_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_bukus` (`kategori_id`);

--
-- Constraints for table `kategori_buku_relasis`
--
ALTER TABLE `kategori_buku_relasis`
  ADD CONSTRAINT `kategori_buku_relasis_buku_id_foreign` FOREIGN KEY (`buku_id`) REFERENCES `bukus` (`buku_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kategori_buku_relasis_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_bukus` (`kategori_id`) ON DELETE CASCADE;

--
-- Constraints for table `koleksi_pribadis`
--
ALTER TABLE `koleksi_pribadis`
  ADD CONSTRAINT `koleksi_pribadis_buku_id_foreign` FOREIGN KEY (`buku_id`) REFERENCES `bukus` (`buku_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `koleksi_pribadis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `peminjamen`
--
ALTER TABLE `peminjamen`
  ADD CONSTRAINT `peminjamen_buku_id_foreign` FOREIGN KEY (`buku_id`) REFERENCES `bukus` (`buku_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `peminjamen_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `ulasan_bukus`
--
ALTER TABLE `ulasan_bukus`
  ADD CONSTRAINT `ulasan_bukus_buku_id_foreign` FOREIGN KEY (`buku_id`) REFERENCES `bukus` (`buku_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ulasan_bukus_peminjaman_id_foreign` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjamen` (`peminjaman_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `ulasan_bukus_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
