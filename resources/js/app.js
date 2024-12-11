import "./bootstrap";
import Alpine from "alpinejs";

window.Alpine = Alpine;
Alpine.start();

document.addEventListener("DOMContentLoaded", () => {
    window.updateSelectedProvince = function (provinceId, provinceName) {
        // Check if province dropdown exists
        const provinceDropdown = document.getElementById("provinceDropdown");
        if (!provinceDropdown) return;

        // Update the province dropdown display
        provinceDropdown.querySelector("div").innerText = provinceName;

        // Clear canton dropdown
        const cantonDropdown = document.getElementById("cantonDropdown");
        cantonDropdown.querySelector("div").innerText = "Select Canton";
        const cantonList = cantonDropdown.querySelector("[id='cantonList']");
        cantonList.innerHTML = '<p class="px-4 py-2">Loading...</p>';

        // Make the AJAX request to fetch cantons
        fetch(`/api/cantons/${provinceId}`)
            .then((response) => response.json())
            .then((data) => {
                cantonList.innerHTML = ""; // Clear content
                data.forEach((canton) => {
                    const button = document.createElement("button");
                    button.className =
                        "w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-indigo-500";
                    button.type = "button";
                    button.innerText = canton.name;
                    button.onclick = () => {
                        cantonDropdown.querySelector("div").innerText =
                            canton.name;
                    };
                    cantonList.appendChild(button);
                });
            })
            .catch(() => {
                cantonList.innerHTML =
                    '<p class="px-4 py-2 text-red-500">Error loading cantons</p>';
            });
    };
});
