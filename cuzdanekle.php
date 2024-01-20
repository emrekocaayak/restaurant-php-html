<?php
include "nav.php";
require_once "session.php";
require_once "db.php";


?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        body{
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
    <form method="POST" enctype="multipart/form-data">
    <section class="container mt  -5">
    <h2 class="my-4">Bakiye Ekle</h2>
    <div class="form-group">
    <label for="card">Kart Bilgileri: </label>
    <input type="text" class="form-control" name="card" placeholder="Kart bilgilerini gir...">
    </div>
    <div class="form-group">
    <label for="date"> Tarih:  </label>
    <input type="date"  class="form-control" name="date">
    </div>
    <div class="form-group">
  <label for="ccv">CVV:  </label>
  <input type="text"  class="form-control" name="cvv" placeholder="CVV şifresi">
    </div>
    <div class="form-group">
  <label for="balance">Miktar </label>
    <input type="number" class="form-control-file" placeholder="12" name="eklenecek_miktar">
    </div>
    <div class="form-group">
    <input class="btn btn-primary" type="submit" name="ekle" value="ekle" >
    </div>
    </form>
    </section>
</body>
</html>

<?php
if(isset($_POST['ekle']))
{

$eklenecek_miktar = $_POST['eklenecek_miktar'];

$guncelmiktar = $db->query("UPDATE kullanicilar SET cuzdan = cuzdan + $eklenecek_miktar WHERE id = " . $_SESSION['id']);

echo "<script>alert('Tebrikler, " . $kullanici['kullanici_adi'] .  " " . $eklenecek_miktar .  "₺ bakiyen başarıyla eklendi!'); window.location.href = 'anasayfa.php';</script>";
}
?>