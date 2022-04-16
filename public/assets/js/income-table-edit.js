let arrHead = new Array(); // array for header.
arrHead = ["Dari Akun", "Jumlah", "#"];
let tableElement = document.getElementById("empTable");
let tbody = tableElement.getElementsByTagName("tbody")[0];

// delete TABLE row function.
function removeRow(oButton) {
    let empTab = document.getElementById("empTable");
    empTab.deleteRow(oButton.parentNode.parentNode.rowIndex); // button -> td -> tr.
}

const addRowBtn = document.getElementById("addRow");
const submitBtn = document.getElementById("bt");

submitBtn.addEventListener("click", function (e) {
    e.preventDefault();
    let id = e.currentTarget.getAttribute("data-id");
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
            let elementChild = element.children[0];
            if (elementChild.getAttribute("data") == "amount") {
                arrObject.amount = elementChild.value;
            } else if (
                elementChild.getAttribute("class") == "data_account_container"
            ) {
                arrObject.data_account_id = parseInt(
                    $(".data_account :selected")[row - 1].value
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
    let to_account_id = document.getElementById("to_account_id").value;

    $.ajax({
        url: `${window.url}/pengelolaan-kas/income/${id}`,
        type: "POST",
        data: {
            _token: CSRF_TOKEN,
            _method: "PUT",
            detail: arrValues,
            data_contact_id,
            total,
            description,
            invoice,
            transaction_date,
            to_account_id,
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
                    window.location.href = `${window.url}/pengelolaan-kas/income`;
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

addRowBtn.addEventListener("click", function (e) {
    e.preventDefault();
    let rowCnt = tbody.rows.length; // table row count.
    let tr = tbody.insertRow(rowCnt); // the table row.

    for (let cell = 0; cell < arrHead.length; cell++) {
        let td = document.createElement("td"); // table definition.
        td = tr.insertCell(cell);

        if (cell == 2) {
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
            select.setAttribute("data", "data_account");
            select.setAttribute("name", "data_account_id[]");
            select.classList.add("form-control", "data_account");
            container.classList.add("data_account_container");
            // optionDefault.innerHTML = "- Pilih Salah Satu -";
            select.appendChild(optionDefault);
            container.appendChild(select);
            td.appendChild(container);
            $(".data_account").select2({
                placeholder: "- Pilih Salah Satu -",
                allowClear: true,
                // dropdownParent: $(`#container-select-${cell}`),
                theme: "bootstrap-5",
                ajax: {
                    url: `${window.url}/pengelolaan-kas/data-account/data`,
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
        } else {
            let ele = document.createElement("input");
            ele.setAttribute("type", "number");
            ele.setAttribute("data", "amount");
            ele.setAttribute("placeholder", "Rp");
            ele.setAttribute("required", "required");
            ele.setAttribute("name", "amount[]");
            ele.classList.add("form-control");
            td.appendChild(ele);
        }
    }
});
