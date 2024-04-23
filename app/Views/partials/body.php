<?php

?>

<style>
    .falling-text {
        position: absolute;
        font-size: 14px;
        top: 80px;
        animation: fall 7s linear infinite;
        /* Fall animation for 5 seconds */
    }

    .text-color {
        text-shadow: -1px 3px 2px rgba(117, 223, 163, 1);
    }

    @keyframes fall {
        from {
            top: -80px;
            /* Start above the container */
        }

        to {
            top: 90vh;
            /* End at the bottom of the container */
        }
    }

    @keyframes blink {
        0% {
            opacity: 1;
        }

        50% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    .blinking {
        animation: blink 1s infinite;
    }

    .correctText {
        color: green;
        font-weight: bolder;
    }

    .wrongText {
        color: orangered;
        font-weight: bolder;
    }

    #placeholder * {
        margin: 0;
        padding: 0;
    }
</style>
<div class="container">
    <div class="row d-flex flex-lg-row flex-column align-items-center justify-content-center w-100 mx-auto py-5">
        <div class="position-relative d-flex justify-content-between border border-dark rounded mx-3" style="width:610px; height: 290px;">
            <div class="position-absolute d-flex justify-content-center top-50 start-50 translate-middle h-100 w-100" id="start-container" style="background-color: rgba(1,1,1,.5); z-index: 1;">
                <div class="d-flex flex-column align-items-center justify-content-center w-100 " style="display: none;" id="main">
                    <button onclick="play('guest')" class="btn neu neu-btn p-color w-50 m-2">Play As Guest</button>
                    <button onclick="play('user')" class="btn neu neu-btn p-color w-50 m-2">Use a Username</button>
                    <button onclick="play('new-user')" class="btn neu neu-btn p-color w-50 m-2">Register</button>
                </div>
                <div class="flex-column align-items-center justify-content-center w-100" style="display: none;" id="login">
                    <h2>Login</h2>
                    <input type="text" class="form-control m-2 neu-inset w-50" placeholder="User-name">
                    <input type="password" class="form-control m-2 neu-inset w-50" placeholder="Password">
                    <button class="btn neu neu-btn p-color m-2  ">Play the game</button>
                </div>
                <div class="flex-column align-items-center justify-content-center w-100" style="display: none;" id="register">
                    <h2>Register</h2>
                    <input type="text" class="form-control m-2 neu-inset w-50" placeholder="User-name">
                    <input type="password" class="form-control m-2 neu-inset w-50" placeholder="Password">
                    <input type="password" class="form-control m-2 neu-inset w-50" placeholder="Confirm-Password">
                    <button class="btn neu neu-btn p-color m-2  ">Play the game</button>
                </div>
            </div>
            <div class="" style="width: 600px; height: 290px;">
                <div class="position-relative overflow-y-hidden d-flex flex-column justify-content-center" id="placeholder_falling" style="height: 100%; z-index: 0;">

                </div>
                <div class="position-relative flex-column justify-content-end" id="placeholder_input" style="height: 100%; z-index: 0; display: none;">
                    <div class="d-flex flex-row justify-content-between">
                        <p>Score <span id="score">0</span></p>
                        <span id="timer">0</span>
                    </div>
                    <div class="bg-dark p-2 d-flex flex-wrap align-items-center" id="placeholder" style="height: 65%;">
                    </div>
                    <div class="row  py-3">
                        <div class="input-group neu neu-inset p-3" style="caret-color: transparent; font-size: 20px;" id="input_group" contenteditable="true">
                            <div id="carret" class="blinking" style="width:1px; height:20px; background-color: white;" contenteditable="false"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 neu  mt-3 " style="height: 500px;">
            <h3 class="m-2 fw-bold my-color text-center">Leaderboard</h1>
                <div class="col overflow-y-scroll rmv-scroll" style="height: 430px;">
                    <?php for ($i = 1; $i < 20; $i++) : ?>
                        <div class="d-flex flex-row justify-content-between px-3 py-2 p-color neu m-2 rounded border border-dark">
                            <div class="d-flex flex-row">
                                <p class="my-0 mx-2"><?= $i ?></p>
                                <p class="fs-6 fw-semi-bold m-0">Juan Dela Cruz</p>
                            </div>
                            <p class="m-0"><?= 2000 - $i ?></p>
                        </div>
                    <?php endfor ?>
                </div>
        </div>
    </div>
