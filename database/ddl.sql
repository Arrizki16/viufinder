DROP TABLE IF EXISTS `metode_bayar`;
DROP TABLE IF EXISTS `terverifikasi`;
DROP TABLE IF EXISTS `ulasan`;
DROP TABLE IF EXISTS `pemesanan_jasa`;
DROP TABLE IF EXISTS `dimiliki_oleh`;
DROP TABLE IF EXISTS `penyedia_jasa_rangkap`;
DROP TABLE IF EXISTS `verifikasi_pendaftar`;
DROP TABLE IF EXISTS `pencari_jasa`;
DROP TABLE IF EXISTS `penyedia_jasa`;
DROP TABLE IF EXISTS `admin_web`;
DROP TABLE IF EXISTS `fotografer_kategori`;
DROP TABLE IF EXISTS `editor_kategori`;
DROP TABLE IF EXISTS `penyewaan_alat_kategori`;
DROP TABLE IF EXISTS `kategori_jasa`;
DROP TABLE IF EXISTS `penyewaan_alat`;
DROP TABLE IF EXISTS `portofolio`;
DROP TABLE IF EXISTS `editor`;
DROP TABLE IF EXISTS `fotografer`;

CREATE TABLE `pencari_jasa` (
    `pcr_id` int(11) NOT NULL AUTO_INCREMENT,
    `pcr_nama` varchar(100),
    `pcr_kontak` varchar(15),
    `pcr_alamat` varchar(1024),
    `pcr_tempatlahir` varchar(200),
    `pcr_tanggallahir` date,
    `pcr_foto` mediumblob,
    `pcr_jkel` varchar(2),
    `pcr_email` varchar(100) NOT NULL,
    `pcr_password` varchar(100) NOT NULL,
    PRIMARY KEY (`pcr_id`)
);

CREATE TABLE `penyedia_jasa` (
    `pjasa_id` int(11) NOT NULL AUTO_INCREMENT,
    `pjasa_nama` varchar(100),
    `pjasa_kontak` varchar(15),
    `pjasa_alamat` varchar(1024),
    `pjasa_tempatlahir` varchar(200),
    `pjasa_tanggallahir` date,
    `pjasa_foto` mediumblob,
    `pjasa_jkel` varchar(2),
    `pjasa_email` varchar(100) NOT NULL,
    `pjasa_password` varchar(100) NOT NULL,
    `pjasa_statusaktif` varchar(100),
    PRIMARY KEY (`pjasa_id`)
);

CREATE TABLE `admin_web` (
    `adm_id` int(11) NOT NULL AUTO_INCREMENT,
    `adm_nama` varchar(100),
    `adm_kontak` varchar(15),
    `adm_jkel` varchar(2),
    `adm_email` varchar(100) NOT NULL,
    `adm_password` varchar(100) NOT NULL,
    PRIMARY KEY (`adm_id`)
);

CREATE TABLE `terverifikasi` (
    `adm_id` int(11) NOT NULL,
    `pjasa_id` int(11) NOT NULL,
    PRIMARY KEY (`adm_id`, `pjasa_id`),
    FOREIGN KEY (`adm_id`) REFERENCES `admin_web`(`adm_id`),
    FOREIGN KEY (`pjasa_id`) REFERENCES `penyedia_jasa`(`pjasa_id`)
);

CREATE TABLE `nonaktif` (
    `adm_id` int(11) NOT NULL,
    `pjasa_id` int(11) NOT NULL,
    PRIMARY KEY (`adm_id`, `pjasa_id`),
    FOREIGN KEY (`adm_id`) REFERENCES `admin_web`(`adm_id`),
    FOREIGN KEY (`pjasa_id`) REFERENCES `penyedia_jasa`(`pjasa_id`)
);

