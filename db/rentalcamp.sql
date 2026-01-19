-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 19, 2026 at 04:23 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rentalcamp`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` bigint UNSIGNED NOT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `harga_sewa` int NOT NULL,
  `stok` int NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `deskripsi`, `harga_sewa`, `stok`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'Tas Gunung 60 Liter', 'Tas Gunung / Carrier Toba 60 Liter Arei Outdoorgear\r\n\r\nTas Gunung / Carrier Toba 60 Liter Arei Outdoorgear dirancang untuk kegiatan Pendakian selama 3-4 hari.Dilengkapi kompartement utama dan kompartement tambahan seperti saku depan, organizer, saku samping, dan raincover.\r\n\r\nSpesifikasi\r\n\r\nBahan : Nylon+Polyester\r\nBerat : 1500gr\r\n1 Kompartemen Utama\r\n1 Saku Dalam\r\nQuick Access\r\n2 Saku Sabuk\r\nHip Belt\r\n2 Saku Samping\r\nStabilizer Straps\r\nCompression Straps\r\nPeluit\r\nSingle frame\r\nInclude Raincover\r\nUkuran 56 x 30 x 19 cm\r\nKapasitas 60 Liter', 10000, 13, '1765253500_60l.jpg', '2025-12-08 20:59:47', '2026-01-18 21:19:46'),
