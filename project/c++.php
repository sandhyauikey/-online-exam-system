<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Examination System</title>

    <script>
        var index = 0;
        var score = 0;
        var question = ["What is the primary purpose of a loop in programming?", "What does the if statement do in programming?","Explain the concept of a variable in programming.",
            "What is the purpose of a for loop in programming?", "What is the role of a constructor in object-oriented programming (OOP)?"];
        var option1 = ["To perform a specific task once", "Executes a block of code repeatedly", "It defines a function", " To execute code only once", " It defines the properties of an object"];
        var option2 = ["To execute a block of code repeatedly", "Declares a variable", " It holds a fixed value that cannot be changed", " To perform operations on arrays", "It initializes an object when it is created"];
        var option3 = ["To define a function", "Checks a condition and executes code based on the result", "It represents a storage location in memory to store data", "To execute a block of code repeatedly for a specified number of times", "It executes a block of code repeatedly"];
        var option4 = ["To check conditions", "Defines a function", "It executes a block of code repeatedly", " To define a function", "It performs arithmetic calculations"];
        var answer = [2, 3, 3, 3, 2];
        var userAnswers = []; // Array to store user's answers

        var timeLimitMinutes = 15; // Updated time limit for 5 questions
        var timeLimitMilliseconds = timeLimitMinutes * 60 * 1000; // Convert minutes to milliseconds
        var startTime = Date.now();

        function show(v) {
            index = v;
            var questionNumber = v + 1; // Calculate question number (starting from 1)
            document.getElementById("q").innerHTML = "Question " + questionNumber + ": " + question[v];
            document.getElementById("op1").innerHTML = "<input type='radio' name='x' id='a' value='1'>" + option1[v];
            document.getElementById("op2").innerHTML = "<input type='radio'  name='x' id='b' value='2'>" + option2[v];
            document.getElementById("op3").innerHTML = "<input type='radio' name='x' id='c' value='3'>" + option3[v];
            document.getElementById("op4").innerHTML = "<input type='radio' name='x' id='d' value='4'>" + option4[v];
            
            // Restore user's answer if previously selected
            if (userAnswers[v] !== undefined) {
                document.getElementById("a").checked = (userAnswers[v] == 1);
                document.getElementById("b").checked = (userAnswers[v] == 2);
                document.getElementById("c").checked = (userAnswers[v] == 3);
                document.getElementById("d").checked = (userAnswers[v] == 4);
            } else {
                // Clear radio button selection if no answer was previously selected
                document.getElementById("a").checked = false;
                document.getElementById("b").checked = false;
                document.getElementById("c").checked = false;
                document.getElementById("d").checked = false;
            }
        }

        function next() {
            // Save user's answer before moving to next question
            if (document.getElementById("a").checked == true) {
                userAnswers[index] = 1;
            } else if (document.getElementById("b").checked == true) {
                userAnswers[index] = 2;
            } else if (document.getElementById("c").checked == true) {
                userAnswers[index] = 3;
            } else if (document.getElementById("d").checked == true) {
                userAnswers[index] = 4;
            } else {
                userAnswers[index] = undefined; // If no answer selected, set to undefined
            }

            if (index == 4) { // Updated to 4 for 5 questions
                index = 0;
            } else {
                index++;
            }
            show(index);
        }

        function previous() {
            if (index == 0) {
                index = 4; // Updated to 4 for 5 questions
            } else {
                index--;
            }
            show(index);
        }

        function checkanswer() {
            // Check user's answer and update score
            var uans;
            if (document.getElementById("a").checked == true) {
                uans = 1;
            } else if (document.getElementById("b").checked == true) {
                uans = 2;
            } else if (document.getElementById("c").checked == true) {
                uans = 3;
            } else if (document.getElementById("d").checked == true) {
                uans = 4;
            } else {
                uans = undefined; // If no answer selected, set to undefined
            }
            
            if (uans == answer[index]) {
                score++;
                alert("Correct!");
            } else {
                alert("Wrong!");
            }
        }

        function finish() {
            // Save user's answer for the last question before finishing
            if (document.getElementById("a").checked == true) {
                userAnswers[index] = 1;
            } else if (document.getElementById("b").checked == true) {
                userAnswers[index] = 2;
            } else if (document.getElementById("c").checked == true) {
                userAnswers[index] = 3;
            } else if (document.getElementById("d").checked == true) {
                userAnswers[index] = 4;
            } else {
                userAnswers[index] = undefined; // If no answer selected, set to undefined
            }

            var elapsedTime = Date.now() - startTime;
            var remainingTime = timeLimitMilliseconds - elapsedTime;
            var remainingMinutes = Math.floor(remainingTime / (1000 * 60));
            var remainingSeconds = Math.floor((remainingTime % (1000 * 60)) / 1000);
            document.getElementById("timeRemaining").innerHTML = "Time Remaining: " + remainingMinutes + " minutes " + remainingSeconds + " seconds";
            document.getElementById("score").innerHTML = "Score: " + score + "/5"; // Updated to /5 for 5 questions
        }

        // Start the timer
        var timer = setInterval(function () {
            var elapsedTime = Date.now() - startTime;
            if (elapsedTime >= timeLimitMilliseconds) {
                clearInterval(timer);
                finish();
            } else {
                var remainingTime = timeLimitMilliseconds - elapsedTime;
                var remainingMinutes = Math.floor(remainingTime / (1000 * 60));
                var remainingSeconds = Math.floor((remainingTime % (1000 * 60)) / 1000);
                document.getElementById("timeRemaining").innerHTML = "Time Remaining: " + remainingMinutes + " minutes " + remainingSeconds + " seconds";
            }
        }, 1000); // Check elapsed time every second (1000 milliseconds)

        // Show the first question on page load
        window.onload = function () {
            show(0);
        };
    </script>
</head>

<body>
<center>
    <h1>Online Examination System</h1><br>
    <div id="timeRemaining"></div><br>

    <input type='button' value='1' onClick='show(0)'>
    <input type='button' value='2' onClick='show(1)'>
    <input type='button' value='3' onClick='show(2)'>
    <input type='button' value='4' onClick='show(3)'>
    <input type='button' value='5' onClick='show(4)'>

    <p id='q'></p>
    <p id='op1'></p>
    <p id='op2'></p>
    <p id='op3'></p>
    <p id='op4'></p>
    <input type='button' value='Answer' onClick='checkanswer()' style='background-color:green;'><br><br>
    <input type='button' value='Previous' onClick='previous()'>
    <input type='button' value='Next' onClick='next()'><br><br>
    <input type='button' value='Finish' onClick='finish()'><br>
    <div id="score"></div>
</center>
</body>
</html>
