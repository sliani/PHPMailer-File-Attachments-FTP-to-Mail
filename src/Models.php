<?php

// Variable déclaration for automate the Cron Tasks ...

// Variable for your SMTP : 
$DebugState = 0;
$Host       = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
$SMTPAuth   = true;                                   // Enable SMTP authentication
$Username   = 'Mail@mail.fr';         // SMTP username
$Password   = 'YourPassword';                       // SMTP password
$SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
$Port       = 587;                                    // TCP port to connect to

// Variable for your recipients mailer :
$recipient = 'Mail@mail.fr';          // Principal mail recipient
$CC        = 'Mail@mail.fr';          // Mail copy

// Variable for content mail
$Subject = 'TEST PFD';                                // Set email format to HTML
$Body    = 'TEST PFD';

// Variable for FTP Configuration
$ftp_s         = 'localhost';
$ftp_login     = 'root';
$ftp_pass      = '';

// Variable for FTP Routes
$sync_p     = 'public';

// Variable for mail page - Historique if ($DebugState = 2)
// Identify directories
$dest_source = "public/";                       // Change if the folder must be different for your new project
$dest_final  = "historique"; // you can let this