(2, 'Trekking Pole', 'Trekking Pole / Tongkat Hiking Hightrack 02 Arei Outdoogear Cocok digunakan untuk kegiatan Hiking maupun Treking, terbuat dari bahan Duralium yang ringan namun kuat. Treking Pole Hightrack 02 siap menemani petualangan Areingers.\r\n\r\nSPESIFIKASI\r\nBahan : Duralium (Alumunium)\r\nUkuran : Panjang Minimal :53 CM\r\nUkuran : Panjang Maximal : 110 CM (4 Step)\r\nBerat : 365gr\r\nFitur :\r\nSenter 9 LED + baterai\r\nDilengkapi Antishock\r\nSnow Mud Basket mencegah Tip Trakking Pole menancap terlalu dalam ke tanah, pasir, lumpur atau salju', 10000, 12, '1765417412_trekking.png', '2025-12-10 18:43:32', '2026-01-18 18:46:28'),
(4, 'Tenda Camping 200 x 200 ANTARESTAR biru', 'Tenda Camping 200 x 200 ANTARESTAR\r\n\r\nUkuran paling besar 200cm x 200cm bisa untuk sampai 4 orang\r\nBahan material polyester yang berkualitas\r\nTahan terhadap air dan cuaca panas\r\nTidak mudah sobek\r\nMemiliki berat yang ringan sehingga mudah dibawa kemana saja\r\nSudah termasuk pasak 4 pcs dan tas tenda', 12000, 12, '1765636118_tenda.png', '2025-12-13 07:28:38', '2026-01-14 06:00:21'),
(5, 'Matras Yoga Olahraga', '1. Ukuran 180cm x 60cm\r\n2. Matras Yoga / Camping ini terbuat dari Bahan Spon Karet Anti Slip , Tidak Licin , Good Quality , Good Price\r\n\r\n3. Dilengkapi dengan tali pengikat yang elegan dengan klip pengunci praktis pada saat selesai digunakan / digulung\r\n4. Nyaman digunakan dan tidak mudah sobek\r\n5. Bisa digunakan sebagai matras Yoga maupun Matras Camping (Olahraga, outdoor, Hiking, Camping, Fishing/memancing, Rekreasi, dll ) 6. Kombinasikan matras ini dengan sleeping bag untuk keperluan petualangan / adventure Anda\r\n7. Bisa juga digunakan sebagai alas untuk tidur di asrama / pesantren ataupun kegiatan lainnya seperti event-event khusus atau para relawan di lokasi bencana atau lokasi penelitian)\r\n8. Atau bisa juga digunakan untuk karpet senam yoga, karpet alas olahraga atau Karpet Yoga\r\n9. Untuk produk ini bisa di melakukan pemayaran di tempat ( COD ) atau bayarkan kepada kurir ketika pesanan sampai', 10000, 15, '1768263063_matras.jpg', '2026-01-12 17:11:03', '2026-01-17 06:43:13'),
(6, 'Sleeping Bag Cabin Polar', 'Kantong Tidur Kabin Polar ANTARESTAR\r\n\r\nSleeping Bag Cabin Polar Bahan Lebih Tebal Lebih Hangat\r\nKualitas Terbaik dengan harga terjangkau\r\nBahan lebih tebal dan lebih hangat sehingga lebih nyaman di pakai\r\nCocok untuk hiking camping atau berkemah di cuaca dingin\r\nMenjaga suhu tubuh agar tetap nyaman di suhu dingin ekstrem\r\nKantong Kemasan Ringkas', 17000, 16, '1768263127_sleepbag.png', '2026-01-12 17:12:07', '2026-01-17 06:43:02'),
(7, 'Senter Flashlight 1287 Lampu Emergency', 'Lampu senter rechargeable powerfull untuk aktifitas outdoor, camping hiking, bekerja ataupun emergency. Ramah lingkungan dengan menggunakan sumber daya internal battery yang dapat discharge ulang. Dilengkapi dengan 1 sumber cahaya yang powerful dan dapat diatur sebaran cahayanya dengan diputar ring bagian depan senter. Terdapat pula tombol utama di bagian sisi senter untuk aktifkan 5 mode: Full light, half light, third light, berkedip cepat, dan berkedip lama.\r\n\r\nAplikasi: Camping, Hiking, Outdoor, Emergency, Fishing, Trekking\r\n\r\nFitur:\r\n– Satu sumber cahaya yang powerfull di depan unit\r\n– Housing lampu utama yang ringan dan kuat. Berpenutup karet di tombol mode dan lubang charge\r\n– 5 Mode:Full light, half light, third light, berkedip cepat, dan berkedip lama. \r\n\r\n– Tali di bagian belakang senter dapat dilepas pasang untuk dikaitkan ke carabiner / pengait.\r\n– Waterproof aman saat digunakan di kondisi hujan\r\n– Type C Charging', 5000, 20, '1768263229_senter.jpg', '2026-01-12 17:13:49', '2026-01-14 19:49:09'),
(9, 'Headlamp Aurora', 'Senter Kepala Led Cree dan Lampu COB. Super Terang.\r\nRechargeable\r\nLampu COB Bisa dijadikan lampu penerangan / Emergency.', 5000, 19, '1768263276_headlamp.png', '2026-01-12 17:14:36', '2026-01-14 05:39:22'),
(10, 'Kompor Mini Portable Windproof', 'Kompor Outdoor dengan bentuk Bunga Anti Angin (windproof) & menggunakan Gas Kaleng memudahkan anda dalam membawanya bisa untuk kegiatan traveling maupun hiking', 10000, 17, '1768263408_kompor.jpg', '2026-01-12 17:16:48', '2026-01-18 21:19:46'),
(11, 'Kompor Portable Mini Model Kotak', 'Kompor portable kotak', 10000, 15, '1768263543_kompor1.jpg', '2026-01-12 17:18:41', '2026-01-18 18:46:28'),
(12, 'Nesting Panci Set', 'Spesifikasi:\r\n\r\nBahan: Aluminium Anodisasi Keras\r\n\r\nBerat: 800 gram\r\n\r\nCocok Untuk: 1-2 Orang\r\n\r\nDimensi Package : 18x13x19\r\n\r\n\r\n\r\nWajan penggorengan: 178x44 mm\r\n\r\nPannikin: 171x92 mm\r\n\r\nPenutup Panci: 1 buah\r\n\r\nKetel: 1 buah (1000ml)\r\n\r\n\r\n\r\nPegangan dengan isolasi plastik secara efektif mencegah luka bakar akibat panas dan memberikan keamanan untuk melindungi tangan Anda. Setiap detailnya dilindungi dengan cermat. Panci aluminium ringan, anti karat, anti gesekan, tahan korosi, mudah dibersihkan.', 12000, 15, '1768263771_cookingset.jpg', '2026-01-12 17:22:51', '2026-01-18 21:19:46'),
(13, 'Nesting', 'Alat masak outdoor', 10000, 14, '1768263840_nesting.jpg', '2026-01-12 17:24:00', '2026-01-18 21:01:36'),
(15, 'Sepatu Hiking Pria / Wanita Tinggi', 'Spesifikasi : \r\n– Napa Leather yang menjaga temperatur kaki tetap stabil saat trekking pada kondisi musim dingin\r\n– Atasan PU Leather\r\n– Mesh Polyester\r\n– Cocok dipakai Pria dan Wanita', 13000, 7, '1768264239_pria.jpeg', '2026-01-12 17:28:52', '2026-01-18 18:46:50'),
(16, 'Sepatu Hiking Wanita', 'Speksifikasi :\r\n-Outsole : TPR (Thermo Plastic Rubber)\r\n-Atasan : PU Lether\r\n-Mesh : Polyester\r\n-Size : 36-40', 12000, 7, '1768264206_wanita.jpg', '2026-01-12 17:30:06', '2026-01-17 21:26:27'),
(17, 'Sepatu Hiking Pria / Wanita Pendek', 'Sepatu Hiking Pria / Wanita Pendek - Sepatu Outdoor', 12000, 12, '1768264318_pendek1.jpg', '2026-01-12 17:31:58', '2026-01-18 18:47:59'),
(18, 'Tenda Double Layer Kapasitas 4/5', 'Tenda double layer dengan material waterproof polyester\r\nDilengkapi akses satu pintu masuk dengan ritsleting 2 arah dan teras tenda\r\nDirancang dengan ventilasi berbentuk segitiga dan panel mesh untuk meningkatkan sirkulasi udara\r\nDilengkapi 4 saku pada bagian dalam tenda untuk menyimpan barang esensial secara rapi\r\nPengait di bagian dalam tenda untuk mengaitkan lentera lampu atau senter\r\nGuyline reflektif membantu lebih mudah terlihat di malam hari atau saat keadaan minim cahaya', 40000, 5, '1768785185_45.jpg', '2026-01-18 18:06:12', '2026-01-18 21:19:46'),
(19, 'Tenda Double Layer Kapasitas 2/3', 'Ukuran tenda camping 2 orang umumnya kecil karena dirancang untuk dua orang dewasa. Ruang utama tenda ini sekitar 210 x 140 x 120 cm. Jika tenda memiliki vestibule atau teras, akan ada tambahan panjang antara 40 cm hingga 110 cm. Sementara ukuran packing-nya sekitar 50 x 20 x 20 cm. Selain itu, berat tenda camping 2P ini bervariasi, sekitar 2-3 kg, tergantung tebal layer dan frame yang dipakai.', 30000, 5, '1768785445_23.png', '2026-01-18 18:17:25', '2026-01-18 18:17:25');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_penyewaan`
--

CREATE TABLE `detail_penyewaan` (
  `id_detail` bigint UNSIGNED NOT NULL,
  `id_penyewaan` bigint UNSIGNED NOT NULL,
  `id_barang` bigint UNSIGNED NOT NULL,
  `jumlah` int NOT NULL,
  `harga_sewa` int NOT NULL,
  `subtotal` int NOT NULL,
  `denda` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_12_07_054721_create_barang_table', 1),
(5, '2025_12_07_054729_create_keranjang_table', 1),
(6, '2025_12_07_054736_create_penyewaan_table', 1),
(7, '2025_12_07_054743_create_penyewaan_detail_table', 1),
(8, '2025_12_07_054750_create_pembayaran_table', 1),
(9, '2025_12_07_054755_create_pengembalian_table', 1),
(10, '2025_12_08_145251_create_users_table', 2),
(11, '2025_12_14_122825_create_penyewaan_table', 3),
(12, '2026_01_12_040012_create_detail_penyewaan_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` bigint UNSIGNED NOT NULL,
  `id_penyewaan` bigint UNSIGNED NOT NULL,
  `jumlah_bayar` int NOT NULL,
  `metode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_penyewaan`, `jumlah_bayar`, `metode`, `tanggal_bayar`, `created_at`, `updated_at`) VALUES
