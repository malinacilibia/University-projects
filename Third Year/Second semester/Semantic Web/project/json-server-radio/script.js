document.getElementById("loadRdf").onclick = function () {
    fetch("../radio-backend/api/unified-rdf-shows.php")
        .then(function (response) {
            return response.json();
        })
        .then(function (data) {
            var tableBody = document.querySelector("#rdfTable tbody");
            tableBody.innerHTML = "";

            for (var i = 0; i < data.results.bindings.length; i++) {
                var item = data.results.bindings[i];
                var guest = item.guestName ? item.guestName.value + " (" + item.profession.value + ")" : "-";
                tableBody.innerHTML += "<tr><td>" + item.title.value + "</td><td>" + item.time.value + "</td><td>" + guest + "</td></tr>";
            }

        });
};



document.getElementById("transferBtn").onclick = function () {
    const tableRows = document.querySelectorAll("#rdfTable tbody tr");
    const dataToSend = [];

    tableRows.forEach(row => {
        const cells = row.querySelectorAll("td");
        if (cells.length >= 2) {
            const entry = {
                title: cells[0].textContent,
                time: cells[1].textContent
            };

            if (cells.length >= 3 && cells[2].textContent !== "-") {
                const guestCell = cells[2].textContent;
                const match = guestCell.match(/^(.*) \((.*)\)$/);
                if (match) {
                    entry.guestName = match[1].trim();
                    entry.profession = match[2].trim();
                }
            }

            dataToSend.push(entry);
        }

    });

    fetch("../radio-backend/api/transfer-to-json1.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(dataToSend)
    })
        .then(response => response.json())
        .then(data => {
            document.getElementById("status").textContent = data.success
                ? `Transfer reusit (${data.count} inregistrari).`
                : `Eroare: ${data.error}`;
        });
};


document.getElementById("loadJson").onclick = function () {
    fetch("../radio-backend/api/shows.php")
        .then(function (response) {
            return response.json();
        })
        .then(function (shows) {
            var tableBody = document.querySelector("#jsonTable tbody");
            var dropdown = document.getElementById("showsDropdownForm");

            tableBody.innerHTML = "";
            dropdown.innerHTML = '<option value="">-- Selecteaza o emisiune --</option>';

            for (var i = 0; i < shows.length; i++) {
                var show = shows[i];
                var guests = show.guests && show.guests.length
                    ? show.guests.map(g => g.name + " (" + g.profession + ")").join(", ")
                    : "-";

                tableBody.innerHTML += "<tr><td>" + show.title + "</td><td>" + show.time + "</td><td>" + guests + "</td></tr>";
                dropdown.innerHTML += '<option value="' + show.id + '">' + show.title + " (" + show.time + ")</option>";
            }
        });
};


document.getElementById("guestForm").onsubmit = function (event) {
    event.preventDefault();


    const formData = new FormData(this);
    const newGuest = {};

    formData.forEach((value, key) => {
        newGuest[key] = value;
    });

    const dataToSend = {
        newGuest: {
            name: newGuest.name,
            profession: newGuest.profession,
            showId: parseInt(newGuest.showId)
        }
    };

    fetch("../radio-backend/api/add-guest.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(dataToSend)
    })
        .then(res => res.json())
        .then(result => {
            const status = document.getElementById("guestStatus");
            status.textContent = result.success
                ? "Invitat adaugat"
                : "Eroare: " + result.error;

            if (result.success) document.getElementById("guestForm").reset();
        });
};

document.getElementById("loadJson2").onclick = function () {
    fetch("../radio-backend/api/fetch-datajson.php")
        .then(function (response) {
            return response.json();
        })
        .then(function (data) {
            var tableBody = document.querySelector("#json2Table tbody");
            tableBody.innerHTML = "";

            for (var i = 0; i < data.shows.length; i++) {
                var show = data.shows[i];
                var guestList = "";

                for (var j = 0; j < show.guests.length; j++) {
                    var guest = show.guests[j];
                    if (guestList !== "") guestList += ", ";
                    guestList += guest.name + " (" + guest.profession + ")";
                }

                var row = "<tr><td><b>" + show.title + "</b></td><td>" + show.time + "</td><td>" + guestList + "</td></tr>";
                tableBody.innerHTML += row;
            }
        });
};
