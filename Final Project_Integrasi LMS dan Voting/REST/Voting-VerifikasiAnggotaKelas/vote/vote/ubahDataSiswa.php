<?php
include "install.php";
include  'function.php' ;
// $siswa =  query(" SELECT * FROM siswa ") ;
$nisn = $_GET["nisn"];
var_dump($nisn);
$query = "SELECT * FROM siswa WHERE nisn =$nisn";
$siswa =tampil($query);
var_dump(ubah($_POST,$nisn));

if (isset($_POST["edit"])) {
   if (ubah($_POST,$nisn) > 0 ) {
         echo"
        
                  <script>
                  alert('DATA BERHASIL DIUBAH');
                  document.location.href = 'siswa.php';
                  </script>
         ";
   }
  // else{
  //   echo"
        
  //                 <script>
  //                 alert('BELUM BERHASIL DIUBAH');
  //                 document.location.href = 'siswa.php';
  //                 </script>
  //        ";
  //  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Material Design for Bootstrap</title>
    <!-- MDB icon -->
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
    <!-- Google Fonts Roboto -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
    />
    <!-- Start your project here-->
    <div class="container">
      <div class="d-flex justify-content-center align-items-center" style="height: 100vh">
        <div class="text-center">
    <link rel="stylesheet" href="css/mdb.min.css" />
  </head>
  <body style="background-image: url(img/bgradmin.png);">
        <header>
    <div class="container d-flex justify-content-center align-items-center mt-5">
          <div class="row text - center">
                <div class="col-lg-12">
                   <p class="fw-bold">Tambah Data Siswa</p>
                </div>
                <div class="col-lg -12">
                    <form action="" method="post" class="d-grid gap-3">

                      <?php foreach($siswa as $s):?>
                      <!-- nisn -->
                    <div>
                            <input id="nisn" name="nisn" class="form-control" required value="<?php echo $s["nisn"];?>"/>
                    </div>

                    <!-- fullname -->
                    <div class="form-outline bg-info bg-light bg-gradient text dark border border-secondary" data-mdb-input-init>
                          <input type="text" id="fullname" name="fullname" class="form-control" value="<?php echo $s["fullname"];?>" required />
                          <label class="form-label" for="fullname">Nama</label>
                      </div>

                      <!-- kelas -->
                      <div class="form-outline bg-info bg-light bg-gradient text dark border border-secondary" data-mdb-input-init>
                          <input type="text" id="kelas" name="kelas" class="form-control"  value="<?php echo $s["kelas"];?>" required />
                          <label class="form-label" for="kelas">Kelas</label>
                      </div>

                      <!-- status -->
                      <div class="form-outline bg-info bg-light bg-gradient text dark border border-secondary" data-mdb-input-init>
                          <select class="form-control" name="status" id="status">
                                <option name="status" value="belum voting">Belum Voting</option>
                                <option name="status" value="sudah voting">Sudah Voting</option>
                          </select>
                      </div>

                      <!-- token -->
                      <div class="form-outline bg-info bg-light bg-gradient text dark border border-secondary" data-mdb-input-init>
                          <input type="text" id="token" name="token" class="form-control" value="<?php echo $s["token"];?>" readonly />
                          <label class="form-label" for="token">token</label>
                      </div>
                      <div>
                        <button type="submit" name="edit">UBAH</button>
                      </div>
                      <?php endforeach;?>
                    </form>
                </div>
          </div>
          
    </div>
    <!-- End your project here-->

    <!-- MDB -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
  </body>
</html>
