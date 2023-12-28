<?php
  include "nav.php";
  require_once "session.php";
  require_once "db.php";
  if(isset($_POST['menuEkle'])){
    $id = $_POST['id'];
    $isim = $_POST['isim'];
    $fiyat = $_POST['fiyat'];
    $gorsel = $_FILES['gorsel'];
    $fileName = $gorsel['name'];
    $filePath = "./files/".md5(time()).$fileName;
    move_uploaded_file($gorsel['tmp_name'], $filePath);
    $db->query("INSERT INTO menuler (restaurant_id, isim, fiyat, foto) VALUES ('$id', '$isim', '$fiyat', '".$filePath. "')");
  }
?>

<html>
  <head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
    body {
			

	
			height: 100vh;
			
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

		.container h2 {
			font-size: 2rem;
			font-weight: bold;
			text-align: center;
		}

		.container form {
			padding-left: 20px;
			padding-right: 20px;
			padding-bottom: 20px;
		}

		.container label {
			font-weight: bold;
		}

		.container .btn {
			width: 100%;
			margin-top: 20px;
		}

		.container form .form-group {
			margin-bottom: 20px;
		}

</style>
  </head>
  <body>
  <section class="container mt-5">
    <h2 class="my-4">Menü Ekle</h2>
    <form method="POST"  enctype="multipart/form-data">
     
    <div class="form-group">
    <label for="id">Restaurant ismi</label> 
      <select name="id" class="form-control" >
        <?php $restaurantlar = $db->query("SELECT * FROM restaurant WHERE sahip = $_SESSION[id]") ?>
        <?php foreach($restaurantlar as $rest) { ?>
          <option value="<?php echo $rest['restaurant_id'] ?>">
            <?php echo $rest['isim'] ?>
          </option>
        <?php } ?>
      </select>

    </div>
    <div class="form-group">
    
    <label for="isim">Menu İsmi</label>
      <input type="text" class="form-control" name="isim" placeholder="Menü İsmi Gir.">
    
    </div>
    <div class="form-group">
    <label for="fiyat">Menü Fiyatı</label>
      <input type="number" class="form-control-file" name="fiyat" placeholder="12">
    </div>
    <div class="form-group">
    <label for="gorsel">Menü Resmi</label>
      <input type="file" class="form-control-file" name="gorsel">
    </div>
      <button class="btn btn-primary" name="menuEkle">Ekle</button>
    </form>
  </section>
  </body>
</html>