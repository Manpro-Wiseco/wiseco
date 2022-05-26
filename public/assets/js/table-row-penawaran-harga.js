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
// const submitBtn = document.getElementById("bt");

// submitBtn.addEventListener("click", function (e) {
//     e.preventDefault();
//     let myTab = document.getElementById("empTable");
//     let arrValues = new Array();
//     // loop through each row of the table.
//     for (row = 1; row < myTab.rows.length; row++) {
//         let arrObject = {};
//         // loop through each cell in a row.
//         // console.log(myTab.rows[row].cells.length, "Cell length");
//         for (
//             cellIndex = 0;
//             cellIndex < myTab.rows[row].cells.length - 1;
//             cellIndex++
//         ) {
//             let element = myTab.rows.item(row).cells[cellIndex];
//             let elementChild = element.childNodes[0];
//             if (elementChild.getAttribute("data") == "amount") {
//                 arrObject.amount = elementChild.value;
//             } else if (
//                 elementChild.getAttribute("class") == "bank_account_container"
//             ) {
//                 arrObject.bank_account_id = parseInt(
//                     $(".bank_account :selected")[row - 1].value
//                 );
//             }
//         }
//         arrValues.push(arrObject);
//     }

//     // let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");

//     // let data_contact_id = $("#data_contact_id").find(":selected")[0].value;
//     // let total = arrValues.reduce((accumulator, object) => {
//     //     return parseInt(accumulator) + parseInt(object.amount);
//     // }, 0);
//     // let description = document.getElementById("description").value;
//     // let invoice = document.getElementById("invoice").value;
//     // let transaction_date = document.getElementById("transaction_date").value;

//     // console.log(arrValues);
    
