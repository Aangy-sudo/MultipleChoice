document.addEventListener("DOMContentLoaded", () => {
    const studentsTableBody = document.querySelector("tbody");
    const notificationDiv = document.createElement("div");
    notificationDiv.className = "notification";
    document.body.insertBefore(notificationDiv, document.body.firstChild);

    const fetchStudents = async () => {
        const response = await fetch("./php/manageStudents.php");
        const students = await response.json();
        renderStudentsTable(students);
    };

    const renderStudentsTable = (students) => {
        studentsTableBody.innerHTML = "";

        if (students.length === 0) {
            studentsTableBody.innerHTML = `<tr><td colspan="6">No students found.</td></tr>`;
            return;
        }

        students.forEach((student) => {
            const row = document.createElement("tr");

            row.innerHTML = `
                <td>${student.id}</td>
                <td>${student.name}</td>
                <td>${student.school}</td>
                <td>${student.username}</td>
                <td>${student.score}</td>
                <td>
                    <button class="action-btn delete" data-id="${student.id}">Delete</button>
                </td>
            `;
            studentsTableBody.appendChild(row);
        });
    };

    studentsTableBody.addEventListener("click", async (event) => {
        if (event.target.classList.contains("delete")) {
            const deleteId = event.target.dataset.id;

            if (confirm("Are you sure you want to delete this student?")) {
                const response = await fetch("./php/manageStudents.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ delete_id: deleteId }),
                });

                const result = await response.json();
                notificationDiv.textContent = result.message;
                notificationDiv.className = `notification ${result.success ? "success" : "error"}`;
                fetchStudents();
            }
        }
    });

    fetchStudents();
});
