<?php
include "navbar.php";
include "../function.php";
if(isset($_POST["submit"])){
    if((tambah($_POST))>0){
        echo "
        <script>
        alert('berhasil');
        document.location.href='menampilkan.php';

        </script>
        ";
        }
    }
//token
$acak = random_bytes(5);
$token = bin2hex($acak);
?>
<form class="container min-vh-100 d-flex flex-column align-items-center mt-5"
action="" method="post">
    <h3>TAMBAH DATA SISWA</h3>
  <!-- nisn input -->
  <div data-mdb-input-init class="form-outline mb-4">
    <input type="text" id="form1Example1" class="form-control" 
    name="nisn"/>
    <label class="form-label" for="form1Example1">nisn</label>
  </div>

  <!-- fullname input -->
  <div data-mdb-input-init class="form-outline mb-4">
    <input type="text" id="form1Example2" class="form-control" 
    name="fullname"/>
    <label class="form-label" for="form1Example2">fullname</label>
  </div>

  <!-- kelas input -->
  <div data-mdb-input-init class="form-outline mb-4">
    <input type="text" id="form1Example2" class="form-control" 
    name="kelas"/>
    <label class="form-label" for="form1Example2">kelas</label>
  </div>

  <!-- token input -->
  <div data-mdb-input-init class="form-outline mb-4">
    <input type="text" id="form1Example2" class="form-control"
    name="token" value="<?php echo $token;?>" readonly/>
    <label class="form-label" for="form1Example2">token</label>
  </div>

  <!-- status input -->
  <div data-mdb-input-init class="form-outline mb-4">
    <select name="status" id="status"">
        <option name="belum voting" value="belum voting">belum voting</option>
        <option name="sudah voting" value="sudah voting">sudah voting</option>
    </select>
  </div>

  <!-- Submit button -->
    <button data-mdb-ripple-init type="submit" name="submit" class="btn btn-primary btn-block w-25">
    submit    
    </button>

</form>