CREATE TABLE `penyewaan_alat` (
    `palat_id` int NOT NULL AUTO_INCREMENT,
    `palat_rating` int,
    `palat_alt1` varchar(256),
    `palat_alt2` varchar(256),
    `palat_alt3` varchar(256),
    `palat_alt4` varchar(256),
    `palat_alt5` varchar(256),
    `palat_alt6` varchar(256),
    `palat_alt7` varchar(256),
    `palat_hrg1` decimal(10,2),
    `palat_hrg2` decimal(10,2),
    `palat_hrg3` decimal(10,2),
    `palat_hrg4` decimal(10,2),
    `palat_hrg5` decimal(10,2),
    `palat_hrg6` decimal(10,2),
    `palat_hrg7` decimal(10,2),
    `palat_img1` mediumblob,
    `palat_img2` mediumblob,
    `palat_img3` mediumblob,
    `palat_img4` mediumblob,
    `palat_img5` mediumblob,
    `palat_img6` mediumblob,
    `palat_img7` mediumblob,
    PRIMARY KEY (`palat_id`)
);

CREATE TABLE `portofolio` (
    `prtf_id` int NOT NULL AUTO_INCREMENT,
    `prtf_foto` mediumblob,
    `prtf_deskripsi` varchar(1024),
    PRIMARY KEY (`prtf_id`)
);

CREATE TABLE `editor` (
    `edtr_id` int(11) NOT NULL AUTO_INCREMENT,
    `edtr_rating` int,
    `edtr_tarif` decimal(10,2),
    PRIMARY KEY (`edtr_id`)
);

CREATE TABLE `fotografer` (
    `ftg_id` int(11) NOT NULL AUTO_INCREMENT,
    `ftg_rating` int,
    `ftg_tarif` decimal(10,2),
    PRIMARY KEY (`ftg_id`)
);

CREATE TABLE `kategori_jasa` (
    `ktg_id` int NOT NULL AUTO_INCREMENT,
    `ktg_kategori` varchar(64),
    PRIMARY KEY (`ktg_id`)
);

CREATE TABLE `fotografer_kategori` (
    `ftg_id` int(11) NOT NULL,
    `ktg_id` int NOT NULL,
    PRIMARY KEY (`ftg_id`, `ktg_id`),
    FOREIGN KEY (`ftg_id`) REFERENCES `fotografer`(`ftg_id`),
    FOREIGN KEY (`ktg_id`) REFERENCES `kategori_jasa`(`ktg_id`)
);

CREATE TABLE `editor_kategori` (
    `edtr_id` int(11) NOT NULL,
    `ktg_id` int NOT NULL,
    PRIMARY KEY (`edtr_id`, `ktg_id`),
    FOREIGN KEY (`edtr_id`) REFERENCES `editor`(`edtr_id`),
    FOREIGN KEY (`ktg_id`) REFERENCES `kategori_jasa`(`ktg_id`)
);

CREATE TABLE `penyewaan_alat_kategori` (
    `palat_id` int(11) NOT NULL,
    `ktg_id` int NOT NULL,
    PRIMARY KEY (`palat_id`, `ktg_id`),
    FOREIGN KEY (`palat_id`) REFERENCES `penyewaan_alat`(`palat_id`),
    FOREIGN KEY (`ktg_id`) REFERENCES `kategori_jasa`(`ktg_id`)
);

CREATE TABLE `dimiliki_oleh` (
    `prtf_id` int NOT NULL,
    `pjasa_id` int(11) NOT NULL,
    PRIMARY KEY (`prtf_id`, `pjasa_id`),
    FOREIGN KEY (`prtf_id`) REFERENCES `portofolio`(`prtf_id`),
    FOREIGN KEY (`pjasa_id`) REFERENCES `penyedia_jasa`(`pjasa_id`)
);

CREATE TABLE `penyedia_jasa_rangkap`(
    `palat_id` int,
    `pjasa_id` int(11),
    `ftg_id` int(11),
    `edtr_id` int(11),
    `pjr_rangkap` varchar(256),
    FOREIGN KEY (`palat_id`) REFERENCES `penyewaan_alat`(`palat_id`),
    FOREIGN KEY (`pjasa_id`) REFERENCES `penyedia_jasa`(`pjasa_id`),
    FOREIGN KEY (`ftg_id`) REFERENCES `fotografer`(`ftg_id`),
    FOREIGN KEY (`edtr_id`) REFERENCES `editor`(`edtr_id`)
);

