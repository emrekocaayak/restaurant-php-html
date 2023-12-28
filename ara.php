<html>
  <head>
  <style>
        body {
            background-color: #e84242;
      asdadada
         
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
        .restaurantcard {
            display: inline-block;
            flex-wrap: wrap;
            justify-content: space-around;
            box-shadow: 2px 2px 20px black;
            border-radius: 5px;
            margin: 2%;
            margin-left: 3rem;
            width: 20%;
            height: 550px;
            text-transform: none;
            background-color: white;
            border-radius: 30px;
        }

        .restaurantfoto {
            width: 100%;
            height: 350px;
            border-radius: 30px;

        }

        .title {
            text-align: center;
            padding: 10px;
            color: black;
        }

        .title h1 {
            font-size: 20px;
        }

        .des {
            padding: 3px;
            text-align: center;
            padding-top: 10px;
            border-bottom-right-radius: 5px;
            border-bottom-left-radius: 5px;
        }

        .desbutton {
            margin-top: 40px;
            background-color: white;
            border: 1px solid black;
            border-radius: 5px;
            padding: 10px;
        }

        button:hover {
            background-color: black;
            color: white;
            transition: 0.5s;
            cursor: pointer;
        }

        </style>

   
  </head>
  <body>
    <?php include "nav.php"; ?>
    
      </form>
      <h1 class="baslik">Eşleşen Restoranlarımız</h1>
        <?php
          require_once "db.php";

          if(!isset($_GET['q']) || empty($_GET['q']))
            return;

          $q = $_GET['q'];
          $resturantlar = $db->query("SELECT * FROM restaurant WHERE isim LIKE '%$q%'");
        ?>
        <?php if($resturantlar->rowCount() == 0) { ?>
          <p>Aradığınız restoran bulunamadı.</p>
        <?php } else { ?>
      
        <?php foreach($resturantlar as $restaurant) { ?>
          <div class="restaurantcard">
                    <div class="image">
                        <img class="restaurantfoto" src="<?php echo $restaurant["foto"] ?>">
                    </div>
                    <div class="title">
                        <h1><?php echo $restaurant["isim"] ?></h1>
                    </div>
                    <div class="des">
                        <?php $puan = $db->query("SELECT ROUND(AVG(puan),2) FROM yorumlar WHERE restaurant_id = $restaurant[restaurant_id]")->fetch()[0]; ?>
                        <p><i class="fa-sharp fa-solid fa-star" style="color: #000000;"></i> <?php echo $puan ? $puan : 0 ?> Yıldız</p>
                        <p><i class="fa-sharp fa-solid fa-location-dot" style="color: #000000;"> </i> <?php echo $restaurant["adres"] ?></p>
                        <a href=<?php echo "restaurant.php?id=" . $restaurant["restaurant_id"] ?>><button
                                class="desbutton" href="restaurant.php">Restorana git...</button></a>
                    </div>
                </div>
          <?php }} ?>
       
      </div>
    </div>
  </body>
</html>
