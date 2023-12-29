<?php 
  include "nav.php";
  require_once "db.php";
  require_once "session.php";
  
  if(!isset($_POST['siparis'])){
    header("Location: anasayfa.php");
    return;
  }

  $menuler = $_POST['menu'];
  $restaurant_id = $_POST['restaurant_id'];
  $menuisimleri = implode(',', $menuler);
  setcookie("menu",$menuisimleri,time()+(60*60*12));
  $islem = $db->query("SELECT * FROM menuler WHERE menu_id IN ($menuisimleri)")->fetchAll();
  $toplam = 0;
  foreach($islem as $i){
    $toplam += $i['fiyat'];
  }
  
  $user = $db->query("SELECT * FROM kullanicilar WHERE id = {$_SESSION['id']}")->fetch();
?>

<html>
  <head>
    <style>
      body {
     
        background-color: #e84242;
        
      }

      .container {
        max-width: 600px;
        margin: 50px auto;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
      }

      .isim {
        font-size: 18px;
        margin: 0;
      }

      .tutar {
        font-size: 18px;
        margin: 0;
        margin-top: 10px;
      }

      .date-input {
        width: 100%;
        padding: 10px;
        margin-top: 10px;
        margin-bottom: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-sizing: border-box;
      }

      .button-container {
        margin-top: 20px;
      }

      .submit-button, .cancel-button {
        display: inline-block;
        padding: 10px;
        text-align: center;
        text-decoration: none;
        border-radius: 5px;
        cursor: pointer;
        color: #fff;
      }

      .submit-button {
        background-color: #28a745;
        border: none;
        margin-right: 10px;
      }

      .cancel-button {
        background-color: #dc3545;
      }
    </style>
  </head>
  <body>
  
    <div class="container">
    
      <p class="isim">Sayın: <?php echo $user['kullanici_adi'] ?></p>
      <p class="tutar">Toplam tutar: <?php echo $toplam ; ?>TL</p>
      <?php if($user['cuzdan'] >= $toplam) { ?> 
      <form action="siparisOnay.php" method="post">
      <input type="hidden" name="restaurant_id" value="<?php echo $restaurant_id ?>">
        <input class="date-input" type="datetime-local" name="gun">
        <div class="button-container">
          <button class="submit-button" name="onayla">Siparişi Onayla</button>
          <a class="cancel-button" href="anasayfa.php">İptal</a>
        </div>
      </form>
      <?php } else { ?>
          <?php echo $toplam - $user['cuzdan'] ?> TL Eksik. Lütfen bakiye yükleyiniz.
        <?php } ?>
    </div>
  </body>
</html>
