<?php
function build_single_card_with_image($id, $image, $heading, $source, $bg_color, $url) {

echo <<<EOL
<div horizontal layout class="image-card">
    <div class="image-card-media">
EOL;

for ($i = 0; $i < count($url); $i++) {
echo <<<EOL
        <div class="card-$id-image">
            <a href="$url[$i]">
                <img src="$image" class="card-image" />
            </a>
        </div>
EOL;
}

echo <<<EOL
    </div>
    <div class="image-card-info" vertical layout>
    <div class="image-card-heading card-heading">

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
        <div class="card-padding"></div>
        <div class="image-card-control" horizontal layout>
            <div class="image-card-meta">
            </div>
            <div class="image-card-nav">
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
