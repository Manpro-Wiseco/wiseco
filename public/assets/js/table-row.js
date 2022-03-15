const btnAddRow = document.getElementById("add-row");
const expenseTable = document.getElementById("expense-table");
let i = 1;
btnAddRow.addEventListener("click", (e) => {
    e.preventDefault();
    let row = expenseTable.insertRow(-1);
    let cel0 = row.insertCell(0);
    let cel1 = row.insertCell(1);
    let cel2 = row.insertCell(2);
    cel0.insertAdjacentHTML(
        "afterbegin",
        `<select name="bank_account_id[]" class="form-control"
            required>
            <option>- Pilih Salah Satu -</option>
        </select>`
    );
    cel1.insertAdjacentHTML(
        "afterbegin",
        `<input type="text" class="form-control" name="amount[]" placeholder="Rp" required>`
    );
    cel2.className = "align-middle text-center";
    cel2.insertAdjacentHTML(
        "afterbegin",
        `<button class="btn bg-gradient-danger btn-small btn-delete" type="button" data-row="${++i}">
            Delete
        </button>`
    );
});

document.addEventListener("click", function (e) {
    if (e.target && e.target.className.includes("btn-delete")) {
        let element = e.target;
        let dataRow = element.getAttribute("data-row");
        if (dataRow - 1 != 0) {
            expenseTable.deleteRow(dataRow - 1);
        }
    }
});
