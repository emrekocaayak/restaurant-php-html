<?php
  include "nav.php";
  require_once "session.php";
  require_once "db.php";

  if(empty($_SESSION['id'])) {
    header("Location: giris.php");
    return;
  }

  $kullanici = $db->query("SELECT * FROM kullanicilar WHERE id = " . $_SESSION['id'])->fetch();

  if($kullanici['tur'] != 'yonetici') {
    header("Location: anasayfa.php");
    return;
  }
?>

<html>
  <head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <style>
		body {
     
      background-color: #e84242;
		}

		.container {
			width: 30%;
			border-radius: 10px;
			box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
			overflow: hidden;
      background-color: white;
		}

		.container h1 {
			font-size: 2.5rem;
			font-weight: bold;
			text-align: center;
			margin-bottom: 20px;
		}

		.container form {
			padding: 20px;
		}

		.container label {
			font-weight: bold;
		}

		.container .btn {
			width: 100%;
			
      
		}

		.container form .form-group {
			margin-bottom: 20px;
		}
	</style>
  </head>
  <body>
   
    <div class="container pt-4">  
    <h1>İş Yeri Kayıt</h1>
    <form method="POST"  enctype="multipart/form-data">
    <div class="form-group">
      <label for="isim" >İş Yeri İsmi:</label>
      <input name="isim" type="text" class="form-control" required>
    </div>
    <div class="form-group">
      <label for="iletisim" >İletişim:</label>
      <input name="iletisim" type="text" class="form-control" required><br>
    </div>
    <div class="form-group">  
    <label for="resim" >Görsel:</label>
    <input name="resim" type="file" class="form-control-file" required><br>
    </div>
    <div class="form-group"> 
    <label for="cocukPark" >Çocuk Parkı</label>    <input type="checkbox" name="cocukPark" value="1"><br>
    </div>
    <div class="form-group"> 
    <label for="alkol" >Alkol</label> <input type="checkbox" name="alkol" id="alkol" value="1"><br>
    </div>
    <div class="form-group"> 
    <label for="muzik" >Müzik</label>   <input type="checkbox" name="muzik" id="muzik" value="1"><br>
    </div>
    <div class="form-group">
    <label for="adres" >Adres:</label>
    <textarea name="adres" class="form-control" required></textarea> <br>
    </div>  
    <button name="restoranKayit" class="btn btn-primary">Kayıt</button> 
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

  </body>

</html>

<?php
    if(!isset($_POST['restoranKayit'])) {
        return;
    }

    $cocukParkC = isset($_POST['cocukPark']) ? 1 : 0;
    $muzik = isset($_POST['muzik']) ? 1 : 0;
    $alkol = isset($_POST['alkol']) ? 1 : 0;
    $isim = $_POST['isim'];
    $iletisim = $_POST['iletisim'];
    $adres = $_POST['adres'];
    $file = $_FILES['resim'];
    $fileName = $file['name'];
    $filePath = "./files/".md5(time()).$fileName;
    move_uploaded_file($file['tmp_name'], $filePath);
    $db->query("INSERT INTO restaurant (isim, iletisim, adres, sahip, foto,cocuk_parki,muzik,alkol) VALUES ('$isim', '$iletisim', '$adres', {$_SESSION['id']},'$filePath' ,$cocukParkC,$muzik,$alkol)");