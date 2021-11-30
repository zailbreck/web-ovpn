<?php
/*
Err101 = Server Error
Err102 = Login Error



*/
//Hide All Error
error_reporting(0);
ini_set('display_errors', 0);


include 'vendor/autoload.php';



function createAccount($NIM){
    $host = '192.168.11.183';
    $port = 22;
    $timeout = 3;
    $username = 'vpn';
    $password = 'vpn903';
    // Cek Koneksi Tersedia Atau Tidak ?
    $fsock = fsockopen($host, $port, $errno, $errstr, $timeout);
    if (!$fsock) {
        //Jika Koneksi Tidak Tersedia
        print_r($fsock);
        return "Err101";
    }else{ //Jika Koneksi Tersedia
        // Cek Sambungan SSH
        $ssh = new \phpseclib3\Net\SSH2($host, $port);

        // Cek Status Login ke SSH
        if (!$ssh->login($username, $password)) {
            //Jika Login gagal 
            print_r("102");
            return "Err102";
        }else{
            $ssh->exec('cd ~/');
            $ssh->exec("./createUser.sh '".$NIM."'");
            echo "<b>Download ur File in Here <a href=config/".$NIM.".ovpn>".$NIM.".ovpn</a></b>";
        }
    }
}

if(!empty($_POST['nim'])){ // Cek apakah parameter tidak kosong
    $nim_mhs = $_POST['nim']; // assign nilai dari parameter kedalam variabel
    if(!strpos($nim_mhs, ' ')){ // cek apakah variable mengandung space (spasi)
        createAccount($nim_mhs);
    }else{
        echo "Error : Tidak Boleh ada Spasi"; //Tampilkan error Jika Ada Spasi
    }
}else{
    echo "Error : NIM Wajib Diisi!"; // Tampilkan Error Jika form kosong
}






?>