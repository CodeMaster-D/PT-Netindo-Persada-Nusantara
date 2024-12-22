<?php

/*
 * nanti kalau mau lanjut ini saya sudah sediakan ya pak startupnya
 */
$receiving_email_address = 'contact@example.com';

/*
 * Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
 */
/*
$contact->smtp = array(
  'host' => 'example.com',
  'username' => 'example',
  'password' => 'pass',
  'port' => '587'
);
*/

/*
 * If not enter your correct SMTP credentials, form will use native PHP mail function
 */
if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
    include($php_email_form);
} else {
    die('Unable to load the "PHP Email Form" Library!');
}

$contact = new PHP_Email_Form;
$contact->ajax = true;

$contact->to = $receiving_email_address;
$contact->from_name = isset($_POST['name']) ? $_POST['name'] : '';
$contact->from_email = isset($_POST['email']) ? $_POST['email'] : '';
$contact->subject = isset($_POST['subject']) ? $_POST['subject'] : '';

if (!empty($contact->from_name) && !empty($contact->from_email) && !empty($_POST['message'])) {
    $contact->add_message($contact->from_name, 'From');
    $contact->add_message($contact->from_email, 'Email');
    $contact->add_message($_POST['message'], 'Message', 10);

    echo $contact->send();
} else {
    echo 'Error: Missing required fields.';
}
?>

