<?php
/**
 * Template Name: Quiz
 *
 * A custom page template that displays all posts.
 *
 * @package Gateway
 */
get_header();?>




<!-- dont delete this please this is the main code being commented to cope with our idea of hiding 
based on api retrievals -->

<div class="Quiz" style="display:flex;justify-content:center;">
    <h2 style="color:#FFFFFFDE;">Quiz</h2>
</div>

<!-- dont delete this please this is the main code being commented to cope with our idea of hiding 
based on api retrievals -->

<div class="Question_with_img">
    <p>Identify the picture</p>
    <img src="http://localhost/wordpress/wp-content/uploads/2023/03/layer_2.png">  
</div> 

<!-- dont delete this please this is the main code being commented to cope with our idea of hiding 
based on api retrievals -->

<!-- question without image can be used for both image only options and text only options -->
 <div class="Question_without_img" >
    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
    Repellat doloribus consequatur minus mollitia a enim. Nam, temporibus?
     Pariatur aspernatur veritatis ipsam inventore ducimus nemo, labore dignissimos
      voluptate dicta cupiditate praesentium.</p>
    
</div>

<!-- dont delete this please this is the main code being commented to cope with our idea of hiding 
based on api retrievals -->
<!-- Questions with audio -->
<div class="question-with-audio" style="display: flex; align-items:center;">
	<div class="mediPlayer" id="question-player">
         <audio class="listen" preload="none" data-size="250" src="http://localhost/wordpress/wp-content/uploads/2023/04/TheWorldOfSound-DemoDolby.mp3"></audio>
</div>
</div>
<script src="//code.jquery.com/jquery.min.js"> </script>
<script> 
// (function (root, factory) {

//     if (typeof define === 'function' && define.amd) {
//         define(factory);
//     } else if (typeof exports === 'object') {
//         module.exports = factory;
//     } else {
//         root.lunar = factory();
//     }
// })(this, function () {

//     'use strict';

//     var lunar = {};

//     lunar.hasClass = function (elem, name) {
//         return new RegExp('(\\s|^)' + name + '(\\s|$)').test(elem.attr('class'));
//     };

//     lunar.addClass = function (elem, name) {
//         !lunar.hasClass(elem, name) && elem.attr('class', (!!elem.getAttribute('class') ? elem.getAttribute('class') + ' ' : '') + name);
//     };

//     lunar.removeClass = function (elem, name) {
//         var remove = elem.attr('class').replace(new RegExp('(\\s|^)' + name + '(\\s|$)', 'g'), '$2');
//         lunar.hasClass(elem, name) && elem.attr('class', remove);
//     };

//     lunar.toggleClass = function (elem, name) {
//         lunar[lunar.hasClass(elem, name) ? 'removeClass' : 'addClass'](elem, name);
//     };

//     lunar.className = function (elem, name) {
//         elem.attr('class', name);
//         console.log('className', elem);
//     };

//     return lunar;

// });

