<?php 
  require_once "session.php";
  require_once "db.php";
?>

<html> 
<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;500;600&display=swap');
  .logo img{
    height: 4rem;
} 
*{
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    outline: none;
    border: none;
    text-decoration: none;
   
    transition: 0.3s ease;
     text-transform: none;
}


/* header kodları */
.header{
    background-color: white;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 7%;
    margin: 2rem 7%;
    border-radius: 30rem;
    box-shadow: 0px 0px 17px -2px rgba(0,0,0,0.75);
    position: sticky;
    top: 2rem;
    z-index: 1000;
}
.header .navbar a{
    margin: 0.5rem;
    font-size: 16px;
    color: black;
    border-bottom: 0.1rem solid transparent;
    

    
    
}
.header .buttons form {
    display: inline-block;
    vertical-align: middle;
}
.header .navbar a:hover{
    border-color: #E84242;
    padding-bottom: 0.2rem;
  
  
}

.header .navbar .active{
    border-color: #E84242;
    padding-bottom: 0.2rem;
}
.header .buttons button{
    cursor: pointer;
    font-size: 1.1rem;
    margin-left: 1rem;
    background-color: transparent;
    
}
.dropdown {
    position: relative;
    display: inline-block;
}


.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
   
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {
    background-color: red;
}

.dropdown:hover .dropdown-content {
    display: block;
}
.header .navbar form {
    display: inline-block;
    vertical-align: middle;}
    .searchbar input{
   margin-left: 2%;
  
width:60%;
}
.searchbar
{

    
    border: 2px solid;
    border-color: black;
    width: 300px;
   
    border-radius: 30rem;
      
   
    margin-left: auto;
    
    background-color: white;
}
.searchbar button{
  margin-left: 12px;
}
.ara {
  border-radius: 24px;
  background-color: #34e0a1;
  width:96px;
  height: 30px;
  margin-left: 100px;
  text-align: left;
 
.ara:hover{
background-color: #80ffd0;
  
}


</style>    


<body>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<header class="header"> 
    <a href="anasayfa.php" class="logo">
        <img src="pics/logoo.png" alt="logo" width="80px">
    </a>

<div class="navbar">
  
  <a href="anasayfa.php">Ana sayfa</a>
  
  
  <form action="ara.php">
  <div class="searchbar">
    
    <input type="text" name="q" placeholder="Restoran ara..." required >
    
    <button class="ara">Ara
    <input id="cocukParki" type="checkbox" name="cocukParki" class="jojik" value="1">
    </button>
  
   
</div>

    </form>
    <?php if(!empty($_SESSION['id'])) { ?>
    <?php $kullanici = $db->query("SELECT * FROM kullanicilar WHERE id = " . $_SESSION['id'])->fetch() ?>
    
    
    <?php if($kullanici['tur'] == 'yonetici') { ?>
      <div class="dropdown">
    
      <a>Restoran Yonetim</a>
      <div class="dropdown-content">
          
            <a href="yonetimEkle.php">Restoran Ekle</a>
            <a href="yonetimMenu.php">Menü Ekle</a>
            <a href="yonetim.php">Rezervasyonlar</a>
          

  
        </div>
      </div>
    <?php } ?>
  <?php } else { ?>
    
  <?php } ?>
  <?php if(!empty($_SESSION['id'])) { ?>
  <?php $kullanici = $db->query("SELECT * FROM kullanicilar WHERE id = " . $_SESSION['id'])->fetch() ?>
    
    <?php if($kullanici['tur'] == 'admin') { ?> 
      <div class="dropdown">
  <a>Admin Yönetim</a> 
  <div class="dropdown-content">
  <a href="admin.php">Restoran Ekle</a> 
          <a href="adminRest.php">Restoranlar Listesi</a>
          <a href="adminUser.php">Üyeler Listesi</a>
         
          
      
      </div></div>
  <?php } ?>
  <?php } else { ?>
    
  <?php } ?>
</div>

<div class="buttons">

<?php if(!empty($_SESSION['id'])) { ?>
  <?php $kullanici = $db->query("SELECT * FROM kullanicilar WHERE id = " . $_SESSION['id'])->fetch() ?>
        <button>
        <?php echo $kullanici['cuzdan'] ?> ₺ <?php } ?> <i class="fa-solid fa-wallet"></i></i>
        </button>
        
        <div class="dropdown">
        <button class="dropdown-btn">
            <i class="fa-solid fa-user"></i>
        </button>
        
        <div class="dropdown-content">
          
            <a href="giris.php">Giriş Yap</a>
            <a href="kayitol.php">Kayıt Ol</a>
          

  
        </div>
    </div>
       
        <form method="post" action="cikis.php">
          <button name="cikis">
          <i class="fa-solid fa-right-from-bracket"></i>
          </button>
         
          </form>
        
    </div>
</header>
</body>
</html>
