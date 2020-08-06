<?php
function build_single_card_without_image($id, $heading, $snippet, $source, $bg_color, $url) {

echo <<<EOL
<div horizontal layout class="text-card">
    <div class="text-card-info" vertical layout>
        <div class="text-card-heading card-heading">
EOL;

for ($i = 0; $i < count($heading); $i++) {
echo <<<EOL
            <div class="card-$id-heading">
                <a href="$url[$i]">
                    <p class="heading-text">
                        $heading[$i]
                    </p>
                </a>
            </div>
EOL;
}

echo <<<EOL
        </div>
        <div class="text-card-snippet">
EOL;

for ($i = 0; $i < count($snippet); $i++) {
echo <<<EOL
            <div class="card-snippet card-$id-snippet">
                <a href="$url[$i]">
                    <p class="snippet-text">
                        $snippet[$i]
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
for ($i = 0; $i < count($source); $i++) {
echo <<<EOL
                <div class="card-source card-$id-source" style="background-color: $bg_color[$i];">
                    <a onclick="showCard($id, $i)">
                    <p class="source-text">
                            $source[$i]
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
}
?>
