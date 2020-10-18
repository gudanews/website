<head>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<?php
define(SITE_ROOT, './');

require_once 'php/include.php';

include_once 'header.php';
echo <<<EOL
<link rel='stylesheet' id='style_contact-us' href='css/contact_us.css' type='text/css' media='all'>
<title>GudaNews- Contact Us</title>
EOL;
include_once 'php/user.php';

include_once 'container/top.php'; # Adding top sticky
echo <<<EOL
<body>

<div class="wrapper">
<div class="title">
<h1>Contact Us Form</h1>
</div>
<div class="contact-form">
<form id="contact-form" method="post" action="/php/contact_form_handler.php">
<div class="input-fields">
  <input name="name" type="text" class="input" autocomplete="off" placeholder="Name" required>
  <input name="email" type="email" class="input" autocomplete="off" placeholder="Email Address" required>
  <input name="subject" type="message" class="input" autocomplete="off" placeholder="Subject" required>
</div>
<div class="msg">
  <textarea name="message" type="message" autocomplete="off" placeholder="Message" required></textarea>
  <button href="/php/contact_form_handler.php" class="btn">SEND</button>
</div>
</div>
</div>


    </div>

</body>
EOL;

include_once 'container/bottom.php';

include_once 'footer.php';

?>
<!-- <script>
function confirmation_popup(){
    swal({
      title: "Are you sure?",
      text: "Once entered, the message will be sent!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        swal("Your message has been sent!", {
          icon: "success",
        });
      } else {
        swal("Your message has not been sent!");
      }
    });
}
</script> -->
<!-- <script>
const selected = document.querySelector(".selected");
const optionsContainer = document.querySelector(".options-container");

const optionsList = document.querySelectorAll(".option");

selected.addEventListener("click", () => {
  optionsContainer.classList.toggle("active");
});

optionsList.forEach(o => {
  o.addEventListener("click", () => {
    selected.innerHTML = o.querySelector("label").innerHTML;
    optionsContainer.classList.remove("active");
  });
});
</script> -->

<!-- <div class="container">


  <div class="select-box">
    <div class="options-container">
      <div class="option">
        <input
          type="radio"
          class="radio"
          id="automobiles"
          name="category"
        />
      </div>

      <div class="option">
        <input name="subject" type="subject" class="radio" id="film" name="category" />
        <label for="film">Business</label>
      </div>

      <div class="option">
        <input name="subject" type="subject" class="radio" id="science" name="category" />
        <label for="science">Feedback</label>
      </div>

      <div class="option">
        <input name="subject" type="subject" class="radio" id="art" name="category" />
        <label for="art">Questions</label>
      </div>
    </div>

    <div class="selected">
      Select Subject
    </div>
  </div>
</div> -->
