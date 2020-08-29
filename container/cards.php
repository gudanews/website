<?php

echo <<<EOL
<div class='cards-container' id='cards'>
</div>
<input type='hidden' id='pageno' value='0'></input>
<img id="loader" class='card-loading' src="images/misc/loading.svg"></img>
<script>
    $(document).ready(function(){
        $('#loader').on('inview', function(event, isInView) {
            if (isInView) {
                var nextPage = parseInt($('#pageno').val()) + 1;
                $.ajax({
                    type: 'POST',
                    url: 'php/pagination.php',
                    data: { pageno: nextPage, lang: $lang, q: '$q' },
                    success: function(data){
                        if(data != ''){							 
                            $('#cards').append(data);
                            $('#pageno').val(nextPage);
                        } else {								 
                            $('#loader').hide();
                        }
                    }
                });
            }
            else {
                initCards();
            }
        });
    });
    function isImageCard(index) {
        var cards = document.querySelectorAll('div.cards-container > div');
        var card_type = cards[index].className;
        return card_type == 'image-card';
    }
    function showCard(index, current) {
        var heading_classname = 'card-'.concat(index, '-heading');
        var date_classname = 'card-'.concat(index, '-date');
        var source_classname = 'card-'.concat(index, '-source');
        var headings = document.getElementsByClassName(heading_classname);
        var dates = document.getElementsByClassName(date_classname);
        var sources = document.getElementsByClassName(source_classname);
        for (i = 0; i < headings.length; i++ ) {
            headings[i].style.display = 'none';
            dates[i].style.display = 'none';
            sources[i].classList.remove('active');
            if (current == i) {
                headings[current].style.display = 'block';
                dates[current].style.display = 'block';
                sources[current].classList.add('active');
            }
        }
    }
    function showImageCard(index, current) {
        showCard(index, current);
        var image_classname = 'card-'.concat(index, '-image');
        var images = document.getElementsByClassName(image_classname);
        for (i = 0; i < images.length; i++ ) {
            images[i].style.display = 'none';
            if (current == i) {
                images[current].style.display = 'block';
            }
        }
    }
    function showTextCard(index, current) {
        showCard(index, current);
        var snippet_classname = 'card-'.concat(index, '-snippet');
        var snippets = document.getElementsByClassName(snippet_classname);
        for (i = 0; i < snippets.length; i++ ) {
            snippets[i].style.display = 'none';
            if (current == i) {
                snippets[current].style.display = 'block';
            }
        }
    }
    var first_time = true;
    function initCards() {
        var initCardIndex = 0;
        var cards = document.querySelectorAll('div.cards-container > div');
//        window.alert('total find ' + cards.length + ' cards ');
        for (x = 0; x < cards.length ; x++) {
            if (isImageCard(x)) {
//                window.alert('card[' + x + '] is image card');
                showImageCard(x, initCardIndex);
            }
            else {
//                window.alert('card[' + x + '] is text card');
                showTextCard(x, initCardIndex);
            }
        }
    }
    if (first_time) {
//        window.alert('First time init cards');
        initCards();
        first_time = false;
    }
</script>
EOL;
?>
