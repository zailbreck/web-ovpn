<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'phpseclib1.0.19');
include('Net/SSH2.php');

$host = '192.168.11.183';
$port = 22;
$username = 'vpn';
$password = 'vpn903';

if(!empty($_POST['nim'])){ // Cek apakah parameter tidak kosong
    $nim_mhs = $_POST['nim']; // assign nilai dari parameter kedalam variabel
    if(!strpos($nim_mhs, ' ')){ // cek apakah variable mengandung space (spasi)
        $script = "sshpass -p 'vpn903' vpn@192.168.11.183 'cd ~/ ; ./createUser.sh ".$nim_mhs."'";
        $connection = ssh2_connect($host, $port);
        ssh2_auth_password($connection, $username, $password);


        $stream = ssh2_exec($connection, $script);
        stream_set_blocking($stream, true);
        $output = stream_get_contents($stream);

        echo print_r($output);      
    }else{
        echo "Error : Tidak Boleh ada Spasi"; //Tampilkan error Jika Ada Spasi
    }
}else{
    echo "Error : NIM Wajib Diisi!"; // Tampilkan Error Jika form kosong
}
?>