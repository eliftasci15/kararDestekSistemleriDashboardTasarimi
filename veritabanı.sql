-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 02 Şub 2021, 13:36:47
-- Sunucu sürümü: 5.7.26
-- PHP Sürümü: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `2018469049`
--

DELIMITER $$
--
-- Yordamlar
--
DROP PROCEDURE IF EXISTS `soru10_şube_adi_parametre_olan_şubedeki_en_pahali_urun_ve_fiyati`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `soru10_şube_adi_parametre_olan_şubedeki_en_pahali_urun_ve_fiyati` (IN `isim1` VARCHAR(55))  NO SQL
SELECT subeler.sube_adi, urunler.urun_id, urunler.urun_adi, max(urunler.fiyat) as en_pahalı_ürün
FROM subeler, urunler, satilan
WHERE subeler.sube_id=satilan.sube_id
AND urunler.urun_id=satilan.urun_id
AND subeler.sube_adi=isim1$$

DROP PROCEDURE IF EXISTS `soru11_sube_bazinda_toplam_satis_adetleri_ve_toplam_gelir`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `soru11_sube_bazinda_toplam_satis_adetleri_ve_toplam_gelir` ()  NO SQL
SELECT subeler.sube_id, subeler.sube_adi, sum(satilan.adet) as toplam_satis, sum(urunler.fiyat*satilan.adet) as toplam_fiyat
FROM satilan, urunler, subeler
WHERE satilan.urun_id=urunler.urun_id
AND subeler.sube_id=satilan.sube_id
GROUP BY subeler.sube_id
ORDER BY toplam_satis$$

DROP PROCEDURE IF EXISTS `soru12_subeid_göre_satilan_urunler_ve_satilma_tarihleri`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `soru12_subeid_göre_satilan_urunler_ve_satilma_tarihleri` (IN `rakam` INT(11))  NO SQL
SELECT subeler.sube_adi, urunler.urun_id, urunler.urun_adi, kategori.kategori_adi, satilan.satis_id, satilan.satilma_tarihi
FROM subeler, urunler, satilan, kategori
WHERE subeler.sube_id=satilan.sube_id
AND urunler.urun_id=satilan.urun_id
AND kategori.kategori_id=urunler.kategori_id
AND subeler.sube_id=rakam$$

DROP PROCEDURE IF EXISTS `soru13_iki_tarih_arasi_şube_satilan_urunler`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `soru13_iki_tarih_arasi_şube_satilan_urunler` (IN `tarih1` DATE, IN `tarih2` DATE, IN `id` INT(11))  NO SQL
SELECT subeler.sube_id, subeler.sube_adi, satilan.satis_id,satilan.satilma_tarihi
FROM subeler, satilan
WHERE subeler.sube_id=satilan.sube_id
AND satilan.satilma_tarihi BETWEEN tarih1 and tarih2
AND subeler.sube_id=id$$

DROP PROCEDURE IF EXISTS `soru14_magazadaki_topam_tüm_satis_adedi`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `soru14_magazadaki_topam_tüm_satis_adedi` ()  NO SQL
SELECT SUM(satilan.adet) as magazadaki_tüm_satis_rakami
FROM magaza, subeler, satilan
WHERE magaza.magaza_id=subeler.magaza_id AND subeler.sube_id=satilan.sube_id$$

DROP PROCEDURE IF EXISTS `soru15_her_subede_satilan_urun_say_toplam_satis_içindeki_yüzdesi`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `soru15_her_subede_satilan_urun_say_toplam_satis_içindeki_yüzdesi` ()  NO SQL
SELECT subeler.sube_id, subeler.sube_adi, round((sum(satilan.adet)/(SELECT sum(satilan.adet) as magazadaki_tüm_satis_rakami FROM magaza,subeler,satilan WHERE magaza.magaza_id=subeler.magaza_id AND subeler.sube_id=satilan.sube_id)*100),2) as yüzde_olarak_satis
FROM satilan, urunler, subeler
WHERE satilan.urun_id=urunler.urun_id AND subeler.sube_id=satilan.sube_id
GROUP BY subeler.sube_id
ORDER BY yüzde_olarak_satis$$

DROP PROCEDURE IF EXISTS `soru16_yüzde_olarak_satis_orani`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `soru16_yüzde_olarak_satis_orani` ()  NO SQL
SELECT subeler.sube_adi, round((sum(urunler.fiyat*satilan.adet)/(SELECT sum(urunler.fiyat*satilan.adet) as magazadaki_tüm_satis_fiyati FROM magaza,subeler,satilan,urunler WHERE magaza.magaza_id=subeler.magaza_id AND subeler.sube_id=satilan.sube_id AND urunler.urun_id=satilan.urun_id)*100),2) as yüzde_olarak_satis_orani
FROM satilan, urunler, subeler
WHERE satilan.urun_id=urunler.urun_id AND subeler.sube_id=satilan.sube_id
GROUP BY subeler.sube_id
ORDER BY yüzde_olarak_satis_orani$$

DROP PROCEDURE IF EXISTS `soru1_altı_taneden_az_ürünü_olan_kategoriler`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `soru1_altı_taneden_az_ürünü_olan_kategoriler` ()  NO SQL
SELECT kategori.kategori_adi, COUNT(urunler.urun_id) as urun_sayısı
FROM kategori LEFT JOIN urunler on urunler.kategori_id=kategori.kategori_id
GROUP BY kategori.kategori_id
HAVING urun_sayısı <6$$

DROP PROCEDURE IF EXISTS `soru2_her_bir_subedeki_satilan_ortalama_ürün_fiyati`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `soru2_her_bir_subedeki_satilan_ortalama_ürün_fiyati` ()  NO SQL
SELECT subeler.sube_adi, round(AVG(urunler.fiyat),1) as ortalama_fiyat
FROM subeler, satilan, urunler
WHERE subeler.sube_id=satilan.sube_id AND urunler.urun_id=satilan.urun_id
GROUP BY subeler.sube_id$$

DROP PROCEDURE IF EXISTS `soru3_her_üründen_kaçar_tane_satildigini_bulan_sakli_yordam`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `soru3_her_üründen_kaçar_tane_satildigini_bulan_sakli_yordam` ()  NO SQL
SELECT urunler.urun_id, urunler.urun_adi, COUNT(satilan.satis_id) as urun_satis
FROM urunler LEFT JOIN satilan
ON urunler.urun_id=satilan.urun_id
GROUP BY urunler.urun_id
ORDER BY urun_satis$$

DROP PROCEDURE IF EXISTS `soru4_musteri_bazinda_odenen_en_fazla_miktar_çoktan_aza_sirala`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `soru4_musteri_bazinda_odenen_en_fazla_miktar_çoktan_aza_sirala` ()  NO SQL
SELECT musteriler.musteri_id, musteriler.musteri_ad, musteriler.musteri_soyad, round(max(urunler.fiyat*satilan.adet)) as odenen_fiyat
FROM urunler, musteriler, satilan
WHERE satilan.musteri_id=musteriler.musteri_id
AND satilan.urun_id=urunler.urun_id
GROUP BY musteriler.musteri_id
ORDER BY odenen_fiyat DESC$$

