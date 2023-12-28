<?php
  include "nav.php";
  require_once "db.php";
  $resturantlar = $db->query("SELECT * FROM restaurant");
?>

<html>
  <head>
    
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

         .desbutton:hover {
            background-color: black;
            color: white;
            transition: 0.5s;
            cursor: pointer;
        }
        .review .box-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(30rem, 1fr));
 
  margin: 3%;
  margin-left: 6rem;
  height: 560px;
}

.review .box-container .box {
  border: var(--border);
  text-align: center;
  padding: 2rem;
  background-color: #fff;
  border-radius: 3rem;
  width: 90%; 
height: 560px;
}

.review .box-container .box p {
  font-size: 1rem;
  line-height: 1.8;
}
.review .box-container .box .user {
  height: 7rem;
  width: 7rem;
  border-radius: 50%;
  object-fit: cover;
}

.review .box-container .box h3 {
  font-size: 1.5rem;
  color: var(--main-color);
}

.review .box-container .box .stars i {
  font-size: 1rem;
  color: gold;
}


      
        .footerbaslik
        {
          
          font-size: 34px;
            text-transform: uppercase;
            color: white;
            text-align: center;
            position: relative;
            

        }
        .footer {
  background-color: black;
  color: #fff;
  text-align: center;
  padding: 10px;
}
.animated-text{
    font-size: 34px;
    font-weight: 600;
    min-width: 280px;
    text-align: center;
}

.animated-text span{
    position: relative;
}

.animated-text span::before{
    content: "Emre Kocaayak";
    color: #e84242;
    animation: words 20s infinite;
}

.animated-text span::after{
    content: "";
    position: absolute;
    width: calc(100% + 8px);
    height: 100%;
    background-color: black;
    border-left: 2px solid white;
    right: -8px;
    animation: cursor .8s infinite, typing 20s steps(14) infinite;
}

@keyframes cursor {
    to{
        border-left: 2px solid white;
    }
}

@keyframes words {
    0%,20%{
        content: "Emre Kocaayak";
    }
    21%,40%{
        content: "Azra Akdoğan";
    }
    41%,60%{
        content: "Batın Sucu";
    }
    61%,80%{
        content: "Serhat Türker";
    }
    81%,100%{
        content: "Semih Mutafoğlu";
    }
}

@keyframes typing {
    10%,15%,30%,35%,50%,55%,70%,75%,90%,95%{
        width: 0;
    }
    5%,20%,25%,40%,45%,60%,65%,80%,85%{
        width: calc(100% + 8px);
    }
}

    </style>
</head>

<body>
    <section class="restoranlar">
        <h1 class="baslik">Restoranlarımız</h1>
        
            <?php foreach ($resturantlar as $restaurant) { ?>
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
            <?php } ?>
     
    </section>
    <section class="review"  id="review">
        <h1 class="baslik">site hakkında Yorumlar</h1>
    
     
      <div class="box-container">
        <div class="box">
          <img src="pics/yorumicon.png" alt="quote" />
          <p>
           Kendi dışkım yedim, ineklerinkini de tattım, orda dağda bulunan dağ keçilerinkini de tattım ama bu sitedeki yemekler daha güzel
          </p>
          <br>
          <img src="pics/celal.jpeg" alt="avatar" class="user" />
    
          <h3>Celal Şengör</h3>
          <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
          </div>
        </div>
        <div class="box">
          <img src="pics/yorumicon.png" alt="quote" />
          <p>
          Oyyyyy Omaygatttt Bu Nasıl Domates Çoğbasıı böyyleeee
          </p>
          <br>
          <br>
          <img src="pics/domates.png" alt="avatar" class="user" />
          <h3>Domates Çorbası Kadını</h3>
          <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
          </div>
        </div>
        <div class="box">
          <img src="pics/yorumicon.png" alt="quote" />
          <p>
        
Bazı restoranlardaki yemekleri yurtdışında denediğimle karşılaştırdığımda, yeterince iyi bulamadım. Ancak, bu siteyi düzenli olarak kullanıyorum çünkü çok güzel.
          </p>
          <br>
          <img src="pics/vedatmilor.jpeg" alt="avatar" class="user" />
          <h3>Vedat Milor</h3>
          <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
          </div>
        </div>
      </div>
    </section>
    <h1 class="baslik"></h1>
    <section>
   
      <footer class="footer">
    <h1 class="footerbaslik">Emeği Gecenler</h1>
    <div class="animated-text">
           <span></span>
    </div>
      </footer>
    </section>
  </body>
</html>