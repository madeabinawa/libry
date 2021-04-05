const modal = document.querySelector('.main-modal');
// const closeButton = document.querySelectorAll('.modal-close');

// for (let i = 0; i < closeButton.length; i++) {
//     const elements = closeButton[i];
//     elements.onclick = (e) => modalClose();
//     modal.style.display = 'none';

//     // CLICK OUTSIDE AREA TO CLOSE MODAL
//     window.onclick = function (event) {
//         if (event.target == modal) modalClose();
//     }
// }

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

// SHOW ADD KATEGORI MODAL FORM
function showAddCategoryForm() {
    // ADD MODAL TITLE
    document.getElementById('judul').innerHTML = 'Tambah Kategori';
    // SHOW TAMBAH BUTTON & HIDE SIMPAN BUTTON
    document.getElementById('tambah_btn').classList.remove('hidden');
    document.getElementById('simpan_btn').classList.add('hidden');
    document.getElementById('hapus_btn').classList.add('hidden');

    // ENABLE INPUT JENIS_KATEGORI
    $('#jenis_kategori').prop("disabled", false);

    $("#jenis_kategori").val("");
    // SET id_kategori VALUE
    $("#id_kategori").val("");
    // SHOW MODAL
    openModal();
}

// STORE NEW CATEGORY TO CONTROLLER
function storeCategory() {
    $(document).ready(function (e) {
        $("#kategoriForm").on('submit', function (e) {
            e.preventDefault();

            let jenis_kategori = $('#jenis_kategori').val();
            let token = $('#_token').val();

            $.ajax({
                type: 'POST',
                url: '/kategori',
                data: {
                    "_token": token,
                    jenis_kategori: jenis_kategori
                },
                success: function (data) {
                    modalClose();
                }
            });
        });
    });
}

// SHOW UPDATE KATEGORI MODAL FORM
function showUpdateCategoryForm(kategori) {
    // ADD MODAL TITLE
    document.getElementById('judul').innerHTML = 'Ubah Kategori';
    // SHOW SIMPAN BUTTON & HIDE TAMBAH BUTTON
    document.getElementById('simpan_btn').classList.remove('hidden');
    document.getElementById('tambah_btn').classList.add('hidden');
    document.getElementById('hapus_btn').classList.add('hidden');

    // ENABLE INPUT JENIS_KATEGORI
    $('#jenis_kategori').prop("disabled", false);

    // ADD PUT METHOD TO FORM
    $('#kategoriForm').append('<input name="_method" type="hidden" value="PUT">');
    // SET jenis_kategori VALUE
    $("#jenis_kategori").val(kategori.jenis_kategori);
    // SET id_kategori VALUE
    $("#id_kategori").val(kategori.id_kategori);

    // INIT UPDATE URL
    url = `/kategori/${kategori.id_kategori}`;
    // SET ACTION FORM URL
    $('#kategoriForm').attr('action', url);
    // SHOW MODAL
    openModal();
}

// UPDATE NEW CATEGORY TO CONTROLLER
function updateCategory() {
    $(document).ready(function (e) {
        $("#kategoriForm").on('submit', function (e) {
            e.preventDefault();

            let jenis_kategori = $('#jenis_kategori').val();
            let id_kategori = $('#id_kategori').val();
            let token = $('#_token').val();

            // INIT AJAX URL
            url = `/kategori/${id_kategori}`;

            $.ajax({
                type: 'PUT',
                url: url,
                data: {
                    "_token": token,
                    jenis_kategori: jenis_kategori,
                    id_kategori: id_kategori,
                },
                success: function (data) {
                    modalClose();
                }
            });
        });
    });
}

// SHOW DELETE MODAL
function showDeleteModal(kategori) {
    // ADD MODAL TITLE
    document.getElementById('judul').innerHTML = 'Hapus Kategori';
    // SHOW SIMPAN BUTTON & HIDE TAMBAH BUTTON
    document.getElementById('simpan_btn').classList.add('hidden');
    document.getElementById('tambah_btn').classList.add('hidden');
    document.getElementById('hapus_btn').classList.remove('hidden');

    // DISABLE INPUT JENIS_KATEGORI
    $('#jenis_kategori').prop("disabled", true);

    // ADD DELETE METHOD TO FORM
    $('#kategoriForm').append('<input name="_method" type="hidden" value="DELETE">');
    // SET jenis_kategori VALUE
    $("#jenis_kategori").val(kategori.jenis_kategori);
    // SET id_kategori VALUE
    $("#id_kategori").val(kategori.id_kategori);

    // INIT UPDATE URL
    url = `/kategori/${kategori.id_kategori}`;
    // SET ACTION FORM URL
    $('#kategoriForm').attr('action', url);
    // SHOW MODAL
    openModal();
}

// HAPUS KATEGORI
function deleteCategory() {
    $(document).ready(function (e) {
        $("#kategoriForm").on('submit', function (e) {
            e.preventDefault();

            let jenis_kategori = $('#jenis_kategori').val();
            let id_kategori = $('#id_kategori').val();
            let token = $('#_token').val();

            // INIT AJAX URL
            url = `/kategori/${id_kategori}`;

            $.ajax({
                type: 'DELETE',
                url: url,
                data: {
                    "_token": token,
                    jenis_kategori: jenis_kategori,
                    id_kategori: id_kategori,
                },
                success: function (data) {
                    modalClose();
                }
            });
        });
    });
}