DROP PROCEDURE IF EXISTS `soru5_satilmayan_urun_adi_kategorisi_ve_fiyati`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `soru5_satilmayan_urun_adi_kategorisi_ve_fiyati` ()  NO SQL
SELECT urunler.urun_id, urunler.urun_adi, kategori.kategori_adi, urunler.fiyat
FROM satilan RIGHT JOIN urunler on satilan.urun_id=urunler.urun_id
LEFT JOIN kategori on kategori.kategori_id=urunler.kategori_id
WHERE satilan.satis_id is null$$

DROP PROCEDURE IF EXISTS `soru6_fiyati_parametre_olan_iki_fiyat_arasindaki_ürün`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `soru6_fiyati_parametre_olan_iki_fiyat_arasindaki_ürün` (IN `rakam1` INT(11), IN `rakam2` INT(11))  NO SQL
SELECT urunler.urun_id, urunler.urun_adi, urunler.fiyat
FROM urunler
WHERE urunler.fiyat BETWEEN rakam1 AND rakam2$$

DROP PROCEDURE IF EXISTS `soru7_kategori_adi_parametre_olan_kategorinin_ürün_sayisi`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `soru7_kategori_adi_parametre_olan_kategorinin_ürün_sayisi` (IN `adi` VARCHAR(55))  NO SQL
SELECT kategori.kategori_adi, COUNT(urunler.urun_id) as urun_sayısı
FROM kategori LEFT JOIN urunler on kategori.kategori_id=urunler.kategori_id
WHERE kategori.kategori_adi=adi$$

DROP PROCEDURE IF EXISTS `soru8_musteri_adi_parametre_olan_musterinin_kaç_defa_urun_aldigi`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `soru8_musteri_adi_parametre_olan_musterinin_kaç_defa_urun_aldigi` (IN `ad` VARCHAR(55), IN `soyad` VARCHAR(55))  NO SQL
SELECT concat(musteriler.musteri_ad,' ',musteriler.musteri_soyad) as musteri, COUNT(satilan.satis_id) as satis_sayısı
FROM musteriler LEFT JOIN satilan ON musteriler.musteri_id=satilan.musteri_id
WHERE musteriler.musteri_ad LIKE concat('%',ad,'%') AND musteriler.musteri_soyad LIKE concat('%',soyad,'%')
GROUP BY musteriler.musteri_id$$

DROP PROCEDURE IF EXISTS `soru9_urun_adi_parametre_olan_ürünün_satilma_sayisi`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `soru9_urun_adi_parametre_olan_ürünün_satilma_sayisi` (IN `isim` VARCHAR(55))  NO SQL
SELECT urunler.urun_adi, COUNT(satilan.adet) as satıs_sayısı
FROM urunler LEFT JOIN satilan on urunler.urun_id=satilan.urun_id
WHERE urunler.urun_adi=isim
ORDER BY satıs_sayısı$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cinsiyet`
--

DROP TABLE IF EXISTS `cinsiyet`;
CREATE TABLE IF NOT EXISTS `cinsiyet` (
  `cinsiyet_id` int(11) NOT NULL,
  `cinsiyet_adi` varchar(55) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`cinsiyet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `cinsiyet`
--

INSERT INTO `cinsiyet` (`cinsiyet_id`, `cinsiyet_adi`) VALUES
(1, 'Kadın'),
(2, 'Erkek');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `eski_fiyat`
--

