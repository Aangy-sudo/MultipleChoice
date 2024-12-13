document.getElementById("login-form").addEventListener("submit", async (e) => {
    e.preventDefault(); 

    const formData = new FormData(e.target); 

    try {
        const response = await fetch("./php/login.php", {
            method: "POST",
            body: formData,
        });

        const result = await response.json(); 

        if (result.success) {
            localStorage.setItem("role", result.role);
            localStorage.setItem("name", result.name);
            localStorage.setItem("id", result.id);

            if (result.role === "student") {
                localStorage.setItem("school", result.school);
            }

            window.location.href = result.role === "admin" ? "./php/admin.php" : "./php/quiz.php";
        } else {
            alert(result.message);
        }
    } catch (error) {
        alert("An error occurred. Please try again.");
    }
});
