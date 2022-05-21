let arrHead = new Array(); // array for header.
arrHead = ["Item", "Qty", "Unit", "Unit Price", "Total Price", "#"];
let tableElement = document.getElementById("empTable");
let tbody = tableElement.getElementsByTagName("tbody")[0];

// delete TABLE row function.
function removeRow(oButton) {
    let empTab = document.getElementById("empTable");
    empTab.deleteRow(oButton.parentNode.parentNode.rowIndex); // button -> td -> tr.
}

const addRowBtn = document.getElementById("addRow");
const submitBtn = document.getElementById("bt");

// submit BUTTON function.
submitBtn.addEventListener("click", function (e) {
    e.preventDefault();
    let myTab = document.getElementById("empTable");
    let id = e.currentTarget.getAttribute("data-id");
    let arrValues = new Array();
    for (row = 1; row < myTab.rows.length; row++) {
        let arrObject = {};
        for (
            cellIndex = 0;
            cellIndex < myTab.rows[row].cells.length - 1;
            cellIndex++
        ) {
            let element = myTab.rows.item(row).cells[cellIndex];
            console.log(`Element ${cellIndex}`, element);
            let elementChild0 = element.children[0];
            let elementChild1 = element.children[1];
            if (elementChild1?.getAttribute("data") == "subtotal") {
                arrObject.subtotal = elementChild1.value;
            } else if (elementChild1?.getAttribute("data") == "harga_barang") {
                arrObject.harga_barang = elementChild1.value;
            } else if (elementChild0?.getAttribute("data") == "jumlah_barang") {
                arrObject.jumlah_barang = elementChild0.value;
            } else if (
                elementChild0.getAttribute("class") == "data_produk_container"
            ) {
                arrObject.data_produk_id = parseInt(
                    $(".data_produk :selected")[row - 1].value
                );
            }
        }
        arrValues.push(arrObject);
    }
    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
    let total = arrValues.reduce((accumulator, object) => {
        return parseInt(accumulator) + parseInt(object.subtotal);
    }, 0);
    let data_contact_id = $("#data_contact_id").find(":selected")[0].value;
    let deskripsi = document.getElementById("deskripsi").value;
    let tanggal = document.getElementById("tanggal").value;
    let no_pesanan = document.getElementById("no_pesanan").value;

    console.log(arrValues);
    console.log("ID", id);
    $.ajax({
        url: `${window.url}/pembelian/pesanan-pembelian/${id}`,
        type: "POST",
        data: {
            _token: CSRF_TOKEN,
            _method: "PUT",
            detail: arrValues,
            data_contact_id,
            total,
            deskripsi,
            tanggal,
            no_pesanan,
        },
        dataType: "JSON",
        success: function (response) {
            console.log(response);
            if (response.status) {
                Swal.fire({
                    icon: "success",
                    type: "success",
                    title: response.message,
                    showConfirmButton: true,
                }).then((result) => {
                    window.location.href = `${window.url}/pembelian/pesanan-pembelian`;
                });
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            Swal.fire({
                icon: "error",
                type: "error",
                title: "Pastikan semua data terisi!",
                showConfirmButton: true,
            });
        },
    });
});

// add row BUTTON function.
addRowBtn.addEventListener("click", function (e) {
    e.preventDefault();
    let rowCnt = tbody.rows.length; // table row count.
    let tr = tbody.insertRow(rowCnt); // the table row.

    for (let cell = 0; cell < arrHead.length; cell++) {
        let td = document.createElement("td"); // table definition.
        td = tr.insertCell(cell);
        var price = 0;

        // Delete Button
        if (cell == 5) {
            let button = document.createElement("input");
            button.setAttribute("type", "button");
            button.setAttribute("value", "Delete");
            button.classList.add("btn", "bg-gradient-danger", "btn-small");
            button.setAttribute("onclick", "removeRow(this)");
            td.classList.add("align-middle", "text-center");
            td.appendChild(button);
        } else if (cell == 0) {
            let container = document.createElement("div");
            let select = document.createElement("select");
            let optionDefault = document.createElement("option");
            select.setAttribute("required", "required");
            select.setAttribute("data", "data_produk");
            select.setAttribute("name", "data_produk_id[]");
            select.classList.add("form-control", "data_produk");
            container.classList.add("data_produk_container");
            // optionDefault.innerHTML = "- Pilih Salah Satu -";
            select.appendChild(optionDefault);
            container.appendChild(select);
            td.appendChild(container);
            $(".data_produk").select2({
                placeholder: "- Pilih Salah Satu -",
                allowClear: true,
                // dropdownParent: $(`#container-select-${cell}`),
                theme: "bootstrap-5",
                ajax: {
                    url: `${window.url}/inventory/data-produk/data`,
                    dataType: "json",
                    data: function (params) {
                        return {
                            search: params.term,
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response,
                        };
                    },
                    cache: true,
                },
            });
            // Update total
            $(".data_produk").on("select2:select", function (e) {
                var data = e.params.data;
                var row = $(this).closest("tr");
                var unitItemText = row.children("td:eq(2)")[0].children[0];
                var harga_barangText = row.children("td:eq(3)")[0].children[0];
                var harga_barangInput = row.children("td:eq(3)")[0].children[1];

                price = data.price;
                unitItemText.textContent = data.unit;

                harga_barangText.textContent = "Rp " + data.price;
                harga_barangInput.value = data.price;
            });
        } else if (cell == 1) {
            let input = document.createElement("input");
            input.setAttribute("type", "number");
            input.setAttribute("name", "jumlah_barang[]");
            input.setAttribute("data", "jumlah_barang");
            input.setAttribute("required", "required");
            input.setAttribute("placeholder", "0");
            input.setAttribute("class", "form-control text-right");
            td.appendChild(input);
            input.addEventListener("keyup", function (e) {
                var row = $(this).closest("tr");
                var subtotalText = row.children("td:eq(4)")[0].children[0];
                var subtotalInput = row.children("td:eq(4)")[0].children[1];
                subtotalText.textContent =
                    "Rp " + parseInt(e.target.value) * parseInt(price);
                subtotalInput.value =
                    parseInt(e.target.value) * parseInt(price);
            });
        } else if (cell == 2) {
            let input = document.createElement("p");
            input.setAttribute("type", "text");
            input.setAttribute("name", "unitItem[]");
            input.setAttribute("data", "unitItem");
            input.setAttribute("required", "required");
            input.setAttribute("class", "text-center unitItem");
            input.innerText = "-";
            td.appendChild(input);
        } else if (cell == 3) {
            let p = document.createElement("p");
            p.setAttribute("class", "text-center harga_barang-text");
            p.innerText = "Rp 0";
            td.appendChild(p);

            let input = document.createElement("input");
            input.setAttribute("name", "harga_barang[]");
            input.setAttribute("data", "harga_barang");
            input.setAttribute("required", "required");
            input.setAttribute("class", "harga_barang-input");
            input.setAttribute("type", "hidden");
            td.appendChild(input);
        } else {
            let p = document.createElement("p");
            p.setAttribute("class", "text-center subtotal-text");
            p.innerText = "Rp 0";
            td.appendChild(p);

            let input = document.createElement("input");
            input.setAttribute("type", "hidden");
            input.setAttribute("name", "subtotal[]");
            input.setAttribute("data", "subtotal");
            input.setAttribute("placeholder", "Rp");
            input.setAttribute("required", "required");
            input.classList.add("text-center", "subtotal-input");
            td.appendChild(input);
        }
    }
});

$(".data_produk").on("select2:select", function (e) {
    var data = e.params.data;
    var row = $(e.currentTarget).closest("tr");
    var qtyItemInput = row.children("td:eq(1)")[0].children[0];
    var unitItemText = row.children("td:eq(2)")[0].children[0];
    var priceItemText = row.children("td:eq(3)")[0].children[0];
    var priceItemInput = row.children("td:eq(3)")[0].children[1];
    var subtotalText = row.children("td:eq(4)")[0].children[0];
    var subtotalInput = row.children("td:eq(4)")[0].children[1];

    price = data.price;
    unitItemText.textContent = data.unit;

    priceItemText.textContent = "Rp " + data.price;
    priceItemInput.value = data.price;

    subtotalText.textContent =
        "Rp " + parseInt(qtyItemInput.value) * parseInt(data.price);
    subtotalInput.value = parseInt(qtyItemInput.value) * parseInt(data.price);
});

document.querySelectorAll(".jumlah_barang").forEach((item) => {
    item.addEventListener("keyup", (event) => {
        var row = $(event.currentTarget).closest("tr");
        var subtotalText = row.children("td:eq(4)")[0].children[0];
        var subtotalInput = row.children("td:eq(4)")[0].children[1];
        var price = row.children("td:eq(3)")[0].children[1];
        subtotalText.textContent =
            "Rp " + parseInt(event.target.value) * parseInt(price.value);
        subtotalInput.value =
            parseInt(event.target.value) * parseInt(price.value);
    });
});