DROP TABLE IF EXISTS `eski_fiyat`;
CREATE TABLE IF NOT EXISTS `eski_fiyat` (
  `urun_adi` varchar(55) COLLATE utf8_turkish_ci NOT NULL,
  `eski_fiyat` int(11) NOT NULL,
  `degisme_tarihi` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `eski_fiyat`
--

INSERT INTO `eski_fiyat` (`urun_adi`, `eski_fiyat`, `degisme_tarihi`) VALUES
('kadın kürklü pembe mont', 240, '2021-01-13 13:47:32'),
('Erkek lacivert fermuarlı ceket', 230, '2021-01-13 13:48:38'),
('kadın beyaz kapüşonlu sweatshirt', 70, '2021-01-13 13:49:15'),
('Erkek mor basic sweatshirt', 75, '2021-01-13 13:50:04'),
('kadın beyaz yüksek bel pantolon', 65, '2021-01-13 13:51:08');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `fatura`
--

DROP TABLE IF EXISTS `fatura`;
CREATE TABLE IF NOT EXISTS `fatura` (
  `satis_id` int(11) NOT NULL,
  `toplam_fiyat` int(11) NOT NULL,
  `satis_tarihi` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `fatura`
--

INSERT INTO `fatura` (`satis_id`, `toplam_fiyat`, `satis_tarihi`) VALUES
(236, 85, '2021-02-01'),
(237, 100, '2021-02-01');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ilceler`
--

DROP TABLE IF EXISTS `ilceler`;
CREATE TABLE IF NOT EXISTS `ilceler` (
  `ilce_id` int(11) NOT NULL,
  `ilce_adi` varchar(55) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`ilce_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `ilceler`
--

INSERT INTO `ilceler` (`ilce_id`, `ilce_adi`) VALUES
(1, 'Karşıyaka'),
(2, 'Konak'),
(3, 'Buca'),
(4, 'Balçova'),
(5, 'Bornova'),
(6, 'Bayraklı');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategori`
--

DROP TABLE IF EXISTS `kategori`;
CREATE TABLE IF NOT EXISTS `kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori_adi` varchar(55) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`kategori_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `kategori_adi`) VALUES
(1, 'Elbise'),
(2, 'Sweatshirt'),
(3, 'T-shirt'),
(4, 'Pantolon'),
(5, 'Gömlek'),
(6, 'Mont'),
(7, 'Eşofman '),
(8, 'Etek'),
(9, 'Tayt'),
(10, 'Şort'),
(11, 'Ceket'),
(12, 'Kazak');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici`
--

DROP TABLE IF EXISTS `kullanici`;
CREATE TABLE IF NOT EXISTS `kullanici` (
  `id` int(11) NOT NULL,
  `kullaniciAdi` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `kullaniciSoyadi` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `eposta` varchar(55) COLLATE utf8_turkish_ci NOT NULL,
  `sifre` int(11) NOT NULL,
  `avatar` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kullanici`
--

INSERT INTO `kullanici` (`id`, `kullaniciAdi`, `kullaniciSoyadi`, `eposta`, `sifre`, `avatar`) VALUES
(1, 'Elif', 'Tasci', 'elifftasci@icloud.com', 1234, 'img/people.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `magaza`
--

DROP TABLE IF EXISTS `magaza`;
CREATE TABLE IF NOT EXISTS `magaza` (
  `magaza_id` int(11) NOT NULL,
  `magaza_adi` varchar(55) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`magaza_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `magaza`
--

INSERT INTO `magaza` (`magaza_id`, `magaza_adi`) VALUES
(1, 'Trend');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `musteriler`
--

DROP TABLE IF EXISTS `musteriler`;
CREATE TABLE IF NOT EXISTS `musteriler` (
  `musteri_id` int(11) NOT NULL,
  `musteri_ad` varchar(55) COLLATE utf8_turkish_ci NOT NULL,
  `musteri_soyad` varchar(55) COLLATE utf8_turkish_ci NOT NULL,
  `cinsiyet_id` int(11) NOT NULL,
  PRIMARY KEY (`musteri_id`),
  KEY `cinsiyet_id` (`cinsiyet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `musteriler`
--

INSERT INTO `musteriler` (`musteri_id`, `musteri_ad`, `musteri_soyad`, `cinsiyet_id`) VALUES
(1, 'Elif ', 'Taşçı', 1),
(2, 'Gökçen', 'Dilber', 1),
(3, 'Pınar', 'Ertürk', 1),
(4, 'Yağmur', 'Alaca', 1),
(5, 'Salih', 'Keleş', 2),
(6, 'Emirhan', 'Enisoğlu', 2),
(7, 'Zafer', 'Özkara', 2),
(8, 'Efe', 'Okur', 2),
(9, 'Berkant', 'Çınar', 2),
(10, 'Hakan', 'Uğurdil', 2),
(11, 'Ayşegül', 'Yavuz', 1),
(12, 'Yasemin ', 'Yazıcı', 1),
(13, 'Kübra', 'Taşçı', 1),
(14, 'Erva', 'Öztoprak', 1),
(15, 'Beyza', 'Taşçı', 1),
(16, 'Zeynep', 'Özçelik', 1),
(17, 'Serra ', 'Öztoprak', 1),
(18, 'Ege', 'Çelik', 2),
(19, 'Sezai', 'Moran', 2),
(20, 'Emre', 'Atalay', 2),
(21, 'Samet', 'Yalınkılıç', 2),
(22, 'Melike', 'Güden', 1),
(23, 'Ceren ', 'Bay', 1),
(24, 'Elif', 'Arslan', 1),
(25, 'Yasemin ', 'Fesliyen', 1),
(26, 'Zehra', 'Gürleş', 1),
(27, 'Büşra', 'Pamukçu', 1),
(28, 'Mustafa', 'Taşçı', 2),
(29, 'Hilal ', 'Külüşlü', 1),
(30, 'Çağla', 'Sunker', 1),
(31, 'Tuğba', 'Sakarya', 2),
(32, 'Nazlı', 'Karslı', 2),
(33, 'Selin', 'Tosun', 1),
(34, 'Cemre', 'Yaylacı', 1),
(35, 'Tuğçe', 'Birsöz', 1),
(36, 'Ayşe', 'Çakıcı', 1),
(37, 'Egesu', 'Arslanyürek', 1),
(38, 'Büşra', 'Doğru', 1),
(39, 'Ahmet', 'Şeker', 2),
(40, 'Serhat', 'Gümüş', 2),
(41, 'Demet', 'Kocadağ', 1),
(42, 'Sude ', 'Gürleş', 1),
(43, 'Hülya', 'Dönmez', 1),
(44, 'İnci', 'Yıldız', 1),
(45, 'Yaren ', 'Akay', 1),
(46, 'Rabia', 'Genç', 1),
(47, 'Zeynep', 'Torlak', 1),
(48, 'Furkan', 'Öz', 2),
(49, 'Hümeyra', 'Yün', 1),
(50, 'Atahan', 'Çakır', 2),
(51, 'Damla', 'Özden', 2),
(52, 'Fatma', 'Doyran', 1),
(53, 'Eren', 'Bilen', 2),
(54, 'Kardelen', 'Kılıç', 1),
(55, 'Kadir', 'Aslıyüksek', 2),
(56, 'Miray', 'Kahya', 1),
(57, 'Ayberk', 'Akkaya', 2),
(58, 'Şimal', 'Erdinç', 1),
(59, 'Seda', 'Sanır', 1),
(60, 'Salih', 'Kulavuz', 2),
(61, 'Hasan', 'Dere', 2),
(62, 'Elif', 'Özdemir', 1),
(63, 'Sinan', 'Harmancı', 2),
(64, 'Eda ', 'Vatansever', 1),
(65, 'Seda', 'Zengin', 1),
(66, 'Yağmur', 'Sökmen', 2),
(67, 'Buse', 'Taşdemir', 1),
(68, 'Berkay', 'Arslan', 2),
(69, 'Mine', 'Tosun', 1),
(70, 'Batuhan', 'Köroğlu', 2),
(71, 'Esra', 'Yalçın', 1),
(72, 'Dilara ', 'Yavuz', 1),
(73, 'Ozan', 'Özgöçer', 2),
(74, 'Özge ', 'Çakar', 1),
(75, 'Berke', 'Çoban', 2),
(76, 'Nurcan', 'Gökçe', 1),
(77, 'Ömer', 'Yüce', 2),
(78, 'Sinem', 'Akın', 1),
(79, 'Burcu', 'Demir', 1),
(80, 'Bahadır', 'Çetin', 2),
(81, 'Cansu', 'Mudara', 1),
(82, 'İsmail', 'Bora', 2),
(83, 'Burak', 'Uçma', 2),
(84, 'Öykü', 'Göçmez', 1),
(85, 'Ali', 'Sabancı', 2),
(86, 'Emin', 'Kılıç', 2),
(87, 'Yasir', 'Kırcıoğlu', 2),
(88, 'Doğan', 'Çevik', 2),
(89, 'Tuğba', 'Külüşlü', 1),
(90, 'Anıl', 'Bahadır', 2),
(91, 'Tuğçe', 'Kaplan', 1),
(92, 'Ahmet', 'Serin', 2),
(93, 'Kemal', 'Saydam', 2),
(94, 'Sude', 'Baykal', 1),
(95, 'Ercüment', 'Çırak', 2),
(96, 'Sena', 'Düzgör', 1),
(97, 'İrem', 'Şentürk', 1),
(98, 'Nisa', 'Karan', 1),
(99, 'Buse', 'Kama', 1),
(100, 'Esra', 'Koçhan', 1),
(101, 'Aslı', 'Demir', 1),
(102, 'İbrahim', 'Kahraman', 2),
(103, 'Gizem', 'Salman', 1),
(104, 'Nilay', 'Arslan', 1),
(105, 'Eren', 'Erçin', 2),
(106, 'Buğra', 'Yaşaroğlu', 2),
(107, 'Zeynep', 'Çetin', 1),
(108, 'Emre', 'Fırat', 2),
(109, 'Fatih', 'Özdemir', 2),
(110, 'Gülşen', 'Çelebei', 1),
(111, 'Fatma', 'Akan', 1),
(112, 'Yunus', 'Seven', 2),
(113, 'Anıl', 'Çetinbaş', 2),
(114, 'Ahmet', 'Yavuz', 2),
(115, 'Gamze', 'Koç', 1),
(116, 'Esra', 'Dağlı', 1),
(117, 'İnci', 'Güngör', 1),
(118, 'Eren', 'Gök', 2),
(119, 'Mert', 'Toprak', 2),
(120, 'Damla', 'Genç', 1),
(121, 'Nur', 'Eski', 1),
(122, 'Nevin ', 'Afacan', 1),
(123, 'Yasin', 'Harman', 2),
(124, 'Didem', 'Ayık', 1),
(125, 'İrem', 'Kartal', 1),
(126, 'Merve', 'Kulavuz', 1),
(127, 'Zeynep', 'Bilen', 1),
(128, 'Sena', 'Özçelik', 1),
(129, 'Selin', 'Aygırcı', 1),
(130, 'Gizem', 'Kızıl', 1),
(131, 'Başak', 'Çakır', 1),
(132, 'Nilgün', 'Ersoy', 1),
(133, 'Elif', 'Akgün', 1),
(134, 'Utku', 'Balcı', 2),
(135, 'Mete', 'Acar', 2),
(136, 'Sercan', 'Elgin', 2),
(137, 'Simay', 'Küçük', 1),
(138, 'Damla', 'Şimşek', 1),
(139, 'Aslı', 'Akyel', 1),
(140, 'Melike', 'Şenyüz', 1),
(141, 'Yiğit', 'Berk', 2),
(142, 'Sude', 'Selvi', 1),
(143, 'İrem', 'Torpi', 1),
(144, 'Ceren ', 'Zengin', 1),
(145, 'Ebrar', 'Altıntaş', 1),
(146, 'Aleyna', 'Genç', 1),
(147, 'Şevval', 'Kocadağ', 1),
(148, 'Tuğba', 'Acar', 1),
(149, 'Berkay', 'Bikbay', 2),
(150, 'Ceylin', 'Teker', 1),
(151, 'Sıla', 'Şahin', 1),
(152, 'Sare', 'Yeşilyurt', 1),
(153, 'Yağız', 'Tek', 2),
(154, 'Ceren ', 'Ünal', 1),
(155, 'Yelda', 'Kara', 1),
(156, 'Mine', 'Çelik', 1),
(157, 'Kaan', 'Karataş', 2),
(158, 'Esra', 'Koç', 1),
(159, 'Gülsüm', 'Uysal', 1),
(160, 'Azra', 'Kösem', 1),
(161, 'Sezin', 'Kınık', 1),
(162, 'İpek', 'Bakış', 1),
(163, 'Şeyda', 'Önalan', 1),
(164, 'Caner', 'Şen', 2),
(165, 'Berna', 'Mercan', 1),
(166, 'Eren', 'Çimen', 2),
(167, 'Selen', 'Yılmaz', 1),
(168, 'Eda', 'Bilici', 1),
(169, 'Betül', 'Güçlü', 1),
(170, 'Burak', 'Avcı', 2),
(171, 'Duru', 'Etkin', 1),
(172, 'Rümeysa', 'Şen', 1),
(173, 'Neslihan', 'Yılmazer', 1),
(174, 'Gülşah', 'Keleş', 1),
(175, 'Mert', 'Tuzcu', 2),
(176, 'Ekrem', 'Kızıl', 2),
(177, 'Berat', 'Tilki', 2),
(178, 'Deniz', 'Alp', 2),
(179, 'Oğuz', 'Kantar', 2),
(180, 'Umut', 'Kınalı', 2),
(181, 'Nihat', 'Can', 2),
(182, 'Doğukan', 'Kılıç', 2),
(183, 'Feyza', 'Karataş', 1),
(184, 'Cem', 'Şahit', 2),
(185, 'Nida', 'Gürer', 1),
(186, 'Mete', 'Güneş', 2),
(187, 'Melisa', 'Sezer', 1),
(188, 'Nisa', 'Soydan', 1),
(189, 'Begüm', 'Başar', 1),
(190, 'Faruk', 'Çark', 2),
(191, 'Aslı', 'Kır', 1),
(192, 'Hilal', 'Arsın', 1),
(193, 'Kaan', 'Mert', 2),
(194, 'Miray', 'Er', 1),
(195, 'Oğuzhan', 'Yıldırım', 2),
(196, 'Erkan', 'Bulut', 2),
(197, 'Derya', 'Yaka', 1),
(198, 'Beril', 'Polat', 1),
(199, 'Ömür', 'Taş', 2),
(200, 'Aytaç', 'Kır', 2),
(201, 'Ali', 'Taşçı', 2);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `satilan`
--

DROP TABLE IF EXISTS `satilan`;
CREATE TABLE IF NOT EXISTS `satilan` (
  `satis_id` int(11) NOT NULL,
  `sube_id` int(11) NOT NULL,
  `urun_id` int(11) NOT NULL,
  `musteri_id` int(11) NOT NULL,
  `adet` int(11) NOT NULL,
  `satilma_tarihi` date NOT NULL,
  PRIMARY KEY (`satis_id`),
  KEY `urun_id` (`urun_id`),
  KEY `musteri_id` (`musteri_id`),
  KEY `sube_id` (`sube_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `satilan`
--

INSERT INTO `satilan` (`satis_id`, `sube_id`, `urun_id`, `musteri_id`, `adet`, `satilma_tarihi`) VALUES
(1, 1, 1, 1, 1, '2020-01-01'),
(2, 1, 1, 2, 1, '2020-01-02'),
(3, 2, 11, 3, 2, '2020-01-03'),
(4, 2, 21, 4, 1, '2020-01-04'),
(5, 3, 31, 5, 1, '2020-01-05'),
(6, 3, 41, 6, 2, '2020-01-08'),
(7, 4, 51, 7, 1, '2020-01-10'),
(8, 4, 61, 8, 1, '2020-01-14'),
(9, 5, 71, 9, 1, '2020-01-17'),
(10, 5, 81, 10, 1, '2020-01-18'),
(11, 6, 91, 11, 1, '2020-01-19'),
(12, 6, 101, 12, 1, '2020-01-20'),
(13, 1, 12, 13, 1, '2020-01-21'),
(14, 1, 22, 14, 1, '2020-01-22'),
(15, 1, 32, 15, 1, '2020-01-23'),
(16, 1, 42, 16, 1, '2020-01-24'),
(17, 3, 52, 17, 2, '2020-01-25'),
(18, 3, 62, 18, 1, '2020-01-26'),
(19, 4, 72, 19, 1, '2020-01-27'),
(20, 4, 82, 20, 1, '2020-01-28'),
(21, 5, 92, 21, 1, '2020-01-29'),
(22, 5, 102, 22, 1, '2020-01-30'),
(23, 2, 13, 23, 1, '2020-02-02'),
(24, 2, 23, 24, 1, '2020-02-04'),
(25, 1, 33, 25, 1, '2020-02-05'),
(26, 1, 43, 26, 1, '2020-02-07'),
(27, 2, 53, 27, 1, '2020-02-10'),
(28, 2, 63, 28, 1, '2020-02-12'),
(29, 6, 73, 29, 1, '2020-02-13'),
(30, 6, 83, 30, 1, '2020-02-15'),
(31, 1, 93, 31, 1, '2020-02-17'),
(32, 1, 103, 32, 1, '2020-02-20'),
(33, 1, 14, 33, 1, '2020-03-01'),
(34, 1, 24, 34, 1, '2020-03-03'),
(35, 2, 34, 35, 1, '2020-03-05'),
(36, 2, 44, 36, 1, '2020-03-07'),
(37, 2, 54, 37, 1, '2020-03-08'),
(38, 2, 64, 38, 1, '2020-03-10'),
(39, 3, 74, 39, 1, '2020-03-12'),
(40, 3, 84, 40, 1, '2020-03-14'),
(41, 3, 94, 41, 1, '2020-03-16'),
(42, 3, 104, 42, 1, '2020-03-20'),
(43, 4, 15, 43, 1, '2020-04-01'),
(44, 4, 25, 44, 1, '2020-04-03'),
(45, 4, 35, 45, 1, '2020-04-06'),
(46, 4, 45, 46, 1, '2020-04-08'),
(47, 5, 55, 47, 1, '2020-04-10'),
(48, 5, 65, 48, 1, '2020-04-13'),
(49, 5, 75, 49, 1, '2020-04-15'),
(50, 5, 85, 50, 2, '2020-04-18'),
(51, 6, 95, 51, 1, '2020-04-23'),
(52, 6, 105, 52, 1, '2020-04-28'),
(53, 6, 16, 53, 1, '2020-05-01'),
(54, 6, 26, 54, 1, '2020-05-03'),
(55, 1, 36, 55, 1, '2020-05-06'),
(56, 1, 46, 56, 1, '2020-05-08'),
(57, 5, 56, 57, 1, '2020-05-14'),
(58, 5, 66, 58, 1, '2020-05-18'),
(59, 2, 76, 59, 1, '2020-05-21'),
(60, 3, 86, 60, 1, '2020-05-23'),
(61, 4, 96, 61, 1, '2020-05-26'),
(62, 5, 106, 62, 1, '2020-05-29'),
(63, 3, 17, 63, 1, '2020-06-03'),
(64, 3, 27, 64, 1, '2020-06-05'),
(65, 3, 37, 65, 1, '2020-06-08'),
(66, 3, 47, 66, 1, '2020-06-11'),
(67, 3, 57, 67, 1, '2020-06-13'),
(68, 4, 67, 68, 1, '2020-06-16'),
(69, 4, 77, 69, 1, '2020-06-18'),
(70, 4, 87, 70, 1, '2020-06-20'),
(71, 4, 97, 71, 1, '2020-06-25'),
(72, 5, 107, 72, 1, '2020-06-27'),
(73, 5, 18, 73, 1, '2020-07-02'),
(74, 5, 28, 74, 1, '2020-07-03'),
(75, 5, 38, 75, 1, '2020-07-06'),
(76, 2, 48, 76, 1, '2020-06-12'),
(77, 2, 58, 77, 1, '2020-06-15'),
(78, 2, 68, 78, 1, '2020-06-18'),
(79, 2, 78, 79, 1, '2020-06-18'),
(80, 1, 88, 80, 1, '2020-06-20'),
(81, 1, 98, 81, 1, '2020-06-25'),
(82, 1, 108, 82, 1, '2020-06-27'),
(83, 1, 19, 83, 1, '2020-07-03'),
(84, 5, 29, 84, 1, '2020-07-10'),
(85, 5, 39, 85, 1, '2020-07-11'),
(86, 5, 49, 86, 1, '2020-07-13'),
(87, 1, 59, 87, 1, '2020-07-16'),
(88, 6, 69, 88, 1, '2020-07-18'),
(89, 6, 79, 89, 1, '2020-07-23'),
(90, 6, 89, 90, 1, '2020-07-30'),
(91, 6, 99, 91, 1, '2020-07-30'),
(92, 1, 109, 92, 1, '2020-07-31'),
(93, 1, 5, 93, 1, '2020-08-03'),
(94, 1, 6, 94, 1, '2020-08-06'),
(95, 1, 7, 95, 1, '2020-08-13'),
(96, 1, 8, 96, 1, '2020-08-15'),
(97, 1, 9, 97, 1, '2020-08-19'),
(98, 2, 10, 98, 1, '2020-08-21'),
(99, 2, 11, 99, 1, '2020-08-24'),
(100, 2, 12, 100, 1, '2020-08-27'),
(101, 2, 10, 10, 1, '2020-09-03'),
(102, 2, 20, 20, 1, '2020-09-05'),
(103, 2, 30, 30, 1, '2020-09-08'),
(104, 2, 40, 40, 1, '2020-09-10'),
(105, 3, 50, 50, 1, '2020-09-12'),
(106, 4, 60, 60, 1, '2020-09-17'),
(107, 5, 70, 70, 1, '2020-09-19'),
(108, 6, 80, 80, 1, '2020-09-25'),
(109, 2, 90, 90, 1, '2020-09-27'),
(110, 1, 100, 100, 1, '2020-09-29'),
(111, 3, 5, 1, 1, '2020-09-21'),
(112, 1, 110, 102, 1, '2020-10-01'),
(113, 2, 111, 105, 1, '2020-10-01'),
(114, 3, 112, 106, 1, '2020-10-02'),
(115, 4, 113, 108, 1, '2020-10-03'),
(116, 5, 114, 109, 1, '2020-10-05'),
(117, 6, 115, 112, 1, '2020-10-07'),
(118, 1, 116, 113, 1, '2020-10-09'),
(119, 5, 117, 114, 1, '2020-10-15'),
(120, 3, 118, 118, 1, '2020-10-17'),
(121, 4, 119, 119, 1, '2020-10-20'),
(122, 5, 120, 39, 1, '2020-10-27'),
(123, 2, 121, 50, 1, '2020-11-02'),
(124, 1, 122, 68, 1, '2020-11-04'),
(125, 5, 123, 106, 1, '2020-11-06'),
(126, 6, 124, 39, 1, '2020-11-08'),
(127, 1, 125, 57, 1, '2020-11-12'),
(128, 2, 126, 70, 1, '2020-11-13'),
(129, 3, 127, 80, 1, '2020-11-15'),
(130, 4, 128, 11, 1, '2020-11-17'),
(131, 5, 86, 101, 1, '2020-11-16'),
(132, 6, 1, 103, 1, '2020-11-18'),
(133, 1, 5, 104, 1, '2020-11-19'),
(134, 6, 10, 107, 1, '2020-11-20'),
(135, 3, 21, 110, 1, '2020-11-21'),
(136, 4, 35, 111, 1, '2020-11-22'),
(137, 5, 40, 115, 1, '2020-11-23'),
(138, 2, 60, 116, 1, '2020-11-24'),
(139, 1, 61, 117, 1, '2020-11-25'),
(140, 5, 70, 120, 1, '2020-11-26'),
(141, 1, 5, 1, 1, '2020-12-01'),
(142, 3, 11, 6, 1, '2020-12-03'),
(143, 1, 11, 121, 1, '2020-10-01'),
(144, 2, 2, 122, 1, '2020-10-02'),
(145, 3, 6, 123, 1, '2020-10-03'),
(146, 1, 10, 124, 1, '2020-10-04'),
(147, 2, 20, 125, 1, '2020-10-05'),
(148, 3, 30, 126, 1, '2020-10-06'),
(149, 4, 40, 127, 1, '2020-10-07'),
(150, 1, 50, 128, 1, '2020-10-08'),
(151, 2, 60, 129, 1, '2020-10-09'),
(152, 3, 70, 130, 1, '2020-10-10'),
(153, 1, 80, 131, 1, '2020-10-11'),
(154, 1, 90, 132, 1, '2020-10-12'),
(155, 2, 100, 133, 1, '2020-10-13'),
(156, 3, 110, 134, 1, '2020-10-14'),
(157, 1, 111, 135, 1, '2020-10-15'),
(158, 1, 112, 136, 1, '2020-10-16'),
(159, 2, 113, 137, 1, '2020-10-17'),
(160, 3, 7, 138, 1, '2020-10-18'),
(161, 1, 8, 139, 1, '2020-10-19'),
(162, 1, 9, 140, 1, '2020-10-20'),
(163, 1, 9, 141, 1, '2020-10-22'),
(164, 2, 10, 142, 1, '2020-10-23'),
(165, 3, 11, 143, 1, '2020-10-24'),
(166, 4, 12, 144, 1, '2020-10-25'),
(167, 5, 13, 145, 1, '2020-10-26'),
(168, 6, 14, 146, 1, '2020-10-27'),
(169, 1, 15, 147, 1, '2020-10-28'),
(170, 2, 21, 148, 1, '2020-10-29'),
(171, 3, 22, 149, 1, '2020-10-30'),
(172, 4, 23, 150, 1, '2020-10-31'),
(173, 5, 25, 151, 1, '2020-11-01'),
(174, 2, 26, 152, 1, '2020-11-02'),
(175, 1, 31, 153, 1, '2020-11-03'),
(176, 5, 32, 154, 1, '2020-11-04'),
(177, 6, 33, 155, 1, '2020-11-05'),
(178, 6, 35, 156, 1, '2020-11-06'),
(179, 6, 41, 157, 1, '2020-11-07'),
(180, 1, 55, 158, 1, '2020-11-08'),
(181, 2, 65, 159, 1, '2020-11-10'),
(182, 3, 75, 160, 1, '2020-11-11'),
(183, 4, 52, 161, 1, '2020-11-12'),
(184, 5, 53, 162, 1, '2020-11-13'),
(185, 5, 63, 163, 1, '2020-11-14'),
(186, 3, 73, 164, 1, '2020-11-15'),
(187, 1, 84, 165, 1, '2020-11-16'),
(188, 2, 86, 166, 1, '2020-11-17'),
(189, 3, 96, 167, 1, '2020-11-18'),
(190, 4, 97, 168, 1, '2020-11-19'),
(191, 5, 98, 169, 1, '2020-11-20'),
(192, 5, 99, 170, 1, '2020-11-21'),
(193, 5, 100, 171, 1, '2020-11-22'),
(194, 2, 101, 172, 1, '2020-11-23'),
(195, 1, 102, 173, 1, '2020-11-24'),
(196, 4, 103, 174, 1, '2020-11-25'),
(197, 1, 51, 175, 1, '2020-11-26'),
(198, 2, 52, 176, 1, '2020-11-27'),
(199, 3, 53, 177, 1, '2020-11-28'),
(200, 5, 54, 178, 1, '2020-11-29'),
(201, 4, 55, 179, 1, '2020-11-30'),
(202, 5, 56, 180, 1, '2020-12-01'),
(203, 1, 2, 181, 1, '2020-12-02'),
(204, 1, 22, 182, 1, '2020-12-03'),
(205, 1, 23, 183, 1, '2020-12-04'),
(206, 6, 64, 184, 1, '2020-12-05'),
(207, 2, 45, 185, 1, '2020-12-06'),
(208, 5, 76, 186, 1, '2020-12-07'),
(209, 3, 66, 187, 1, '2020-12-08'),
(210, 1, 77, 188, 1, '2020-12-09'),
(211, 2, 42, 189, 1, '2020-12-10'),
(212, 1, 43, 190, 1, '2020-12-11'),
(213, 2, 26, 191, 1, '2020-12-12'),
(214, 3, 13, 192, 1, '2020-12-13'),
(215, 5, 14, 193, 1, '2020-12-14'),
(216, 2, 18, 194, 1, '2020-12-15'),
(217, 4, 52, 195, 1, '2020-12-16'),
(218, 3, 41, 196, 1, '2020-12-17'),
(219, 2, 6, 197, 1, '2020-12-18'),
(220, 1, 91, 198, 1, '2020-12-19'),
(221, 2, 84, 199, 1, '2020-12-20'),
(222, 3, 75, 200, 1, '2020-12-21'),
(223, 2, 9, 201, 1, '2020-12-30'),
(224, 3, 59, 80, 1, '2021-01-14'),
(225, 4, 59, 65, 1, '2021-01-15'),
(226, 5, 59, 12, 1, '2021-01-16'),
(227, 6, 59, 24, 1, '2021-01-15'),
(228, 6, 126, 32, 1, '2021-01-16'),
(229, 5, 126, 52, 1, '2021-01-16'),
(230, 3, 3, 2, 1, '2021-01-15'),
(231, 4, 3, 3, 1, '2021-01-16'),
(232, 5, 3, 25, 1, '2021-01-16'),
(233, 6, 3, 54, 1, '2021-01-17'),
(234, 6, 37, 66, 1, '2021-01-17'),
(235, 5, 37, 148, 1, '2021-01-18'),
(236, 1, 5, 20, 1, '2021-02-01'),
(237, 2, 81, 53, 2, '2021-02-01');

--
-- Tetikleyiciler `satilan`
--
DROP TRIGGER IF EXISTS `fatura`;
DELIMITER $$
CREATE TRIGGER `fatura` AFTER INSERT ON `satilan` FOR EACH ROW INSERT INTO fatura
VALUES (new.satis_id, new.adet*(SELECT urunler.fiyat FROM urunler WHERE urunler.urun_id=new.urun_id),now())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `satistan_kaldirilan_urunler_sonrasi_guncel_urun_sayisi`
--

DROP TABLE IF EXISTS `satistan_kaldirilan_urunler_sonrasi_guncel_urun_sayisi`;
CREATE TABLE IF NOT EXISTS `satistan_kaldirilan_urunler_sonrasi_guncel_urun_sayisi` (
  `sayi` int(11) NOT NULL,
  `tarih` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `satistan_kaldirilan_urunler_sonrasi_guncel_urun_sayisi`
--

INSERT INTO `satistan_kaldirilan_urunler_sonrasi_guncel_urun_sayisi` (`sayi`, `tarih`) VALUES
(129, '2021-02-01 20:05:37');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `subeler`
--

DROP TABLE IF EXISTS `subeler`;
CREATE TABLE IF NOT EXISTS `subeler` (
  `sube_adi` varchar(55) COLLATE utf8_turkish_ci NOT NULL,
  `magaza_id` int(11) NOT NULL,
  `sube_id` int(11) NOT NULL,
  `ilce_id` int(11) NOT NULL,
  PRIMARY KEY (`sube_id`),
  KEY `magaza_id` (`magaza_id`),
  KEY `il_id` (`ilce_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `subeler`
--

INSERT INTO `subeler` (`sube_adi`, `magaza_id`, `sube_id`, `ilce_id`) VALUES
('Karşıyaka Şubesi', 1, 1, 1),
('Konak Şubesi', 1, 2, 2),
('Buca Şubesi', 1, 3, 3),
('Balçova Şubesi', 1, 4, 4),
('Bornova Şubesi', 1, 5, 5),
('Bayraklı Şubesi', 1, 6, 6);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunler`
--

DROP TABLE IF EXISTS `urunler`;
CREATE TABLE IF NOT EXISTS `urunler` (
  `urun_id` int(11) NOT NULL,
  `urun_adi` varchar(55) COLLATE utf8_turkish_ci NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `fiyat` int(11) NOT NULL,
  `maliyet` int(11) NOT NULL,
  PRIMARY KEY (`urun_id`),
  KEY `kategori_id` (`kategori_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `urunler`
--

INSERT INTO `urunler` (`urun_id`, `urun_adi`, `kategori_id`, `fiyat`, `maliyet`) VALUES
(1, 'kadın lila peluş sweatshirt', 2, 85, 35),
(2, 'kadın siyah kapüşonlu sweat', 2, 70, 25),
(3, 'kadın beyaz kapüşonlu sweatshirt', 2, 50, 25),
(4, 'kadın pembe basic sweatshirt', 2, 80, 30),
(5, 'kadın mavi kapüşonlu crop sweatshirt', 2, 85, 35),
(6, 'kadın yeşil oversize sweatshirt', 2, 90, 40),
(7, 'kadın turuncu sweatshirt', 2, 70, 25),
(8, 'kadın gri baskılı crop sweatshirt', 2, 50, 15),
(9, 'kadın kahverengi basic örme sweatshirt', 2, 55, 15),
(10, 'kadın kırmızı sweatshirt', 2, 80, 30),
(11, 'kadın siyah bisiklet yaka t-shirt', 3, 20, 5),
(12, 'kadın siyah beyaz çizgili uzun kollu t-shirt', 3, 30, 10),
(13, 'kadın beyaz v yaka t-shirt', 3, 25, 10),
(14, 'kadın haki uzun kollu t-shirt', 3, 30, 10),
(15, 'kadın mor yazı detaylı t-shirt', 3, 35, 10),
(16, 'kadın lila crop t-shirt', 3, 20, 5),
(17, 'kadın kırmızı oversize t-shirt', 3, 30, 10),
(18, 'kadın pembe dik yaka t-shirt', 3, 35, 10),
(19, 'kadın yeşil örme t-shirt', 3, 30, 10),
(20, 'kadın lacivert uzun kollu t-shirt', 3, 35, 10),
(21, 'kadın siyah yanları büzgülü elbise', 1, 55, 20),
(22, 'kadın beyaz güpür elbise', 1, 105, 45),
(23, 'kadın siyah kolları nakışlı elbise', 1, 80, 25),
(24, 'kadın gri triko elbise', 1, 70, 20),
(25, 'kadın yeşil balon kol elbise', 1, 55, 15),
(26, 'kadın çiçek desenli elbise ', 1, 45, 15),
(27, 'kadın mavi balıkçı yaka elbise', 1, 80, 30),
(28, 'kadın kiremit volanlı elbise', 1, 85, 35),
(29, 'kadın bordo kuşaklı elbise', 1, 90, 30),
(30, 'kadın yeşil desenli volanlı elbise', 1, 110, 40),
(31, 'kadın siyah basic pantolon', 4, 90, 30),
(32, 'kadın gri geniş paça pantolon', 4, 80, 25),
(33, 'kadın kazayağı desenli pantolon', 4, 75, 15),
(34, 'kadın lacivert bilek boy pantolon', 4, 50, 10),
(35, 'kadın siyah ekose pantolon', 4, 70, 20),
(36, 'kadın vizon jogger pantolon', 4, 55, 15),
(37, 'kadın beyaz yüksek bel pantolon', 4, 50, 25),
(38, 'kadın kahverengi kemerli pantolon', 4, 90, 30),
(39, 'kadın mavi jean pantolon', 4, 110, 45),
(40, 'kadın bej pantolon', 4, 75, 25),
(41, 'renkli ekose gömlek', 5, 85, 35),
(42, 'beyaz boyfriend gömlek', 5, 60, 20),
(43, 'siyah oduncu gömlek', 5, 85, 35),
(44, 'mavi denim gömlek', 5, 80, 30),
(45, 'kırmızı çizgili gömlek', 5, 75, 25),
(46, 'kadın lila desenli gömlek', 5, 95, 45),
(47, 'kadın turuncu puantiyeli gömlek', 5, 75, 35),
(48, 'kadın kiremit kadife gömlek', 5, 85, 45),
(49, 'kırmızı cep detaylı gömlek', 5, 75, 35),
(50, 'kadın mint kazayağı gömlek', 5, 70, 20),
(51, 'kadın siyah şişme mont', 6, 190, 60),
(52, 'kadın lila peluş mont', 6, 100, 40),
(53, 'kadın bej kapüşonlu mont', 6, 220, 100),
(54, 'kadın haki parlak şişme mont', 6, 200, 90),
(55, 'kadın gri kapüşonlu şişme mont', 6, 250, 120),
(56, 'kadın vizon kemerli şişme mont', 6, 210, 100),
(57, 'kadın kahverengi oversize şişme mont', 6, 170, 60),
(58, 'kadın ekru desenli peluş mont', 6, 180, 70),
(59, 'kadın kürklü pembe mont', 6, 200, 120),
(60, 'kadın beyaz kısa şişme mont', 6, 150, 60),
(61, 'kadın siyah jogger eşofman', 7, 50, 20),
(62, 'kadın gri basic örme eşofman', 7, 60, 20),
(63, 'kadın lacivert basic jogger eşofman', 7, 65, 25),
(64, 'kadın mavi kadife eşofman ', 7, 70, 30),
(65, 'kadın bol kesim eşofman', 7, 65, 25),
(66, 'kadın taş paçası lastikli eşofman', 7, 80, 30),
(67, 'kadın ekru eşofman', 7, 60, 20),
(68, 'kadın lila cep detaylı eşofman', 7, 75, 25),
(69, 'baskılı eşofman', 7, 55, 15),
(70, 'kadın mürdüm basic örme eşofman ', 7, 60, 20),
(71, 'mor kazayağı etek', 8, 60, 20),
(72, 'siyah pileli kısa etek', 8, 70, 30),
(73, 'kahverengi asimetrik etek', 8, 65, 25),
(74, 'bordo kalem etek', 8, 100, 40),
(75, 'pembe desenli etek', 8, 55, 25),
(76, 'siyah deri etek', 8, 120, 50),
(77, 'mor kemer detaylı etek', 8, 70, 30),
(78, 'yeşil kareli etek', 8, 65, 25),
(79, 'lacivert düğmeli etek', 8, 75, 35),
(80, 'kiremit puantiyeli etek', 8, 70, 30),
(81, 'siyah yüksek bel tayt', 9, 50, 20),
(82, 'lacivert yüksek bel tayt', 9, 50, 20),
(83, 'kadın mor tayt', 9, 45, 15),
(84, 'kadın siyah parlak tayt', 9, 60, 20),
(85, 'kadın gri basic tayt', 9, 55, 15),
(86, 'kadın antrasit şort', 10, 60, 20),
(87, 'kadın gri bermuda şort', 10, 65, 25),
(88, 'kahverengi cepli şort', 10, 50, 20),
(89, 'kadın mavi jean şort', 10, 80, 30),
(90, 'kadın lila çizgili şort', 10, 75, 25),
(91, 'kadın siyah polar ceket', 11, 100, 40),
(92, 'gri kareli ceket', 11, 90, 35),
(93, 'kadın deri görünümlü ceket', 11, 160, 70),
(94, 'kadın kahverengi blazer ceket', 11, 110, 55),
(95, 'kadın mavi kot ceket', 11, 120, 60),
(96, 'kadın siyah kot ceket', 11, 85, 25),
(97, 'kadın yeşil bağlama detaylı ceket', 11, 90, 30),
(98, 'kadın ekru oversize denim ceket', 11, 110, 55),
(99, 'kadın beyaz tüylü ceket', 11, 200, 90),
(100, 'kadın bordo ekose ceket', 11, 120, 50),
(101, 'kadın ekru kısa kazak', 12, 65, 25),
(102, 'kadın lila triko kazak', 12, 80, 30),
(103, 'kadın mavi triko kazak', 12, 80, 30),
(104, 'kadın mint düğme detaylı kazak', 12, 85, 35),
(105, 'kadın lacivert balon kol kazak', 12, 85, 35),
(106, 'kadın siyah fermuarlı triko kazak', 12, 85, 35),
(107, 'kadın turuncu kazak', 12, 70, 25),
(108, 'kadın mavi volanlı triko kazak', 12, 70, 25),
(109, 'kadın yeşil  nakışlı kazak', 12, 90, 40),
(110, 'kadın balıkçı yaka triko kazak', 12, 55, 20),
(111, 'Erkek siyah t-shirt', 3, 45, 15),
(112, 'Erkek beyaz t-shirt', 3, 45, 15),
(113, 'Erkek yeşil bisiklet yaka sweatshirt', 2, 70, 20),
(114, 'Erkek siyah cep detaylı sweatshirt', 2, 100, 40),
(115, 'Erkek ekru nakışlı sweatshirt', 2, 90, 30),
(116, 'Erkek lacivert kapüşonlu sweatshirt', 2, 85, 25),
(117, 'Erkek gri sweatshirt', 2, 70, 20),
(118, 'Erkek haki oduncu gömlek', 5, 75, 25),
(119, 'Erkek mavi ekoseli gömlek', 5, 105, 45),
(120, 'Erkek bej cepli gömlek', 5, 85, 35),
(121, 'Erkek siyah basic eşofman', 7, 65, 25),
(122, 'Erkek siyah slim fit pantolon', 4, 100, 40),
(123, 'Erkek mavi jean pantolon', 4, 120, 60),
(124, 'Erkek gri keten pantolon', 4, 150, 70),
(125, 'Erkek deri ceket', 11, 350, 150),
(126, 'Erkek lacivert fermuarlı ceket', 11, 180, 110),
(127, 'Erkek siyah bomber ceket', 11, 170, 60),
(128, 'Erkek beyaz gömlek', 5, 100, 40),
(129, 'Erkek lacivert polo yaka t-shirt', 3, 120, 50);

--
-- Tetikleyiciler `urunler`
--
DROP TRIGGER IF EXISTS `eski_fiyat`;
DELIMITER $$
CREATE TRIGGER `eski_fiyat` BEFORE UPDATE ON `urunler` FOR EACH ROW INSERT INTO eski_fiyat VALUES(old.urun_adi, old.fiyat, now())
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `satistan_kaldirilan_urunler_sonrasi_guncel_urun_sayisi`;
DELIMITER $$
CREATE TRIGGER `satistan_kaldirilan_urunler_sonrasi_guncel_urun_sayisi` AFTER DELETE ON `urunler` FOR EACH ROW INSERT INTO satistan_kaldirilan_urunler_sonrasi_guncel_urun_sayisi
VALUES((SELECT COUNT(*) FROM urunler),now())
$$
DELIMITER ;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `musteriler`
--
ALTER TABLE `musteriler`
  ADD CONSTRAINT `musteriler_ibfk_1` FOREIGN KEY (`cinsiyet_id`) REFERENCES `cinsiyet` (`cinsiyet_id`);

--
-- Tablo kısıtlamaları `satilan`
--
ALTER TABLE `satilan`
  ADD CONSTRAINT `fk_sube_id` FOREIGN KEY (`sube_id`) REFERENCES `subeler` (`sube_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `satilan_ibfk_1` FOREIGN KEY (`urun_id`) REFERENCES `urunler` (`urun_id`),
  ADD CONSTRAINT `satilan_ibfk_2` FOREIGN KEY (`musteri_id`) REFERENCES `musteriler` (`musteri_id`);

--
-- Tablo kısıtlamaları `subeler`
--
ALTER TABLE `subeler`
  ADD CONSTRAINT `subeler_ibfk_1` FOREIGN KEY (`magaza_id`) REFERENCES `magaza` (`magaza_id`),
  ADD CONSTRAINT `subeler_ibfk_2` FOREIGN KEY (`ilce_id`) REFERENCES `ilceler` (`ilce_id`);

--
-- Tablo kısıtlamaları `urunler`
--
ALTER TABLE `urunler`
  ADD CONSTRAINT `urunler_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`kategori_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
