<?php
define(SITE_ROOT, './');

require_once 'php/include.php';

include_once 'header.php';
echo <<<EOL
<link rel='stylesheet' id='style_contact-us' href='css/contact_us.css' type='text/css' media='all'>
<title>GudaNews- Contact Us</title>
EOL;
include_once 'php/user.php';

include_once 'container/top.php'; # Adding top sticky
echo <<<EOL
<body>

    <div class="contact-title">
        <h1>Contact Us<h1>
    </div>

    <div class="contact-form">
        <form id="contact-form" method="post" action="php/contact_form_handler.php">
        <input name="name" type="text" class="form-control" autocomplete="off" placeholder="Your Name" required>
        <br>
        <input name="email" type="email" class="form-control" autocomplete="off" placeholder="Your Email" required>
        <br>

            <textarea name="message" class="form-control" autocomplete="off" placeholder="Message" row"4" required></textarea><br>
            <input type="submit" class="form-control submit" value="SEND MESSAGE">

        </form>
    </div>

</body>
EOL;

include_once 'container/bottom.php';

include_once 'footer.php';

?>
