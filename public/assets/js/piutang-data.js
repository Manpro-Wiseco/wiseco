function invcreate() {
    let kode = moment(new Date()).format("DMYY");
    return ('P-' + kode + Math.floor(Math.random() * 999));
}

let table2;
$('body').on('click', '#pembayaran-piutang', function (event) {
    event.preventDefault();
    var id = $(this).data('id');
    $('#modal-bayar').modal('show');
    // console.log('clicked');
    $('.spinner-load').removeClass('hidden');

    setTimeout(function() {
        table2 = $('#history-pembayaran').DataTable({
            fixedHeader: true,
            pageLength: 5,
            responsive: true,
                language: {
                paginate: {
                    previous: "<",
                    next: ">"
                }
            },
            ajax: `${window.url}/penjualan/daftar-piutang/list-history/${id}`,
            columns: [
                {
                    data: 'tanggal_pembayaran',
                    name: 'tanggal',
                    className: 'align-middle text-center'
                },
                {
                    data: 'total_pembayaran',
                    name: 'total_pembayaran',
                    className: 'align-middle text-center'
                },
                {
                    data: 'sisa_pembayaran',
                    name: 'sisa_pembayaran',
                    className: 'align-middle text-center'
                },
                {
                    data: 'jenis_pembayaran',
                    name: 'jenis_pembayaran',
                    className: 'align-middle text-center'
                },
                {
                    data: 'status',
                    name: 'status',
                    className: 'align-middle text-center'
                },

            ]
        });

        $.ajax({
            type: "GET",
            url: `${window.url}/penjualan/daftar-piutang/get-data-detail/${id}`,
            dataType: 'json',
            beforeSend: function() {
            },
            success: function(data){
                // console.log(data);
                $('#kode_penjualan').text(data.penjualan.no_penjualan);
                $('#nama_pelanggan').text(data.pelanggan.name);
                $('#tak').text(data.tanggal_akhir_kredit);
                $('#bt-tagihan').text("Rp."+data.beban_pembayaran.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
                $('#piutang_id').val(data.id);
                $('#total_pembayaran').val(data.beban_pembayaran);
                $('#sisa_piutang').val(data.sisa_piutang);
                if (data.status == "LUNAS") {
                    $('#tanggal_pembayaran').attr('disabled', true);
                    $('#total_pembayaran').attr('disabled', true);
                    $('#data_bank_id').attr('disabled', true);
                    $('#submit-bayar').hide();
                }else{
                    $('#submit-bayar').show();
                }
            },
            complete: function(){
                $('.spinner-load').addClass('hidden');
            },
        });

    }, 1500);
});

$('body').on('click', '#edit-piutang', function (event) {
    event.preventDefault();
    $('#modal-edit').modal('show');
    var id = $(this).data('id');
    $('.spinner-load').removeClass('hidden');
    // console.log(id);

    setTimeout(function() {
        $.ajax({
            type: "GET",
            url: `${window.url}/penjualan/daftar-piutang/get-data-detail/${id}`,
            dataType: 'json',
            beforeSend: function() {
            },
            success: function(data){
                // console.log(data);
                $('#kode_penjualan').val(data.penjualan.no_penjualan);
                $('#piutang_id').val(data.id);
                $('#sisa_piutang').val(data.sisa_piutang);
                $('#no_piutang').val(data.no_piutang);
                $('#tanggal_awal_kredit').val(data.tanggal_awal_kredit);
                $('#tenor').val(data.tenor);
                $('#status').val(data.status);
                $('#beban_pembayaran').val(data.beban_pembayaran);
                $('#total-beban').text("Rp."+data.beban_pembayaran.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
            },
            complete: function(){
                $('.spinner-load').addClass('hidden');
            },
        });
    }, 1500);
});

$('body').on('change', '#penjualan_id', function(event){
    event.preventDefault();
    let id = $(this).val();
    if (id){
        $('.spinner-load').removeClass('hidden');
        setTimeout(function() {
            $.ajax({
                type: "GET",
                url: `${window.url}/penjualan/daftar-piutang/get-data/${id}`,
                dataType: 'json',
                beforeSend: function() {
                },
                success: function(data){
                    // console.log(data);
                    $('#sisa_piutang').val(-1 * parseInt(data.sisa_pembayaran));
                },
                complete: function(){
                    // $('#loader').addClass('hidden')
                    $('.spinner-load').addClass('hidden');
                    // $('#edit-data-pengiriman').removeClass('hidden')
                },
            });
        }, 1000);
    }else{
        $('#sisa_piutang').val("0");
        $('#deskripsi').val("");
        alert('pilih salah satu');
    }
});

$('body').on('change', '#tanggal_awal_kredit', function(event){
    $('#no_piutang').val(invcreate());
});

$('body').on('keyup', '#tenor', function(event){
    event.preventDefault();
    // console.log('trigger tenor');
    let tenor = $(this).val();
    let sisa = $('#sisa_piutang').val();
    // console.log(tenor, sisa, Math.round(parseFloat(sisa)/parseFloat(tenor)));
    let total = parseFloat(sisa)/parseFloat(tenor);
    $('#beban_pembayaran').val(total);
    $('#total-beban').text("");
    $('#total-beban').text("Rp."+ total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
});

//Save data into database
$('body').on('click', '#submit-edit', function (event) {
    event.preventDefault()
    let id = $("#piutang_id").val();
    let sisa = $("#sisa_piutang").val();
    let tanggal_awal = $("#tanggal_awal_kredit").val();
    let tenor = $("#tenor").val();
    let status = $("#status").val();
    let beban = $("#beban_pembayaran").val();
    let kode_penjualan = $("#kode_penjualan").val();
    console.log("id = "+ id);
    // let token = $('meta[name="csrf-token"]').attr('content');
    
    setTimeout(function() {
        $.ajax({
            type: "POST",
            url: `${window.url}/penjualan/daftar-piutang/update/${id}`,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                sisa_piutang : sisa,
                tanggal_awal_kredit: tanggal_awal,
                tenor: tenor,
                status: status,
                beban_pembayaran:beban,
                no_penjualan: kode_penjualan,
            },
            beforeSend: function() {
                $('.spinner-load').removeClass('hidden');
            },
            success: function(data){
                console.log(data);
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Sukses',
                    showConfirmButton: false,
                    timer: 1500
                })
                $('.spinner-load').addClass('hidden');
                $('#modal-edit').modal('hide');
                table.ajax.reload();
            },
            error: function(data){
                console.log(data);
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Gagal',
                    showConfirmButton: false,
                    timer: 1500
                })
            },
        });
    }, 500);
});

