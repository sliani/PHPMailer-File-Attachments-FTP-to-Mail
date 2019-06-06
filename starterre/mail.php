<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../src/Exception.php';
require '../src/PHPMailer.php';
require '../src/SMTP.php';
require '../src/FTP.php';
// Change the values for deploye new project
require '../src/Models.php';
require './fileslist.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    //Make 2 for watch all logs
    $mail->SMTPDebug = $DebugState;                             // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = $Host;                                  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = $SMTPAuth ;                             // Enable SMTP authentication
    $mail->Username   = $Username;                              // SMTP username
    $mail->Password   = $Password;                              // SMTP password
    $mail->SMTPSecure = $SMTPSecure;                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = $Port;                                  // TCP port to connect to

    //Recipients
    $mail->setFrom($recipient, 'Name for you mail');
    $mail->addAddress($recipient, 'Name for you mail');     // Add a recipient
    //$mail->addAddress('example@example.com');                        // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC($CC);                                    // Add a CC mail..
    //$mail->addBCC('bcc@example.com');
    //Attachments
    foreach ($contents as $value) {
        echo $value.'<br><br>';
        $mail->addAttachment($value); // Add attachments
        
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    }
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $Subject;
    $mail->Body    = $Body;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->send();
    echo 'Message has been sent <br>';

    // Date Folder
    //Year in YYYY format.
    $year = date("Y");
    
    //Month in mm format, with leading zeros.
    $month = date("m");
    
    //Day in dd format, with leading zeros.
    $day = date("d");
    
    //The folder path for our file should be YYYY/MM/DD
    $directory = "./$dest_final/$year.$month.$day";
    
    //If the directory doesn't already exists.
    if(!is_dir($directory)){
        //Create our directory.
        mkdir($directory, 755, true);
    }

    if($mail->SMTPDebug = 2){
        // Get array of all source files
        $files = scandir($dest_source);
        // Identify directories
        $source = $dest_source;
        $destination = "$dest_final/$year.$month.$day/";
        // Cycle through all source files
        foreach ($files as $file) {
        if (in_array($file, array(".",".."))) continue;
        // If we copied this successfully, mark it for deletion
        if (copy($source.$file, $destination.$file)) {
            $delete[] = $source.$file;
        }
        }
        // Delete all successfully-copied files
        foreach ($delete as $file) {
        unlink($file);
        }
    }

    // Size for array content (all files count)
    echo sizeof($contents);

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo} <br>";
}