$(() => {
    // Mengambil Nilai Tambahan dan History berdasarkan NIM
    $('#his').on('click', () => {
        let nimSiswa = $('#nim').val();  // Pastikan ada input dengan ID 'nim' untuk NIM

        if (!nimSiswa) {
            $('#output').html('<p>NIM Siswa tidak ditemukan.</p>');
            return;
        }

        $.ajax({
            url: 'client-nilaitambahan.php',
            method: 'POST',  // Pastikan metode POST digunakan
            data: { action: 'getHistory', nim: nimSiswa },  // Mengirimkan NIM Siswa
            dataType: 'json'  // Tentukan format data yang diterima adalah JSON
        }).done((history) => {
            let html = '<h3>History Nilai Tambahan:</h3>';
            if (history && history.length > 0) {
                history.forEach((h) => {
                    html += `<p>Vote Menang: ${h.voteMenang ? 'Ya' : 'Tidak'}, Nilai Akhir: ${h.finalScore}</p>`;
                });
            } else {
                html += '<p>Belum ada history untuk NIM ini.</p>';
            }
            $('#output').html(html);
        }).fail((jqXHR, textStatus, errorThrown) => {
            $('#output').html(`<p>Error: ${textStatus}, ${errorThrown}</p>`);
        });
    });
});
