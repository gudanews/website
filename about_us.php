<head>
<link rel='stylesheet' id='about_us.css' href='css/about_us.css' type='text/css' media='all'>
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<?php
require_once 'php/include.php';

include_once 'header.php';
echo <<<EOL
<title>GudaNews - About Us</title>
EOL;
include_once 'php/user.php';

include_once 'container/top.php';
?>
<html>
<body>
<section id="aboutus">
    <div class="container">
        <div class="image-timeline">
            <img src="images/misc/gudanews_timeline.png"/>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <div class="about_us_title">
                <h2 class="text-center">About Us</h2>
            </div>
        </div>
            <div class="about_us_content">
                <p>&emsp;Welcome to GudaNews. We Hope you’re enjoying your time browsing multi-bias news on our site.

We’re a family owned business that founded GudaNews. Our stories started a few months ago when we saw a lot of controversial news flying around. It was difficult to get the truth as biased news sources reported the same news in completely different manners. People on the right wing became more and more conservative. People on the left wing became more and more liberal. As no political parties are absolutely correct, we thought it was only correct to give people the option to hear from the other side. GudaNews was created. Our mission, to bring multi-biased news to people. Multi-biased information would give people an option to see the ideology and opinions of others that had different political ideas as themself. Instead of just trusting your favorite news source, you can see how other sources are reporting the exact same event.
<p>

            </div>
        </div>
            <div class="col-sm-5">
                <div class="img-wrap">
                    <img src="images/misc/gudanews_icon.png">
                </div>
            </div>
        </div>
    </div>
    </section>
</body>
</html>
