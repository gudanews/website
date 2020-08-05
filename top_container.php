<body>
    <div class="top" id="top">
        <div class="top-container">
            <div class="top-logo">
                <a href="index.php">
                    <img class="image-logo" src="wp-content/themes/gudanews/gudanews_logo_with_oval.jpg">
                    </img>
                </a>
            </div>
            <div class="padding">
            </div>
            <div class="top-search">
                <div class="padding">
                </div>
                <form action="" class="top-search-form">
                    <input class="top-search-input" type="search" name="search" pattern=".*\S.*" required autocomplete="off">
                    </input>
                    <button class="top-search-button" type="submit">
                        <span>Search</span>
            	   </button>
                </form>
            </div>
            <div class="top-menu">
                <div class="top-menu-button"></div>
            </div>
        </div>
    </div>

<script>

window.onscroll = function() {myFunction()};

var top = document.getElementById("top");
var sticky = top.offsetTop;

function myFunction() {
    if (window.pageYOffset > sticky) {
        top.classList.add("sticky");
    } else {
        top.classList.remove("sticky");
    }
}

const menuBtn = document.querySelector('.top-menu');
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