(3, 28, 44000, 'tunai', '2026-01-14', '2026-01-13 23:30:58', '2026-01-13 23:30:58'),
(4, 29, 60000, 'tunai', '2026-01-14', '2026-01-14 03:23:23', '2026-01-14 03:23:23'),
(7, 31, 123000, 'tunai', '2026-01-14', '2026-01-14 06:01:26', '2026-01-14 06:01:26'),
(8, 32, 50000, 'tunai', '2026-01-14', '2026-01-14 06:08:44', '2026-01-14 06:08:44'),
(9, 34, 40000, 'tunai', '2026-01-15', '2026-01-14 20:02:14', '2026-01-14 20:02:14'),
(10, 35, 20000, 'tunai', '2026-01-15', '2026-01-14 20:10:51', '2026-01-14 20:10:51'),
(11, 37, 30000, 'tunai', '2026-01-15', '2026-01-14 20:17:49', '2026-01-14 20:17:49'),
(12, 38, 20000, 'tunai', '2026-01-18', '2026-01-17 21:00:28', '2026-01-17 21:00:28'),
(13, 39, 20000, 'tunai', '2026-01-18', '2026-01-17 21:23:32', '2026-01-17 21:23:32'),
(14, 40, 70000, 'cash', '2026-01-18', '2026-01-17 22:01:55', '2026-01-17 22:01:55'),
(15, 42, 50000, 'tunai', '2026-01-19', '2026-01-18 18:44:54', '2026-01-18 18:44:54'),
(16, 43, 20000, 'tunai', '2026-01-19', '2026-01-18 18:59:42', '2026-01-18 18:59:42'),
(17, 44, 50000, 'tunai', '2026-01-19', '2026-01-18 19:18:01', '2026-01-18 19:18:01'),
(18, 45, 50000, 'tunai', '2026-01-19', '2026-01-18 21:01:07', '2026-01-18 21:01:07'),
(19, 46, 510000, 'tunai', '2026-01-19', '2026-01-18 21:18:53', '2026-01-18 21:18:53');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_pengembalian` bigint UNSIGNED NOT NULL,
  `id_penyewaan` bigint UNSIGNED NOT NULL,
  `tanggal_dikembalikan` datetime DEFAULT NULL,
  `kondisi_barang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `denda` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`id_pengembalian`, `id_penyewaan`, `tanggal_dikembalikan`, `kondisi_barang`, `denda`, `created_at`, `updated_at`) VALUES
