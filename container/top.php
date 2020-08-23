<div class="top-container" id="top-container">
    <div class="top-bar">
        <div class="top-logo">
            <a href="index.php">
                <img class="image-logo" src="images/misc/gudanews_logo.jpg">
                </img>
            </a>
        </div>
        <div class="top-search">
            <form class="top-search-form">
                <input id="top-search-input" class="top-search-input" type="search" name="q" pattern=".*\S.*" required autocomplete="off">
                </input>
                <button class="top-search-button">
                    <span></span>
                </button>
            </form>
        </div>
        <div class="top-menu" id="top-menu">
            <div class="top-menu-button"></div>
        </div>
    </div>

    <div class="top-nav" id="top-nav">
        <ul class="top-nav-list">
            <li>
                <a href="#">About</a>
            </li>
            <li>
                <a href="#">Services</a>
            </li>
            <li>
                <a href="#">Contact</a>
            </li>
        </ul>
    </div>
</div>

<script>

<?php
if (isset($q)) {
echo <<<EOL
    var search_input = document.getElementById("top-search-input");
    search_input.focus();
    search_input.value = "$q";
    search_input.blur();
EOL;
}
?>

</script>
