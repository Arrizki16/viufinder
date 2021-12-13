<?php
session_start();
if(!isset($_SESSION['email']) || !isset($_GET['id'])){
    header("location:login.php");
}
include_once("database/db_connection.php");
$pjasaid = $_GET['id'];
$email = $_SESSION['email'];

$query = "SELECT * FROM pencari_jasa WHERE pcr_email = '$email'";
$pcrdata = mysqli_fetch_assoc(mysqli_query($conn, $query));
$pcrid = $pcrdata['pcr_id'];

$query = "SELECT * FROM penyedia_jasa WHERE pjasa_id = '$pjasaid'";
$pjasadata = mysqli_fetch_assoc(mysqli_query($conn, $query));

if($_SERVER['REQUEST_METHOD'] == "POST"){    
    $date = $_POST['tanggal'];
    $timeStart = $_POST['waktu-mulai'];
    $timeEnd = $_POST['waktu-selesai'];
    $place = $_POST['tempat'];
    $note = $_POST['catatan'];
    $payment = $_POST['metodebayar'];
    $type = $_POST['jenisjasa'];
    $harga = $_POST['harga'];
    echo $harga;
    $query = "INSERT INTO pemesanan_jasa (pcr_id, pjasa_id, pmsn_tanggal, pmsn_waktu_mulai, pmsn_waktu_selesai, pmsn_lokasi, pmsn_catatan, mtd_id, pmsn_status, pmsn_jenis, pmsn_harga) 
                VALUES ($pcrid, $pjasaid, '$date', '$timeStart', '$timeEnd', '$place', '$note', $payment, 'Dipesan', '$type', $harga)";
    $result = mysqli_query($conn, $query);

    if($result){
        header("location:index.php");
    }
}
?>
<!doctype html>
<html>
<head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>Halaman Pembayaran</title>
        
        <link href='' rel='stylesheet'>
        <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
        <style>
            body {
                background: rgb(236, 236, 236);
                font-family: Arial, Helvetica, sans-serif
            }
            input[name=harga] {
                background: red;
            }
            .container {
                background: #fff !important;
                border: none;
                border-radius: 20px;
                box-shadow: 0 1px 10px 5px rgba(0, 0, 0, 0.05);
            }

            h6.text-muted {
                color: #6c757d85 !important
            }

            h4.text-danger {
                margin-left: 250px;
                color: #f11126 !important
            }

            h3.text-success {
                margin-left: 250px;
                font-weight: bold;
            }

            .htwo {
                margin-left: 200px
            }

            .scol {
                padding-left: 60px
            }

            .row.r2 {
                margin-bottom: 20px
            }

            .row.r2:after {
                content: '.';
                font-size: 0;
                display: block;
                height: 1px;
                width: 77%;
                background: #a9abae3d
            }

            h3.payment {
                margin-top: 30px
            }

            h4.jasa {
                color: rgb(0, 0, 0);
            }

            h6.payment-method {
                margin-top: 30px
            }

            .r5.col-2 {
                padding-left: 0
            }

            div.col-2 {
                cursor: pointer
            }

            .personalDetails {
                margin-right: 100px;
                padding-top: 30px
            }

            .form-control {
                border: none;
                border-radius: none;
                border-bottom: 1px solid #a9abae3d
            }

            .form-control:focus {
                border: none;
                color: #000 !important;
                font-weight: bold;
                border-color: #fff;
                border-bottom: 1px solid #a9abae3d;
                outline: 0;
                box-shadow: 0 0 0 0 rgba(0, 123, 255, .25)
            }

            .far {
                color: #adb5bd
            }

            .th {
                margin-top: 10px
            }

            .btn.btn-primary {
                border: none;
                border-radius: 40px;
                /* width: 40% */
            }

            .row.r5 img {
                width: 60px;
                height: 60px;
            }

            .row.r5 .paymentmethod{
                margin-bottom: 20pt;
                float: left;
            }

            .row.r5 .paymentmethod .payment-info{
                float: right;
                padding-left: 1rem;
            }

            .col .card {
                box-shadow: 0 1px 10px 5px rgba(0, 0, 0, 0.05);
                border: none;
                border-radius: 10px;
            }

            .col.mx-auto .card-body.payment{
                box-shadow: 0 1px 10px 5px rgba(0, 0, 0, 0.05);
                padding-left: 6%;
                border-radius: 10px;
            }

            @media screen and (max-width: 1200px) {
                .rcol {
                    width: 100%
                }
            
                .scol {
                    width: 100%
                }
            }

            @media screen and (max-width: 768px) {
                .container {
                    width: 95%
                }
            
                .row.r2:after {
                    width: 95%
                }
            }
        </style>
        <link href="assets/css/style.css" rel="stylesheet">  
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <style>
            body {
                background: rgb(236, 236, 236);
                font-family: Arial, Helvetica, sans-serif
            }
            input[name=harga] {
                background: white !important;
                font-size: 48px !important;
                font-weight: bold !important;
                text-align: right !important;
            }
            .container {
                background: #fff !important;
                border: none;
                border-radius: 20px;
                box-shadow: 0 1px 10px 5px rgba(0, 0, 0, 0.05);
            }

            h6.text-muted {
                color: #6c757d85 !important
            }

            h4.text-danger {
                margin-left: 250px;
                color: #f11126 !important
            }

            h3.text-success {
                margin-left: 250px;
                font-weight: bold;
            }

            .htwo {
                margin-left: 200px
            }

            .scol {
                padding-left: 60px
            }

            .row.r2 {
                margin-bottom: 20px
            }

            .row.r2:after {
                content: '.';
                font-size: 0;
                display: block;
                height: 1px;
                width: 77%;
                background: #a9abae3d
            }

            h3.payment {
                margin-top: 30px
            }

            h4.jasa {
                color: rgb(0, 0, 0);
            }

            h6.payment-method {
                margin-top: 30px
            }

            .r5.col-2 {
                padding-left: 0
            }

            div.col-2 {
                cursor: pointer
            }

            .personalDetails {
                margin-right: 100px;
                padding-top: 30px
            }

            .form-control {
                border: none;
                border-radius: none;
                border-bottom: 1px solid #a9abae3d
            }

            .form-control:focus {
                border: none;
                color: #000 !important;
                font-weight: bold;
                border-color: #fff;
                border-bottom: 1px solid #a9abae3d;
                outline: 0;
                box-shadow: 0 0 0 0 rgba(0, 123, 255, .25)
            }

            .far {
                color: #adb5bd
            }

            .th {
                margin-top: 10px
            }

            .btn.btn-primary {
                border: none;
                border-radius: 40px;
                /* width: 40% */
            }

            .row.r5 img {
                width: 60px;
                height: 60px;
            }

            .row.r5 .paymentmethod{
                margin-bottom: 20pt;
                float: left;
            }

            .row.r5 .paymentmethod .payment-info{
                float: right;
                padding-left: 1rem;
            }

            .col .card {
                box-shadow: 0 1px 10px 5px rgba(0, 0, 0, 0.05);
                border: none;
                border-radius: 10px;
            }

            .col.mx-auto .card-body.payment{
                box-shadow: 0 1px 10px 5px rgba(0, 0, 0, 0.05);
                padding-left: 6%;
                border-radius: 10px;
            }

            @media screen and (max-width: 1200px) {
                .rcol {
                    width: 100%
                }
            
                .scol {
                    width: 100%
                }
            }

            @media screen and (max-width: 768px) {
                .container {
                    width: 95%
                }
            
                .row.r2:after {
                    width: 95%
                }
            }
        </style>
