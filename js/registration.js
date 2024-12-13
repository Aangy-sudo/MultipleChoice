document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");
    const roleField = document.getElementById("role");
    const schoolField = document.getElementById("school");

    roleField.addEventListener("change", () => {
        if (roleField.value === "student") {
            schoolField.style.display = "block";
        } else {
            schoolField.style.display = "none";
        }
    });

    form.addEventListener("submit", async (event) => {
        event.preventDefault();

        const formData = new FormData(form);

        try {
            const response = await fetch("./php/registration.php", {
                method: "POST",
                body: formData,
            });

            const result = await response.json();

            if (result.success) {
                alert(result.message);
                window.location.href = "./login.html";
            } else {
                alert(result.message);
            }
        } catch (error) {
            console.error("Error:", error);
            alert("An unexpected error occurred. Please try again later.");
        }
    });
});
