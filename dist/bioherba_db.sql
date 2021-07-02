-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Jul 2021 pada 10.57
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bioherba_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cash_flow`
--

CREATE TABLE `cash_flow` (
  `ID_Cash` int(11) NOT NULL,
  `Cash_Type` enum('in','out') NOT NULL,
  `subject` varchar(30) NOT NULL,
  `Cash_Date` datetime NOT NULL DEFAULT current_timestamp(),
  `EmployeeID` int(10) UNSIGNED NOT NULL,
  `Nominal` double NOT NULL DEFAULT 0,
  `Keterangan` varchar(1000) NOT NULL,
  `Bukti` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `CategoryID` tinyint(5) UNSIGNED NOT NULL,
  `CategoryName` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Description` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `CustomerID` int(11) NOT NULL,
  `Name` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `No_HP` varchar(20) DEFAULT NULL,
  `Address` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `Dukuh` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `RTRW` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `KelID` int(11) NOT NULL,
  `Gender` enum('P','L') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'L',
  `Tgl_Lahir` date DEFAULT NULL,
  `InfoMarket` varchar(30) DEFAULT NULL,
  `InfoProgRadio` varchar(40) DEFAULT NULL,
  `Keterangan` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `Status_Anggota` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftarkecamatan`
--

CREATE TABLE `daftarkecamatan` (
  `KecID` int(11) NOT NULL,
  `Kecamatan` varchar(20) NOT NULL,
  `KotaID` int(11) NOT NULL,
  `Latitude` double DEFAULT 0,
  `Longitude` double DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftarkota`
--

