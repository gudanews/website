
<div class="top-container" id="top-container">
    <div class="top-bar">
        <div class="top-logo">
            <a href="index.php">
                <img class="image-logo" src="<?php echo $cwd?>/gudanews_logo.jpg">
                </img>
            </a>
        </div>
        <div class="top-search">
            <form action="" class="top-search-form">
                <input class="top-search-input" type="search" name="q" pattern=".*\S.*" required autocomplete="off">
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

    <div class="top-nav" id="top-nav">
        <ul class="top-nav-list">
            <li>
                <a href="#">About</a>
            </li>
            <li>
                <a href="#">Services</a>
            </li>
            <li>
                <a href="#">Clients</a>
            </li>
            <li>
                <a href="#">Contact</a>
            </li>
        </ul>
    </div>
</div>

<script>

window.onscroll = function() {myFunction()};

var top_bar = document.getElementById("top-container");
var sticky = top_bar.offsetTop;

function myFunction() {
    if (window.pageYOffset > sticky) {
        top_bar.classList.add("sticky");
    } else {
        top_bar.classList.remove("sticky");
    }
}

menuBtn = document.getElementById('top-menu');
menuNav = document.getElementById('top-nav');

menuBtn.addEventListener('click', () => {
    menuBtn.classList.toggle('open');
    menuNav.classList.toggle('open');
});


function openNav() {
  // document.getElementById("main").style.marginTop = "250px";
  // document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
  // document.getElementById("main").style.marginTop= "0";
  // document.body.style.backgroundColor = "white";
}
</script>
