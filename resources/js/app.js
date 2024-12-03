import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

document.getElementById("province").addEventListener("change", function () {
    const provinceId = this.value;
    const cantonSelect = document.getElementById("canton");

    // Clear cantons
    cantonSelect.innerHTML = '<option value="">Seleccione un cantón</option>';

    if (provinceId) {
        fetch(`/cantones/${provinceId}`)
            .then((response) => response.json())
            .then((data) => {
                data.forEach((canton) => {
                    const option = document.createElement("option");
                    option.value = canton.id;
                    option.textContent = canton.nombre;
                    cantonSelect.appendChild(option);
                });
            })
            .catch((error) => console.error("Error fetching cantones:", error));
    }
});
