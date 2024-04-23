<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
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
    </style>
</head>

<body>
    <div id="placeholder" style="font-size: 20px; font-weight: bolder;"></div>

    <div id="container" style="height: auto; width: 300px; display: flex; flex-flow:row wrap; font-size:20px ; border: 1px solid black; padding: 5px; caret-color: transparent;" onclick="toggleInputField()" contenteditable="true">
        <div id="carret" class="blinking" style="width:1px; height:20px; background-color: black;" contenteditable="false"></div>
    </div>

    <script>
        var text = "AREA FORBIDDEN";
        var placeholder = document.querySelector('#placeholder');


        for (var i = 0; i < text.length; i++) {
            var spanElement = document.createElement('span');
            spanElement.innerText = text[i];
            placeholder.appendChild(spanElement);
        }
    </script>
    <script>
        // Get the input field and container div
        const inputField = document.getElementById('inputField');
        const container = document.getElementById('container');



        container.addEventListener('keydown', function(event) {
            event.preventDefault();
            var key = event.key;
            const validChars = /^[a-zA-Z0-9!@#$%^&*()-=_+[\]{}|;:'",.<>/?\\ ]+$/;

            var carret = document.querySelector('#carret');


            var lastSpan = carret.previousElementSibling;
            if (key === 'Backspace' && lastSpan != null && lastSpan.tagName == 'SPAN') {
                var currCountContainer = container.childElementCount - 2;
                var currCountPlaceholder = placeholder.childElementCount;
                var placeHolderElement = placeholder.children[currCountContainer];
                console.log(currCountContainer);
                placeHolderElement.classList.remove("correctText");
                placeHolderElement.classList.remove("wrongText");
                container.removeChild(lastSpan);
            }

            if (validChars.test(key) && key.length == 1) {
                var currCountContainer = container.childElementCount - 1;
                var currCountPlaceholder = placeholder.childElementCount;

                //check if count is greater
                if (currCountContainer < currCountPlaceholder) {
                    // create span element 
                    var spanElement = document.createElement('span');
                    spanElement.innerHTML = key === ' ' ? '&nbsp' : key;
                    var placeHolderElement = placeholder.children[currCountContainer];


                    //check if the element in placeholder and the element created is the same
                    if (placeHolderElement.innerText === spanElement.innerText) {
                        placeHolderElement.className = 'correctText';
                        spanElement.className = 'correctText';
                    } else {
                        placeHolderElement.className = 'wrongText';
                        spanElement.className = 'wrongText';
                    }

                    container.insertBefore(spanElement, carret);
                }
            }
        })
    </script>


</body>

</html>