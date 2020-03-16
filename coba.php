<html>
<head>
    <title>Penjumlahan</title>
    
</head>
<body>
    <?php

    $koneksi = mysqli_connect("localhost","root","","calculator");

    if (mysqli_connect_errno()){
    echo "Gagal melakukan koneksi ke MySQL: " . mysqli_connect_error();
    }
    ?>

    <form method="post" action="">   

        <h2 class="judul">Penjumlahan 10 Kali</h2>
       
             
            <input type="number" name="a" class="bil" placeholder="Masukan Nilai" required/>
            <input type="number" name="b" class="bil" placeholder="Masukan Nilai" required/><br>
            
            <input type="submit" name="hitung" value="Hitung" class="tombol"><br>
            
            Hasil Akhir:
    <?php 
    if(isset($_POST['hitung'])){
        $a = $_POST['a'];
        $b = $_POST['b'];
         $c = $a + $b;
         if($c<0){
                    $ket='D';
                } elseif(0<=$c && 10>=$c){
                    $ket='A';
                }elseif(10<$c && 20>=$c) {
                    $ket='B';

                } else{
                    $ket='C';

                }
        
    
    for($i=0;$i<=10;$i++){
                $a=$b;
                $b=$c;
                $c=$a+$b;
                if($c<0){
                    $ket='D';
                } elseif(0<=$c && 10>=$c){
                    $ket='A';
                }elseif(10<$c && 20>=$c) {
                    $ket='B';

                } else{
                    $ket='C';

                }

        
            
            $sql = mysqli_query($koneksi, "INSERT INTO hitung (a, b, c, ket) VALUES('$a', '$b', '$c','$ket')") or die(mysqli_error($koneksi));

            }
            echo "<br><input type='text' value=$c>";
            
        }
    ?>
     
                                            
    
     </form>

<form method="post" action="">
     <?php 
    if(isset($_POST['reset'])){
        $sql = mysqli_query($koneksi, "TRUNCATE hitung") or die(mysqli_error($koneksi));


    }
    ?>
     <input type="submit" name="reset" value="Reset" class="tombol"> <br>
</form>

<table border="1" width="60%">
    <tr>
        <th>No</th>
        <th>A</th>
        <th>B</th>
        <th>Hasil</th>
        <th>Ket</th>
    </tr>
    <tbody>
    <?php
        $sql = mysqli_query($koneksi, "Select * from hitung");
        if(mysqli_num_rows($sql) > 0){
            $no = 1;
            while($yaw = mysqli_fetch_assoc($sql)){
                echo '
                <tr>
                <td>'.$no++.'</td>
                <td>'.$yaw['a'].'</td>
                <td>'.$yaw['b'].'</td>
                <td>'.$yaw['c'].'</td>
                <td>'.$yaw['ket'].'</td>
                
                </tr>
                ';

                }
                //jika query menghasilkan nilai 0
                }else{
                echo '
                <tr>
                <td colspan="5">Tidak ada data.</td>
                </tr>
                ';
                }
            
        ?>
<tbody>
</table>

</body>
</html>