//     // $.ajax({
//     //     url: `${window.url}/pengelolaan-kas/expense`,
//     //     type: "POST",
//     //     data: {
//     //         _token: CSRF_TOKEN,
//     //         detail: arrValues,
//     //         data_contact_id,
//     //         total,
//     //         description,
//     //         invoice,
//     //         transaction_date,
//     //     },
//     //     dataType: "JSON",
//     //     success: function (response) {
//     //         console.log(response);
//     //         if (response.status) {
//     //             Swal.fire({
//     //                 icon: "success",
//     //                 type: "success",
//     //                 title: response.message,
//     //                 showConfirmButton: true,
//     //             }).then((result) => {
//     //                 window.location.href = `${window.url}/pengelolaan-kas/expense`;
//     //             });
//     //         }
//     //     },
//     //     error: function (jqXHR, textStatus, errorThrown) {
//     //         Swal.fire({
//     //             icon: "error",
//     //             type: "error",
//     //             title: "Pastikan semua data terisi!",
//     //             showConfirmButton: true,
//     //         });
//     //     },
//     // });
// });

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
            button.setAttribute("onclick", "removeRow(this); getTotalItem();");
            td.classList.add("align-middle", "text-center");
            td.appendChild(button);
        }  else if (cell == 2){
            let ele = document.createElement("input");
            ele.setAttribute("type", "number");
            ele.setAttribute("data", "harga-unit");
            ele.setAttribute("placeholder", "Rp");
            ele.setAttribute("required", "required");
            ele.setAttribute("name", "items["+rowCnt+"][harga_unit]");
            ele.setAttribute("id", "hu"+rowCnt);
            ele.onkeyup=function(){Total(this.id, rowCnt)};
            ele.classList.add("hargaunit","form-control");
            td.appendChild(ele);
        } else if (cell == 0) {
            let container = document.createElement("div");
            let select = document.createElement("select");
            let optionDefault = document.createElement("option");
            select.setAttribute("required", "required");
            select.setAttribute("data", "items");
            select.setAttribute("data-id-row", rowCnt);
            select.setAttribute("name", "items["+rowCnt+"][id]");
            select.setAttribute("id", "items"+rowCnt);
            select.classList.add("form-control", "items-list");
            container.classList.add("item_container");
            container.setAttribute("id", `container-select-${cell}`);
            // optionDefault.innerHTML = "- Pilih Salah Satu -";
            select.appendChild(optionDefault);
            container.appendChild(select);
            td.appendChild(container);

            $(".items-list").select2({ 
                //Database
                placeholder: "- Pilih Salah Satu -",
                allowClear: true,
                // minimumInputLength: 3,
                // dropdownParent: $(`#container-select-${cell}`),
                ajax: {
                    //ngambil dari data barang
                    url: `${window.url}/penjualan/pesanan-penjualan/get-item`,  
                    dataType: "json",
                    delay: 250,
                    data: function (params) {
                        // console.log(params);
                        return {
                            search: params.term,
                        };
                    },
                    processResults: function (response) {
                        // console.log(response);
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
            ele.setAttribute("name", "items["+rowCnt+"][qty]");
            ele.setAttribute("id", "qty"+rowCnt);
            // ele.setAttribute("onKeyup", "Total("+rowCnt+")");
            ele.onkeyup=function(){Total(this.id, rowCnt)};
            ele.classList.add("qty" ,"form-control");
            td.appendChild(ele);
        } else if (cell == 3){
            let ele = document.createElement("input");
            ele.setAttribute("readonly", true);
            ele.setAttribute("type", "number");
            ele.setAttribute("data", "total");
            ele.setAttribute("placeholder", "Rp");
            ele.setAttribute("required", "required");
            ele.setAttribute("name", "items["+rowCnt+"][total]");
            ele.setAttribute("id", "total"+rowCnt);
            ele.classList.add("total","form-control");
            td.appendChild(ele);
        }
    }
});

// $('.items-list').on("change", function(e) { 
//     console.log(this.value);
//  });

// $('.items-list').on("select2:selecting", function(e) { 
//     console.log(this.value);
// });

$(document.body).on("change",".items-list",function(){
    let row = $(this).data('id-row')
    // console.log(this.value, row);
    $.ajax({
        type: "GET",
        url: `${window.url}/penjualan/pesanan-penjualan/get-harga-item/${this.value}`,
        dataType: 'json',
        success: function(data){
            // console.log(data.priceItem);
            $("#hu"+row).val(data.priceItem);
        },
        complete: function(){
            // $("#no_pesanan").attr('disabled', false);
        },
    });
});

createTable();

function getTotalItem() {
    var total = 0;
    let oc = parseInt($('#other-cost').val());
    let disc = parseInt($('#discount').val());
    let pajak = parseInt($('#pajak').val());
    
    $('.total').each(function(){
        total += parseInt(this.value);
    });

    if (oc) {
        total += oc;
        // console.log('oc ada');
    }
    if(disc){
        disc = (total*disc)/100;
        total -= disc;
        $("#potongan").val(disc);
        // console.log('disc ada');
    }else{
        $("#potongan").val(0);
    }

    if(pajak){
        total += pajak;
        // console.log('pajak ada');
    }
    
    $("#jml-total").val(total);
}

function Total(target, row) {
    if (target == "qty"+row) {
        let qty = $("#qty"+row).val();
        let hu = $("#hu"+row).val();
        if (hu == null || hu == undefined ) {
            hu = $("#hu"+row).val(0);
            $("#total"+row).val(parseInt(hu)*parseInt(qty));
        }else{
            $("#total"+row).val(parseInt(hu)*parseInt(qty));
        }
    }else{
        let qty = $("#qty"+row).val();
        let hu = $("#hu"+row).val();
        if (qty == null || qty == undefined ) {
            qty = $("#qty"+row).val(0);
            $("#total"+row).val(parseInt(hu)*parseInt(qty));
        }else{
            $("#total"+row).val(parseInt(hu)*parseInt(qty));
        }
    }
    getTotalItem();
}

$( "#other-cost" ).keyup(function() {
    getTotalItem();
});
$( "#discount" ).keyup(function() {
    getTotalItem();
});
$( "#pajak" ).keyup(function() {
    getTotalItem();
});

function invcreate(no) {
    let cust = $('#data_contact_id option:selected').text();
    if (cust) {
        cust = cust.replace(/^\s+|\s+$/gm,'');
        // let kode = $('#transaction_date').val().replace(/[^\w\s]/gi, '');
        let kode = moment().format('DMYYss');
        // console.log(cust[0].toLowerCase()+"-"+kode+Math.floor(Math.random() * 1000));
        $('#invoice').val(kode+Math.floor(Math.random() * 101));
        // $('#addRow').show();
    }else{
        alert('Anda belum memilih pelanggan');
        $("input[type=date]").val("");
    }
}