$('body').on('click', '#submit-bayar', function (event) {
    event.preventDefault()
    let id = $("#piutang_id").val();
    let sisa = $("#sisa_piutang").val();
    let tanggal = $("#tanggal_pembayaran").val();
    let total = $("#total_pembayaran").val();
    let bank = $("#data_bank_id").val();
    // console.log("id = "+ id);
    // let token = $('meta[name="csrf-token"]').attr('content');
    
    setTimeout(function() {
        $.ajax({
            type: "POST",
            url: `${window.url}/penjualan/daftar-piutang/save-data-bayar/${id}`,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                sisa_piutang : sisa,
                tanggal_pembayaran: tanggal,
                total_pembayaran: total,
                data_bank_id:bank,
            },
            beforeSend: function() {
                $('.spinner-load').removeClass('hidden');
                console.log(this.data);
            },
            success: function(data){
                console.log(data);
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Sukses Menyimpan Data!',
                    showConfirmButton: false,
                    timer: 1500
                })
                $('.spinner-load').addClass('hidden');
                // $('#modal-edit').modal('hide');
                table2.ajax.reload();
                table1.ajax.reload();
            },
            error: function(data){
                console.log(data);
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Gagal Menyimpan Data!',
                    showConfirmButton: false,
                    timer: 1500
                })
            },
        });
    }, 500);
});
