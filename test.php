
<div class="top-container" id="top-nav">
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
        </div>
    </div>
    <!-- <div class="men-bar">
        <div class="topnav" id="mySidenav" onclick="openNav()"></div>
        <a href="#">About</a>
        <a href="#">Services</a>
        <a href="#">Clients</a>
        <a href="#">Contact</a>
    </div> -->
</div>

<script>

window.onscroll = function() {myFunction()};

var top_nav = document.getElementById("top-nav");
var sticky = top_nav.offsetTop;

function myFunction() {
    if (window.pageYOffset > sticky) {
        top_nav.classList.add("sticky");
    } else {
        top_nav.classList.remove("sticky");
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

function openNav() {
  document.getElementById("mySidenav").style.height = "250px";
  document.getElementById("main").style.marginTop = "250px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
  document.getElementById("mySidenav").style.height = "0";
  document.getElementById("main").style.marginTop= "0";
  document.body.style.backgroundColor = "white";
}
</script>










.topnav {
  height: 0;
  width: 100%;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-y: hidden;
  transition: 0.5s;
  padding-top: 0px;
}

.topnav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.topnav a:hover {
  color: #f1f1f1;
}

.topnav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-top: 50px;
}
/*
#main {
  transition: margin-top .5s;
  padding: 16px;
} */

/* @media screen and (max-height: 450px) {
  .topnav {padding-top: 0px;}
  .topnav a {font-size: 18px;}
}
body {
   transition: background-color 0.5s;
} */
