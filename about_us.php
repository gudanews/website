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

            <p>We’re a family owned startup with two lovely middleschoolers. Our stories started a few months ago when we saw
            a lot of controversial news flying around. It was difficult to get the truth as biased news sources reported the
            same news in completely different manners. People on the right wing became more and more conservative. People on
            the left wing became more and more liberal. As no political parties are absolutely correct, we thought people should
            be grant the option to hear from the other side freely.

            <p>Things become worse as we realize the propoganda education inside US school system as parents. Students are can no
            longer express their ideas within campus if they hold a different political view. Before actions can be taken by
            government, we will try to defend our political balance to our children. Propoganda will only turn our future
            generations into zombies.

            <p>During this presidental voting season, media are completely crazy when writing their news stories. Social media
            even started censoring legitimate news source and disabling users account. This is a huge shock to us and makes us
            deeply worried about the freedom of speech in this country.

            <p>GudaNews.com was created. Our mission, to bring least-biased uncensored news to our audience. Balanced information from
            different source would give people an option to see the ideology and opinions of others who hold a different political
            view. Instead of just relying your only one favorite news source, you will also be providing take a glimpse of all news
            being read by most users.

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
