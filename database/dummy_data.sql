INSERT INTO kategori_jasa (ktg_kategori) VALUES ('Prewedding'); #1
INSERT INTO kategori_jasa (ktg_kategori) VALUES ('Baby Shoot'); #2
INSERT INTO kategori_jasa (ktg_kategori) VALUES ('Wedding');    #3
INSERT INTO kategori_jasa (ktg_kategori) VALUES ('Portrait');   #4
INSERT INTO kategori_jasa (ktg_kategori) VALUES ('Family');     #5
INSERT INTO kategori_jasa (ktg_kategori) VALUES ('Maternity');  #6

INSERT INTO penyedia_jasa (pjasa_nama, pjasa_email, pjasa_password, pjasa_alamat) 
    VALUES ('Adi', 'adi@email.com', '123', 'Kepanjen, Malang');
INSERT INTO penyedia_jasa (pjasa_nama, pjasa_email, pjasa_password, pjasa_alamat) 
    VALUES ('Budi', 'budi@email.com', '123', 'Sukolilo, Surabaya');
INSERT INTO penyedia_jasa (pjasa_nama, pjasa_email, pjasa_password, pjasa_alamat) 
    VALUES ('Cika', 'cika@email.com', '123', 'Kebon Jeruk, Jakarta');
INSERT INTO penyedia_jasa (pjasa_nama, pjasa_email, pjasa_password, pjasa_alamat) 
    VALUES ('Dina', 'dina@email.com', '123', 'Manyar, Surabaya');
INSERT INTO penyedia_jasa (pjasa_nama, pjasa_email, pjasa_password, pjasa_alamat) 
    VALUES ('Eka', 'eka@email.com', '123', 'Keputih, Surabaya');
INSERT INTO penyedia_jasa (pjasa_nama, pjasa_email, pjasa_password, pjasa_alamat) 
    VALUES ('Fahri', 'fahri@email.com', '123', 'Pasar Baru, Jakarta');

INSERT INTO fotografer (ftg_tarif, ftg_rating) VALUES (250000, 4);  #Adi
INSERT INTO fotografer (ftg_tarif, ftg_rating) VALUES (150000, 3);  #Budi
INSERT INTO fotografer (ftg_tarif, ftg_rating) VALUES (50000, 4);   #Cika
INSERT INTO fotografer (ftg_tarif, ftg_rating) VALUES (70000, 5);   #Eka

INSERT INTO fotografer_kategori (ftg_id, ktg_id) VALUES (1, 1);
INSERT INTO fotografer_kategori (ftg_id, ktg_id) VALUES (1, 3);
INSERT INTO fotografer_kategori (ftg_id, ktg_id) VALUES (1, 4);
INSERT INTO fotografer_kategori (ftg_id, ktg_id) VALUES (2, 6);
INSERT INTO fotografer_kategori (ftg_id, ktg_id) VALUES (2, 4);
INSERT INTO fotografer_kategori (ftg_id, ktg_id) VALUES (3, 1);
INSERT INTO fotografer_kategori (ftg_id, ktg_id) VALUES (4, 2);
INSERT INTO fotografer_kategori (ftg_id, ktg_id) VALUES (4, 3);
INSERT INTO fotografer_kategori (ftg_id, ktg_id) VALUES (4, 5);

INSERT INTO editor (edtr_tarif, edtr_rating) VALUES (250000, 4);    #Adi
INSERT INTO editor (edtr_tarif, edtr_rating) VALUES (230000, 3);    #Dina
INSERT INTO editor (edtr_tarif, edtr_rating) VALUES (65000, 4);     #Eka
INSERT INTO editor (edtr_tarif, edtr_rating) VALUES (120000, 2);    #Fahri

