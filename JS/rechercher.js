document.addEventListener('DOMContentLoaded', function () {
    const slider = document.getElementById('budget-range');
    const budgetValue = document.getElementById('budget-max-value');

    // Mettre à jour la valeur lorsque l'utilisateur change le slider
    slider.addEventListener('input', function () {
        budgetValue.textContent = slider.value + ' €';
    });

    // Initialiser la valeur affichée avec la valeur par défaut
    budgetValue.textContent = slider.value + ' €';
});

document.addEventListener("DOMContentLoaded", () => {
    const daysOfWeek = ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"];
    const visibleDaysCount = 7;

    const parseDatabaseDate = (dateString) => {
        const [datePart, timePart] = dateString.split(" ");
        const [year, month, day] = datePart.split("-").map(Number);
        const [hour, minute, second] = timePart.split(":").map(Number);
        return new Date(year, month - 1, day, hour, minute, second);
    };

    const isSameDay = (date1, date2) => {
        return (
            date1.getFullYear() === date2.getFullYear() &&
            date1.getMonth() === date2.getMonth() &&
            date1.getDate() === date2.getDate()
        );
    };

    const loadDays = (startIndex, container, coachData) => {
        if (!coachData || !coachData.creneaux) {
            console.error("Les données du coach ou les créneaux sont absents.");
            return;
        }

        // Utiliser la date passée depuis PHP (filtres.date)
        const selectedDate = filtresDate ? new Date(filtresDate) : new Date(); // Utilisation de la date sélectionnée ou de la date actuelle si elle est vide
        console.log(selectedDate);

        container.innerHTML = ""; // Efface les jours précédents
        for (let i = startIndex; i < startIndex + visibleDaysCount; i++) {
            selectedDate.setDate(selectedDate.getDate() + i);

            const dayName = daysOfWeek[selectedDate.getDay()];
            const formattedDate = selectedDate.toLocaleDateString("fr-FR", {
                day: "2-digit",
                month: "2-digit",
            });

            const dayDiv = document.createElement("div");
            dayDiv.className = "day text-center";
            dayDiv.innerHTML = `
                <h6 style ="font-size: 14px !important;">${dayName}</h6>
                <p class="date" style ="font-size: 12px !important; color: #6c757d !important; margin-bottom: 5px !important;">
                    ${formattedDate}
                </p>
            `;

            // Ajouter les créneaux horaires
            (coachData.creneaux || [])
                .sort((a, b) => parseDatabaseDate(a.dateDebut) - parseDatabaseDate(b.dateDebut))
                .forEach((creneau) => {
                    const creneauDate = parseDatabaseDate(creneau.dateDebut);
                    if (isSameDay(creneauDate, selectedDate)) {
                        const button = document.createElement("button");
                        button.className = "btn btn-primary btn-sm";
                        button.textContent = creneauDate.toLocaleTimeString("fr-FR", {
                            hour: "2-digit",
                            minute: "2-digit",
                        });
                        dayDiv.appendChild(button);
                    }
                });

            container.appendChild(dayDiv);
        }
    };

    document.querySelectorAll(".card-calendar").forEach((calendar) => {
        const coachDataJson = calendar.getAttribute("data-coach");
        const coachData = JSON.parse(coachDataJson); // Convertit le JSON en objet JavaScript
        const coachId = coachData.id;
        const daysContainer = document.getElementById(`week-days-${coachId}`);
        let startIndex = 0;

        const updateDays = () => {
            loadDays(startIndex, daysContainer, coachData);
        };

        calendar.querySelector(`.prevDay[data-coach-id="${coachId}"]`).addEventListener("click", () => {
            if (startIndex > 0) {
                startIndex -= 7;
                updateDays();
            }
        });

        calendar.querySelector(`.nextDay[data-coach-id="${coachId}"]`).addEventListener("click", () => {
            startIndex += 7;
            updateDays();
        });

        updateDays();
    });
});