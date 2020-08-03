<?php
function build_single_card_with_image($id, $image, $heading, $source, $url) {

echo <<<EOL
<div horizontal layout class="image-card" style="width: 100%; height: 100%;">
    <div class="image-card-media" style="display: inline-block; width: 38%; height: 38%;">
EOL;

for ($i = 0; $i < count($image); $i++) {
echo <<<EOL
        <div class="card-$id-image">
            <a href="$url[$i]">
                <img src="$image[$i]" style="max-width:100%; max-height=100%"/>
            </a>
        </div>
EOL;
}

echo <<<EOL
    </div>
    <div class="image-card-info" style="display: inline-block; width: 60%; height: 60%;" vertical layout>
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
        <div class="image-card-control" horizontal layout vertical-align="bottom">
            <div class="image-card-meta">
            </div>
            <div class="iamge-card-nav">
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
