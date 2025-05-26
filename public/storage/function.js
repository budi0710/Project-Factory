function formatUangTanpaRupiah(angka, prefix) {
    if (angka) {

        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
    }
}

function generateNomorUrut(urut) {
    const now = new Date();
    const tanggal = String(now.getDate()).padStart(2, '0');
    const bulan = String(now.getMonth() + 1).padStart(2, '0'); // Januari = 0
    const tahun = String(now.getFullYear());

    return `${tanggal}${bulan}${tahun}-${String(urut).padStart(3, '0')}`;
}


function resultFormatAngka(lokalString) {
    // Langkah 1: Hilangkan pemisah ribuan (titik)
    const tanpaTitik = lokalString.replace(/\./g, "");

    // Langkah 2: Ganti koma dengan titik sebagai desimal
    const denganTitikDesimal = tanpaTitik.replace(",", ".");

    // Langkah 3: Konversi ke number
    return parseFloat(denganTitikDesimal);
}


function formatAngkaView(angka) {
    const formatID = new Intl.NumberFormat('id-ID', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });

    return formatID.format(angka);

}


function generateNewId(latestId) {
    if (!latestId) return 'BR-001';

    const [prefix, number] = latestId.split('-');
    const newNumber = String(parseInt(number, 10) + 1).padStart(3, '0');
    if (newNumber >= 999) {
        return 'erorr'
    }
    return `${prefix}-${newNumber}`;
}