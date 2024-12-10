var timer;
var timeElapsed = 0;
var questions = [];
var currentQuestion = null;
var correctAnswers = 0;
var questionNumber = 1;

document.getElementById("startButton").addEventListener("click", startExam);
document.getElementById("checkButton").addEventListener("click", checkAnswer);
document.getElementById("nextButton").addEventListener("click", loadNextQuestion);

var timeLeft = 1800; // 30 minutes in seconds

function startTimer() {
    var timerDisplay = document.getElementById("timer");
    timer = setInterval(function () {
        if (timeLeft <= 0) {
            clearInterval(timer);
            finishExam();
        } else {
            var minutes = Math.floor(timeLeft / 60);
            var seconds = timeLeft % 60;
            timerDisplay.textContent = minutes + ":" + (seconds < 10 ? "0" + seconds : seconds);
            timeLeft--;
        }
    }, 1000);
}

function startExam() {
    document.getElementById("instructions").style.display = "none";
    document.getElementById("questionContainer").style.display = "block";
    startTimer();
    fetchQuestions();
}

function fetchQuestions() {
    fetch('fetchQuestions.php')
        .then(function (response) {
            if (!response.ok) {
                throw new Error("Failed to fetch questions");
            }
            return response.json();
        })
        .then(function (data) {
            if (data.error) {
                alert(data.error);
                return;
            }
            questions = data;
            loadNextQuestion();
        })
        .catch(function (error) {
            console.error("Error fetching questions:", error);
            alert("Unable to load questions. Please try again later.");
        });
}

function loadNextQuestion() {
    if (questions.length === 0) {
        finishExam();
        return;
    }

    currentQuestion = questions.shift();
    displayQuestion();
    questionNumber++;

    document.getElementById("checkButton").disabled = false;
    document.getElementById("nextButton").disabled = true;
    clearFeedback();
}

function displayQuestion() {
    var questionDiv = document.getElementById("questions");
    questionDiv.innerHTML =
        "<p><strong>Question " + questionNumber + ": " + currentQuestion.question + "</strong></p><br>" +
        "<label><input type='radio' name='answer' value='A'> " + currentQuestion.option_a + "</label><br>" +
        "<label><input type='radio' name='answer' value='B'> " + currentQuestion.option_b + "</label><br>" +
        "<label><input type='radio' name='answer' value='C'> " + currentQuestion.option_c + "</label><br>" +
        "<label><input type='radio' name='answer' value='D'> " + currentQuestion.option_d + "</label><br>" +
        "<p id='feedback' class='feedback'></p>";
}

function checkAnswer() {
    var selectedAnswer = document.querySelector('input[name="answer"]:checked');
    var feedback = document.getElementById("feedback");

    if (!selectedAnswer) {
        feedback.textContent = "Please select an answer.";
        feedback.style.color = "red";
        return;
    }

    var isCorrect = selectedAnswer.value === currentQuestion.correct_option;

    if (isCorrect) {
        correctAnswers++;
        feedback.textContent = "Correct!";
        feedback.style.color = "green";
    } else {
        feedback.textContent = "Wrong!";
        feedback.style.color = "red";
    }

    document.getElementById("checkButton").disabled = true;
    document.getElementById("nextButton").disabled = false;
}

function clearFeedback() {
    var feedback = document.getElementById("feedback");
    feedback.textContent = "";
}

function finishExam() {
    clearInterval(timer);
    document.getElementById("questionContainer").style.display = "none";
    var finalScoreElement = document.getElementById("finalScore");
    finalScoreElement.textContent = correctAnswers;
    document.getElementById("congratulations").style.display = "block";

    var userId = localStorage.getItem('userId');

    fetch('submitScore.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ user_id: userId, score: correctAnswers })
    })
        .then(function (response) {
            return response.json();
        })
        .then(function (data) {
            if (!data.success) {
                console.error("Error saving score:", data.error);
                alert("Failed to save your score. Please try again.");
            }
        })
        .catch(function (error) {
            console.error("Error:", error);
            alert("An error occurred while saving your score.");
        });
}
