<?php
$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$parsed_url = parse_url($current_url);
$query = $parsed_url['query'];
parse_str($query, $params);

if (isset($params['lang'])) {
    unset($params['lang']);
}
$params['lang'] = $lang? 0: 1;
$query = http_build_query($params);
$link = "$parsed_url[scheme]://$parsed_url[host]$parsed_url[path]?$query";

echo <<<EOL
<div class='top-container' id='top-container'>
    <div class='top-bar'>
        <div class='top-logo'>
            <a href='index.php'>
                <img class='image-logo' src='images/misc/gudanews_logo.jpg'>
                </img>
            </a>
        </div>
        <div class='top-search'>
            <form class='top-search-form'>
                <input id='top-search-input' class='top-search-input' type='search' name='q' pattern='.*\S.*' required autocomplete='off'>
                </input>
                <button class='top-search-button'>
                    <span></span>
                </button>
            </form>
        </div>
        <div class='top-translation'>
            <a href='$link'>
                <img class='image-translation' src='images/misc/translation_icon.png'>
                </img>
            </a>
        </div>
        <div class='top-menu' id='top-menu'>
            <div class='top-menu-button'></div>
        </div>
    </div>

    <div class='top-nav' id='top-nav'>
        <ul class='top-nav-list'>
            <li>
                <a href='#'>About</a>
            </li>
            <li>
                <a href='#'>Services</a>
            </li>
            <li>
                <a href='#'>Contact</a>
            </li>
        </ul>
    </div>
</div>
<div class='top-container-padding' id='top-container'>
</div>

<script>

var top_bar = document.getElementById('top-container');
var sticky = top_bar.offsetTop;

let menuBtn = document.getElementById('top-menu');
let menuNav = document.getElementById('top-nav');
menuBtn.addEventListener('click', () => {
    menuBtn.classList.toggle('open');
    menuNav.classList.toggle('open');
});
EOL;

if (isset($q)) {
echo <<<EOL
    var search_input = document.getElementById('top-search-input');
    search_input.focus();
    search_input.value = '$q';
    search_input.blur();
EOL;
}
?>

</script>
