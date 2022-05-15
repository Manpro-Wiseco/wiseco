let arrHead = new Array(); // array for header.
arrHead = ["Item", "Qty", "Unit", "Unit Price", "Total Price", "#"];
let tbody;

// first create TABLE structure with the headers.
function createTable() {
    let empTable = document.createElement("table");
    empTable.setAttribute("id", "empTable"); // table id.
    // class : table align-items-center mb-0
    empTable.classList.add("table", "align-items-center", "mb-0");
    let header = empTable.createTHead();
    tbody = empTable.createTBody();
    let tr = header.insertRow(0);
    for (let h = 0; h < arrHead.length; h++) {
        let cell = tr.insertCell(h);
        cell.innerHTML = arrHead[h];
        cell.classList.add(
            "text-uppercase",
            "text-secondary",
            "text-xs",
            "text-center",
            "font-weight-bolder",
            "opacity-7"
        );
    }
    let div = document.getElementById("cont");
    div.appendChild(empTable); // add the TABLE to the container.
}

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
    let arrValues = new Array();
    for (row = 1; row < myTab.rows.length; row++) {
        let arrObject = {};
        for (
            cellIndex = 0;
            cellIndex < myTab.rows[row].cells.length - 1;
            cellIndex++
        ) {
            let element = myTab.rows.item(row).cells[cellIndex];
            let elementChild = element.childNodes[0];
            if (elementChild.getAttribute("data") == "amount") {
                arrObject.amount = elementChild.value;
            } else if (
                elementChild.getAttribute("class") == "data_produk_container"
            ) {
                arrObject.data_produk_id = parseInt(
                    $(".data_produk :selected")[row - 1].value
                );
            }
        }
        arrValues.push(arrObject);
    }
    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
    let data_contact_id = $("#data_contact_id").find(":selected")[0].value;
    let total = arrValues.reduce((accumulator, object) => {
        return parseInt(accumulator) + parseInt(object.amount);
    }, 0);
    let description = document.getElementById("description").value;
    let invoice = document.getElementById("invoice").value;
    let transaction_date = document.getElementById("transaction_date").value;
    let from_account_id = document.getElementById("from_account_id").value;

    console.log(data_contact_id);
    $.ajax({
        url: `${window.url}/pengelolaan-kas/expense`,
        type: "POST",
        data: {
            _token: CSRF_TOKEN,
            detail: arrValues,
            data_contact_id,
            total,
            description,
            invoice,
            transaction_date,
            from_account_id,
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
                    window.location.href = `${window.url}/pengelolaan-kas/expense`;
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
            $('.data_produk').on('select2:select', function (e) {
                $(function(){$('.priceItem').val('Rp. 5000000');})
                var data = e.params.data;
                console.log(data);
              });
        } else if (cell == 1) {
            let input = document.createElement("input");
            input.setAttribute("type", "text");
            input.setAttribute("name", "amount[]");
            input.setAttribute("data", "amount");
            input.setAttribute("required", "required");
            input.setAttribute("placeholder", "0");
            input.setAttribute("class", "form-control text-right");
            td.appendChild(input);
        
        } else if (cell == 2) {
            let input = document.createElement("p");
            input.setAttribute("type", "text");
            input.setAttribute("name", "unitItem[]");
            input.setAttribute("data", "unitItem");
            input.setAttribute("required", "required");
            input.setAttribute("class", "text-center");
            input.innerText = "-";
            td.appendChild(input);
        } else if (cell == 3) {
            let input = document.createElement("p");
            input.setAttribute("type", "text");
            input.setAttribute("name", "priceItem[]");
            input.setAttribute("data", "priceItem");
            input.setAttribute("required", "required");
            input.setAttribute("id", "priceItem");
            input.setAttribute("class", "text-center");
            input.innerText = "Rp 0";
            td.appendChild(input);
        }else {
            let ele = document.createElement("p");
            ele.setAttribute("type", "text");
            ele.setAttribute("name", "amount[]");
            ele.setAttribute("data", "amount");
            ele.setAttribute("placeholder", "Rp");
            ele.setAttribute("required", "required");
            ele.classList.add("text-center");
            ele.innerText = "Rp 0";
            td.appendChild(ele);
        }
    }
});


createTable();