(2, 28, NULL, 'Baik, tetapi sedikit kotor', -10000, '2026-01-14 04:37:53', '2026-01-14 04:37:53'),
(3, 29, NULL, 'Baik', 0, '2026-01-14 04:38:22', '2026-01-14 04:38:22'),
(4, 30, '2026-01-16 00:00:00', 'Baik', 0, '2026-01-14 05:59:24', '2026-01-14 05:59:24'),
(5, 31, '2026-01-16 00:00:00', 'Baik', 0, '2026-01-14 06:03:06', '2026-01-14 06:03:06'),
(6, 32, NULL, 'Baik tdk ada yg rusak', 0, '2026-01-14 06:11:59', '2026-01-14 06:11:59'),
(7, 34, NULL, 'Baik hanya sedikit kotor', 0, '2026-01-14 20:04:01', '2026-01-14 20:04:01'),
(8, 33, NULL, NULL, -3000, '2026-01-14 20:07:23', '2026-01-14 20:07:23'),
(9, 35, NULL, NULL, 0, '2026-01-14 20:11:24', '2026-01-14 20:11:24'),
(10, 37, NULL, NULL, 0, '2026-01-14 20:19:26', '2026-01-14 20:19:26'),
(11, 39, NULL, NULL, 0, '2026-01-17 21:28:51', '2026-01-17 21:28:51'),
(12, 42, NULL, 'Baik', 0, '2026-01-18 18:46:28', '2026-01-18 18:46:28'),
(13, 41, NULL, NULL, 0, '2026-01-18 18:46:50', '2026-01-18 18:46:50'),
(14, 40, NULL, NULL, 0, '2026-01-18 18:47:59', '2026-01-18 18:47:59'),
(15, 38, NULL, 'Baik', 0, '2026-01-18 18:56:27', '2026-01-18 18:56:27'),
(16, 43, NULL, 'Kotor sedikit', 0, '2026-01-18 19:00:09', '2026-01-18 19:00:09'),
(17, 44, '2026-01-21 00:00:00', 'Baik', 3000, '2026-01-18 19:18:42', '2026-01-18 19:18:42'),
(18, 45, '2026-01-21 00:00:00', 'Baik', 3000, '2026-01-18 21:01:36', '2026-01-18 21:01:36'),
(19, 46, '2026-01-26 00:00:00', 'Lengkap dan Baik', 3000, '2026-01-18 21:19:46', '2026-01-18 21:19:46');

