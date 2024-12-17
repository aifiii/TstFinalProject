<?php
include "navbar.php";
include "../function.php";
$nisn = $_GET["nisn"];
$query = "SELECT * FROM siswa WHERE nisn=$nisn";
$tampil = tampil($query);

if(isset($_POST["submit"])){
    if((ubah($_POST,$nisn))>0){
        echo "
        <script>
        alert('berhasil mengubah data');
        document.location.href='menampilkan.php';

        </script>
        ";
        }
        
    }
?>
<form class="container d-flex flex-column align-items-center mt-5
w-50 p-5 shadow-4"
action="" method="post">
    <h3>MENGUBAH DATA SISWA</h3>
    <?php foreach($tampil as $t):?>
  <!-- nisn input -->
  <div data-mdb-input-init class="form-outline mb-4">
    <input type="text" id="form1Example1" class="form-control" 
    name="nisn" value="<?php echo $t["nisn"];?>"/>
    <label class="form-label" for="form1Example1">nisn</label>
  </div>

  <!-- fullname input -->
  <div data-mdb-input-init class="form-outline mb-4">
    <input type="text" id="form1Example2" class="form-control" 
    name="fullname" value="<?php echo $t["fullname"];?>"/>
    <label class="form-label" for="form1Example2">fullname</label>
  </div>

  <!-- kelas input -->
  <div data-mdb-input-init class="form-outline mb-4">
    <input type="text" id="form1Example2" class="form-control" 
    name="kelas" value="<?php echo $t["kelas"];?>"/>
    <label class="form-label" for="form1Example2">kelas</label>
  </div>

  <!-- token input -->
  <div data-mdb-input-init class="form-outline mb-4">
    <input type="text" id="form1Example2" class="form-control"
    name="token" value="<?php echo $t["token"];?>" readonly/>
    <label class="form-label" for="form1Example2">token</label>
  </div>

  <!-- status input -->
  <div data-mdb-input-init class="form-outline mb-4">
    <select name="status" id="status"" value="<?php echo $t["status"];?>">
        <option name="belum voting" value="belum voting">belum voting</option>
        <option name="sudah voting" value="sudah voting">sudah voting</option>
    </select>
  </div>

  <!-- Submit button -->
    <button data-mdb-ripple-init type="submit" name="submit" class="btn btn-primary btn-block w-25">
    submit    
    </button>
    <?php endforeach;?>
</form>