(function ($) {

    var _ = {

        cursorPoint: function (evt, el) {
            _.settings.pt.x = evt.clientX;
            _.settings.pt.y = evt.clientY;
            var playObject  = el.find('svg').attr('id');
            playObject      = document.getElementById(playObject);
            return _.settings.pt.matrixTransform(playObject.getScreenCTM().inverse());
        },

        angle: function (ex, ey) {
            var dy    = ey - 50; // 100;
            var dx    = ex - 50; // 100;
            var theta = Math.atan2(dy, dx); // range (-PI, PI]
            theta *= 180 / Math.PI; // rads to degs, range (-180, 180]
            theta     = theta + 90; // in our case we are animating from the top, so we offset by the rotation value;
            if (theta < 0) theta = 360 + theta; // range [0, 360)
            return theta;
        },

        setGraphValue: function (obj, val, el) {

            var audioObj = el.find(_.settings.audioObj),
                pc       = _.settings.pc,
                dash     = pc - parseFloat(((val / audioObj[0].duration) * pc), 10);

            $(obj).css('strokeDashoffset', dash);

            if (val === 0) {
                $(obj).addClass(obj, 'done');
                if (obj === $(_.settings.progress)) $(obj).attr('class', 'ended');
            }
        },

        reportPosition: function (el, audioId) {
            var progress = el.find(_.settings.progress),
                audio    = el.find(_.settings.audioObj);

            _.setGraphValue(progress, audioId.currentTime, el);
        },

        stopAllSounds: function () {

            document.addEventListener('play', function (e) {
                var audios = document.getElementsByTagName('audio');
                for (var i = 0, len = audios.length; i < len; i++) {
                    if (audios[i] != e.target) {
                        audios[i].pause();
                    }
                    if (audios[i] != e.target) $(audios[i]).parent('div').find('.playing').attr('class', 'paused');
                }
            }, true);
        },

        settings: {},

        init: function (options) {

            var template = ['<svg viewBox="0 0 100 100" id="playable" version="1.1" xmlns="http://www.w3.org/2000/svg" width="80px" height="80px" data-play="playable" class="not-started playable">',
                '<g class="shape">',
                '<circle class="progress-track" cx="50" cy="50" r="47.45" stroke="#becce1" stroke-opacity="0.25" stroke-linecap="round" fill="none" stroke-width="5"/>',
                '<circle class="precache-bar" cx="50" cy="50" r="47.45" stroke="#302F32" stroke-opacity="0.25" stroke-linecap="round" fill="none" stroke-width="5" transform="rotate(-90 50 50)"/>',
                '<circle class="progress-bar" cx="50" cy="50" r="47.45" stroke="#FFC800" stroke-opacity="1" stroke-linecap="round" fill="none" stroke-width="5" transform="rotate(-90 50 50)"/>',
                '</g>',
                '<circle class="controls" cx="50" cy="50" r="45" stroke="none" fill="#000000" opacity="0.0" pointer-events="all"/>',
                '<g class="control pause">',
                '<line x1="40" y1="35" x2="40" y2="65" stroke="#FFC800" fill="none" stroke-width="8" stroke-linecap="round"/>',
                '<line x1="60" y1="35" x2="60" y2="65" stroke="#FFC800" fill="none" stroke-width="8" stroke-linecap="round"/>',
                '</g>',
                '<g class="control play">',
                '<polygon points="45,35 65,50 45,65" fill="#FFC800" stroke-width="0"></polygon>',
                '</g>',
                '<g class="control stop">',
                '<rect x="35" y="35" width="30" height="30" stroke="#FFC800" fill="none" stroke-width="1"/>',
                '</g>',
                '</svg>'];

            template = template.join(' ');

            $.each(this, function (a, b) {
                
                var audio = $(this).find('audio');
                audio.attr('id', 'audio' + a);
                template = template.replace('width="34"','width="'+ audio.data('size')  +'"');
                template = template.replace('height="34"','height="'+ audio.data('size')  +'"');
                template = template.replace('id="playable"', 'id="playable' + a + '"');
                $(this).append(template);
                
            });

            var svgId = $(this).find('svg').attr('id');
            svgId     = document.getElementById(svgId);

            _.defaults = {
                this        : this,
                thisSelector: this.selector.toString(),
                playObj     : 'playable',
                progress    : '.progress-bar',
                precache    : '.precache-bar',
                audioObj    : 'audio',
                controlsObj : '.controls',
                pt          : svgId.createSVGPoint(),
                pc          : 298.1371428256714 // 2 pi r                                
            };

            lunar = {};

            _.settings = $.extend({}, _.defaults, options);

            $(_.settings.controlsObj).on('click', function (e) {

                var el = $(e.currentTarget).closest($(_.settings.thisSelector));

                var obj = {
                    el         : el,
                    activeAudio: el.find(_.settings.audioObj),
                    playObj    : el.find('[data-play]'),
                    precache   : el.find(_.settings.precache)
                };

                obj.class = obj.playObj.attr('class');
                switch (obj.class.replace('playable', '').trim()) {

                    case 'not-started':
                        _.stopAllSounds();
                        obj.activeAudio[0].play();
                        var audioId = document.getElementById(obj.activeAudio.attr('id'));
                        audioId.addEventListener('timeupdate', function (e) {
                            _.reportPosition(el, audioId)
                        });
                        obj.playObj.attr('class', 'playing');
                        break;
                    case 'playing':
                        obj.playObj.attr('class', 'playable paused');
                        obj.activeAudio[0].pause();
                        $(audioId).off('timeupdate');
                        break;
                    case 'paused':
                        obj.playObj.attr('class', 'playable playing');
                        obj.activeAudio[0].play();
                        break;
                    case 'ended':
                        obj.playObj.attr('class', 'playable');
                        obj.activeAudio.off('timeupdate', _.reportPosition);
                        break;
                }
            });

            $(_.defaults.audioObj).on('progress', function (e) {
                if (this.buffered.length > 0) {
                    var end = this.buffered.end(this.buffered.length - 1);
                    var cache = $(e.currentTarget).parent().find(_.settings.precache),
                        el    = $(this).closest($(_.settings.thisSelector));
                    _.setGraphValue(cache, end, el);
                }
            });

        }

    };

    // Add Plugin to Jquery
    $.fn.mediaPlayer = function (methodOrOptions) {
        if (_[methodOrOptions]) {
            return _[methodOrOptions].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof methodOrOptions === 'object' || !methodOrOptions) {
            // Default to "init"
            return _.init.apply(this, arguments);
        } else {
            $.error('Method ' + methodOrOptions + ' does not exist on jQuery.mediaPlayer');
        }
    };
})(jQuery);
</script>
<script>  $('.mediPlayer').mediaPlayer(); </script>
	
