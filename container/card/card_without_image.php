<?php
echo <<<EOL
<div horizontal layout class="text-card">
    <div class="text-card-info" vertical layout>
        <div class="text-card-heading card-heading">
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
        <div class="text-card-snippet">
EOL;
for ($i = 0; $i < count($current_snippet); $i++) {
echo <<<EOL
            <div class="card-snippet card-$current_id-snippet">
                <a href="index.php?p=news&uuid=$current_news_id[$i]$url_lang">
                    <p class="snippet-text">
                        $current_snippet[$i]
                    </p>
                </a>
            </div>
EOL;
}
echo <<<EOL
        </div>
        <div class="card-padding"></div>
        <div class="text-card-control" horizontal layout>
            <div class="text-card-meta">
            </div>
            <div class="text-card-nav">
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
