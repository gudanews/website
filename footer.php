<script>

var top_bar = document.getElementById("top-container");
var sticky = top_bar.offsetTop;

let menuBtn = document.getElementById('top-menu');
let menuNav = document.getElementById('top-nav');
menuBtn.addEventListener('click', () => {
    menuBtn.classList.toggle('open');
    menuNav.classList.toggle('open');
});

//Get the button
var mybutton = document.getElementById("topBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (window.pageYOffset > sticky) {
        top_bar.classList.add("sticky");
    } else {
        top_bar.classList.remove("sticky");
    }
 if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}

</script>
</body>
</html>
