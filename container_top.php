
<div class="top-container" id="top-bar">
    <div class="top-logo">
        <a href="index.php">
            <img class="image-logo" src="<?php echo $cwd?>/gudanews_logo.jpg">
            </img>
        </a>
    </div>
    <div class="top-search">
        <form action="" class="top-search-form">
            <input class="top-search-input" type="search" name="q" pattern=".*\S.*" required autocomplete="on">
            </input>
            <button class="top-search-button" type="submit">
                <span></span>
    	   </button>
        </form>
    </div>
    <div class="top-menu" id="top-menu">
        <div class="top-menu-button"></div>
    </div>
</div>

<script>

window.onscroll = function() {myFunction()};

var top_bar = document.getElementById("top-bar");
var sticky = top_bar.offsetTop;

function myFunction() {
    if (window.pageYOffset > sticky) {
        top_bar.classList.add("sticky");
    } else {
        top_bar.classList.remove("sticky");
    }
}

const menuBtn = document.getElementById('top-menu');
let menuOpen = false;

menuBtn.addEventListener('click', () => {
    if(!menuOpen) {
        menuBtn.classList.add('open');
        menuOpen = true;
    } else {
        menuBtn.classList.remove('open');
        menuOpen = false;
    }
});

</script>
