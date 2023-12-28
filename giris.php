<html>
  <head>
   
    <style>
body{
   
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    background-color: #e84242;
}
.center{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 400px;
    background: white;
    border-radius: 10px;
    box-shadow: 2px 2px 20px black;
}

.center h1{
    text-align: center;
    padding: 0 0 20px 0;
    border-bottom: 1px solid silver;
}

.center form{
    padding: 0 40px;
    box-sizing: border-box;
}

form .txt_field {
    position: relative;
    
    margin: 30px 0;
}

.txt_field input{
    width: 100%;
    padding: 0 5px;
    height: 40px;
    font-size: 16px;
    border: none;
    background: none;
    outline: none;
}

.txt_field label{
    position: absolute;
    top: 50%;
    left: 5px;
    color: #adadad;
    transform: translateY(-50%);
    font-size: 16px;
    pointer-events: none;
    transition: .5s;
}

.txt_field span::before{
    content: '';
    position: absolute;
    top: 40px;
    left: 0;
    width: 0%;
    height: 2px;
    background: #007bff;
    transition: .5s;
}

.txt_field input:focus ~ label,
.txt_field input:valid ~ label{
    top: 5px;
    color: black;
}

.txt_field input:focus ~ span::before,
.txt_field input:valid ~ span::before{
    width: 100%;
}

input[type="submit"]{
    width: 100%;
    height: 50px;
    border: 1px solid;
    background: #007bff;
    border-radius: 25px;
    font-size: 18px;
    color: white;
    font-weight: 700;
    cursor: pointer;
    outline: none;
}

input[type="submit"]:hover{
    border-color: #579BB1;
    transition: .5s;
}

.signup_link{
   margin: 30px 0; 
   text-align: center;
   font-size: 16px;
   color: #666666;
}

.signup_link a{
    color: #579BB1;
    text-decoration: none;

}

.signup_link a:hover{
    text-decoration: underline;

}


      </style>

  </head>
  <body>
    <?php include "nav.php"; ?>
    <form method="post" class="mx-auto flex flex-col w-fit mt-4 gap-4">
    <div class="center">
        <h1>Giriş Yap</h1>
        <!---->
        <form method="post">
            <div class="txt_field">
                <input type="text" name="kullanici_adi" required>
                <span></span>
                <label>Kullanıcı Adı</label>
            </div>
            <!---->
            <div class="txt_field">
                <input type="password" name="sifre" required>
                <span></span>
                <label>Şifre</label>
            </div>
            <!---->
            <input type="submit" name="giris" value="Giriş">
            <div class="signup_link">
                Üye değil misiniz? <a href="kayitol.php">Kayıt olun</a>
            </div>
        </form>
        <!---->
    </div>
    </form>
    
  </body>
</html>

<?php 
  require_once "db.php";
  require_once "session.php";

  if($_SERVER['REQUEST_METHOD'] != "POST" || !isset($_POST["giris"]))
    return;
  

    
  $kullanici_adi=$_POST["kullanici_adi"];
  $sifre=$_POST["sifre"];

  $kullanici=$db->query("SELECT * FROM kullanicilar WHERE kullanici_adi ='$kullanici_adi'")->fetch();
  if($kullanici['id'] == "")
  {
      echo "Kullanıcı Bulunamadı";
      return;
  }
  
  if($kullanici_adi == $kullanici['kullanici_adi'] and $sifre == $kullanici['sifre'])
  {
      $_SESSION["id"] = $kullanici['id'];
      echo "<script>alert('Hoşgeldin, " . $kullanici['kullanici_adi'] . "'); window.location.href = 'anasayfa.php';</script>";
      
  }
?>