<?php
include "navbar.php";
include "../function.php";
$query = "SELECT * FROM siswa";
$tampil = tampil($query);

//hapus

?>
<button class="btn btn-success mt-5 ms-5 ms-5 ">
    <a class=" text-light text-decoration-none" href="menambah.php">
        tambah data
    </a>    
</button>
<table class="table mx-auto mt-5  shadow-4 w-75">
  <thead>
    <tr>
      <th scope="col">nisn</th>
      <th scope="col">fullname</th>
      <th scope="col">kelas</th>
      <th scope="col">token</th>
      <th scope="col">status</th>
      <th scope="col">aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($tampil as $t):?>
    <tr>
      <th scope="row"><?php echo $t["nisn"];?></th>
      <td><?php echo $t["fullname"];?></td>
      <td><?php echo $t["kelas"];?></td>
      <td><?php echo $t["token"];?></td>
      <td><?php echo $t["status"];?></td>
      <td>
        <button class="btn btn-warning" >
            <a class="text-decoration-none text-light" 
            href="mengubah.php?nisn=<?php echo $t["nisn"]?>">
                ubah
            </a>
        </button>
        |
        <button class="btn btn-danger">
            <a class="text-decoration-none text-light" 
            href="menghapus.php?nisn=<?php echo $t["nisn"]?>">
                hapus
            </a>
        </button>
      </td>
    </tr>
    <?php endforeach;?>
    
  </tbody>
</table>