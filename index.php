<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Sholat</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <center>
        <h2>Jadwal Sholat Imsakiyah</h2>
    </center>

    <?php
    $api_url = 'https://api.myquran.com/v2/sholat/kota/semua';

    //membaca JSON dari url
    $kota = file_get_contents($api_url);
    //decode data JSON data menjadi array PHP
    $response_kota = json_decode($kota);
    //mengakses data yang ada dalam object 'data'
    $list_kota = $response_kota -> data;

    if(isset($_GET['kota'])){
        $kota_terpilih = $_GET['kota'];
    }
    else {
        $kota_terpilih = '0119';
    }
    ?>
	<center>
 <form method="get" action="">
     <select name="kota" onchange="this.form.submit()">
         <?php 
         foreach($list_kota as $k){
             ?>
             <option <?php if($kota_terpilih == $k->id){ echo "selected='selected'";} ?> value="<?php echo $k->id ?>"><?php echo $k->lokasi ?></option>
             <?php
         }
         ?>
     </select>
 </form>
</center>
<br>		
<br>
<div class="kotak">
    <div class="imsakiyah">
        <table>
            <tr>
                <th width="200px">Tanggal</th>
                <th>Imsak</th>
                <th>Subuh</th>
                <th>Dzuhur</th>
                <th>Ashar</th>
                <th>Maghrib</th>
                <th>Isya</th>
            </tr>
            <?php
            //tentukan bulan puasa
            $api_url = 'https://api.myquran.com/v2/sholat/jadwal/'.$kota_terpilih.'/2024/3';
            //membaca JSON dari url
            $json_data = file_get_contents($api_url);
            //decode data JSON data menjadi array PHP
            $response_data = json_decode($json_data);
            //mengakses data yang ada dalam object 'data'
            $jadwal_shalat = $response_data -> data;
            foreach($jadwal_shalat -> jadwal as $jadwal){
                ?>
                <tr>
                    <th><?php echo $jadwal -> tanggal; ?></th>
                    <td><?php echo $jadwal -> imsak; ?></td>
                    <td><?php echo $jadwal -> subuh; ?></td>
                    <td><?php echo $jadwal -> dzuhur; ?></td>
                    <td><?php echo $jadwal -> ashar; ?></td>
                    <td><?php echo $jadwal -> maghrib; ?></td>
                    <td><?php echo $jadwal -> isya; ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>
</body>
<script>
    document.cookie = "namaCookie=nilaiCookie; expires=Thu, 31 Dec 2024 23:59:59 UTC; path=/";
    function setCookie(nama, nilai, hari) {
        const date = new Date();
        date.setTime(date.getTime() + (hari * 24 * 60 * 60 * 1000));
        const expires = "expires=" + date.toUTCString();
        document.cookie = nama + "=" + nilai + ";" + expires + ";path=/";
    }

    setCookie("user", "Budi", 7);
</script>
</html>