</head>
<body oncontextmenu='return false' class='snippet-body'>

<div class="container m-5 mx-auto">
    <div class="row main">
        <div class="col-lg-6 col-12 my-5 rcol">
        <div class="row r1">
                <div class="card text-center">
                    <img src="/assets/img/blog/comments-1.jpg" width=100px height=100px style="margin-top: 3%;" class="rounded-circle mx-auto" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $pjasadata['pjasa_nama']?></h5>
                        <h7><?php echo $pjasadata['pjasa_alamat'];?></h7>
                    </div>
                </div>
            </div>
            <div class="row r4 text-justify" style="width: 90%;">
                <h6 class="payment-method" style="margin-bottom: 1px;">Silahkan lakukan pembayaran pada satu diantara metode pembayaran berikut 
                    dalam jangka waktu 1x6 jam agar pesanan Anda dapat kami proses. Jika melebihi dari batas waktu yang ditentukan, status 
                    pemesanan Anda akan hangus, cek ketentuan lainnya di <a href="#">Terms and Conditions.</a><br> <br>
                    Notifikasi pembayaran akan Anda terima melalui nomer ponsel 
                    Anda yang terdaftar setelah sistem kami mendeteki pembayaran Anda. Simpan bukti pembayaran jika diperlukan sewaktu-waktu. 
                    Terima Kasih sudah mempecayakan urusan fotografi Anda pada viufinder.
                </h6>
            </div>
        </div>
        <div class="col mx-auto my-3" style="padding-right: 1%;">
        <h3 class="product text-center">DETAIL PESANAN</h3>
            <form action="" method="post">
                <p>Jenis Jasa</p>
                <?php
                    include_once("database/db_connection.php");
                    $query = "SELECT * FROM penyedia_jasa_rangkap WHERE pjasa_id = '$pjasaid'";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);
                    $isChecked = 'checked';

                    if(!is_null($row['ftg_id'])) {
                        echo "<div class='form-check-inline'>";
                        echo "<input class='btn-check' type='radio' name='jenisjasa' onclick='updateJenisJasa(this)' id='jenisjasaftg' value='1'".$isChecked.">";
                        echo "<label class='btn btn-outline-dark' for='jenisjasaftg'>Fotografi</label>";
                        echo "</div>";
                        $isChecked = '';
                    }

                    if(!is_null($row['edtr_id'])) {
                        echo "<div class='form-check-inline'>";
                        echo "<input class='btn-check' type='radio' name='jenisjasa' onclick='updateJenisJasa(this)' id='jenisjasaedtr' value='2'".$isChecked.">";
                        echo "<label class='btn btn-outline-dark' for='jenisjasaedtr'>Editing</label>";
                        echo "</div>";
                        $isChecked = '';
                    }

                    if(!is_null($row['palat_id'])) {
                        echo "<div class='form-check-inline'>";
                        echo "<input class='btn-check' type='radio' name='jenisjasa' onclick='updateJenisJasa(this)' id='jenisjasapalat' value='3'".$isChecked.">";
                        echo "<label class='btn btn-outline-dark' for='jenisjasapalat'>Sewa Jasa</label>";
                        echo "</div>";
                        $isChecked = '';
                    }
                ?>
                <div class="form-group">
                    <label><br>Tanggal</label>
                    <div class="input-group">
                        <input class="form-control" name="tanggal" type="text" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label><br>Waktu Mulai</label>
                    <div class="input-group">
                        <input class="form-control" name="waktu-mulai" type="time" required>
                    </div>
                </div>
                <div class="form-group">
                    <label><br>Waktu Selesai</label>
                    <div class="input-group">
                        <input class="form-control" name="waktu-selesai" type="time" required>
                    </div>
                </div>
                <div class="form-group">
                    <label><br>Tempat</label>
                    <div class="input-group">
                        <input class="form-control" name="tempat" type="text" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="jumlah"><br>Jumlah</label>
                    <div name="jumlah" class="input-group">
                        <input class="form-control" name="jumlah" type="text" value="1" required>
                    </div>
                </div>
                <div class="form-group">
                    <label><br>Catatan</label>
                    <div class="input-group">
                        <input class="form-control" name="catatan" type="text" required>
                    </div>
                </div>
                <p><br>Metode Pembayaran<br></p>

                <?php
                    include_once("database/db_connection.php");
                    $query = "SELECT * FROM metode_bayar";
                    $result = mysqli_query($conn, $query);
                    while($row = $result->fetch_assoc()){
                        $id = $row['mtd_id'];
                        $nama = $row['mtd_nama'];
                        $notf = $row['mtd_nomertf'];
                        $isChecked = ($id == 1) ? 'checked' : '';
                        echo "<div class='form-check-inline'>";
                        echo "<input class='btn-check' type='radio' name='metodebayar' id='metodebayar".$id."' value='".$id."' ".$isChecked.">";
                        echo "<label class='btn btn-outline-dark' for='metodebayar".$id."'><b>".$nama."</b><br>".$notf."</label>";
                        echo "</div>";
                    }
                ?>
                <div class="form-group">
                    <label><br>Total Harga</label>
                    <div class="input-group">
                        <input class="form-control form-control-lg" name="harga" type="text" value="00" readonly>
                    </div>
                </div>

                <div class="form-group my-3 d-grid gap-2">
                    <button class="form-control-lg btn btn-primary btn-block" type="submit">Buat Pesanan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