</div>
<script>
    var textArray = [
        "SELECT * FROM users WHERE user_id = 3;",
        "SELECT username, email FROM users WHERE username LIKE 'J%';",
        "SELECT COUNT(*) FROM messages;",
        "SELECT * FROM messages ORDER BY timestamp DESC LIMIT 5;",
        "INSERT INTO users (username, email) VALUES ('NewUser6', 'newuser6@example.com');",
        "UPDATE users SET email = 'updatedemail3@example.com' WHERE user_id = 1;",
        "DELETE FROM users WHERE email = 'newuser6@example.com';"
    ];

    var xhr = new XMLHttpRequest();
    var data;
    xhr.open('GET', "<?= site_url('/access') ?>"), true;
    xhr.onload = function() {
        if (xhr.status == 200) {
            data = JSON.parse(xhr.responseText.trim());
        }
    }
    xhr.send();


    function play(type) {
        var main = document.querySelector('#main');
        var login = document.querySelector('#login');
        var register = document.querySelector('#register');
        var input_group = document.querySelector('#input_group');
        var start_container = document.querySelector('#start-container');
        var placeholder_fall = document.querySelector('#placeholder_falling');
        var placeholder_input = document.querySelector('#placeholder_input');

        switch (type) {
            case 'guest':
                input_group.style.display = 'flex';
                placeholder.style.zIndex = '1';
                start_container.style.zIndex = '0';
                placeholder_fall.style.display = 'none';
                placeholder_fall.classList.remove('d-flex');
                placeholder_input.style.display = 'block';
                main.classList.remove('d-flex');

                placeholder
                gameStart();
                break;
            case 'user':
                break;
            case 'new-user':
                break;
            default:
                break;
        }
    }

    let timeLeft = 0;
    let add_score = 0;
    let current_points = 0;
    let interval;

    function checkInput(ev) {
        var placeholder = document.querySelector('#placeholder');
        var last_element = placeholder.lastChild;
        var score = document.getElementById('score');
        var target = ev.target;

        if (last_element.textContent == target.value) {
            placeholder.removeChild(last_element);
            current_points = current_points + add_score;
            console.log('hello');
            score.innerText = current_points;
            timeleft = timeLeft + 30;

            createTextElement();
            target.value = '';
        } else {
            console.log('not yet ' + last_element.textContent + ' ' + target.value)
        }
    }

    const inputGroup = document.querySelector('#input_group');
    const placeholder = document.querySelector('#placeholder');

    inputGroup.addEventListener('keydown', function(event) {
        event.preventDefault();
        var key = event.key;

        const validChars = /^[a-zA-Z0-9!@#$%^&*()-=_+[\]{}|;:'",.<>/?\\ ]+$/;
        var carret = document.querySelector('#carret');
        var currCountInputGroup = inputGroup.childElementCount - 1;
        var currCountPlaceholder = placeholder.childElementCount;

        if (key === "Backspace") {
            //get the current last element in the inputgroup and the current span placeholder
            var prevElement = carret.previousElementSibling;
            var spanPlaceholder = placeholder.children[currCountInputGroup];

            spanPlaceholder.classList.remove('correctText');
            inputGroup.removeChild(prevElement);

        }

        if (validChars.test(key) && key.length == 1) {
            //create an span element
            var spanElement = document.createElement('span');
            spanElement.innerHTML = key === ' ' ? '&nbsp' : key;

            //check the size of the inputgroup
            if (currCountInputGroup - 1 < currCountPlaceholder) {
                var spanPlaceholder = placeholder.children[currCountInputGroup];
                //check the element if its the same 
                if (spanPlaceholder.innerText == spanElement.innerText) {
                    spanElement.className = 'correctText';
                    spanPlaceholder.className = 'correctText';
                } else {
                    spanElement.className = 'wrongText';
                    spanPlaceholder.className = 'wrongText';
                }
            }

            inputGroup.insertBefore(spanElement, carret);
        }

    })

    function gameStart() {
        timeLeft += 10;
        var placeholder = document.getElementById('placeholder');
        removeElement(placeholder);
        createTextElement();
        interval = setInterval(function() {
            time(timeLeft);
            timeLeft--;

            if (timeLeft == -1) {
                // If the timer has reached 0, clear the interval to stop the timer
                clearInterval(interval);
            }
        }, 1000)
    }

    function time(curTime) {
        var timer = document.querySelector('#timer');
        timer.innerHTML = curTime;
    }


    function createTextElement() {
        var placeholder = document.querySelector('#placeholder');

        var obj = data['queries'][Math.floor(Math.random() * data['queries'].length)];
        var text = obj['query'];
        add_time = obj['time'];
        add_score = obj['points'];

        for (var i = 0; i < text.length; i++) {
            var textElement = document.createElement('h3');
            textElement.innerHTML = text[i] === ' ' ? '&nbsp' : text[i];
            textElement.className = "wrongText";
            placeholder.appendChild(textElement);
        }
    }

    //remove all element on the placeholder
    function removeElement(placeholder) {
        while (placeholder.firstChild) {
            placeholder.removeChild(placeholder.firstChild);
        }
    }

    function animateFall() {
        var placeholder = document.getElementById('placeholder_falling');

        textArray.forEach((text, index) => {
            var textElement = document.createElement('div');
            textElement.className = 'falling-text my-color';
            textElement.textContent = text;

            textElement.style.left = Math.random() * 60 + "%";
            textElement.style.top = "-80px";

            textElement.style.animationDelay = `${index * 1}s`;

            placeholder.appendChild(textElement);
        });
    }

    animateFall();
</script>
<?php
echo view('partials/num_of_user')
?>