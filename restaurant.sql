-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 29 Ara 2023, 19:02:47
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `restaurant`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `id` int(11) NOT NULL,
  `kullanici_adi` text NOT NULL,
  `sifre` text NOT NULL,
  `tur` text NOT NULL,
  `cuzdan` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `kullanici_adi`, `sifre`, `tur`, `cuzdan`) VALUES
(1, 'floscy', '123', 'admin', 0),
(2, 'floscy2', '123', 'yonetici', 3420),
(3, 'floscy3', '123', 'musteri', 9994988);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `menuler`
--

CREATE TABLE `menuler` (
  `menu_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `isim` text NOT NULL,
  `foto` text NOT NULL,
  `fiyat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `menuler`
--

INSERT INTO `menuler` (`menu_id`, `restaurant_id`, `isim`, `foto`, `fiyat`) VALUES
(13, 13, 'iskender ', './files/77a74589fe6322df57702ad4efe2b6211683794782230_1125x522.png', 200),
(14, 13, 'Coca Cola', './files/c70df18c6a5be65a9715f81d8cb5091510803121.jpg', 20),
(15, 17, 'Baklava', './files/8a5da6b83be1d8710928e3c7e272197e1639346986159_500x375.jpeg', 250);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `restaurant`
--

CREATE TABLE `restaurant` (
  `restaurant_id` int(11) NOT NULL,
  `isim` text NOT NULL,
  `iletisim` text NOT NULL,
  `adres` text NOT NULL,
  `sahip` int(11) NOT NULL,
  `foto` text DEFAULT NULL,
  `cocuk_parki` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `restaurant`
--

INSERT INTO `restaurant` (`restaurant_id`, `isim`, `iletisim`, `adres`, `sahip`, `foto`, `cocuk_parki`) VALUES
(13, 'İskender ', 'iskender@gmail.com', 'Bandırma Liman AVM', 2, './files/1ac3f014cae35ed9c57e56ac9d9b98421683794782230_1125x522.png', b'0'),
(14, 'İskender 2', 'iskender@gmail.com', 'Bandırma Liman AVM', 2, './files/314c46848e49535ccee4286b96a3e9431683794782230_1125x522.png', b'1'),
(15, 'Pizza', 'pasaportpizza@gmail.com', 'Bandırma Bahçelievler', 2, './files/f78ba8acc98974598f3680c866600988Screenshot_33.png', b'0'),
(16, 'Pizza 2', 'pasaportpizza@gmail.com', 'Bandırma Bahçelievler', 2, './files/d76b044ad5ed1231d177b4e89c5418b1Screenshot_33.png', b'1'),
(17, 'Tatlı', 'tatlı@gmail.com', 'Çarşı', 2, './files/b771e64cd3494eb6715b66bb97d462ca1639346986159_500x375.jpeg', b'0');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparisler`
--

CREATE TABLE `siparisler` (
  `siparis_id` int(11) NOT NULL,
  `menuler` text NOT NULL,
  `tutar` int(11) NOT NULL,
  `zaman` datetime NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorumlar`
--

CREATE TABLE `yorumlar` (
  `restaurant_id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `yorum` text DEFAULT NULL,
  `puan` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kullanici_adi` (`kullanici_adi`) USING HASH;

--
-- Tablo için indeksler `menuler`
--
ALTER TABLE `menuler`
  ADD PRIMARY KEY (`menu_id`),
  ADD KEY `menuler_ibfk_1` (`restaurant_id`);

--
-- Tablo için indeksler `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`restaurant_id`),
  ADD KEY `fk_sahip` (`sahip`);

--
-- Tablo için indeksler `siparisler`
--
ALTER TABLE `siparisler`
  ADD PRIMARY KEY (`siparis_id`),
  ADD KEY `siparisler_ibfk_1` (`kullanici_id`),
  ADD KEY `siparisler_ibfk_2` (`restaurant_id`);

--
-- Tablo için indeksler `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD PRIMARY KEY (`restaurant_id`,`kullanici_id`),
  ADD UNIQUE KEY `unique_comment` (`restaurant_id`,`kullanici_id`),
  ADD KEY `kullanici_id` (`kullanici_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `menuler`
--
ALTER TABLE `menuler`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Tablo için AUTO_INCREMENT değeri `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `restaurant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Tablo için AUTO_INCREMENT değeri `siparisler`
--
ALTER TABLE `siparisler`
  MODIFY `siparis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `menuler`
--
ALTER TABLE `menuler`
  ADD CONSTRAINT `menuler_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`restaurant_id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `restaurant`
--
ALTER TABLE `restaurant`
  ADD CONSTRAINT `fk_sahip` FOREIGN KEY (`sahip`) REFERENCES `kullanicilar` (`id`);

--
-- Tablo kısıtlamaları `siparisler`
--
ALTER TABLE `siparisler`
  ADD CONSTRAINT `siparisler_ibfk_1` FOREIGN KEY (`kullanici_id`) REFERENCES `kullanicilar` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `siparisler_ibfk_2` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`restaurant_id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD CONSTRAINT `yorumlar_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`restaurant_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `yorumlar_ibfk_2` FOREIGN KEY (`kullanici_id`) REFERENCES `kullanicilar` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
