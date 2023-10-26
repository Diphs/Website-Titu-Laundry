<?php
//ini wajib dipanggil paling atas
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//ini sesuaikan foldernya ke file 3 ini
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require "koneksi.php";
session_start();

        $verifNumber =  rand(pow(10, 5 - 1), pow(10, 5) - 1); 
        $email = $_SESSION['emailres'];
        $query1 = mysqli_query($koneksi, "SELECT `id_user` FROM `user` WHERE `email` ='$email'");
        $row = mysqli_fetch_array($query1);
        $id_user = $row['id_user'];
        $query = mysqli_query($koneksi, "INSERT INTO `register`(`kode_verifikasi`, `verify_status`, `id_user`)
         VALUES ('$verifNumber','','$id_user')");
        //sesuaikan name dengan di form nya ya 
        $judul = "Titulaundry password reset";
        $pesan = "Kode verifikasi : $verifNumber";

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 2;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail.titulaundry.me';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'otp@titulaundry.me';                     //SMTP username
    $mail->Password   = 'RTJEaL{)1)hk';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //pengirim
    $mail->setFrom('otp@titulaundry.me', 'Titulaundry.com');
    $mail->addAddress($email);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $judul;
    $mail->Body    = $pesan;
    $mail->AltBody = '';
    //$mail->AddEmbeddedImage('gambar/logo.png', 'logo'); //abaikan jika tidak ada logo
    //$mail->addAttachment(''); 

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

}
        //redirect ke halaman index.php
        echo "<script>alert('Email berhasil terkirim!');window.location='reset-password.php';</script>";
        
        ?>