-- --------------------------------------------------------

--
-- Table structure for table `penyewaan`
--

CREATE TABLE `penyewaan` (
  `id_penyewaan` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `tanggal_sewa` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `tanggal_dikembalikan` date DEFAULT NULL,
  `total_harga` int NOT NULL DEFAULT '0',
  `denda` int NOT NULL DEFAULT '0',
  `status` enum('disewa','dikembalikan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'disewa',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penyewaan`
--

INSERT INTO `penyewaan` (`id_penyewaan`, `id_user`, `tanggal_sewa`, `tanggal_kembali`, `tanggal_dikembalikan`, `total_harga`, `denda`, `status`, `created_at`, `updated_at`) VALUES
(28, 1, '2026-01-14', '2026-01-15', '2026-01-16', 44000, -10000, 'dikembalikan', '2026-01-13 23:30:34', '2026-01-14 04:37:53'),
(29, 11, '2026-01-14', '2026-01-18', '2026-01-18', 60000, 0, 'dikembalikan', '2026-01-14 03:23:14', '2026-01-14 04:38:22'),
(30, 8, '2026-01-14', '2026-01-16', '2026-01-16', 15000, 0, 'dikembalikan', '2026-01-14 05:39:22', '2026-01-14 05:59:24'),
(31, 11, '2026-01-14', '2026-01-16', '2026-01-16', 123000, 0, 'dikembalikan', '2026-01-14 06:00:21', '2026-01-14 06:03:06'),
(32, 7, '2026-01-14', '2026-01-15', '2026-01-15', 50000, 0, 'dikembalikan', '2026-01-14 06:08:35', '2026-01-14 06:11:59'),
(33, 8, '2026-01-14', '2026-01-15', '2026-01-16', 24000, -3000, 'dikembalikan', '2026-01-14 06:26:44', '2026-01-14 20:07:23'),
(34, 16, '2026-01-15', '2026-01-16', '2026-01-16', 40000, 0, 'dikembalikan', '2026-01-14 20:02:06', '2026-01-14 20:04:01'),
(35, 12, '2026-01-15', '2026-01-16', '2026-01-16', 20000, 0, 'dikembalikan', '2026-01-14 20:10:47', '2026-01-14 20:11:24'),
(37, 7, '2026-01-15', '2026-01-16', '2026-01-16', 30000, 0, 'dikembalikan', '2026-01-14 20:17:46', '2026-01-14 20:19:26'),
(38, 18, '2026-01-18', '2026-01-19', '2026-01-20', 20000, 0, 'dikembalikan', '2026-01-17 21:00:17', '2026-01-18 18:56:27'),
(39, 8, '2026-01-18', '2026-01-19', '2026-01-19', 20000, 0, 'dikembalikan', '2026-01-17 21:23:29', '2026-01-17 21:28:51'),
(40, 18, '2026-01-18', '2026-01-20', '2026-01-21', 66000, 0, 'dikembalikan', '2026-01-17 22:01:42', '2026-01-18 18:47:59'),
(41, 16, '2026-01-18', '2026-01-19', '2026-01-19', 26000, 0, 'dikembalikan', '2026-01-17 22:08:35', '2026-01-18 18:46:50'),
(42, 20, '2026-01-19', '2026-01-20', '2026-01-21', 40000, 0, 'dikembalikan', '2026-01-18 18:44:37', '2026-01-18 18:46:28'),
(43, 15, '2026-01-19', '2026-01-20', '2026-01-21', 20000, 0, 'dikembalikan', '2026-01-18 18:59:35', '2026-01-18 19:00:09'),
(44, 1, '2026-01-19', '2026-01-20', '2026-01-21', 44000, 3000, 'dikembalikan', '2026-01-18 19:17:52', '2026-01-18 19:18:42'),
(45, 20, '2026-01-19', '2026-01-20', '2026-01-21', 40000, 3000, 'dikembalikan', '2026-01-18 21:01:00', '2026-01-18 21:01:36'),
(46, 11, '2026-01-19', '2026-01-25', '2026-01-26', 504000, 3000, 'dikembalikan', '2026-01-18 21:18:35', '2026-01-18 21:19:46');

-- --------------------------------------------------------

--
-- Table structure for table `penyewaan_detail`
--

CREATE TABLE `penyewaan_detail` (
  `id_penyewaan_detail` bigint UNSIGNED NOT NULL,
  `id_penyewaan` bigint UNSIGNED NOT NULL,
  `id_barang` bigint UNSIGNED NOT NULL,
  `jumlah` int NOT NULL,
  `subtotal` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penyewaan_detail`
--

INSERT INTO `penyewaan_detail` (`id_penyewaan_detail`, `id_penyewaan`, `id_barang`, `jumlah`, `subtotal`, `created_at`, `updated_at`) VALUES
(4, 28, 16, 1, 24000, '2026-01-13 23:30:34', '2026-01-13 23:30:34'),
(5, 28, 1, 1, 20000, '2026-01-13 23:30:34', '2026-01-13 23:30:34'),
(6, 29, 10, 1, 60000, '2026-01-14 03:23:14', '2026-01-14 03:23:14'),
(7, 30, 9, 1, 15000, '2026-01-14 05:39:22', '2026-01-14 05:39:22'),
(8, 31, 6, 1, 51000, '2026-01-14 06:00:21', '2026-01-14 06:00:21'),
(9, 31, 16, 1, 36000, '2026-01-14 06:00:21', '2026-01-14 06:00:21'),
(10, 31, 4, 1, 36000, '2026-01-14 06:00:21', '2026-01-14 06:00:21'),
(11, 32, 12, 1, 50000, '2026-01-14 06:08:35', '2026-01-14 06:08:35'),
(12, 33, 10, 1, 24000, '2026-01-14 06:26:44', '2026-01-14 06:26:44'),
(13, 34, 13, 1, 20000, '2026-01-14 20:02:06', '2026-01-14 20:02:06'),
(14, 34, 1, 1, 20000, '2026-01-14 20:02:06', '2026-01-14 20:02:06'),
(15, 35, 10, 1, 20000, '2026-01-14 20:10:47', '2026-01-14 20:10:47'),
(17, 37, 15, 1, 30000, '2026-01-14 20:17:46', '2026-01-14 20:17:46'),
(18, 38, 13, 1, 20000, '2026-01-17 21:00:17', '2026-01-17 21:00:17'),
(19, 39, 13, 1, 20000, '2026-01-17 21:23:29', '2026-01-17 21:23:29'),
(20, 40, 13, 1, 30000, '2026-01-17 22:01:42', '2026-01-17 22:01:42'),
(21, 40, 17, 1, 36000, '2026-01-17 22:01:42', '2026-01-17 22:01:42'),
(22, 41, 15, 1, 26000, '2026-01-17 22:08:35', '2026-01-17 22:08:35'),
(23, 42, 11, 1, 20000, '2026-01-18 18:44:37', '2026-01-18 18:44:37'),
(24, 42, 2, 1, 20000, '2026-01-18 18:44:37', '2026-01-18 18:44:37'),
(25, 43, 1, 1, 20000, '2026-01-18 18:59:35', '2026-01-18 18:59:35'),
(26, 44, 1, 1, 20000, '2026-01-18 19:17:52', '2026-01-18 19:17:52'),
(27, 44, 12, 1, 24000, '2026-01-18 19:17:52', '2026-01-18 19:17:52'),
(28, 45, 1, 1, 20000, '2026-01-18 21:01:00', '2026-01-18 21:01:00'),
(29, 45, 13, 1, 20000, '2026-01-18 21:01:00', '2026-01-18 21:01:00'),
(30, 46, 1, 1, 70000, '2026-01-18 21:18:35', '2026-01-18 21:18:35'),
(31, 46, 18, 1, 280000, '2026-01-18 21:18:35', '2026-01-18 21:18:35'),
(32, 46, 10, 1, 70000, '2026-01-18 21:18:35', '2026-01-18 21:18:35'),
(33, 46, 12, 1, 84000, '2026-01-18 21:18:35', '2026-01-18 21:18:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `email`, `password`, `alamat`, `no_hp`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Aulia Rakmawati', 'auliarakmawati06@gmail.com', '$2y$12$F0tGV0uA3MxJywHqFGnCVunhIoHhCT1hZDIEXJJ6ktXHiUlUvp72C', 'Ds. wuluh Kec. Kesamben Kab. Jombang RT.01/RW.01', '085706760096', 'user', '2025-12-08 08:45:55', '2025-12-08 19:26:29'),
(7, 'Haris Setiawan', 'harissetiawan@gmail.com', '$2y$12$QRiAPuFYm4j9.UeHFt3DbenyUGDDMIlS0xrB8bkQii44wGGq4WQsS', 'Ds. wuluh Kec. Kesamben Kab. Jombang RT.01/RW.01', '081553445253', 'user', '2025-12-13 07:07:12', '2025-12-13 07:07:12'),
(8, 'Nita Tri Novitasari', 'nitatri@gmail.com', '$2y$12$oLdjR3eKBQwThRLeI.jgxeYVHJI4GWdmiK4KH0oz3F.Lmmh7MCcC.', 'Ds. wuluh Kec. Kesamben Kab. Jombang RT.01/RW.01', '085855273180', 'user', '2025-12-13 07:09:17', '2025-12-13 07:09:17'),
(11, 'Jihan salma', 'jihansalma@gmil.com', '$2y$12$x7qnz8cZ7DUOLOjog41B4uOexxB0H4gJ65XVO0STjK.UoKfH9MTxK', 'Sidonganti, Pulorejo, Kota Mojokerto', '0838-3135-7728', 'user', '2025-12-16 05:37:35', '2025-12-16 05:37:35'),
(12, 'Revika Indrasari Dewi', 'rerecantik@gmail.com', '$2y$12$dmrEy/iH5J/ucCnmdiZV/unpZg03ICw9URIE.u8u1Up3CWljL/.vi', 'Sumolepen, Gajahmada, Kota Mojokerto', '082176483628', 'user', '2025-12-16 05:38:12', '2025-12-16 05:38:12'),
(13, 'Adelia Helmi Nawan', 'adellll0101@gmail.com', '$2y$12$2.9Hv2XBF5dAYLdkv6W5t.zglfQw2k2FuZQeEEFaZ01Yw0lb/UQnu', 'Karangkedawang, Sooko, Mojokerto', '0856-0678-9334', 'user', '2025-12-16 05:39:17', '2025-12-30 06:34:32'),
(14, 'Bunga Ayu', 'bungaayu00@gmail.com', '$2y$12$BYlEUcqarWAu1xfNcEDGde2McbbdO.pemkCdbYAW2pFvI770VqGfm', 'Kota Mojokerto', '085678390921', 'user', '2026-01-14 19:59:38', '2026-01-14 19:59:38'),
(15, 'Anggun fadhilah', 'anggun000@gmail.com', '$2y$12$/gtOzP5dHNYqHqKhZXW0I.AB63UwbzPtY6onAfkLVOtHn9RCQ8.fW', 'Kota Mojokerto', '082167880921', 'user', '2026-01-14 20:00:15', '2026-01-14 20:00:15'),
(16, 'Revand Pramaditya', 'revandpram@gmail.com', '$2y$12$EKpQGudYnFgG1N32vPjhnedRCK6WHD2sV8rH7SqczpJkbia1ImB4G', 'Sidoarjo', '0857983198371', 'user', '2026-01-14 20:00:59', '2026-01-14 20:00:59'),
(17, 'Dhama Haikal', 'dhamahaikal@gmail.com', '$2y$12$bgdxR6D7ZhORY25fMv9OO.FJ1ERKDHCtsBKGjbDvxH2acEcEDC9GK', 'Kota Mojokerto', '085890980909', 'user', '2026-01-14 20:01:24', '2026-01-14 20:01:24'),
(18, 'M Denny', 'denny123@gmail.com', '$2y$12$QBYgy60EWNzbkwUvId/16uCfjOT3lpsosVIxBX96hoe/SXqOc566q', 'Kota Mojokerto', '085792130923', 'user', '2026-01-17 06:44:58', '2026-01-17 06:44:58'),
(19, 'Administrator', 'adminrental@gmail.com', '$2y$12$4E97mXZW/UEGsaFi9XEyCeLzWQxYKCXv2VsRhFeeWlQE8Tb7jlTvy', 'Kantor Admin', '081234567890', 'admin', '2026-01-18 06:56:35', '2026-01-18 06:56:35'),
(20, 'Bu supri', 'busupri@gmail.com', '$2y$12$DjLu02rVfuvcHxxoWJ0Xa.SspHNv76WRtCql5.Pdwi9QzfhRJdwii', 'Kota Mojokerto', '085768729127', 'user', '2026-01-18 18:44:05', '2026-01-18 18:44:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `detail_penyewaan`
--
ALTER TABLE `detail_penyewaan`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `detail_penyewaan_id_penyewaan_foreign` (`id_penyewaan`),
  ADD KEY `detail_penyewaan_id_barang_foreign` (`id_barang`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `pembayaran_id_penyewaan_foreign` (`id_penyewaan`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`),
  ADD KEY `pengembalian_id_penyewaan_foreign` (`id_penyewaan`);

--
-- Indexes for table `penyewaan`
--
ALTER TABLE `penyewaan`
  ADD PRIMARY KEY (`id_penyewaan`),
  ADD KEY `penyewaan_id_user_foreign` (`id_user`);

--
-- Indexes for table `penyewaan_detail`
--
ALTER TABLE `penyewaan_detail`
  ADD PRIMARY KEY (`id_penyewaan_detail`),
  ADD KEY `penyewaan_detail_id_penyewaan_foreign` (`id_penyewaan`),
  ADD KEY `penyewaan_detail_id_barang_foreign` (`id_barang`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `detail_penyewaan`
--
ALTER TABLE `detail_penyewaan`
  MODIFY `id_detail` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id_pengembalian` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `penyewaan`
--
ALTER TABLE `penyewaan`
  MODIFY `id_penyewaan` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `penyewaan_detail`
--
ALTER TABLE `penyewaan_detail`
  MODIFY `id_penyewaan_detail` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_penyewaan`
--
ALTER TABLE `detail_penyewaan`
  ADD CONSTRAINT `detail_penyewaan_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_penyewaan_id_penyewaan_foreign` FOREIGN KEY (`id_penyewaan`) REFERENCES `penyewaan` (`id_penyewaan`) ON DELETE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_id_penyewaan_foreign` FOREIGN KEY (`id_penyewaan`) REFERENCES `penyewaan` (`id_penyewaan`) ON DELETE CASCADE;

--
-- Constraints for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `pengembalian_id_penyewaan_foreign` FOREIGN KEY (`id_penyewaan`) REFERENCES `penyewaan` (`id_penyewaan`) ON DELETE CASCADE;

--
-- Constraints for table `penyewaan`
--
ALTER TABLE `penyewaan`
  ADD CONSTRAINT `penyewaan_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `penyewaan_detail`
--
ALTER TABLE `penyewaan_detail`
  ADD CONSTRAINT `penyewaan_detail_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE,
  ADD CONSTRAINT `penyewaan_detail_id_penyewaan_foreign` FOREIGN KEY (`id_penyewaan`) REFERENCES `penyewaan` (`id_penyewaan`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
