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

// SHOW ADD PENERBIT MODAL FORM
function showAddPenerbitForm() {
    // ADD MODAL TITLE
    document.getElementById('judul').innerHTML = 'Tambah Penerbit';
    // SHOW TAMBAH BUTTON & HIDE SIMPAN BUTTON
    document.getElementById('tambah_btn').classList.remove('hidden');
    document.getElementById('simpan_btn').classList.add('hidden');
    document.getElementById('hapus_btn').classList.add('hidden');

    // ENABLE INPUT
    $('#nama_penerbit').prop("disabled", false);
    $('#kota').prop("disabled", false);
    $('#telp').prop("disabled", false);

    // CLEAR INPUT VALUE
    $("#id_penerbit").val("");
    $("#nama_penerbit").val("");
    $("#kota").val("");
    $("#telp").val("");

    // SHOW MODAL
    openModal();
}

// STORE NEW PENERBIT TO CONTROLLER
function storePenerbit() {
    $(document).ready(function (e) {
        $("#penerbitForm").on('submit', function (e) {
            e.preventDefault();

            let nama_penerbit = $('#nama_penerbit').val();
            let kota = $('#kota').val();
            let telp = $('#telp').val();
            let token = $('#_token').val();

            $.ajax({
                type: 'POST',
                url: '/penerbit',
                data: {
                    "_token": token,
                    nama_penerbit: nama_penerbit,
                    kota: kota,
                    telp: telp
                },
                success: function (data) {
                    modalClose();
                }
            });
        });
    });
}

// SHOW UPDATE KATEGORI MODAL FORM
function showUpdatePenerbitForm(penerbit) {
    // ADD MODAL TITLE
    document.getElementById('judul').innerHTML = 'Ubah Penerbit';
    // SHOW SIMPAN BUTTON & HIDE TAMBAH BUTTON
    document.getElementById('simpan_btn').classList.remove('hidden');
    document.getElementById('tambah_btn').classList.add('hidden');
    document.getElementById('hapus_btn').classList.add('hidden');

    // ENABLE INPUT
    $('#nama_penerbit').prop("disabled", false);
    $('#kota').prop("disabled", false);
    $('#telp').prop("disabled", false);

    // ADD PUT METHOD TO FORM
    $('#penerbitForm').append('<input name="_method" type="hidden" value="PUT">');

    // SET VALUE
    $("#nama_penerbit").val(penerbit.nama_penerbit);
    $("#kota").val(penerbit.kota);
    $("#telp").val(penerbit.telp);

    // SET ID VALUE
    $("#id_penerbit").val(penerbit.id_penerbit);

    // INITIALIZE UPDATE URL
    url = `/penerbit/${penerbit.id_penerbit}`;

    // SET ACTION FORM URL
    $('#penerbitForm').attr('action', url);

    // SHOW MODAL
    openModal();
}

// UPDATE NEW PENERBIT TO CONTROLLER
function updatePenerbit() {
    $(document).ready(function (e) {
        $("#penerbitForm").on('submit', function (e) {
            e.preventDefault();

            id_penerbit = $('#id_penerbit').val();
            let nama_penerbit = $('#nama_penerbit').val();
            let kota = $('#kota').val();
            let telp = $('#telp').val();
            let token = $('#_token').val();

            // INIT AJAX URL
            url = `/penerbit/${id_penerbit}`;

            $.ajax({
                type: 'PUT',
                url: url,
                data: {
                    "_token": token,
                    id_penerbit: id_penerbit,
                    nama_penerbit: nama_penerbit,
                    kota: kota,
                    nama_penerbit: nama_penerbit,
                },
                success: function (data) {
                    modalClose();
                }
            });
        });
    });
}

// SHOW DELETE MODAL
function showDeleteModal(penerbit) {
    // ADD MODAL TITLE
    document.getElementById('judul').innerHTML = 'Hapus Penerbit';
    // SHOW SIMPAN BUTTON & HIDE TAMBAH BUTTON
    document.getElementById('simpan_btn').classList.add('hidden');
    document.getElementById('tambah_btn').classList.add('hidden');
    document.getElementById('hapus_btn').classList.remove('hidden');

    // DISABLE INPUT
    $("#nama_penerbit").prop("disabled", true);
    $("#kota").prop("disabled", true);
    $("#telp").prop("disabled", true);

    // ADD DELETE METHOD TO FORM
    $('#penerbitForm').append('<input name="_method" type="hidden" value="DELETE">');

    // SET VALUE
    $("#id_penerbit").val(penerbit.id_penerbit);
    $("#nama_penerbit").val(penerbit.nama_penerbit);
    $("#kota").val(penerbit.kota);
    $("#telp").val(penerbit.telp);

    // INIT UPDATE URL
    url = `/penerbit/${penerbit.id_penerbit}`;

    // SET ACTION FORM URL
    $('#penerbitForm').attr('action', url);

    // SHOW MODAL
    openModal();
}

// HAPUS KATEGORI
function deleteCategory() {
    $(document).ready(function (e) {
        $("#penerbitForm").on('submit', function (e) {
            e.preventDefault();

            let id_penerbit = $('#id_penerbit').val();
            let token = $('#_token').val();

            // INIT AJAX URL
            url = `/penerbit/${id_penerbit}`;

            $.ajax({
                type: 'DELETE',
                url: url,
                data: {
                    "_token": token,
                    id_penerbit: id_penerbit,
                },
                success: function (data) {
                    modalClose();
                }
            });
        });
    });
}





