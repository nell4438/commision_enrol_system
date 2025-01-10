<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

$mail = new PHPMailer;
$mail->isSMTP(); 


$mail->SMTPDebug = 2; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
$mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
$mail->Port = 587; // TLS only
$mail->SMTPSecure = 'tls'; // ssl is depracated
$mail->SMTPAuth = true;
$mail->Username = "addatujhasper0@gmail.com";
				$mail->Password = "aifoczdjbmylcsoo";

$admission_ID = 1;
$mail->setFrom("addatujhasper0@gmail.com", "ONLINE ENROLMENT SYSTEM, SNHS MAIN");
$mail->addAddress("rhalpdarrencabrera@gmail.com", "Darren");
$mail->Subject = 'Your Enrollment Registration Approve';
$mail->msgHTML("<html>
                <head>
                <title>Your Enrollment Registration Approved</title>
                </head>
                <body>
                <h4>Kindly pass the required documents</h4>
                <h2>REQUIREMENTS</h2>
                <h3>(Grade and Transferees)</h3>
                <ul>
                    <li> Report Card</li>
                    <li> Photocopy of Birth Certificate</li>
                    <li> 3 pcs 1x1 ID Picture</li>
                    <li> Good Moral Certificate</li>
                    <li> Barangay Clearance</li>
                    <li> Brown Envelope (Long)</li>
                    <li> Financial Assessment (from private school)</li>
                </ul>
                
                <a href='http://localhost/enrol/index?page=admission-files&admission_ID=$admission_ID'>UPLOAD SCAN DOCUMENT HERE</a>
                </body>
                </html>"); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
$mail->AltBody = 'SAMPLE HTML BODY';
// $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file

if(!$mail->send()){
    echo "Mailer Error: " . $mail->ErrorInfo;
}else{
    echo "Message sent!";
}




