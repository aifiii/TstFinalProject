<?php
include "navbar.php";
include "../function.php";

$nama_paslon = mysqli_query($conn,"SELECT fullname FROM kandidat");
$namapaslon = [];
while($data = mysqli_fetch_assoc($nama_paslon)){
    $namapaslon[]=$data;
}
// var_dump($namapaslon);
$nama_paslon = json_encode($namapaslon);
echo"<br>";
// var_dump($nama_paslon);

//suara hasil
$suara = [];
for($i=1;$i<=3;$i++){
    $count_paslon=mysqli_query($conn,"SELECT COUNT(suara) AS paslon$i FROM siswa WHERE suara=$i");
    $paslon = mysqli_fetch_assoc($count_paslon);
    $suara[] = $paslon;
}
// var_dump($suara);
$hasil = json_encode($suara);
echo"<br>";
?>
<!DOCTYPE html>
<html>

    <body >
    <div class="min-vh-100" style="width: 600px; height:auto; margin:auto; ">
        <h1 class="text-center m-5">HASIL PEMILIHAN</h1>
        <br>

    <div>
        <canvas id="myChart" "></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');
    //hasil pemilihan
    const data = <?php echo $hasil;?>;
    
    let paslon1=data[0].paslon1
    let paslon2=data[1].paslon2
    // console.log(paslon2)
    let paslon3=data[2].paslon3
    const hasil = [paslon1,paslon2,paslon3]

    //nama paslon
    const namaPaslon = <?php echo $nama_paslon;?>;
    console.log(namaPaslon[0].fullname)
    let nama_paslonn = []
    for(let i=0;i<=2; i++){
    let paslon = []
    let nama_paslon=namaPaslon[i].fullname
    paslon.push(nama_paslon)
    nama_paslonn.push(paslon)
    }
    console.log(nama_paslonn)

    let paslon = nama_paslonn
    new Chart(ctx, {
        type: 'bar',
        data: {
        labels: paslon,
        datasets: [{
            label: 'hasil Pemilu',
            data: hasil,
            borderWidth: 1
        }]
        },
        options: {
        scales: {
            y: {
            beginAtZero: true
            }
        }
        }
    });
    </script>
</div>


    </body>
</html>