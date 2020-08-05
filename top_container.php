<body>
    <div class="top-bar" id="top-bar">
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

var top_bar = document.getElementById("top-bar");
var sticky = top_bar.offsetTop;

function myFunction() {
    if (window.pageYOffset > sticky) {
        top_bar.classList.add("sticky");
    } else {
        top_bar.classList.remove("sticky");
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
