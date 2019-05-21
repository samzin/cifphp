
<?php

if (mail('kanchanzinjade5555@gmail.com', 'My Title', 'Some Text')) {
    echo "OK";
} else {
    echo "Why ??";
}


$email = "kanchanzinjade5555@gmail.com
";
$subject =  "Email Test";
$message = "this is a mail testing email function on server";


$sendMail = mail($email, $subject, $message);
if($sendMail)
{
echo "Email Sent Successfully";
}
else

{
echo "Mail Failed";
}
?>
