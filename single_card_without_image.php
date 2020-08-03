<?php
function build_single_card_without_image($id, $heading, $source, $url) {

echo <<<EOL
<div horizontal layout class="text-card">
    <div class="text-card-info" vertical layout>
        <div class="text-card-heading" >
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
        <div class="text-card-control" horizontal layout>
            <div class="text-card-meta">
            </div>
            <div class="text-card-nav">
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
