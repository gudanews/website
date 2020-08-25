<?php


echo <<<EOL
<div horizontal layout class="image-card">
    <div class="image-card-media">
EOL;

for ($i = 0; $i < count($current_url); $i++) {
echo <<<EOL
        <div class="card-$current_id-image">
            <a href="index.php?p=news&uuid=$current_news_id[$i]$url_lang">
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
                <a href="index.php?p=news&uuid=$current_news_id[$i]$url_lang">
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
            <div class="card-date">
            <div class="card-date-image">
            <i class="far fa-clock">&nbsp;&nbsp;&nbsp;‎‎‎</i>
EOL;
$datetime = strtotime($current_datetime[0]);
$new_date = date("D M d, h:i A", $datetime);
print strtoupper($new_date);
for ($i = 0; $i < count($current_source); $i++) {
echo <<<EOL
        </div>
            </div>
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