CREATE TABLE `daftarkota` (
  `KotaID` int(11) NOT NULL,
  `Kota` varchar(20) NOT NULL,
  `PropinsiID` int(11) NOT NULL,
  `Latitude` double DEFAULT 0,
  `Longitude` double DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftarpropinsi`
--

CREATE TABLE `daftarpropinsi` (
  `PropinsiID` int(11) NOT NULL,
  `Propinsi` varchar(20) DEFAULT NULL,
  `Latitude` double DEFAULT 0,
  `Longitude` double DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_kelurahan`
--

CREATE TABLE `daftar_kelurahan` (
  `KelID` int(11) NOT NULL,
  `Kelurahan` varchar(20) NOT NULL,
  `KecID` int(11) NOT NULL,
  `Latitude` double DEFAULT 0,
  `Longitude` double DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_perkiraan`
--

CREATE TABLE `data_perkiraan` (
  `No_Perkiraan` varchar(13) NOT NULL,
  `Nama_Perkiraan` varchar(36) DEFAULT NULL,
  `Debet_Perkiraan` decimal(20,0) DEFAULT NULL,
  `Kredit_Perkiraan` decimal(20,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detailsakit`
--

CREATE TABLE `detailsakit` (
  `ID` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `Sakit` varchar(30) CHARACTER SET latin1 DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `distribusi_products`
--

CREATE TABLE `distribusi_products` (
  `DistribusiID` int(11) NOT NULL,
  `Dist_Date` datetime DEFAULT NULL,
  `ProductID` varchar(20) DEFAULT NULL,
  `Qty` int(11) DEFAULT NULL,
  `Cost_Delivery` double NOT NULL DEFAULT 0,
  `From_Emp` int(10) UNSIGNED DEFAULT NULL,
  `To_Emp` int(10) UNSIGNED DEFAULT NULL,
  `Receive_Date` datetime DEFAULT NULL,
  `Status` enum('Received','Return','OTW','ReturnAccepted','Requesting','Request','Declain','CancelRequest','CancelDelivery','Ordering','Received Order','Decline') CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `employees`
--

CREATE TABLE `employees` (
  `EmployeeID` int(10) UNSIGNED NOT NULL,
  `Username` varchar(255) NOT NULL,
  `LastName` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FirstName` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Title` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Level` int(1) DEFAULT NULL,
  `TitleOfCourtesy` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `BirthDate` date DEFAULT NULL,
  `HireDate` date DEFAULT NULL,
  `Address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `City` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `Region` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `PostalCode` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `Country` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `Phone` varchar(24) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `Nationality` varchar(30) NOT NULL,
  `Photo` longblob DEFAULT NULL,
  `Notes` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ReportsTo` int(10) UNSIGNED DEFAULT NULL,
  `EmployeePassword` char(41) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  `login` varchar(2) NOT NULL,
  `LoginDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Trigger `employees`
--
DELIMITER $$
CREATE TRIGGER `Employee_Del_Data_Perkiraan` BEFORE DELETE ON `employees` FOR EACH ROW DELETE FROM data_perkiraan where data_perkiraan.No_Perkiraan like CONCAT('%',old.EmployeeID)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Employee_Insert_Data_Perkiraan` AFTER INSERT ON `employees` FOR EACH ROW INSERT INTO data_perkiraan 
	(data_perkiraan.No_Perkiraan,data_perkiraan.Nama_Perkiraan,data_perkiraan.Debet_Perkiraan,data_perkiraan.Kredit_Perkiraan) 
	VALUES(CONCAT("1050.", new.EmployeeID) ,CONCAT("PERSEDIAAN BARANG " , new.FirstName , " " , new.LastName),0,0),
	(CONCAT("5001." , new.EmployeeID) ,CONCAT("HARGA POKOK PENJUALAN " , new.FirstName , " " , new.LastName) ,0,0),
	(CONCAT("1000." , new.EmployeeID) ,CONCAT("KAS " , new.FirstName , " " , new.LastName) ,0,0),
	(CONCAT("4001." , new.EmployeeID) ,CONCAT("PENDAPATAN USAHA " , new.FirstName , " " , new.LastName) ,0,0),
	(CONCAT("1030." , new.EmployeeID) ,CONCAT("PIUTANG " , new.FirstName , " " , new.LastName) ,0,0),
	(CONCAT("2001." , new.EmployeeID) ,CONCAT("HUTANG USAHA " , new.FirstName , " " , new.LastName) ,0,0),
	(CONCAT("3002." , new.EmployeeID) ,CONCAT("SHU TAHUN LALU " , new.FirstName , " " , new.LastName) ,0,0),
	(CONCAT("3003." , new.EmployeeID) ,CONCAT("SHU BERJALAN " , new.FirstName , " " , new.LastName) ,0,0),
	(CONCAT("1401." , new.EmployeeID) ,CONCAT("HARGA PEROLEHAN " , new.FirstName , " " , new.LastName) ,0,0),
	(CONCAT("6001.01." , new.EmployeeID) ,CONCAT("BIAYA GAJI " , new.FirstName , " " , new.LastName) ,0,0),
    (CONCAT("4001.01." , new.EmployeeID) ,CONCAT("POTONGAN PENJUALAN - DISKON " , new.FirstName , " " , new.LastName) ,0,0),
    (CONCAT("4001.02." , new.EmployeeID) ,CONCAT("POTONGAN PENJUALAN - BIAYA PENGIRIMAN " , new.FirstName , " " , new.LastName) ,0,0),
    (CONCAT("3014." , new.EmployeeID) ,CONCAT("SHU BELUM DISETOR " , new.FirstName , " " , new.LastName) ,0,0),
    (CONCAT("6001.02." , new.EmployeeID) ,CONCAT("BY UMUM DAN ADMINISTRASI " , new.FirstName , " " , new.LastName) ,0,0),
    (CONCAT("6001.03." , new.EmployeeID) ,CONCAT("BY  HADIAH LEBARAN " , new.FirstName , " " , new.LastName) ,0,0),
    (CONCAT("6001.04." , new.EmployeeID) ,CONCAT("BIAYA KERUGIAN PIUTANG " , new.FirstName , " " , new.LastName) ,0,0),
    (CONCAT("6001.05." , new.EmployeeID) ,CONCAT("BIAYA PENGIRIMAN " , new.FirstName , " " , new.LastName) ,0,0),
    (CONCAT("5001.01." , new.EmployeeID) ,CONCAT("PEMBELIAN BARANG DAGANG " , new.FirstName , " " , new.LastName) ,0,0),
    (CONCAT("5001.06." , new.EmployeeID) ,CONCAT("PENAMBAHAN BARANG DAGANG " , new.FirstName , " " , new.LastName) ,0,0),
    (CONCAT("3001." , new.EmployeeID) ,CONCAT("MODAL KANTOR PUSAT " , new.FirstName , " " , new.LastName) ,0,0)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_jurnal`
--

CREATE TABLE `jenis_jurnal` (
  `Jenis_Jurnal` varchar(2) NOT NULL,
  `Nama_Jenis_Jurnal` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurnal`
--

CREATE TABLE `jurnal` (
  `Tanggal_Jurnal` datetime NOT NULL,
  `Jenis_Jurnal` varchar(2) NOT NULL,
  `No_Bukti` varchar(40) NOT NULL,
  `No_Perkiraan` varchar(13) NOT NULL,
  `Debet_Jurnal` double NOT NULL,
  `Kredit_Jurnal` double NOT NULL,
  `Keterangan_Jurnal` varchar(100) DEFAULT NULL,
  `No_Urut` int(11) DEFAULT NULL,
  `Tgl_Input` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `konsinasi`
--

CREATE TABLE `konsinasi` (
  `Konsinasi_ID` int(11) NOT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `EmployeeID` int(11) UNSIGNED DEFAULT NULL,
  `KonsinasiDate` datetime DEFAULT NULL,
  `SubDasarTotal` double NOT NULL DEFAULT 0,
  `SubTotal` double DEFAULT 0,
  `Discount` double NOT NULL DEFAULT 0,
  `Biaya_Pengiriman` double NOT NULL DEFAULT 0,
  `Tunai` double DEFAULT 0,
  `NominalDasarReturn` double NOT NULL DEFAULT 0,
  `NominalReturn` double DEFAULT 0,
  `ReturnDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `konsinasi_details`
--

CREATE TABLE `konsinasi_details` (
  `Konsinasi_Detail_ID` int(11) NOT NULL,
  `Konsinasi_ID` int(11) DEFAULT NULL,
  `Product_ID` varchar(20) DEFAULT NULL,
  `EmployeeID` int(10) UNSIGNED DEFAULT NULL,
  `Konsinasi_Qty` double DEFAULT 0,
  `UnitPrice` double DEFAULT 0,
  `Price_sales` double DEFAULT 0,
  `Discount` double NOT NULL DEFAULT 0,
  `Return_Qty` double DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `OrderID` varchar(20) NOT NULL,
  `EmployeeID` int(10) UNSIGNED NOT NULL,
  `OrderDate` datetime NOT NULL DEFAULT current_timestamp(),
  `ReceiveDate` datetime DEFAULT NULL,
  `SubTotal` double DEFAULT 0,
  `DiskonTransaksi` double DEFAULT 0,
  `GrandTotalOrder` double DEFAULT 0,
  `Cost_Delivery` double DEFAULT NULL,
  `Tunai` double DEFAULT 0,
  `No_Nota` varchar(20) DEFAULT NULL,
  `Status_Order` enum('Request','Ordering','Order','Received') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Trigger `orders`
--
DELIMITER $$
CREATE TRIGGER `Order_Jurnal` AFTER INSERT ON `orders` FOR EACH ROW INSERT INTO jurnal (Tanggal_Jurnal,Jenis_Jurnal,No_Bukti,No_Perkiraan,Debet_Jurnal,Kredit_Jurnal, Keterangan_Jurnal,No_Urut) VALUES
(new.OrderDate,'FB',new.OrderID,CONCAT('1000.',new.EmployeeID),0,new.Tunai,CONCAT('Orders Number - ',new.OrderID),1),
(new.OrderDate,'FB',new.OrderID,CONCAT('1401.',new.EmployeeID),new.Tunai,0,CONCAT('Orders Number - ',new.OrderID),2)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_details`
--

CREATE TABLE `order_details` (
  `DetailID` int(10) UNSIGNED NOT NULL,
  `OrderID` varchar(20) NOT NULL,
  `DistribusiID` int(11) NOT NULL,
  `ProductID` varchar(20) NOT NULL,
  `EmployeeID` int(10) UNSIGNED NOT NULL,
  `OrderPrice` double UNSIGNED DEFAULT 0,
  `Quantity` double NOT NULL DEFAULT 0,
  `Discount` double NOT NULL DEFAULT 0,
  `Cost_Delivery` double NOT NULL DEFAULT 0,
  `Status_Order` enum('Request','Ordering','Order','Received') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `ProductID` varchar(20) NOT NULL,
  `ProductName` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `RemarkProduct` varchar(2000) DEFAULT '',
  `SupplierID` int(10) UNSIGNED DEFAULT NULL,
  `CategoryID` tinyint(5) UNSIGNED NOT NULL,
  `QuantityPerUnit` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `SalePrice` double NOT NULL DEFAULT 0,
  `UnitPrice` double NOT NULL DEFAULT 0,
  `Discon` double DEFAULT 0,
  `UnitsInStock` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `MinStock` int(5) DEFAULT 0,
  `ReorderLevel` int(5) UNSIGNED NOT NULL DEFAULT 0,
  `ExpiredDate` date DEFAULT '1999-01-01',
  `Discontinued` enum('y','n') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  `SatuanTerkecil` enum('y','n') NOT NULL DEFAULT 'n',
  `Picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sales`
--

CREATE TABLE `sales` (
  `SalesID` datetime NOT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `EmployeeID` int(10) UNSIGNED DEFAULT NULL,
  `SaleDate` datetime NOT NULL,
  `SubDasarTotal` double NOT NULL DEFAULT 0,
  `SubTotal` double DEFAULT 0,
  `DiskonTransaksi` double DEFAULT 0,
  `GrandTotalSale` double DEFAULT 0,
  `Tunai` double DEFAULT 0,
  `Biaya_Pengiriman` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Trigger `sales`
--
DELIMITER $$
CREATE TRIGGER `Sales_Penjurnalan` AFTER INSERT ON `sales` FOR EACH ROW INSERT INTO jurnal (Tanggal_Jurnal,Jenis_Jurnal,No_Bukti,No_Perkiraan,Debet_Jurnal,Kredit_Jurnal, Keterangan_Jurnal,No_Urut) VALUES
(new.SalesID,'FJ',CONCAT(new.SalesID,'-',new.EmployeeID,'-',new.CustomerID),CONCAT('1000.',new.EmployeeID),new.Tunai,0,CONCAT('Sales by - ',new.EmployeeID),1),
(new.SalesID,'FJ',CONCAT(new.SalesID,'-',new.EmployeeID,'-',new.CustomerID),CONCAT('4001.01.',new.EmployeeID),new.DiskonTransaksi,0,CONCAT('Sales by - ',new.EmployeeID),2),
(new.SalesID,'FJ',CONCAT(new.SalesID,'-',new.EmployeeID,'-',new.CustomerID),CONCAT('4001.02.',new.EmployeeID),0,new.Biaya_Pengiriman,CONCAT('Sales by - ',new.EmployeeID),3),
(new.SalesID,'FJ',CONCAT(new.SalesID,'-',new.EmployeeID,'-',new.CustomerID),CONCAT('4001.',new.EmployeeID),0,new.SubTotal,CONCAT('Sales by - ',new.EmployeeID),4),
(new.SalesID,'FJ',CONCAT(new.SalesID,'-',new.EmployeeID,'-',new.CustomerID),CONCAT('5001.',new.EmployeeID),new.SubDasarTotal,0,CONCAT('Sales by - ',new.EmployeeID),5),
(new.SalesID,'FJ',CONCAT(new.SalesID,'-',new.EmployeeID,'-',new.CustomerID),CONCAT('1050.',new.EmployeeID),0,new.SubDasarTotal,CONCAT('Sales by - ',new.EmployeeID),6)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sales_details`
--

CREATE TABLE `sales_details` (
  `ID` int(10) UNSIGNED NOT NULL,
  `SalesID` datetime NOT NULL,
  `ProductID` varchar(20) NOT NULL,
  `EmployeeID` int(10) UNSIGNED NOT NULL,
  `UnitPrice` double UNSIGNED NOT NULL DEFAULT 0,
  `OrderPrice` double NOT NULL DEFAULT 0,
  `Quantity` double UNSIGNED NOT NULL DEFAULT 1,
  `Discount` double UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Trigger `sales_details`
--
DELIMITER $$
CREATE TRIGGER `Sales_detail_Insert_Pengurangan_Stock` AFTER INSERT ON `sales_details` FOR EACH ROW UPDATE products, stckproductonemployee set 
products.UnitsInStock=products.UnitsInStock-new.Quantity, 
stckproductonemployee.UnitsInStock=stckproductonemployee.UnitsInStock-new.Quantity 
WHERE (products.ProductID=new.ProductID) 
AND (stckproductonemployee.ProductID=new.ProductID AND stckproductonemployee.EmployeeID=new.EmployeeID)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `sales_detail_Del_Penambahan_Stock` BEFORE DELETE ON `sales_details` FOR EACH ROW UPDATE products, stckproductonemployee set 
products.UnitsInStock=products.UnitsInStock+old.Quantity, 
stckproductonemployee.UnitsInStock=stckproductonemployee.UnitsInStock+old.Quantity 
WHERE (products.ProductID=old.ProductID) 
AND (stckproductonemployee.ProductID=old.ProductID AND stckproductonemployee.EmployeeID=old.EmployeeID)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `setoran`
--

CREATE TABLE `setoran` (
  `ID_Setor` int(11) NOT NULL,
  `Periode` varchar(15) NOT NULL,
  `Setor_Date` datetime NOT NULL DEFAULT current_timestamp(),
  `FromEmployeeID` int(10) UNSIGNED NOT NULL,
  `ToEmployeeID` int(10) UNSIGNED NOT NULL,
  `Nominal` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `stckawalproductonemployee`
--

CREATE TABLE `stckawalproductonemployee` (
  `ProductID` varchar(20) NOT NULL,
  `EmployeeID` int(10) UNSIGNED NOT NULL,
  `SalePrice` double DEFAULT NULL,
  `UnitPrice` double NOT NULL,
  `UnitsInStock` int(10) DEFAULT NULL,
  `Discon` double DEFAULT 0,
  `InputDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Trigger `stckawalproductonemployee`
--
DELIMITER $$
CREATE TRIGGER `StockAwalEmployee_Insert_Jurnal` AFTER INSERT ON `stckawalproductonemployee` FOR EACH ROW INSERT INTO jurnal (Tanggal_Jurnal,Jenis_Jurnal,No_Bukti,No_Perkiraan,Debet_Jurnal,Kredit_Jurnal, Keterangan_Jurnal,No_Urut) VALUES
(now(),'BU',CONCAT(new.EmployeeID,'-',new.ProductID),CONCAT('1050.',new.EmployeeID),new.UnitPrice*new.UnitsInStock,0,
 CONCAT('First Stock of - ',new.EmployeeID,'-',new.ProductID),1),
 (now(),'BU',CONCAT(new.EmployeeID,'-',new.ProductID),CONCAT('1401.',new.EmployeeID),0,new.UnitPrice*new.UnitsInStock,
 CONCAT('First Stock of - ',new.EmployeeID,'-',new.ProductID),2),
 (now(),'BU',CONCAT(new.EmployeeID,'-',new.ProductID),CONCAT('5001.',new.EmployeeID),0,new.UnitPrice*new.UnitsInStock,
 CONCAT('First Stock of - ',new.EmployeeID,'-',new.ProductID),3),
 (now(),'BU',CONCAT(new.EmployeeID,'-',new.ProductID),CONCAT('5001.06.',new.EmployeeID),new.UnitPrice*new.UnitsInStock,0,
 CONCAT('First Stock of - ',new.EmployeeID,'-',new.ProductID),4)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `stockAwalEmployee_Del_Pengurangan_Stock` BEFORE DELETE ON `stckawalproductonemployee` FOR EACH ROW UPDATE products set 
products.UnitsInStock=products.UnitsInStock-old.UnitsInStock 
WHERE products.ProductID=old.ProductID
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `stckproductonemployee`
--

CREATE TABLE `stckproductonemployee` (
  `ProductID` varchar(20) NOT NULL,
  `EmployeeID` int(10) UNSIGNED NOT NULL,
  `SalePrice` double DEFAULT NULL,
  `UnitPrice` double NOT NULL,
  `UnitsInStock` int(10) DEFAULT NULL,
  `Discon` double DEFAULT NULL,
  `Discontinued` enum('y','n') NOT NULL DEFAULT 'n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Trigger `stckproductonemployee`
--
DELIMITER $$
CREATE TRIGGER `stockAwalEmployee_Insert_Penambahan_Stock` AFTER INSERT ON `stckproductonemployee` FOR EACH ROW UPDATE products set 
products.UnitsInStock=products.UnitsInStock+new.UnitsInStock 
WHERE products.ProductID=new.ProductID
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `suppliers`
--

CREATE TABLE `suppliers` (
  `SupplierID` int(10) UNSIGNED NOT NULL,
  `CompanyName` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `ContactName` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `ContactTitle` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `Address` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `City` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `Region` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `PostalCode` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `Country` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `Phone` varchar(24) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `Fax` varchar(24) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `HomePage` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cash_flow`
--
ALTER TABLE `cash_flow`
  ADD PRIMARY KEY (`ID_Cash`),
  ADD KEY `cash_flow_employees` (`EmployeeID`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CategoryID`),
  ADD UNIQUE KEY `Uidx_categories_category_name` (`CategoryName`);

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CustomerID`),
  ADD KEY `idx_customers_company_name` (`Name`),
  ADD KEY `idx_customers_city` (`Dukuh`),
  ADD KEY `idx_customers_postalcode` (`RTRW`),
  ADD KEY `KelID` (`KelID`);

--
-- Indeks untuk tabel `daftarkecamatan`
--
ALTER TABLE `daftarkecamatan`
  ADD PRIMARY KEY (`KecID`),
  ADD KEY `KecID` (`KecID`),
  ADD KEY `KotaID` (`KotaID`);

--
-- Indeks untuk tabel `daftarkota`
--
ALTER TABLE `daftarkota`
  ADD PRIMARY KEY (`KotaID`),
  ADD KEY `Kota_Propinsi` (`PropinsiID`);

--
-- Indeks untuk tabel `daftarpropinsi`
--
ALTER TABLE `daftarpropinsi`
  ADD PRIMARY KEY (`PropinsiID`);

--
-- Indeks untuk tabel `daftar_kelurahan`
--
ALTER TABLE `daftar_kelurahan`
  ADD PRIMARY KEY (`KelID`),
  ADD KEY `daftar_kelurahan_ibfk_1_2` (`KecID`);

--
-- Indeks untuk tabel `data_perkiraan`
--
ALTER TABLE `data_perkiraan`
  ADD PRIMARY KEY (`No_Perkiraan`);

--
-- Indeks untuk tabel `detailsakit`
--
ALTER TABLE `detailsakit`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Indeks untuk tabel `distribusi_products`
--
ALTER TABLE `distribusi_products`
  ADD PRIMARY KEY (`DistribusiID`),
  ADD KEY `ProductID` (`ProductID`),
  ADD KEY `From_Emp` (`From_Emp`),
  ADD KEY `To_Emp` (`To_Emp`);

--
-- Indeks untuk tabel `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`EmployeeID`),
  ADD KEY `idx_employees_lastname` (`LastName`),
  ADD KEY `idx_employees_postalcode` (`PostalCode`),
  ADD KEY `idx_ReportsTo` (`ReportsTo`);

--
-- Indeks untuk tabel `jenis_jurnal`
--
ALTER TABLE `jenis_jurnal`
  ADD PRIMARY KEY (`Jenis_Jurnal`);

--
-- Indeks untuk tabel `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`Tanggal_Jurnal`,`Jenis_Jurnal`,`No_Bukti`,`No_Perkiraan`,`Debet_Jurnal`,`Kredit_Jurnal`),
  ADD KEY `Jurnal_Perkiraan` (`No_Perkiraan`),
  ADD KEY `Jurnal_Jenis` (`Jenis_Jurnal`);

--
-- Indeks untuk tabel `konsinasi`
--
ALTER TABLE `konsinasi`
  ADD PRIMARY KEY (`Konsinasi_ID`),
  ADD KEY `FK_Konsinasi_Customer` (`CustomerID`),
  ADD KEY `FK_Konsinasi_Employees` (`EmployeeID`);

--
-- Indeks untuk tabel `konsinasi_details`
--
ALTER TABLE `konsinasi_details`
  ADD PRIMARY KEY (`Konsinasi_Detail_ID`),
  ADD KEY `FK_Konsinasi_Detail_Konsinasi` (`Konsinasi_ID`),
  ADD KEY `FK_Konsinasi_Detail_StockEmployee` (`Product_ID`),
  ADD KEY `FK_Konsinasi_Detail_StockEmployee2` (`EmployeeID`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `FK_orders_employeeid` (`EmployeeID`),
  ADD KEY `FK_orders_customer_id` (`Status_Order`);

--
-- Indeks untuk tabel `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`DetailID`),
  ADD UNIQUE KEY `Uidx_OrderID_ProductID` (`OrderID`,`ProductID`,`EmployeeID`) USING BTREE,
  ADD KEY `FK_order_details_productid` (`ProductID`),
  ADD KEY `FK_order_details_Distribusi` (`DistribusiID`),
  ADD KEY `FK_Order_details_ProductsEmployee2` (`EmployeeID`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `FK_products_categoryid` (`CategoryID`),
  ADD KEY `FK_products_supplierid` (`SupplierID`),
  ADD KEY `idx_products_product_name` (`ProductName`);

--
-- Indeks untuk tabel `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`SalesID`),
  ADD KEY `FK_orders_employeeid` (`EmployeeID`),
  ADD KEY `FK_orders_customer_id` (`CustomerID`);

--
-- Indeks untuk tabel `sales_details`
--
ALTER TABLE `sales_details`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Uidx_OrderID_ProductID` (`SalesID`,`ProductID`),
  ADD KEY `FK_order_details_productid` (`ProductID`),
  ADD KEY `Sales_details_StockEmployee2` (`EmployeeID`);

--
-- Indeks untuk tabel `setoran`
--
ALTER TABLE `setoran`
  ADD PRIMARY KEY (`ID_Setor`),
  ADD KEY `setoran_employee_fk1` (`ToEmployeeID`),
  ADD KEY `setoran_employee_fk2` (`FromEmployeeID`);

--
-- Indeks untuk tabel `stckawalproductonemployee`
--
ALTER TABLE `stckawalproductonemployee`
  ADD PRIMARY KEY (`ProductID`,`EmployeeID`,`UnitPrice`) USING BTREE,
  ADD KEY `EmployeeID` (`EmployeeID`);

--
-- Indeks untuk tabel `stckproductonemployee`
--
ALTER TABLE `stckproductonemployee`
  ADD PRIMARY KEY (`ProductID`,`EmployeeID`,`UnitPrice`) USING BTREE,
  ADD KEY `EmployeeID` (`EmployeeID`);

--
-- Indeks untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`SupplierID`),
  ADD KEY `idx_suppliers_product_name` (`CompanyName`),
  ADD KEY `idx_suppliers_postalcode` (`PostalCode`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `CategoryID` tinyint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `daftarkecamatan`
--
ALTER TABLE `daftarkecamatan`
  MODIFY `KecID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `daftarkota`
--
ALTER TABLE `daftarkota`
  MODIFY `KotaID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `daftar_kelurahan`
--
ALTER TABLE `daftar_kelurahan`
  MODIFY `KelID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detailsakit`
--
ALTER TABLE `detailsakit`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `distribusi_products`
--
ALTER TABLE `distribusi_products`
  MODIFY `DistribusiID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `konsinasi`
--
ALTER TABLE `konsinasi`
  MODIFY `Konsinasi_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `konsinasi_details`
--
ALTER TABLE `konsinasi_details`
  MODIFY `Konsinasi_Detail_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `order_details`
--
ALTER TABLE `order_details`
  MODIFY `DetailID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sales_details`
--
ALTER TABLE `sales_details`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `setoran`
--
ALTER TABLE `setoran`
  MODIFY `ID_Setor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `SupplierID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `cash_flow`
--
ALTER TABLE `cash_flow`
  ADD CONSTRAINT `cash_flow_employees` FOREIGN KEY (`EmployeeID`) REFERENCES `employees` (`EmployeeID`);

--
-- Ketidakleluasaan untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1_2` FOREIGN KEY (`KelID`) REFERENCES `daftar_kelurahan` (`KelID`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `daftarkecamatan`
--
ALTER TABLE `daftarkecamatan`
  ADD CONSTRAINT `daftarkecamatan_ibfk_1` FOREIGN KEY (`KotaID`) REFERENCES `daftarkota` (`KotaID`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `daftarkota`
--
ALTER TABLE `daftarkota`
  ADD CONSTRAINT `Kota_Propinsi` FOREIGN KEY (`PropinsiID`) REFERENCES `daftarpropinsi` (`PropinsiID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `daftar_kelurahan`
--
ALTER TABLE `daftar_kelurahan`
  ADD CONSTRAINT `daftar_kelurahan_ibfk_1_2` FOREIGN KEY (`KecID`) REFERENCES `daftarkecamatan` (`KecID`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detailsakit`
--
ALTER TABLE `detailsakit`
  ADD CONSTRAINT `detailsakit_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customers` (`CustomerID`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `distribusi_products`
--
ALTER TABLE `distribusi_products`
  ADD CONSTRAINT `distribusi_products_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `distribusi_products_ibfk_2` FOREIGN KEY (`From_Emp`) REFERENCES `employees` (`EmployeeID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `distribusi_products_ibfk_3` FOREIGN KEY (`To_Emp`) REFERENCES `employees` (`EmployeeID`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `FK_employees_reports_to` FOREIGN KEY (`ReportsTo`) REFERENCES `employees` (`EmployeeID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `jurnal`
--
ALTER TABLE `jurnal`
  ADD CONSTRAINT `Jurnal_Jenis` FOREIGN KEY (`Jenis_Jurnal`) REFERENCES `jenis_jurnal` (`Jenis_Jurnal`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Jurnal_Perkiraan` FOREIGN KEY (`No_Perkiraan`) REFERENCES `data_perkiraan` (`No_Perkiraan`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `konsinasi`
--
ALTER TABLE `konsinasi`
  ADD CONSTRAINT `FK_Konsinasi_Customer` FOREIGN KEY (`CustomerID`) REFERENCES `customers` (`CustomerID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Konsinasi_Employees` FOREIGN KEY (`EmployeeID`) REFERENCES `employees` (`EmployeeID`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `konsinasi_details`
--
ALTER TABLE `konsinasi_details`
  ADD CONSTRAINT `FK_Konsinasi_Detail_Konsinasi` FOREIGN KEY (`Konsinasi_ID`) REFERENCES `konsinasi` (`Konsinasi_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Konsinasi_Detail_StockEmployee` FOREIGN KEY (`Product_ID`) REFERENCES `stckproductonemployee` (`ProductID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Konsinasi_Detail_StockEmployee2` FOREIGN KEY (`EmployeeID`) REFERENCES `stckproductonemployee` (`EmployeeID`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_Order_Employees` FOREIGN KEY (`EmployeeID`) REFERENCES `employees` (`EmployeeID`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `FK_Order_details_ProductsEmployee1` FOREIGN KEY (`ProductID`) REFERENCES `stckproductonemployee` (`ProductID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Order_details_ProductsEmployee2` FOREIGN KEY (`EmployeeID`) REFERENCES `stckproductonemployee` (`EmployeeID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_order_details_Distribusi` FOREIGN KEY (`DistribusiID`) REFERENCES `distribusi_products` (`DistribusiID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_order_details_order` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_products_categoryid` FOREIGN KEY (`CategoryID`) REFERENCES `categories` (`CategoryID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_products_supplierid` FOREIGN KEY (`SupplierID`) REFERENCES `suppliers` (`SupplierID`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `Sales_Cus` FOREIGN KEY (`CustomerID`) REFERENCES `customers` (`CustomerID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Sales_Emp` FOREIGN KEY (`EmployeeID`) REFERENCES `employees` (`EmployeeID`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sales_details`
--
ALTER TABLE `sales_details`
  ADD CONSTRAINT `Sales_details_StockEmployee` FOREIGN KEY (`ProductID`) REFERENCES `stckproductonemployee` (`ProductID`),
  ADD CONSTRAINT `Sales_details_StockEmployee2` FOREIGN KEY (`EmployeeID`) REFERENCES `stckproductonemployee` (`EmployeeID`),
  ADD CONSTRAINT `sales_details_ibfk_1` FOREIGN KEY (`SalesID`) REFERENCES `sales` (`SalesID`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `setoran`
--
ALTER TABLE `setoran`
  ADD CONSTRAINT `setoran_employee_fk1` FOREIGN KEY (`ToEmployeeID`) REFERENCES `employees` (`EmployeeID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `setoran_employee_fk2` FOREIGN KEY (`FromEmployeeID`) REFERENCES `employees` (`EmployeeID`);

--
-- Ketidakleluasaan untuk tabel `stckawalproductonemployee`
--
ALTER TABLE `stckawalproductonemployee`
  ADD CONSTRAINT `stckawalproductonemployee_ibfk_1` FOREIGN KEY (`EmployeeID`) REFERENCES `stckproductonemployee` (`EmployeeID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `stckawalproductonemployee_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `stckproductonemployee` (`ProductID`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `stckproductonemployee`
--
ALTER TABLE `stckproductonemployee`
  ADD CONSTRAINT `stckproductonemployee_ibfk_1` FOREIGN KEY (`EmployeeID`) REFERENCES `employees` (`EmployeeID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `stckproductonemployee_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
