<?php
$message = "line of message";
$message = wordwrap($message, 70);
if(mail('casey@caseyharford.com', 'My Subject', $message)) {
echo 'sent mail';
}
else {
echo 'failed to send mail';
}
?>
