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


<div class = "homepage_card_header">
      <ul class="nav nav-pills card-header-pills">

EOL;

for ($i = 0; $i < count($url); $i++) {
    echo "<li class='nav-item'><a class='nav-link demo". $rand ."' onclick='currentCard" . $rand . "(" . $i;
    echo ")'>" . $source[$i] . "</a></li>";
}

echo <<<EOL
      </ul>
      <div class = "homepage_sources_button_container_header">
            <div class = "homepage_content_sources_bar_header">
      </div>
      </div>
</div>

<div class = "homepage_card_body">
      <div class = "homepage_content_image">
EOL;

for ($i = 0; $i < count($url); $i++) {
    echo "<div class='myCards" . $rand . "'>";
    echo "<a href='" . $url[$i] . "'>"
        . "<img width='280' height='180' style='max-width: 100%; max-height: 100%'"
        . " src='" . $image[$i] ."' /></a>";
    echo "</div>";
}

echo <<<EOL
</div>
<div class = "homepage_content_text">

      <div class = "homepage_content_heading">
EOL;

for ($i = 0; $i < count($url); $i++) {
  echo "<div class='myCards" . $rand . "'>";
 
  echo "</div>";
}

echo <<<EOL
      </div>
      <div class = "homepage_content_snippet">

      </div>
</div>
<div class = "homepage_buttons_content_container_for_features">
      <!--add buttons here-->
</div>
</div>



<script>
        var cardIndex = 1;
        showCards$rand(cardIndex);

        function currentCard$rand(n) {
              showCards$rand(cardIndex = n);
        }

        function showCards$rand(n) {
              var i;
              var cards = document.getElementsByClassName("myCards$rand");
              var dots = document.getElementsByClassName("demo$rand");
              if (n > cards.length) {cardIndex = 1}
              if (n < 1) {cardIndex = cards.length}
              for (i = 0; i < cards.length; i++) {
                          cards[i].style.display = "none";
                    }
              for (i = 0; i < dots.length; i++) {
                          dots[i].className = dots[i].className.replace(" active", "");


              }
              cards[cardIndex-1].style.display = "block";
              dots[cardIndex-1].className += " active";

        }
</script>


EOL;
}
?>
