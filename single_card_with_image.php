<?php
function getName($n) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}
function build_single_card_with_image($image, $url, $heading, $source) {

$rand = getName(10);

echo <<<EOL
<div horizontal layout class="image-card" style="width: 100%; height: 100%;">
    <div class="image-card-media" style="display: inline-block; width: 38%; height: 38%;">
EOL;

for ($i = 0; $i < count($image); $i++) {
echo <<<EOL
        <div class="image$rand">
            <a href="$url[$i]">
                <img src="$image[$i]" style="width:100%; height=100%"/>
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
            <div class="heading$rand">
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
                        <a class="nav-link source$rand" onclick="currentCard$rand($i)">
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


<script>
    var cardIndex = 0;
    showCards$rand(cardIndex);

    function currentCard$rand(n) {
        showCards$rand(cardIndex = n);
    }

    function showCards$rand(n) {
        var images = document.getElementsByClassName("image$rand");
        var headings = document.getElementsByClassName("heading$rand");
        var sources = document.getElementsByClassName("source$rand");
        for (i = 0; i < images.length; i++) {
            images[i].style.display = "none";
            headings[i].style.display = "none";
            sources[i].className = sources[i].className.replace(" active", "");
        }
        images[n].style.display = "block";
        headings[n].style.display = "block";
        sources[n].className += " active";
    }
</script>

EOL;
}
?>
