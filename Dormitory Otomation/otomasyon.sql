-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 22 Haz 2023, 14:49:51
-- Sunucu sürümü: 8.0.17
-- PHP Sürümü: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `otomasyon`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin`
--

CREATE TABLE `admin` (
  `email` text NOT NULL,
  `sifre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `admin`
--

INSERT INTO `admin` (`email`, `sifre`) VALUES
('abidik207@gmail.com', 'candan'),
('alihan@gmail.com', 'candan');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `duyuru`
--

CREATE TABLE `duyuru` (
  `baslik` text NOT NULL,
  `metin` text NOT NULL,
  `tarih` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `iletisim`
--

CREATE TABLE `iletisim` (
  `metin` int(11) NOT NULL,
  `veli_adi` int(11) NOT NULL,
  `veli_soyadi` int(11) NOT NULL,
  `ogrenci_adi` int(11) NOT NULL,
  `ogrenci_soyadi` int(11) NOT NULL,
  `ogrenci_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `izin`
--

CREATE TABLE `izin` (
  `baslangic` date NOT NULL,
  `bitis` date NOT NULL,
  `metin` text NOT NULL,
  `ogrenci_adi` text NOT NULL,
  `ogrenci_soyadi` text NOT NULL,
  `ogrenci_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `izin`
--

INSERT INTO `izin` (`baslangic`, `bitis`, `metin`, `ogrenci_adi`, `ogrenci_soyadi`, `ogrenci_no`) VALUES
('2023-06-16', '2023-06-18', 'hocam', 'Öğrenci Adı', 'Öğrenci Soyadı', 0),
('2023-06-16', '2023-06-18', 'hocam', '', '', 0),
('2023-06-16', '2023-06-18', 'hocalar hocası', '', '', 0),
('2023-06-16', '2023-06-18', 'naber hocam', '', '', 0),
('2023-06-26', '2023-06-29', 'hocam bayramda ailemle takılcam', '', '', 0),
('2023-06-15', '2023-06-18', 'hocaların hocası', '', '', 0),
('2023-06-15', '2023-06-18', 'hocaların hocası', '', '', 0),
('2023-06-30', '2023-06-18', 'hücimmm', '', '', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogrenci`
--

CREATE TABLE `ogrenci` (
  `ogrenci_adi` text NOT NULL,
  `ogrenci_soyadi` text NOT NULL,
  `ogrenci_no` int(11) NOT NULL,
  `ogrenci_tc` bigint(20) NOT NULL,
  `ogrenci_veli_tc` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `ogrenci`
--

INSERT INTO `ogrenci` (`ogrenci_adi`, `ogrenci_soyadi`, `ogrenci_no`, `ogrenci_tc`, `ogrenci_veli_tc`) VALUES
('Alihan', 'Kaplan', 567, 55555555555, 12547896321),
('Alihan', 'kaplan', 209, 12345678901, 98765432109),
('Abdullah', 'Candan', 207, 12356897410, 56789123405);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sikayet`
--

CREATE TABLE `sikayet` (
  `metin` text NOT NULL,
  `tarih` text NOT NULL,
  `okundu` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `sikayet`
--

INSERT INTO `sikayet` (`metin`, `tarih`, `okundu`) VALUES
('Hocam okul çok sıkıcı', '2023-06-14', '0'),
('Hocam bugün yurt girişinde köpekler bekliyordu. Çok korktum. Köpekleri uzaklaştırabilir misiniz?', '2023-06-14', '0'),
('Yurt çok soğuk hocam', '2023-06-18', '0');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `veli`
--

CREATE TABLE `veli` (
  `veli_tc` bigint(20) NOT NULL,
  `veli_adi` text NOT NULL,
  `veli_soyadi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `veli`
--

INSERT INTO `veli` (`veli_tc`, `veli_adi`, `veli_soyadi`) VALUES
(98765432109, 'Nihat', 'Kaplan'),
(56789123405, 'Ziya', 'Candan');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yemek`
--

CREATE TABLE `yemek` (
  `liste` text NOT NULL,
  `tarih` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `yemek`
--

INSERT INTO `yemek` (`liste`, `tarih`) VALUES
('Mercimek çorbası.\r\nYayla çorbası', '2023-06-13'),
('-Yayla Çorbası\r\n-Pirinç Pilavı\r\n-Çoban Salata\r\n-Ayran', '2023-06-12'),
('-Ezogelin Çorbası\r\n-Bulgur Pilavı\r\n-Çoban Salata\r\n-Meyve Suyu', '2023-06-11'),
('-Yayla Çorbası\r\n-Pirinç Pilavı\r\n-Çoban Salata\r\n-Ayran', '2023-06-10'),
('-Ezogelin Çorbası\r\n-Bulgur Pilavı\r\n-Çoban Salata\r\n-Meyve Suyu', '2023-06-09'),
('-Yayla Çorbası\r\n-Pirinç Pilavı\r\n-Çoban Salata\r\n-Ayran', '2023-06-08'),
('-Ezogelin Çorbası\r\n-Bulgur Pilavı\r\n-Çoban Salata\r\n-Meyve Suyu', '2023-06-07'),
('sdafasdfasdfasdfasdfasdfasdfasdf', '2023-06-06'),
('sdfsdafasdfasdfasfasfasdf', '2023-06-05'),
('-Bamya Çorbası  -Etli Pilav -İrmik Helvası\r\n', '2023-06-14');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
