<?php
echo <<<EOL
<div horizontal layout class="image-card">
    <div class="image-card-media">
EOL;

for ($i = 0; $i < count($current_url); $i++) {
echo <<<EOL
        <div class="card-$current_id-image">
            <a href="news.php?uuid=$current_news_id[$i]">
                <img src="$current_image" class="card-image" />
            </a>
        </div>
EOL;
}
echo <<<EOL
    </div>
    <div class="image-card-info" vertical layout>
        <div class="image-card-heading card-heading">

EOL;
for ($i = 0; $i < count($current_title); $i++) {
echo <<<EOL
            <div class="card-$current_id-heading">
                <a href="news.php?uuid=$current_news_id[$i]">
                    <p class="heading-text">
                        $current_title[$i]
                    </p>
                </a>
            </div>

EOL;
}
echo <<<EOL
        </div>
        <div class="card-padding"></div>
        <div class="image-card-control" horizontal layout>
            <div class="image-card-meta">
            </div>
            <div class="image-card-nav">
EOL;
for ($i = 0; $i < count($current_source); $i++) {
echo <<<EOL
                <div class="card-source card-$current_id-source" style="background-color: $current_source_color[$i];">
                    <a onclick="showCard($current_id, $i)">
                        <p class="source-text">
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
