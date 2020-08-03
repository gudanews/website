<?php
function build_single_card_with_image($id, $image, $heading, $source, $url) {

echo <<<EOL
<div horizontal layout class="image-card">
    <div class="image-card-media">
EOL;

for ($i = 0; $i < count($url); $i++) {
echo <<<EOL
        <div class="card-$id-image">
            <a href="$url[$i]">
                <img src="$image" class="card-image" style="max-width:100%; max-height=100%"/>
            </a>
        </div>
EOL;
}

echo <<<EOL
    </div>
    <div class="image-card-info" vertical layout>
    <div class="image-card-heading">

EOL;

for ($i = 0; $i < count($heading); $i++) {
echo <<<EOL
            <div class="card-$id-heading">
                <a href="$url[$i]">
                    $heading[$i]
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
                <ul class="nav nav-pills card-header-pills">
EOL;
for ($i = 0; $i < count($source); $i++) {
echo <<<EOL
                    <li class="nav-item">
                        <a class="nav-link card-$id-source" onclick="currentCard($id, $i)">
                            $source[$i]
                        </a>
                    </li>
EOL;
}

echo <<<EOL
                </ul>
            </div>
        </div>
    </div>

</div>



EOL;
}
?>
