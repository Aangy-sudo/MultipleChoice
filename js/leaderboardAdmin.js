document.addEventListener("DOMContentLoaded", async () => {
    const leaderboardTableBody = document.querySelector("#leaderboard tbody");

    try {
        const response = await fetch("./php/leaderboardAdmin.php");
        const leaderboard = await response.json();

        if (leaderboard.length > 0) {
            leaderboard.forEach((entry, index) => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${entry.name}</td>
                    <td>${entry.school}</td>
                    <td>${entry.score}</td>
                `;
                leaderboardTableBody.appendChild(row);
            });
        } else {
            leaderboardTableBody.innerHTML = "<tr><td colspan='4'>No data available</td></tr>";
        }
    } catch (error) {
        console.error("Error fetching leaderboard data:", error);
        leaderboardTableBody.innerHTML = "<tr><td colspan='4'>Error loading data</td></tr>";
    }
});
