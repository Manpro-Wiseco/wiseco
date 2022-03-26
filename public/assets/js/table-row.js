let arrHead = new Array(); // array for header.
arrHead = ["Dari Akun Bank", "Jumlah", "#"];
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
submitBtn.addEventListener("click", function (e) {
    e.preventDefault();
    let myTab = document.getElementById("empTable");
    let arrValues = new Array();
    // loop through each row of the table.
    for (row = 1; row < myTab.rows.length; row++) {
        let arrValues2 = new Array();
        // loop through each cell in a row.
        // console.log(myTab.rows[row].cells.length, "Cell length");
        for (c = 0; c < myTab.rows[row].cells.length - 1; c++) {
            let element = myTab.rows.item(row).cells[c];
            let elementChild = element.childNodes[0];
            if (
                elementChild.getAttribute("type") == "text" ||
                elementChild.getAttribute("type") == "number"
            ) {
                arrValues2.push(elementChild.value);
            } else if (elementChild.tagName == "SELECT") {
                arrValues2.push(elementChild.value);
            }
        }
        arrValues.push(arrValues2);
    }

    console.log(arrValues);

    // The final output.
    document.getElementById("output").innerHTML = arrValues;
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
            let select = document.createElement("select");
            let optionDefault = document.createElement("option");
            select.setAttribute("required", "required");
            select.setAttribute("name", "bank_account_id[]");
            select.classList.add("form-control");
            optionDefault.innerHTML = "- Pilih Salah Satu -";
            select.appendChild(optionDefault);
            td.appendChild(select);
        } else {
            let ele = document.createElement("input");
            ele.setAttribute("type", "number");
            ele.setAttribute("placeholder", "Rp");
            ele.setAttribute("required", "required");
            ele.setAttribute("name", "amount[]");
            ele.classList.add("form-control");
            td.appendChild(ele);
        }
    }
});
createTable();