<!-- dont delete this please this is the main code being commented to cope with our idea of hiding 
based on api retrievals -->

<!-- image only options -->
 <div class="options_with_img">
<form id="quiz-form" method="post" action="submit.php">
        <div class="grid-container-quiz-img">
            <div class="grid-item-quiz-img">
                <button type="button" class="button-img" name="option" value="option1" style="width: 154px; height: 154px; border-radius:12px; background-image: url('http://localhost/wordpress/wp-content/uploads/2023/03/How-can-I-improve-my-performance-anxiety-for-singing.png');"></button>
            </div>

            <div class="grid-item-quiz-img">
                <button type="button" class="button-img" name="option" value="option2" style="width: 154px; height: 154px; border-radius:12px; background-image: url('http://localhost/wordpress/wp-content/uploads/2023/03/What-should-I-practise-to-improve-my-vocal-agility-while-singing.png');"></button>
            </div>

            <div class="grid-item-quiz-img">
                <button type="button" class="button-img" name="option" value="option3" style="width: 154px; height: 154px; border-radius:12px; background-image: url('http://localhost/wordpress/wp-content/uploads/2023/03/What-techniques-can-I-use-to-improve-my-vocal-agility-while-singing.png');"></button>
            </div>

            <div class="grid-item-quiz-img">
                <button type="button" class="button-img" name="option" value="option4" style="width: 154px; height: 154px; border-radius:12px; background-image: url('http://localhost/wordpress/wp-content/uploads/2023/03/What-techniques-can-I-use-to-improve-my-vocal-agility-while-singing.png');"></button>
            </div>
        </div>
        
            <p id="answer-feedback" class="feedback" style="text-align: center; margin-top:10px; margin-bottom:-12px;"></p>
        

        <input type="hidden" name="selected-option" id="selected-option" value="">
        <button type="submit" class="submit-btn" style="display: block; margin: 0 auto;margin-top:50px;margin-bottom:60px;width: 237.30px; height: 41px;">CHECK ANSWER</button>
        <button type="button" class="proceed-btn" style="display: none; margin: 0 auto;margin-top:50px;margin-bottom:60px;width: 237.30px; height: 41px;">CONTINUE</button>

    </form>

    <script>
        const correctAnswer = "option2"; // Change this to your correct answer

        const optionButtons = document.querySelectorAll(".button-img");
        optionButtons.forEach((button) => {
            button.addEventListener("click", () => {
                optionButtons.forEach((b) => b.classList.remove("selected"));
                button.classList.add("selected");
                document.getElementById('selected-option').value = button.value;
            });
        });

        const submitBtn = document.querySelector(".submit-btn");
        submitBtn.disabled = true;

        optionButtons.forEach((button) => {
            button.addEventListener("click", () => {
                submitBtn.disabled = false;
                optionButtons.forEach((b) => b.classList.remove("selected"));
                button.classList.add("selected");
                document.getElementById('selected-option').value = button.value;
            });
        });


        const quizForm = document.getElementById("quiz-form");
        quizForm.addEventListener("submit", (e) => {
        e.preventDefault();
        const selectedOption = document.getElementById("selected-option").value;
        if (selectedOption === correctAnswer) {
            document.querySelector(".proceed-btn").classList.add("green-bg-button-quiz");
            document.querySelector(".proceed-btn").style.display = "block";
            document.querySelector(".selected").classList.add("correct");
            document.querySelector(".submit-btn").style.display = "none";
            document.querySelector("#answer-feedback").innerHTML = "Correct!";
            document.querySelector("#answer-feedback").classList.add("correct");
        } else {
            document.querySelector(".proceed-btn").classList.add("red-bg-button-quiz");
            document.querySelector(".proceed-btn").style.display = "block";
            document.querySelector(".selected").classList.add("wrong");
            document.querySelector(".submit-btn").style.display = "none";
            document.querySelector("#answer-feedback").innerHTML = "Oops! Incorrect answer";
            document.querySelector("#answer-feedback").classList.add("wrong");
        }
        });


    </script>
