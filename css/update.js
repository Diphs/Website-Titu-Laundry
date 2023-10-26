const dropdown = document.querySelector(".dropdown"),
    selectBtn = dropdown.querySelector(".select-btn"),
    searchInp = dropdown.querySelector("input"),
    options = dropdown.querySelector(".options");

let statusPesanan = ["Menunggu pembayaran", "Menunggu diproses", "Sedang diproses",
    "Sedang dikirim", "Pesanan selesai", "Pesanan dibatalkan"];

    function addPesanan(selectedPesanan) {
        options.innerHTML = "";
        statusPesanan.forEach(pesanan => {
            let isSelected = pesanan == selectedPesanan ? "selected" : "";
            let li = `<li onclick="updateName(this)" class="${isSelected}">${pesanan}</li>`;
            options.insertAdjacentHTML("beforeend", li);
            console.log(selectedPesanan);
        });
    }

    addPesanan();

    function updateName(selectedLi) {
        searchInp.value = "";
        addPesanan(selectedLi.innerText);
        dropdown.classList.remove("active");
        selectBtn.firstElementChild.innerText = selectedLi.innerText;
    }

    searchInp.addEventListener("keyup", () => {
        let arr = [];
        let searchedVal = searchInp.value.toLowerCase();
        arr = statusPesanan.filter(data => {
            return data.toLowerCase().startsWith(searchedVal);
        }).map(data => `<li onclick="updateName(this)">${data}</li>`).join("");
        options.innerHTML = arr ? arr : `<p>Oops! Status tidak ditemukan</p>`;
        console.log(arr);
    });

selectBtn.addEventListener("click", () => {
    dropdown.classList.toggle("active");
});