<script type='text/javascript' src=''></script>
<script type='text/javascript' src=''></script>
<script type='text/Javascript'></script>
<script>
    window.onload = updateJenisJasa(document.querySelector('input[name="jenisjasa"]:checked'));
    function updateHarga(jenis) {
        // console.log("updateHarga " + jenis);
        switch(jenis) {
            case 1:
                var jumlah = document.querySelector('input[name="jumlah"]').value;
                // console.log("updateHarga1 " + jumlah);
                document.querySelector('input[name="harga"]').value = jumlah * 25000;
                break;
            case 2:
                // console.log("updateHarga2");
                var jumlah = document.querySelector('input[name="jumlah"]').value;
                document.querySelector('input[name="harga"]').value = jumlah * 100000;
                break;
            case 3:
                document.querySelector('input[name="harga"]').value = '250000';
                break;
            default:
                document.querySelector('input[name="harga"]').value = '0';
        }
    }
    function updateJenisJasa(radio) {
        
        var jenis = radio.value;
        var harga = document.querySelector('input[name="harga"]');
        var jumlahLabel = document.querySelector('label[for="jumlah"]');
        var inputJumlah = document.querySelector('div[name="jumlah"]');
        // console.log("updateJanisJasa " + jenis);
        switch(jenis) {
            case '1':
                // console.log("switchJanisJasa1 " + jenis);
                // console.log(harga.value);
                jumlahLabel.innerHTML = "<br>Jumlah Foto";
                inputJumlah.innerHTML = 
                "<?php
                    echo "<input class='form-control' name='jumlah' onchange='updateHarga(1)' onkeyup='this.onchange();' onpaste='this.onchange();' oninput='this.onchange();' type='number' value='1' required>";
                ?>";
                updateHarga(1);
                break;
            case '2':
                // console.log("switchJanisJasa2 " + jenis);
                jumlahLabel.innerHTML = "<br>Jumlah File";
                inputJumlah.innerHTML = 
                "<?php
                    echo "<input class='form-control' name='jumlah' onchange='updateHarga(2)' onkeyup='this.onchange();' onpaste='this.onchange();' oninput='this.onchange();' type='number' value='1' required>";
                ?>";
                updateHarga(2);
                break;
            case '3':
                // console.log("as " + jenis);
                jumlahLabel.innerHTML = "<br>Pilih Alat";
                harga.value = '250000';
                break;
            default:
                harga.value = '0';
        }
    }

    
</script>
</body>
</html>