</div> 

<!-- dont delete this please this is the main code being commented to cope with our idea of hiding 
based on api retrievals -->

<!-- dont delete this please this is the main code being commented to cope with our idea of hiding 
based on api retrievals -->

<!-- text only options -->
<div class="options_without_img">
    <form id="quiz-form" method="post" action="submit.php">
        <div class="grid-container-quiz">
            <div class="grid-item-quiz">
                <button type="button" class="option-btn" name="option" value="option1" style="width: 340px; height: 70px;">Option 1</button>
            </div>

            <div class="grid-item-quiz">
                <button type="button" class="option-btn" name="option" value="option2" style="width: 340px; height: 70px;">Option 2</button>
            </div>

            <div class="grid-item-quiz">
                <button type="button" class="option-btn" name="option" value="option3" style="width: 340px; height: 70px;">Option 3</button>
            </div>

            <div class="grid-item-quiz">
                <button type="button" class="option-btn" name="option" value="option4" style="width: 340px; height: 70px;">Option 4</button>
            </div>
        </div>
        
            <p id="answer-feedback" class="feedback" style="text-align: center; margin-top:10px; margin-bottom:-12px;"></p>
        

        <input type="hidden" name="selected-option" id="selected-option" value="">
        <button type="submit" class="submit-btn" style="display: block; margin: 0 auto;margin-top:50px;margin-bottom:60px;width: 237.30px; height: 41px;">CHECK ANSWER</button>
        <button type="button" class="proceed-btn" style="display: none; margin: 0 auto;margin-top:50px;margin-bottom:60px;width: 237.30px; height: 41px;">CONTINUE</button>

    </form>

    <script>
        const correctAnswer = "option2"; // Change this to your correct answer

        const optionButtons = document.querySelectorAll(".option-btn");
        optionButtons.forEach((button) => {
            button.addEventListener("click", () => {
                optionButtons.forEach((b) => b.classList.remove("selected"));
                button.classList.add("selected");
                document.getElementById('selected-option').value = button.value;
            });
        });

        const submitBtn = document.querySelector(".submit-btn");
        submitBtn.disabled = true;

        optionButtons.forEach((button) => {
            button.addEventListener("click", () => {
                submitBtn.disabled = false;
                optionButtons.forEach((b) => b.classList.remove("selected"));
                button.classList.add("selected");
                document.getElementById('selected-option').value = button.value;
            });
        });


        const quizForm = document.getElementById("quiz-form");
        quizForm.addEventListener("submit", (e) => {
        e.preventDefault();
        const selectedOption = document.getElementById("selected-option").value;
        if (selectedOption === correctAnswer) {
            document.querySelector(".proceed-btn").classList.add("green-bg-button-quiz");
            document.querySelector(".proceed-btn").style.display = "block";
            document.querySelector(".selected").classList.add("correct");
            document.querySelector(".submit-btn").style.display = "none";
            document.querySelector("#answer-feedback").innerHTML = "Correct!";
            document.querySelector("#answer-feedback").classList.add("correct");
        } else {
            document.querySelector(".proceed-btn").classList.add("red-bg-button-quiz");
            document.querySelector(".proceed-btn").style.display = "block";
            document.querySelector(".selected").classList.add("wrong");
            document.querySelector(".submit-btn").style.display = "none";
            document.querySelector("#answer-feedback").innerHTML = "Oops! Incorrect answer";
            document.querySelector("#answer-feedback").classList.add("wrong");
        }
        });

    </script>
    
</div>

<!-- dont delete this please this is the main code being commented to cope with our idea of hiding 
based on api retrievals -->

