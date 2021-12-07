DROP TABLE IF EXISTS `pencari_jasa`;
DROP TABLE IF EXISTS `penyedia_jasa`;
DROP TABLE IF EXISTS `admin_web`;
DROP TABLE IF EXISTS `penyewaan_alat`;
DROP TABLE IF EXISTS `portofolio`;
DROP TABLE IF EXISTS `editor`;
DROP TABLE IF EXISTS `fotografi`;
DROP TABLE IF EXISTS `dimiliki_oleh`;
DROP TABLE IF EXISTS `penyedia_jasa_rangkap`;
DROP TABLE IF EXISTS `verifikasi_pendaftar`;
DROP TABLE IF EXISTS `terverifikasi`;
DROP TABLE IF EXISTS `pemesanan_jasa`;
DROP TABLE IF EXISTS `ulasan`;
DROP TABLE IF EXISTS `metode_bayar`;

CREATE TABLE `pencari_jasa` (
    `pcr_id` int(11) NOT NULL,
    `pcr_nama` varchar(100),
    'pcr_kontak' varchar(15),
    `pcr_alamat` varchar(1024),
    `pcr_tempatlahir` varchar(200),
    `pcr_tanggallahir` date,
    'pcr_foto' general,
    `pcr_jkel` varchar(2),
    `pcr_email` varchar(100) NOT NULL,
    `pcr_password` varchar(100) NOT NULL,
    PRIMARY KEY (`pcr_id`)
);

CREATE TABLE 'penyedia_jasa' (
    'pjasa_id' int(11) NOT NULL,
    'pjasa_nama' varchar(100),
    'pjasa_kontak' varchar(15),
    'pjasa_alamat' varchar(1024),
    'pjasa_tempatlahir' varchar(200),
    'pjasa_tanggallahir' date,
    'pjasa_foto' general,
    'pjasa_jkel' varchar(2),
    'pjasa_email' varchar(100) NOT NULL,
    'pjasa_password' varchar(100) NOT NULL,
    'pjasa_statusaktif' varchar(100),
    PRIMARY KEY (`pjasa_id`)
);

CREATE TABLE 'admin_web' (
    'adm_id' int(11) NOT NULL,
    'adm_nama' varchar(100),
    'adm_kontak' varchar(15),
    'adm_jkel' varchar(2),
    'adm_email' varchar(100) NOT NULL,
    'adm_password' varchar(100) NOT NULL,
    PRIMARY KEY (`adm_id`)
);

CREATE TABLE 'verifikasi_pendaftar' (
    'adm_id' int NOT NULL,
    'vpend_id' int NOT NULL,
    'vpend_nama' varchar(100),
    'vpend_kontak' varchar(15),
    'vpend_portofolio' general,
    'vpend_email' varchar(200),
    'vpend_password' varchar(100),
    PRIMARY KEY (`vpend_id`),
    FOREIGN KEY (`adm_id`) REFERENCES `admin_web`(`adm_id`),
    PRIMARY KEY (`adm_id`)
);

CREATE TABLE 'terverifikasi' (
    'adm_id' int NOT NULL,
    'vpend_id' int NOT NULL,
    'pjasa_id' numeric NOT NULL,
    PRIMARY KEY (`vpend_id`),
    FOREIGN KEY (`adm_id`) REFERENCES `admin_web`(`adm_id`),
    FOREIGN KEY (`pjasa_id`) REFERENCES `penyedia_jasa`(`pjasa_id`),
    PRIMARY KEY (`adm_id`),
    PRIMARY KEY (`pjasa_id`),
    FOREIGN KEY (`vpend_id`) REFERENCES `verifikasi_pendaftar`(`vpend_id`)
);

CREATE TABLE 'penyewaan_alat' (
    'palat_id' numeric NOT NULL,
    'palat_rating' numeric,
    'palat_alt1' varchar(256),
    'palat_alt2' varchar(256),
    'palat_alt3' varchar(256),
    'palat_alt4' varchar(256),
    'palat_alt5' varchar(256),
    'palat_alt6' varchar(256),
    'palat_alt7' varchar(256),
    'palat_hrg1' currency,
    'palat_hrg2' currency,
    'palat_hrg3' currency,
    'palat_hrg4' currency,
    'palat_hrg5' currency,
    'palat_hrg6' currency,
    'palat_hrg7' currency,
    'palat_img1' general,
    'palat_img2' general,
    'palat_img3' general,
    'palat_img4' general,
    'palat_img5' general,
    'palat_img6' general,
    'palat_img7' general,
    PRIMARY KEY (`palat_id`)
);

