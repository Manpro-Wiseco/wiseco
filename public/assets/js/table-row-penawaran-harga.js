let arrHead = new Array(); // array for header.
arrHead = ["Barang", "Qty", "Harga Unit", "Total", "#"];
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
            "font-weight-bolder",
            "opacity-7"
        ); 
        if (h==0) {
            cell.classList.add(
                "text-left",
                "w-40"
            );    
        } else if (h==1){
            cell.classList.add(
                "text-right",
                "w-10"
            ); 
        }
        else if (h==2){
            cell.classList.add(
                "text-center",
                "w-20"
            );
        }
        else if (h==3){
            cell.classList.add(
                "text-center",
                "w-20"
            );
        }
        else if (h==4){
            cell.classList.add(
                "text-center",
                "w-10"
            );
        }
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

submitBtn.addEventListener("click", function (e) {
    e.preventDefault();
    let myTab = document.getElementById("empTable");
    let arrValues = new Array();
    // loop through each row of the table.
    for (row = 1; row < myTab.rows.length; row++) {
        let arrObject = {};
        // loop through each cell in a row.
        // console.log(myTab.rows[row].cells.length, "Cell length");
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
                elementChild.getAttribute("class") == "bank_account_container"
            ) {
                arrObject.bank_account_id = parseInt(
                    $(".bank_account :selected")[row - 1].value
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

        if (cell == 4) {
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
            select.setAttribute("data", "bank_account");
            select.setAttribute("name", "bank_account_id[]");
            select.classList.add("form-control", "bank_account");
            container.classList.add("bank_account_container");
            container.setAttribute("id", `container-select-${cell}`);
            // optionDefault.innerHTML = "- Pilih Salah Satu -";
            select.appendChild(optionDefault);
            container.appendChild(select);
            td.appendChild(container);
            $(".bank_account").select2({ //Database dadadadadada
                placeholder: "- Pilih Salah Satu -",
                allowClear: true,
                // dropdownParent: $(`#container-select-${cell}`),
                ajax: {
                    url: `${window.url}/pengelolaan-kas/bank-account/data`,  //ngambil dari data barang
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
        } else if (cell == 1){
            let ele = document.createElement("input");
            ele.setAttribute("type", "number");
            ele.setAttribute("data", "qty");
            ele.setAttribute("required", "required");
            ele.setAttribute("name", "qty[]");
            ele.classList.add("qty","form-control");
            td.appendChild(ele);
        }
        else if (cell == 2){
            let ele = document.createElement("input");
            ele.setAttribute("type", "number");
            ele.setAttribute("data", "harga-unit");
            ele.setAttribute("placeholder", "Rp");
            ele.setAttribute("required", "required");
            ele.setAttribute("name", "harga-unit[]");
            ele.classList.add("hargaunit","form-control");
            td.appendChild(ele);
        }
        else if (cell == 3){
            let ele = document.createElement("input");
            ele.setAttribute("disabled", true);
            ele.setAttribute("type", "number");
            ele.setAttribute("data", "total");
            ele.setAttribute("placeholder", "Rp");
            ele.setAttribute("required", "required");
            ele.setAttribute("name", "total[]");
            ele.classList.add("total","form-control");
            td.appendChild(ele);
        }
    }
});

// $(".harga-unit").on('input',function(e){
//     var total = $(this).val();
//     console.log(total);
//    });

$(".hargaunit").keyup(function (e) { 
    var harga = $(this).val();
    console.log(harga);
});

//$(".harga-unit").change(function (e) { 
  //  var total = $(this).val();
    //console.log(total);
//});
createTable();
