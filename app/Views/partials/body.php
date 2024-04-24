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

    .inputcolor {
        color: #faa356;
        font-weight: bolder;
    }

    #placeholder * {
        margin: 0;
        padding: 0;
    }
</style>
<div class="container d-flex flex-lg-row flex-column">
    <div class="row d-flex flex-lg-row flex-column align-items-center justify-content-center w-100 w-lg-50 mx-auto py-5">
        <div class="position-relative d-flex justify-content-between border border-dark rounded mb-3" style="width:610px; height: 300px;">
            <div class="position-absolute d-flex justify-content-center top-50 start-50 translate-middle h-100 w-100" id="start-container" style="background-color: rgba(1,1,1,.5); z-index: 1;">
                <div class="d-flex flex-column align-items-center justify-content-center w-100 " style="display: none;" id="main">
                    <button onclick="play('guest')" class="btn neu neu-btn p-color w-50 m-2">Play As Guest</button>
                    <button onclick="play('user')" class="btn neu neu-btn p-color w-50 m-2" disabled>Use a Username</button>
                    <button onclick="play('new-user')" class="btn neu neu-btn p-color w-50 m-2" disabled>Register</button>
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
                            <div id="carret" class="blinking" style="width:1px; height:25px; background-color: white;" contenteditable="false"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        echo view('partials/num_of_user')
        ?>
    </div>
    <div class="d-flex flex-row align-items-start justify-content-start mx-auto w-100 w-lg-50 py-5">
        <div class="mx-3 p-3 neu neu-inset">
            <h1 class="my-color">SQL GAME</h1>
            <div class="p-color" style="font-size: 19px;">
                <p>
                    SQL Game is a unique twist on the classic typing game genre, focusing specifically on SQL queries. Whether you're a seasoned database developer or just dipping your toes into the world of SQL, this game offers a fun and interactive way to practice your skills.
                </p>
                <p>
                    Created with the intention of helping players remember and master SQL queries, SQL Game provides a dynamic and engaging platform where you can test your knowledge, compete with friends, and track your progress over time. So why wait? Dive into the world of SQL gaming and level up your database skills today!
                </p>
                <p>
                    Designed with both learning and enjoyment in mind, SQL Game challenges players to type out SQL queries ranging from simple CRUD operations to more complex database manipulations. By immersing yourself in this virtual SQL environment, you can sharpen your query-writing abilities and reinforce your understanding of key database concepts.
                </p>
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


    function saveGuest(time, points) {
        console.log('hello');
        var formdata = new FormData();
        formdata.append('score', points);
        formdata.append('time', time);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', "<?= site_url() . "save-guest" ?>", true);

        xhr.onload = function() {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                console.log(response.messages);
            }
        }

        xhr.send(formdata);
    }

    let timeLeft = 0;
    let add_score = 0;
    let current_points = 0;
    let interval;
    let query = "";
    let inputValue = "";

    const inputGroup = document.querySelector('#input_group');
    const placeholder = document.querySelector('#placeholder');

    inputGroup.addEventListener('keydown', function(event) {
        event.preventDefault();
        var key = event.key;

        const validChars = /^[a-zA-Z0-9!@#$%^&*()-=_+[\]{}|;:'",.<>/?\\ ]+$/;
        var carret = document.querySelector('#carret');
        var currCountInputGroup = inputGroup.childElementCount - 1;
        var currCountPlaceholder = placeholder.childElementCount - 1;

        if (key === "Backspace") {
            //get the current last element in the inputgroup and the current span placeholder
            var prevElement = carret.previousElementSibling;
            var spanPlaceholder = placeholder.children[currCountInputGroup - 1];

            //change the color of placeholder
            spanPlaceholder.classList.remove('correctText');
            spanPlaceholder.classList.add('wrongText');

            //remove from reference varaiable and also in  input field
            inputValue = inputValue.slice(0, -1);
            inputGroup.removeChild(prevElement);
        }

        if (key === 'Enter') {
            checkInput();
        }

        if (validChars.test(key) && key.length == 1) {
            //check the size of the inputgroup
            if (currCountInputGroup - 1 < currCountPlaceholder) {
                var spanPlaceholder = placeholder.children[currCountInputGroup];

                //create an span element
                var spanElement = document.createElement('span');
                spanElement.innerHTML = key === ' ' ? '&nbsp' : key;

                //store inputed data for reference
                inputValue += key;

                //check the element if its the same 
                if (spanPlaceholder.innerText == spanElement.innerText) {
                    spanElement.className = 'correctText';
                    spanPlaceholder.className = 'correctText';
                } else {
                    spanElement.className = 'wrongText';
                    spanPlaceholder.className = 'wrongText';
                }
                inputGroup.insertBefore(spanElement, carret);
            }
        }


    })

    function play(type) {
        var main = document.querySelector('#main');
        var login = document.querySelector('#login');
        var register = document.querySelector('#register');
        var input_group = document.querySelector('#input_group');
        var start_container = document.querySelector('#start-container');
        var placeholder_fall = document.querySelector('#placeholder_falling');
        var placeholder_input = document.querySelector('#placeholder_input');

        //variables
        timeLeft += 30;
        add_score = 0;
        current_points = 0;
        query = "";
        inputValue = "";

        switch (type) {
            case 'guest':
                input_group.style.display = 'flex';
                placeholder.style.zIndex = '1';
                start_container.style.zIndex = '0';
                placeholder_fall.style.display = 'none';
                placeholder_fall.classList.remove('d-flex');
                placeholder_input.style.display = 'block';
                main.classList.remove('d-flex');
                inputGroup.focus();
                gameStart();
                break;
            case 'user':
                break;
            case 'new-user':
                break;
            case 'end':
                input_group.style.display = 'none';
                placeholder.style.zIndex = '0';
                start_container.style.zIndex = '1';
                placeholder_fall.style.display = 'block';
                placeholder_fall.classList.add('d-flex');
                placeholder_input.style.display = 'none';
                main.classList.add('d-flex');
                removeElement(inputGroup, inputGroup.childElementCount - 2);
                removeElement(placeholder, placeholder.childElementCount - 1);

                saveGuest(100, 10);
                break;
        }
    }

    function gameStart() {
        createTextElement();
        interval = setInterval(function() {

            var timer = document.querySelector('#timer');
            timer.innerHTML = timeLeft;

            timeLeft--;

            if (timeLeft == -1) {
                // If the timer has reached 0, clear the interval to stop the timer
                clearInterval(interval);
                play('end');
            }
        }, 1000);
    }

    function createTextElement() {
        var placeholder = document.querySelector('#placeholder');

        var obj = data['queries'][Math.floor(Math.random() * data['queries'].length)];
        var text = obj['query'];
        query = text;
        add_score += obj['points'];

        for (var i = 0; i < text.length; i++) {
            var textElement = document.createElement('h3');
            textElement.innerHTML = text[i] === ' ' ? '&nbsp' : text[i];
            textElement.className = "inputcolor";
            placeholder.appendChild(textElement);
        }
    }

    //remove all element on the placeholder
    function removeElement(container, start) {
        for (var i = start; i >= 0; i--) {
            container.removeChild(container.children[i]);
        }
    }

    function checkInput() {
        var score = document.getElementById('score');

        if (query === inputValue) {
            removeElement(inputGroup, inputGroup.childElementCount - 2);
            removeElement(placeholder, placeholder.childElementCount - 1);
            inputValue = "";
            createTextElement();
            timeLeft += 20;
            console.log(timeLeft);
            current_points = current_points + add_score;
            score.innerHTML = current_points;
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

<div class="container d-flex flex-row mb-4">
    <div class="col mt-3 m-2 p-3">
        <h3 class="m-3 p-4 fw-bold my-color text-center">GUEST PLAYER</h1>
            <div class="col overflow-y-scroll rmv-scroll" style="height: 430px;">
                <?php if (count($guest_data) > 0) : ?>
                    <?php for ($i = 0; $i < count($guest_data); $i++) : ?>
                        <div class="d-flex flex-row justify-content-between px-3 py-2 p-color neu m-2 rounded border border-dark">
                            <div class="d-flex flex-row">
                                <p class="fs-6 fw-semi-bold m-0">Guest <?= $i + 1 ?></p>
                            </div>
                            <p class="m-0"><?= $guest_data[$i]['score'] ?></p>
                        </div>
                    <?php endfor ?>
                <?php else : ?>
                    <div class="d-flex flex-row justify-content-between px-3 py-2 p-color neu m-2 rounded border border-dark">
                        <div class="d-flex flex-row justify-content-center">
                            <p class="fs-6 fw-semi-bold m-0">No data yet!!</p>
                        </div>
                    </div>
                <?php endif ?>
            </div>
    </div>
    <div class="col neu mt-3 m-2 p-3">
        <h3 class="m-3 p-4 fw-bold my-color text-center">LEADERBOARD</h1>
            <div class="col overflow-y-scroll rmv-scroll" style="height: 430px;">
                <?php if (count($users_data) > 0) : ?>
                    <?php for ($i = 1; $i < 20; $i++) : ?>
                        <div class="d-flex flex-row justify-content-between px-3 py-2 p-color neu m-2 rounded border border-dark">
                            <div class="d-flex flex-row">
                                <p class="my-0 mx-2"><?= $i ?></p>
                                <p class="fs-6 fw-semi-bold m-0">Juan Dela Cruz</p>
                            </div>
                            <p class="m-0"><?= 2000 - $i ?></p>
                        </div>
                    <?php endfor ?>
                <?php else : ?>
                    <div class="d-flex flex-row justify-content-between px-3 py-2 p-color neu m-2 rounded border border-dark">
                        <div class="d-flex flex-row justify-content-center">
                            <p class="fs-6 fw-semi-bold m-0">No data yet!!</p>
                        </div>
                    </div>
                <?php endif ?>
            </div>
    </div>
</div>