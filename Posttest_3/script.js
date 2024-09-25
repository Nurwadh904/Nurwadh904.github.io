const modeToggle = document.getElementById("mode-toggle");
const body = document.body;

modeToggle.addEventListener("click", () => {
    body.classList.toggle("dark-mode");
    if (body.classList.contains("dark-mode")) {
        modeToggle.textContent = "Light Mode";
    } else {
        modeToggle.textContent = "Dark Mode";
    }
});

function toggleMenu() {
    const navList = document.getElementById("nav-list");
    navList.classList.toggle("show");
}

function showPopup() {
    document.getElementById("popup").style.display = "block";
}

function closePopup() {
    document.getElementById("popup").style.display = "none";
}
