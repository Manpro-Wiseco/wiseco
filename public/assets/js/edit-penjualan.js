let arrHead = new Array(); // array for header.
arrHead = ["Barang", "Qty", "Harga Unit", "Total", "#"];
let tbody, oc, disc, pajak;
const addRowBtn = document.getElementById("addRow");

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

function sisaBayar(bayar) {
    let Subtotal = parseInt($('#jml-total').val());
    $('#sisa').val(parseInt(bayar)-Subtotal);
}

$( "#bayar" ).keyup(function() {
    sisaBayar(this.value);
});