CREATE TABLE `metode_bayar` (
    `mtd_id` int NOT NULL AUTO_INCREMENT,
    `mtd_nama` varchar(256),
    `mtd_deskripsi` varchar(1024),
    `mtd_nomertf` varchar(100),
    PRIMARY KEY (`mtd_id`)
);

CREATE TABLE `ulasan` (
    `ulsn_id` int NOT NULL AUTO_INCREMENT,
    `ulsn_deskripsi` varchar(1024),
    `ulsn_rating` int,
    `ulsn_tgl` date,
    PRIMARY KEY (`ulsn_id`)
);

CREATE TABLE `pemesanan_jasa` (
    `pjasa_id` int(11) NOT NULL,
    `pmsn_id` int NOT NULL AUTO_INCREMENT,
    `pcr_id` int(11) NOT NULL,
    `ulsn_id` int,
    `mtd_id` int NOT NULL,
    `pmsn_harga` decimal(10,2),
    `pmsn_tanggal` date,
    `pmsn_waktu_mulai` time,
    `pmsn_waktu_selesai` time,
    `pmsn_catatan` varchar(1024),
    `pmsn_status` varchar(100),
    `pmsn_jenis` varchar(100),
    `pmsn_lokasi` varchar(256),
    `pmsn_foto1` mediumblob,
    `pmsn_foto2` mediumblob,
    `pmsn_foto3` mediumblob,
    `pmsn_foto4` mediumblob,
    `pmsn_foto5` mediumblob,
    `pmsn_foto6` mediumblob,
    `pmsn_foto7` mediumblob,
    `pmsn_foto8` mediumblob,
    `pmsn_foto9` mediumblob,
    `pmsn_foto10` mediumblob,
    `pmsn_alt1` varchar(256),
    `pmsn_alt2` varchar(256),
    `pmsn_alt3` varchar(256),
    `pmsn_alt4` varchar(256),
    `pmsn_alt5` varchar(256),
    `pmsn_alt6` varchar(256),
    `pmsn_alt7` varchar(256),
    `pmsn_alt8` varchar(256),
    `pmsn_alt9` varchar(256),
    `pmsn_alt10` varchar(256),
    PRIMARY KEY (`pmsn_id`, `pjasa_id`),
    FOREIGN KEY (`mtd_id`) REFERENCES `metode_bayar`(`mtd_id`),
    FOREIGN KEY (`pjasa_id`) REFERENCES `penyedia_jasa`(`pjasa_id`),
    FOREIGN KEY (`pcr_id`) REFERENCES `pencari_jasa`(`pcr_id`),
    FOREIGN KEY (`ulsn_id`) REFERENCES `ulasan`(`ulsn_id`)
);

INSERT INTO metode_bayar (mtd_nama, mtd_nomertf) VALUES ('LinkAja', '08123456789');
INSERT INTO metode_bayar (mtd_nama, mtd_nomertf) VALUES ('BNI', '123-123-123');
INSERT INTO metode_bayar (mtd_nama, mtd_nomertf) VALUES ('GoPay', '08235551112');
INSERT INTO metode_bayar (mtd_nama, mtd_nomertf) VALUES ('BCA', '230-123-321');

INSERT INTO kategori_jasa (ktg_kategori) VALUES ('Prewedding'); #1
INSERT INTO kategori_jasa (ktg_kategori) VALUES ('Baby Shoot'); #2
INSERT INTO kategori_jasa (ktg_kategori) VALUES ('Wedding');    #3
INSERT INTO kategori_jasa (ktg_kategori) VALUES ('Portrait');   #4
INSERT INTO kategori_jasa (ktg_kategori) VALUES ('Family');     #5
INSERT INTO kategori_jasa (ktg_kategori) VALUES ('Maternity');  #6

INSERT INTO admin_web (adm_nama, adm_email, adm_password) VALUES ('Admin 1', 'admin1@email.com', 'admin');
INSERT INTO admin_web (adm_nama, adm_email, adm_password) VALUES ('Admin 2', 'admin2@email.com', 'admin');