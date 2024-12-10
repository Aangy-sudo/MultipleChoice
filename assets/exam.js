let timer;
let timeElapsed = 0;
let questions = [];
let currentQuestion = null;
let correctAnswers = 0;
let questionNumber = 1;

document.getElementById("startButton").addEventListener("click", startExam);
document.getElementById("checkButton").addEventListener("click", checkAnswer);
document.getElementById("nextButton").addEventListener("click", loadNextQuestion);

let timeLeft = 1800; // 30 minutes in seconds

function startTimer() {
    const timerDisplay = document.getElementById("timer");
    timer = setInterval(() => {
        if (timeLeft <= 0) {
            clearInterval(timer);
            finishExam(); // End quiz when time runs out
        } else {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            timerDisplay.textContent = `${minutes}:${seconds < 10 ? "0" : ""}${seconds}`;
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
        .then(response => {
            if (!response.ok) {
                throw new Error("Failed to fetch questions");
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                alert(data.error);
                return;
            }
            questions = data; // Assign fetched questions to the global `questions` array
            loadNextQuestion(); // Load the first question
        })
        .catch(error => {
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
    questionNumber++; // Increment the question counter

    // Reset button states
    document.getElementById("checkButton").disabled = false;
    document.getElementById("nextButton").disabled = true;
    clearFeedback();
}

function displayQuestion() {
    const questionDiv = document.getElementById("questions");
    questionDiv.innerHTML = `
        <p><strong>Question ${questionNumber}: ${currentQuestion.question}</strong></p><br>
        <label><input type="radio" name="answer" value="A"> ${currentQuestion.option_a}</label><br>
        <label><input type="radio" name="answer" value="B"> ${currentQuestion.option_b}</label><br>
        <label><input type="radio" name="answer" value="C"> ${currentQuestion.option_c}</label><br>
        <label><input type="radio" name="answer" value="D"> ${currentQuestion.option_d}</label><br>
        <p id="feedback" class="feedback"></p>`;
}

function checkAnswer() {
    const selectedAnswer = document.querySelector('input[name="answer"]:checked');
    const feedback = document.getElementById("feedback");

    if (!selectedAnswer) {
        feedback.textContent = "Please select an answer.";
        feedback.style.color = "red";
        return;
    }

    const isCorrect = selectedAnswer.value === currentQuestion.correct_option;

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
    const feedback = document.getElementById("feedback");
    feedback.textContent = ""; // Clear feedback text
}

function finishExam() {
    clearInterval(timer);
    document.getElementById("questionContainer").style.display = "none";
    const finalScoreElement = document.getElementById("finalScore");
    finalScoreElement.textContent = correctAnswers; // Display user's score
    document.getElementById("congratulations").style.display = "block";

    const userId = localStorage.getItem('userId');

    // Save the score to the database
    fetch('submitScore.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ user_id: userId, score: correctAnswers }) // Include user_id
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success) {
            console.error("Error saving score:", data.error);
            alert("Failed to save your score. Please try again.");
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("An error occurred while saving your score.");
    });
}
