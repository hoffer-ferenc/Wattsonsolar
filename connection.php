<?php

require 'PHPMailerAutoload.php';

$mail = new PHPMailer();
if (isset($_POST['submit'])) {
	 $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

try {
$mail->IsSMTP();                                          // SMTP-n keresztuli kuldes
$mail->Host     = 'smtp...';                     // SMTP szerverek
$mail->SMTPAuth = true;                                   // SMTP

$mail->Username = 'postmaster@wattsonsolar.hu';            // SMTP felhasználo
$mail->Password = 'titok';                               // SMTP jelszo

$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->From     = 'postmaster@wattsonsolar.hu';            // Felado e-mail cime
$mail->FromName = $name;                // Felado neve
$mail->AddAddress('valaki@gmail.com', 'Wattsonsolar');         // Cimzett es neve
$mail->AddAddress('postmaster@wattsonsolar.hu');
$mail->AddAddress($email);																// Meg egy cimzett
//$mail->AddReplyTo('info@sajat-domain.hu', 'Information'); // Valaszlevel ide

$mail->WordWrap = 80;                                     // Sortores allitasa
$mail->IsHTML(true);                                      // Kuldes HTML-kent
$mail->Subject = 'Form Submission';
$mail->Body = "<h3>Name : $name <br>Email : $email <br>Message : $message</h3>";
	$mail->CharSet = 'UTF-8';   
	 $mail->send();
      $output = '<div class="alert alert-success">
                  <h5>Üzenetét sikeresen fogadtunk, hamarosan keresni fogjuk!</h5>
                </div>';
}
catch (Exception $e) {
      $output = '<div class="alert alert-danger">
                  <h5>' . $e->getMessage() . '</h5>
                </div>';
    }
if(!$mail->send()) 
{
    echo "Hiba, biztonsági okokból nincs kitöltve a levelező. " . $mail->ErrorInfo;
} 
else 
{
    echo "<script>alert('Üzenetét sikeresen fogadtunk, hamarosan keresni fogjuk!');</script>";
}
}

?>