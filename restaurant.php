<?php
  include "nav.php";
  require_once "db.php";
  require_once "session.php";

  if(!isset($_GET['id']) || empty($_GET['id']))
  {
    header("Location: anasayfa.php");
    return;
  }
  
  $id = $_GET['id'];
  $restaurant = $db->query("SELECT * FROM restaurant WHERE restaurant_id = $id")->fetch();
  $yorumlar = $db->query("SELECT * FROM yorumlar INNER JOIN kullanicilar ON yorumlar.kullanici_id = kullanicilar.id WHERE restaurant_id = $id")->fetchAll();
  $puan = $db->query("SELECT ROUND(AVG(puan),2) FROM yorumlar WHERE restaurant_id = $id")->fetch()[0];
?>  

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Page</title>
    <style>
        body {
       
           
            background-color: #e84242;
        }
        .baslik {
            color: white;
            font-size: 40px;
            text-transform: uppercase;
            margin-bottom: 1rem;
            margin-left: 3rem;
            border-bottom: 0.1rem solid white;
            margin-right: 3rem;
            margin-top: 3rem;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .restaurant-info {
            text-align: center;
        }

        .info-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
        }

        .restaurant-image {
            width: 250px;
            height: 250px;
            border-radius: 50%;
            margin-right: 20px;
        }

        .text-info {
            text-align: left;
        }

        .menu-baslik {
            text-align: center;
            text-decoration: underline;
            margin-top: 30px;
            color: #333;
        }

        .menu-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
            height: 250px;
        }

        .menu-item {
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }

        .menu-item:hover {
            transform: scale(1.05);
        }

        .menu-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 10px 10px 0 0;
        }

        .menu-item-details {
            padding: 15px;
            text-align: left;
        }

        .radio-container {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .radio-container input {
            position: absolute;
            opacity: 0;
        }

        .checkmark {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 20px;
    height: 20px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(45deg, #4caf50, #66bb6a);
    color: #fff;
}

        .radio-container input:checked + .checkmark {
            background: linear-gradient(45deg, #ff5e6c, #ff9966);
        }

        .checkmark:after {
            content: '+';
            font-size: 14px;
        }

        .radio-container input:checked + .checkmark:after {
            content: '-';
        }

        .siparis-yorum {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-align: center;
            margin-top: 20px;
        }

        .siparis-yorum:hover {
            background-color: #218838;
        }
      
.user-comment-form {
    margin-top: 20px;
}

.user-comment-form .flex {
    display: flex;
    flex-direction: column;
    gap: 10px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.user-comment-form .flex .flex {
    display: flex;
    gap: 2px;
}

.user-comment-form select {
    width: 50px;
}

.user-comment-form textarea {
    border: 1px solid #ddd;
    padding: 5px;
    font-size: 14px;
    height: 150px;
}


.user-comment-form select {
    width: 100%;
    padding: 8px;
    font-size: 14px;
    border: 1px solid #ddd;
    border-radius: 5px;
}


.user-comments {
    margin-top: 24px;
    text-align: center;
    font-size: 2em;
    margin-bottom: 4px;
}

.user-comment {
    margin-top: 10px;
    font-size: 1.2em;
    background-color: #f8f9fa;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

.user-comment p {
    margin: 0;
}

.user-comment p:first-child {
    font-weight: bold;
}

.user-comment p:nth-child(2) {
    color: #777;
}



    </style>
</head>
<body>

<h1 class="baslik">Restoran İçeriği</h1>
    <div class="container">
        

        <div class="restaurant-info">
            <div class="info-container">
                <img class="restaurant-image" src="<?php echo $restaurant["foto"] ?>" alt="Restaurant Image">
                <div class="text-info">
                    <h1 class="restaurant-name"><?php echo $restaurant['isim']; ?></h1>
                    <p class="restaurant-rating">
                        <i class="fa-sharp fa-solid fa-star" style="color: #000000;"></i>
                        <?php echo $puan ? $puan : 0; ?> Yıldız
                    </p><br>
                    <p class="restaurant-contact">
                        <i class="fa-solid fa-envelope"></i> İletişim: <?php echo $restaurant['iletisim']; ?>
                    </p>
                    <p class="restaurant-address">
                        <i class="fa-solid fa-location-dot"></i> Adres: <?php echo $restaurant['adres']; ?>
                        <?php if($restaurant['cocuk_parki']== 1 )  : ?>
      <p><span class="text-lg">Çocuk Parkı Var </span></p>
      <?php endif ; ?>
                    </p>
                </div>
            </div>
        </div>

        <form method="post" action="siparis.php"><br>
        <h1 class="menu-baslik">MENÜLER</h1>
            <div class="menu-container">
                <?php $menuler = $db->query("SELECT * FROM menuler WHERE restaurant_id=$id"); ?>
                <?php foreach($menuler as $menu) { ?>
                    <div class="menu-item">
                        <img src="<?php echo $menu['foto'] ?>" alt="<?php echo $menu['isim']; ?>">
                        <div class="menu-item-details">
                            <p><?php echo $menu['isim']; ?></p>
                            <p><?php echo $menu['fiyat']; ?> TL</p><br>
                            <label class="radio-container">
                                <input type="checkbox" value="<?php echo $menu['menu_id'] ?>" name="menu[]">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                <?php } ?>
            </div><br><br>
            <?php if(isset($_SESSION['id'])) { ?>
            <button type="submit" class="siparis-yorum" name="siparis">Sipariş Et</button>
            <input type="hidden" name="restaurant_id" value="<?php echo $id ?>">
            <?php } ?>
            <br><br>
        </form>
        
        <?php if(isset($_SESSION['id']) && $_SESSION['id'] != "") { ?>
    <form method="post" class="user-comment-form">
        <div class="flex">
            <div>
                Puanınız:
                <select name="puan">
                    <option value="5">5</option>
                    <option value="4">4</option>
                    <option value="3">3</option>
                    <option value="2">2</option>
                    <option value="1">1</option>
                </select>
            </div>
            <textarea name="yorum"></textarea>
        </div>
        
        <button class="siparis-yorum" name="yap">Yorum yap</button>
    </form>
<?php } ?> 

<p class="user-comments">Diğerleri ne düşünüyor??</p>
<?php foreach($yorumlar as $yorum) { ?>
    <div class="user-comment">
        <p><?php echo $yorum['kullanici_adi']; ?>:</p>
        <p><i class="fa-sharp fa-solid fa-star" style="color: #000000;"></i> <?php echo $yorum['puan'] ?> Yıldız</p>
        <p><?php echo $yorum['yorum']; ?></p>
    </div>
<?php } ?>
</div>

    
    
</body>
</html>



<?php
  require_once "db.php";

  if($_SERVER['REQUEST_METHOD'] != "POST" || !isset($_POST['yap']))
    return;

  $yorum = $_POST['yorum'];
  $puan = $_POST['puan'];
  $kullaniciId = $_SESSION['id'];

  $db->exec("INSERT INTO yorumlar (yorum, kullanici_id, restaurant_id, puan) VALUES ('$yorum', '$kullaniciId', '$id', '$puan') ON DUPLICATE KEY UPDATE yorum = '$yorum', puan = '$puan'");
 
 


?>