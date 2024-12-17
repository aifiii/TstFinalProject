<?php
session_start();
include "navbar.php";
include "../function.php";
if(!isset($_SESSION["nisn"])){
  header("Location: ../index.php");
}
var_dump($_SESSION["nisn"]);
$nisn = (int)$_SESSION["nisn"];
// var_dump(vote($_SESSION["nisn"]),$_POST);
$query = "SELECT * FROM kandidat";
$tampil = tampil($query);
if(isset($_POST["submit"])){
  if((vote($nisn, $_POST))>0){
    echo"
    <script>
    document.location.href='../index.php';
    </script>
    ";
  };
}
?>
<div class="d-flex container gap-5 min-vh-100 align-items-center">
    <?php foreach($tampil as $t):?>
<div class="card gap-2">
    <form action="" method="post">
  <div class="bg-image hover-overlay" data-mdb-ripple-init data-mdb-ripple-color="light">
    <img  src="../img/<?php echo $t["foto"] ?>" class="img-fluid"/>
    <a href="#!">
      <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
    </a>
  </div>
  <div class="card-body">
    <h5 class="card-title"><?php echo $t["fullname"] ?></h5>
    <p class="card-text">visi : <?php echo $t["visi"] ?></p>
    <p class="card-text">misi : <?php echo $t["misi"] ?></p>
    <button class="btn btn-primary" name="submit" value="<?php echo $t["suara"];?>">
    PILIH!
    </button>
  </div>
    </form>
</div>
        <?php endforeach;?>
</div>