INSERT INTO editor_kategori (edtr_id, ktg_id) VALUES (1, 1);
INSERT INTO editor_kategori (edtr_id, ktg_id) VALUES (1, 3);
INSERT INTO editor_kategori (edtr_id, ktg_id) VALUES (1, 4);
INSERT INTO editor_kategori (edtr_id, ktg_id) VALUES (2, 6);
INSERT INTO editor_kategori (edtr_id, ktg_id) VALUES (2, 4);
INSERT INTO editor_kategori (edtr_id, ktg_id) VALUES (3, 1);
INSERT INTO editor_kategori (edtr_id, ktg_id) VALUES (4, 2);
INSERT INTO editor_kategori (edtr_id, ktg_id) VALUES (4, 3);
INSERT INTO editor_kategori (edtr_id, ktg_id) VALUES (4, 5);

INSERT INTO penyewaan_alat (palat_rating) VALUES (4);               #Adi
INSERT INTO penyewaan_alat (palat_rating) VALUES (3);               #Budi
INSERT INTO penyewaan_alat (palat_rating) VALUES (4);               #Dina
INSERT INTO penyewaan_alat (palat_rating) VALUES (4);               #Fahri

INSERT INTO penyewaan_alat_kategori (palat_id, ktg_id) VALUES (1, 1);
INSERT INTO penyewaan_alat_kategori (palat_id, ktg_id) VALUES (1, 3);
INSERT INTO penyewaan_alat_kategori (palat_id, ktg_id) VALUES (1, 4);
INSERT INTO penyewaan_alat_kategori (palat_id, ktg_id) VALUES (2, 6);
INSERT INTO penyewaan_alat_kategori (palat_id, ktg_id) VALUES (2, 4);
INSERT INTO penyewaan_alat_kategori (palat_id, ktg_id) VALUES (3, 1);
INSERT INTO penyewaan_alat_kategori (palat_id, ktg_id) VALUES (4, 2);
INSERT INTO penyewaan_alat_kategori (palat_id, ktg_id) VALUES (4, 3);
INSERT INTO penyewaan_alat_kategori (palat_id, ktg_id) VALUES (4, 5);

INSERT INTO penyedia_jasa_rangkap (pjasa_id, ftg_id, edtr_id, palat_id) VALUES (1, 1, 1, 1);
INSERT INTO penyedia_jasa_rangkap (pjasa_id, ftg_id, edtr_id, palat_id) VALUES (2, 2, null, 2);
INSERT INTO penyedia_jasa_rangkap (pjasa_id, ftg_id, edtr_id, palat_id) VALUES (3, 3, null, null);
INSERT INTO penyedia_jasa_rangkap (pjasa_id, ftg_id, edtr_id, palat_id) VALUES (4, null, 2, 3);
INSERT INTO penyedia_jasa_rangkap (pjasa_id, ftg_id, edtr_id, palat_id) VALUES (5, 4, 3, null);
INSERT INTO penyedia_jasa_rangkap (pjasa_id, ftg_id, edtr_id, palat_id) VALUES (6, null, 4, 4);

INSERT INTO pencari_jasa (pcr_nama, pcr_email, pcr_password) VALUES ('Daanii', 'daanii@email.com', '123');
INSERT INTO pencari_jasa (pcr_nama, pcr_email, pcr_password) VALUES ('Akmal', 'akmal@email.com', '123');
INSERT INTO pencari_jasa (pcr_nama, pcr_email, pcr_password) VALUES ('Deka', 'deka@email.com', '123');
INSERT INTO pencari_jasa (pcr_nama, pcr_email, pcr_password) VALUES ('Ridho', 'ridho@email.com', '123');

INSERT INTO metode_bayar (mtd_nama, mtd_nomertf) VALUES ('LinkAja', '08123456789');
INSERT INTO metode_bayar (mtd_nama, mtd_nomertf) VALUES ('BNI', '123-123-123');
INSERT INTO metode_bayar (mtd_nama, mtd_nomertf) VALUES ('GoPay', '08235551112');
INSERT INTO metode_bayar (mtd_nama, mtd_nomertf) VALUES ('BCA', '230-123-321');

INSERT INTO admin_web (adm_nama, adm_email, adm_password) VALUES ('Admin 1', 'admin1@email.com', 'admin');
INSERT INTO admin_web (adm_nama, adm_email, adm_password) VALUES ('Admin 2', 'admin2@email.com', 'admin');