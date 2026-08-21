document.addEventListener("DOMContentLoaded", () => {
    const langToggleBtn = document.getElementById("langToggleBtn");
    const langFlag = document.getElementById("langFlag");
    const langDisplayID = document.getElementById("langDisplayID");
    const langDisplayEN = document.getElementById("langDisplayEN");

    let currentLang = "id";

    if (langToggleBtn) {
        langToggleBtn.addEventListener("click", () => {
            if (currentLang === "id") {
                currentLang = "en";
                langFlag.src = "https://flagcdn.com/w20/gb.png";
                langDisplayID.classList.remove("font-medium", "text-gray-800");
                langDisplayID.classList.add("text-gray-400");
                langDisplayEN.classList.remove("text-gray-400");
                langDisplayEN.classList.add("font-medium", "text-gray-800");
            } else {
                currentLang = "id";
                langFlag.src = "https://flagcdn.com/w20/id.png";
                langDisplayEN.classList.remove("font-medium", "text-gray-800");
                langDisplayEN.classList.add("text-gray-400");
                langDisplayID.classList.remove("text-gray-400");
                langDisplayID.classList.add("font-medium", "text-gray-800");
            }
        });
    }
});