CREATE TABLE 'portofolio' (
    'prtf_id' numeric NOT NULL,
    'prtf_foto' general,
    'prtf_deskripsi' varchar(1024),
    PRIMARY KEY (`prtf_id`)
);

CREATE TABLE 'editor' (
    'edtr_id' numeric NOT NULL,
    'edtr+rating' numeric,
    'edtr_tarif' currency,
    PRIMARY KEY (`edtr_id`)
);

CREATE TABLE 'fotografer' (
    'ftg_id' numeric NOT NULL,
    'ftg_rating' numeric,
    'ftg_tarif' currency,
    PRIMARY KEY (`ftg_id`)
);


CREATE TABLE 'dimiliki_oleh' (
    'prtf_id' numeric NOT NULL,
    'pjasa_id' numeric NOT NULL,
    PRIMARY KEY (`prtf_id`),
    FOREIGN KEY (`prtf_id`) REFERENCES `portofolio`(`prtf_id`),
    FOREIGN KEY (`pjasa_id`) REFERENCES `penyedia_jasa`(`pjasa_id`)
    PRIMARY KEY (`pjasa_id`)
);

CREATE TABLE 'penyedia_jasa_rangkap'(
    'palat_id' numeric NOT NULL,
    'pjasa_id' numeric NOT NULL,
    'ftg_id' numeric NOT NULL,
    'edtr_id' numeric NOT NULL,
    'pjr_rangkap' varchar(256),
    FOREIGN KEY (`palat_id`) REFERENCES `penyewaan_alat`(`palat_id`),
    FOREIGN KEY (`pjasa_id`) REFERENCES `penyedia_jasa`(`pjasa_id`),
    FOREIGN KEY (`ftg_id`) REFERENCES `fotografer`(`ftg_id`),
    FOREIGN KEY (`edtr_id`) REFERENCES `editor`(`edtr_id`)
);

CREATE TABLE 'pemesanan_jasa' (
    'pjasa_id' numeric NOT NULL,
    'pmsn_id' numeric NOT NULL,
    'pcr_id' numeric,
    'ulsn_id' numeric,
    'pmsn_waktu' datetime,
    'pmsn_catatan' varchar(1024),
    'pmsn_status' varchar(100),
    'pmsn_foto1' general,
    'pmsn_foto2' general,
    'pmsn_foto3' general,
    'pmsn_foto4' general,
    'pmsn_foto5' general,
    'pmsn_foto6' general,
    'pmsn_foto7' general,
    'pmsn_foto8' general,
    'pmsn_foto9' general,
    'pmsn_foto10' general,
    'pmsn_alt1' varchar(256),
    'pmsn_alt2' varchar(256),
    'pmsn_alt3' varchar(256),
    'pmsn_alt4' varchar(256),
    'pmsn_alt5' varchar(256),
    'pmsn_alt6' varchar(256),
    'pmsn_alt7' varchar(256),
    'pmsn_alt8' varchar(256),
    'pmsn_alt9' varchar(256),
    'pmsn_alt10' varchar(256),
);

CREATE TABLE 'ulasan' (
    'pjasa_id' numeric NOT NULL,
    'ulsn_id' numeric NOT NULL,
    'pmsn_id' numeric NOT NULL,
    'ulsn_deskripsi' varchar(1024),
    'ulsn_rating' numeric,
    'ulsn_tgl' date,
    FOREIGN KEY (`pjasa_id`) REFERENCES `penyedia_jasa`(`pjasa_id`),
    FOREIGN KEY (`pmsn_id`) REFERENCES `pemesanan_jasa`(`pmsn_id`),
    PRIMARY KEY (`ulsn_id`)
);

CREATE TABLE 'metode_bayar' (
    'mtd_id' numeric NOT NULL,
    'pjasa_id' numeric NOT NULL,
    'pmsn_id' numeric NOT NULL,
    'mtd_nama' varchar(256),
    'mtd_deskripsi' note,
    'mtd_nomertf' varchar(100),
    PRIMARY KEY (`mtd_id`),
    FOREIGN KEY (`pjasa_id`) REFERENCES `penyedia_jasa`(`pjasa_id`),
    FOREIGN KEY (`pmsn_id`) REFERENCES `pemesanan_jasa`(`pmsn_id`)
);