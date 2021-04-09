const modal = document.querySelector('.main-modal');

const modalClose = () => {
    modal.classList.remove('fadeIn');
    modal.classList.add('fadeOut');
    modal.style.display = 'none';
}

const openModal = () => {
    modal.classList.remove('fadeOut');
    modal.classList.add('fadeIn');
    modal.style.display = 'flex';
}

// SHOW ADD BUKU MODAL FORM
function showAddBukuForm() {
    // ADD MODAL TITLE
    document.getElementById('judulModal').innerHTML = 'Tambah Buku';
    // SHOW TAMBAH BUTTON & HIDE SIMPAN BUTTON
    document.getElementById('tambah_btn').classList.remove('hidden');
    document.getElementById('simpan_btn').classList.add('hidden');
    document.getElementById('hapus_btn').classList.add('hidden');

    // ENABLE INPUT
    $('#isbn').prop("disabled", false);
    $('#judul').prop("disabled", false);
    $('#tahun_terbit').prop("disabled", false);
    $('#jumlah').prop("disabled", false);
    $('#kategori').prop("disabled", false);
    $('#id_kategori').prop("disabled", false);
    $('#id_penerbit').prop("disabled", false);

    // CLEAR INPUT VALUE
    $('#isbn').val("");
    $('#judul').val("");
    $('#tahun_terbit').val("");
    $('#jumlah').val("");
    $('#kategori').val("");
    $('#id_buku').val("");

    // SHOW MODAL
    openModal();
}

// STORE NEW PENERBIT TO CONTROLLER
function storeBuku() {
    $(document).ready(function (e) {
        $("#bukuForm").on('submit', function (e) {
            e.preventDefault();

            let isbn = $('#isbn').val();
            let judul = $('#judul').val();
            let tahun_terbit = $('#tahun_terbit').val();
            let jumlah = $('#jumlah').val();
            let id_kategori = $('#id_kategori').val();
            let id_penerbit = $('#id_penerbit').val();

            $.ajax({
                type: 'POST',
                url: '/buku',
                data: {
                    "_token": token,
                    isbn: isbn,
                    judul: judul,
                    tahun_terbit: tahun_terbit,
                    jumlah: jumlah,
                    id_kategori: id_kategori,
                    id_penerbit: id_penerbit,
                },
                success: function (data) {
                    if (data.error !== undefined) {
                        console.log(data.error);
                    } else {
                        modalClose();
                    }
                }
            });
        });
    });
}

// SHOW UPDATE KATEGORI MODAL FORM
function showUpdateBukuForm(buku) {
    // ADD MODAL TITLE
    document.getElementById('judulModal').innerHTML = 'Ubah Buku';
    // SHOW SIMPAN BUTTON & HIDE TAMBAH BUTTON
    document.getElementById('simpan_btn').classList.remove('hidden');
    document.getElementById('tambah_btn').classList.add('hidden');
    document.getElementById('hapus_btn').classList.add('hidden');

    // ENABLE INPUT
    $('#isbn').prop("disabled", false);
    $('#judul').prop("disabled", false);
    $('#tahun').prop("disabled", false);
    $('#jumlah').prop("disabled", false);
    $('#kategori').prop("disabled", false);
    $('#id_kategori').prop("disabled", false);
    $('#id_penerbit').prop("disabled", false);

    // ADD PUT METHOD TO FORM
    $('#bukuForm').append('<input name="_method" type="hidden" value="PUT">');

    // SET VALUE
    $('#isbn').val(buku.isbn);
    $('#judul').val(buku.judul);
    $('#tahun_terbit').val(buku.tahun_terbit);
    $('#jumlah').val(buku.jumlah);
    $('#id_kategori').val(buku.id_kategori);
    $('#id_penerbit').val(buku.id_penerbit);

    // SET ID VALUE
    $("#id_buku").val(buku.id_buku);

    // INITIALIZE UPDATE URL
    url = `/buku/${buku.id_buku}`;

    // SET ACTION FORM URL
    $('#bukuForm').attr('action', url);

    // SHOW MODAL
    openModal();
}

// UPDATE NEW PENERBIT TO CONTROLLER
function updateBuku() {
    $(document).ready(function (e) {
        $("#bukuForm").on('submit', function (e) {
            e.preventDefault();
            let id_buku = $('#id_buku').val();
            let isbn = $('#isbn').val();
            let judul = $('#judul').val();
            let tahun_terbit = $('#tahun_terbit').val();
            let jumlah = $('#jumlah').val();
            let id_kategori = $('#id_kategori').val();
            let id_penerbit = $('#id_penerbit').val();

            // INIT AJAX URL
            url = `/buku/${id_buku}`;

            $.ajax({
                type: 'PUT',
                url: url,
                data: {
                    "_token": token,
                    id_buku: id_buku,
                    isbn: isbn,
                    judul: judul,
                    tahun_terbit: tahun_terbit,
                    jumlah: jumlah,
                    id_kategori: id_kategori,
                    id_penerbit: id_penerbit,
                },
            });
        });
    });
}

// SHOW DELETE MODAL
function showDeleteModal(buku) {
    // ADD MODAL TITLE
    document.getElementById('judulModal').innerHTML = 'Hapus buku';
    // SHOW SIMPAN BUTTON & HIDE TAMBAH BUTTON
    document.getElementById('gambarPathLabel').classList.add('hidden');
    document.getElementById('gambarPath').classList.add('hidden');
    document.getElementById('simpan_btn').classList.add('hidden');
    document.getElementById('tambah_btn').classList.add('hidden');
    document.getElementById('hapus_btn').classList.remove('hidden');

    // DISABLE INPUT
    $('#isbn').prop("disabled", true);
    $('#judul').prop("disabled", true);
    $('#tahun_terbit').prop("disabled", true);
    $('#jumlah').prop("disabled", true);
    $('#kategori').prop("disabled", true);
    $('#id_kategori').prop("disabled", true);
    $('#id_penerbit').prop("disabled", true);

    // ADD DELETE METHOD TO FORM
    $('#bukuForm').append('<input name="_method" type="hidden" value="DELETE">');

    // SET VALUE
    $('#isbn').val(buku.isbn);
    $('#judul').val(buku.judul);
    $('#tahun_terbit').val(buku.tahun_terbit);
    $('#jumlah').val(buku.jumlah);
    $('#id_kategori').val(buku.id_kategori);
    $('#id_penerbit').val(buku.id_penerbit);

    // SET ID VALUE
    $("#id_buku").val(buku.id_buku);

    // INIT UPDATE URL
    url = `/buku/${buku.id_buku}`;

    // SET ACTION FORM URL
    $('#bukuForm').attr('action', url);

    // SHOW MODAL
    openModal();
}

// HAPUS KATEGORI
function deleteCategory() {
    $(document).ready(function (e) {
        $("#bukuForm").on('submit', function (e) {
            e.preventDefault();

            let id_buku = $('#id_buku').val();
            let token = $('#_token').val();

            // INIT AJAX URL
            url = `/buku/${id_buku}`;

            $.ajax({
                type: 'DELETE',
                url: url,
                data: {
                    "_token": token,
                    id_buku: id_buku,
                },
                success: function (data) {
                    modalClose();
                }
            });
        });
    });
}





