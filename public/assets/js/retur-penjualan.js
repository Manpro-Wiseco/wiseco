function invcreate() {
    let kode = moment().format('DMYY');
    return ('R-'+ Math.floor(kode + Math.random() * 9999));
}

$('#tanggal_retur').on('change', function() {
    $('#no_retur').val(invcreate());
});