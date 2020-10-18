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
        <!-- <div class="image-timeline">
            <img src="images/misc/gudanews_timeline.png"/>
        </div> -->
        <div class="row">
            <div class="col-sm-7">
                <div class="about_us_title">
                <h2 class="text-center">About Us</h2>
            </div>
        </div>
        <div class="about_us_content">
            <p>Welcome to GudaNews. We hope you’re enjoying your time browsing least-bias uncensored news from our site.

            <p>We’re a family owned startup with two lovely middleschoolers from their initiative. Our stories started a few
            months ago during the pandanmic. Spending more time reading news at home, we saw a lot of controversial reporting
            flying around. It was difficult to get the truth as biased news sources reported the same news in completely
            different manners. People on the right wing became more and more conservative. People on the left wing became more
            and more liberal. As no political parties were absolutely correct, we thought people should be granted the option to
            hear from the other side without border.

            <p>Things become more complicated when we as parents start to realize the propoganda education inside US school system. Students can no
            longer express their ideas within campus if they hold a different political view. Before actions can be taken by
            government, we will try to defend our children by providing a politically balanced environment. Propoganda will only turn our future
            generations into brainwashed zombies.

            <p>During this presidental voting season, media are completely crazy when making up their news stories.
            Social networks big techs even started censoring legitimate news source and disabling users account. This is a huge shock to us and makes us
            deeply worried about the freedom of speech in this country.

            <p>GudaNews.com was therefore created. Our mission is to bring least-biased uncensored news to our audience. Balanced information from
            different source would share different ideology and opinions. Instead of just relying on the only one favorite news source,
            our users can overview most popular news being read.

        </div>
        <!-- <div class="col-sm-5">
            <div class="img-wrap">
                <img src="images/misc/gudanews_icon.png">
            </div>
        </div> -->
    </div>
    </section>
</body>
</html>
