<!DOCTYPE html>
<html>
<head>
<script src="https://kit.fontawesome.com/d61d7a4b15.js" crossorigin="anonymous"></script>
    <div class="header" id="header">
        <div class="inner-header">
            <div class="content">
                <div class="logo">
                    <a href="index.php">
                        <img class="image-logo" src="wp-content/themes/gudanews/gudanews_logo_with_oval.jpg">
                        </img>
                    </a>
                </div>
                <div class="heading-space-reserve">
                </div>
                <div class="search-bar-div">
                    <form action="" class="search-bar">
                        <input type="search" name="search" pattern=".*\S.*" required autocomplete="off">
                            <button class="search-btn" type="submit">
                                <span>Search</span>
                    	   </button>
                       </input>
                    </form>
                </div>
                <div class="menu-btn">
                    <div class="menu-btn__burger"></div>
                    <script>
                    const menuBtn = document.querySelector('.menu-btn');
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
                </div>
            </div>
        </div>
    </div>

<script>

window.onscroll = function() {myFunction()};

var header = document.getElementById("header");
var sticky = header.offsetTop;

function myFunction() {
    if (window.pageYOffset > sticky) {
        header.classList.add("sticky");
    } else {
        header.classList.remove("sticky");
    }
}
</script>



<?php wp_head();?>
</head>

<body <?php body_class();?>>
