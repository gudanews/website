
<?php

echo <<<EOL
    <div horizontal layout class='image-card'>
        <div class='image-card-media'>
EOL;

for ($i = 0; $i < count($current_url); $i++) {
echo <<<EOL
            <div class='image-card-image card-$current_id-image'>
                <a href='index.php?p=news&uuid=$current_news_id[$i]&lang=$lang'>
                    <img src='$current_image' class='card-image' />
                </a>
            </div>
EOL;

}
echo <<<EOL
        </div>
        <div class='image-card-info' vertical layout>

            <div class='image-card-heading card-heading'>

EOL;
for ($i = 0; $i < count($current_title); $i++) {
echo <<<EOL
                <div class='card-$current_id-heading'>
                    <a href='index.php?p=news&uuid=$current_news_id[$i]&lang=$lang'>
                        <p class='heading-text'>
                            $current_title[$i]
                        </p>
                    </a>
                </div>

EOL;
}
echo <<<EOL
            </div>
            <div class='card-padding'></div>
            <div class='image-card-control' horizontal layout>
                <div class='image-card-meta'>
EOL;
for ($i = 0; $i < count($current_source); $i++) {
echo <<<EOL
                    <div class='card-$current_id-date card-date'>
                        <p class='datetime-text'>
                            <i class='far fa-clock'>
                                    $current_datetime[$i]
                            ‎‎‎</i>
                        </p>
                    </div>
                    <div style="" class="share-button">
                      <span><i class="fas fa-share-alt"></i> Share!</span>
                      <a href="https://www.facebook.com/sharer/sharer.php?u=https://gudanews.com/index.php?p=news&uuid=$current_news_id[$i]&lang=$lang"><i class="fab fa-facebook-f"></i></a>
                      <a href="https://twitter.com/share?url=https://gudanews.com/index.php?p=news&uuid=$current_news_id[$i]&lang=$lang"><i class="fab fa-twitter"></i></a>
                      <a href="https://www.linkedin.com/shareArticle?url=$url&title=$title&source=$current_source"><i class="fab fa-linkedin-in"></i></a>
                    </div>


EOL;
}
echo <<<EOL

                </div>
                <div class='image-card-nav'>
EOL;
for ($i = 0; $i < count($current_source); $i++) {
echo <<<EOL

                    <div class='card-source card-$current_id-source' style='background-color: $current_source_color[$i];'>
                        <a onclick='showImageCard($current_id, $i)'>
                            <p class='source-text'>
                                $current_source[$i]
                            </p>
                        </a>
                    </div>


EOL;
}
echo <<<EOL
                </div>
            </div>
        </div>
    </div>
EOL;
?>
