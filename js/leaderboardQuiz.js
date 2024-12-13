document.addEventListener('DOMContentLoaded', async () => {
    const leaderboardTable = document.querySelector('tbody');
    const errorMessage = document.getElementById('error-message');

    try {
        const response = await fetch('./php/leaderboardQuiz.php'); 
        const data = await response.json();

        if (data.success) {
            const leaderboard = data.leaderboard;

            if (leaderboard.length > 0) {
                leaderboard.forEach((entry, index) => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${index + 1}</td>
                        <td>${entry.name}</td>
                        <td>${entry.school}</td>
                        <td>${entry.score}</td>
                    `;
                    leaderboardTable.appendChild(row);
                });
            } else {
                leaderboardTable.innerHTML = '<tr><td colspan="4">No data available</td></tr>';
            }
        } else {
            errorMessage.textContent = data.message;
            errorMessage.style.display = 'block';
        }
    } catch (error) {
        console.error('Error fetching leaderboard data:', error);
        errorMessage.textContent = 'An error occurred while loading the leaderboard. Please try again later.';
        errorMessage.style.display = 'block';
    }
});

function logout() {
    localStorage.clear(); 
    window.location.href = './php/logout.php'; 
}

function backToQuiz() {
    window.location.href = './php/quiz.php'; 
}