<!-- option with audio -->
<div class="options_without_img">
    <form id="quiz-form" method="post" action="submit.php">
        <div class="grid-container-quiz" >
            <div class="grid-item-quiz" id="audio-option">
					<div class="grid-item-audio" id="aud-opt-1"><img class="audio-quiz-img" src="http://localhost/wordpress/wp-content/uploads/2023/04/noun_Speaker_10453.png"></div> 
					<button type="button" class="audio-option-btn" name="option" value="option1" style="width: 340px; height: 70px;">Option 1</button>
            </div>

            <div class="grid-item-quiz"id="audio-option">
					<div class="grid-item-audio" id="aud-opt-2"><img class="audio-quiz-img" src="http://localhost/wordpress/wp-content/uploads/2023/04/noun_Speaker_10453.png"></div> 
                <button type="button" class="audio-option-btn" name="option" value="option2" style="width: 340px; height: 70px;">Option 2</button>
            </div>

            <div class="grid-item-quiz" id="audio-option">
					<div class="grid-item-audio" id="aud-opt-3"><img class="audio-quiz-img" src="http://localhost/wordpress/wp-content/uploads/2023/04/noun_Speaker_10453.png"></div> 
                <button type="button" class="audio-option-btn" name="option" value="option3" style="width: 340px; height: 70px;">Option 3</button>
            </div>

            <div class="grid-item-quiz" id="audio-option">
					<div class="grid-item-audio" id="aud-opt-4"><img class="audio-quiz-img" src="http://localhost/wordpress/wp-content/uploads/2023/04/noun_Speaker_10453.png"></div> 
                <button type="button" class="audio-option-btn" name="option" value="option4" style="width: 340px; height: 70px;">Option 4</button>
            </div>
        </div>
        
            <p id="answer-feedback" class="feedback" style="text-align: center; margin-top:10px; margin-bottom:-12px;"></p>
        

        <input type="hidden" name="selected-option" id="selected-option" value="">
        <button type="submit" class="submit-btn" style="display: block; margin: 0 auto;margin-top:50px;margin-bottom:60px;width: 237.30px; height: 41px;">CHECK ANSWER</button>
        <button type="button" class="proceed-btn" style="display: none; margin: 0 auto;margin-top:50px;margin-bottom:60px;width: 237.30px; height: 41px;">CONTINUE</button>

    </form>

    <script>
        const correctAnswer = "option2"; // Change this to your correct answer

        const optionButtons = document.querySelectorAll(".option-btn");
        optionButtons.forEach((button) => {
            button.addEventListener("click", () => {
                optionButtons.forEach((b) => b.classList.remove("selected"));
                button.classList.add("selected");
                document.getElementById('selected-option').value = button.value;
            });
        });

        const submitBtn = document.querySelector(".submit-btn");
        submitBtn.disabled = true;

        optionButtons.forEach((button) => {
            button.addEventListener("click", () => {
                submitBtn.disabled = false;
                optionButtons.forEach((b) => b.classList.remove("selected"));
                button.classList.add("selected");
                document.getElementById('selected-option').value = button.value;
            });
        });


        const quizForm = document.getElementById("quiz-form");
        quizForm.addEventListener("submit", (e) => {
        e.preventDefault();
        const selectedOption = document.getElementById("selected-option").value;
        if (selectedOption === correctAnswer) {
            document.querySelector(".proceed-btn").classList.add("green-bg-button-quiz");
            document.querySelector(".proceed-btn").style.display = "block";
            document.querySelector(".selected").classList.add("correct");
            document.querySelector(".submit-btn").style.display = "none";
            document.querySelector("#answer-feedback").innerHTML = "Correct!";
            document.querySelector("#answer-feedback").classList.add("correct");
        } else {
            document.querySelector(".proceed-btn").classList.add("red-bg-button-quiz");
            document.querySelector(".proceed-btn").style.display = "block";
            document.querySelector(".selected").classList.add("wrong");
            document.querySelector(".submit-btn").style.display = "none";
            document.querySelector("#answer-feedback").innerHTML = "Oops! Incorrect answer";
            document.querySelector("#answer-feedback").classList.add("wrong");
        }
        });

    </script>
    <script>
const audio1 = new Audio("https://s3.ap-south-1.amazonaws.com/riyaz-quizzes/D3.mp3");
const audio2 = new Audio("https://s3.ap-south-1.amazonaws.com/riyaz-quizzes/G3.mp3");
const audio3 = new Audio("https://s3.ap-south-1.amazonaws.com/riyaz-quizzes/C3+G3+C4.mp3");
const audio4 = new Audio("https://s3.ap-south-1.amazonaws.com/riyaz-quizzes/C3+D3+E3.mp3");
const buttons = document.querySelectorAll("div");

buttons.forEach(div => {
  div.addEventListener("click", () => {
    if (div.id === "aud-opt-1") {
      // play audio for div with id "div1"
      audio1.play();
    } else if (div.id === "aud-opt-2") {
      // play audio for div with id "div2"
      audio2.play();
    } else if (div.id === "aud-opt-3") {
      // play audio for div with id "div3"
      audio3.play();
    }
	else if (div.id === "aud-opt-4") {
      // play audio for div with id "div4"
      audio4.play();
    }
    // add more conditions for other divs as needed
  });
});

</script>
</div>

<!-- end of option with audio -->
<?php 
get_footer(); 
?>
</div>


