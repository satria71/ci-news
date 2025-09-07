"use strict";

let dtIn;

$(document).ready(function () {
    //view data table
    dtIn = $("#tbMain").DataTable({
        ajax: {
            url: 'masteratk/dt_masteratk',
            method: 'POST',
            headers: {
                [$('meta[name="csrf-header"]').attr('content')]:
                    $('meta[name="csrf-token"]').attr('content')
            },
            dataSrc: function (json) {
                return json.data;
            },
            error: function () {
                alert('Terjadi kesalahan pada server');
            }
        }
    });

    //delete
    $('#tbMain').on('click', '#delete', function () {
        const detail = $(this).data('detail');
        // console.log(detail.id);

        swal({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            buttons: {
                cancel: {
                    text: "Cancel",
                    value: null,
                    visible: true,
                    className: "btn btn-outline-secondary waves-effect",
                    closeModal: true,
                },
                confirm: {
                    text: "Yes, delete it!",
                    value: true,
                    visible: true,
                    className: "btn btn-primary me-3 waves-effect waves-light",
                    closeModal: true,
                }
            },
            dangerMode: true,
            className: "my-custom-swal"
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: 'masteratk/delete',
                    type: 'POST',
                    data: {
                        id: detail.id
                    },
                    dataType: 'json',
                    success: function (res) {
                        if (res.status === 'success') {
                            swal({
                                icon: "success",
                                title: "Berhasil dihapus!",
                                text: res.message,
                                button: {
                                    text: "OK",
                                    className: "btn btn-success waves-effect"
                                }
                            });
                            reload_dt();
                        } else {
                            swal({
                                icon: "error",
                                title: "Gagal",
                                text: res.message || 'Terjadi kesalahan saat menghapus.',
                                button: {
                                    text: "OK",
                                    className: "btn btn-danger waves-effect"
                                }
                            });
                        }
                    },
                    error: function () {
                        swal({
                            icon: "error",
                            title: "Error",
                            text: "Terjadi kesalahan pada server.",
                            button: {
                                text: "OK",
                                className: "btn btn-danger waves-effect"
                            }
                        });
                    }
                });
            }
        });
    });

    // event listener tombol edit
    // contoh tombol tambah

    // contoh tombol edit dari DataTable
    // $('#tbMain').on('click', '#edit', function() {
    //     let detail = $(this).data('detail');


    //     $('#modaltitle').text('Edit Data');
    //     $('#id').val(detail.id_barang_atk);
    //     $('#nama').val(detail.nama_barang);

    //     // isi field lain
    //     $('#harga').val(detail.harga);
    //     $('#satuan').val(detail.satuan);
    //     $('#tgltambah').val(detail.tgl_tambah);
    //     console.log(detail);
    //     // $('#title').val(detail.title);
    //     // $('#start_date').val(detail.start_date);
    //     // $('#end_date').val(detail.end_date);
    //     // // $('#user_group_id').val(detail.user_group_id).trigger('change');
    //     // $('#user_group_id').val(detail.group_ids).trigger('change');
    //     // // $('#detail_subtest').val(detail.detail_subtest);

    //     $('#modalForm').modal('show');

    //     // load group question lewat ajax
    //     $.ajax({
    //         url: "masteratk/editdata/" + detail.id_barang_atk,
    //         type: "GET",
    //         dataType: "json",
    //         success: function(res) {
    //             let $select = $("#modalForm");
    //             $select.empty();

    //             $.each(res, function(i, item) {
    //                 $select.append(
    //                     $("<option>", {
    //                         value: item.id,
    //                         text: item.name
    //                     })
    //                 );
    //             });

    //             // kalau di detail ada group_ids, auto select
    //             if (detail.pool_group_ids) {
    //                 let ids = detail.pool_group_ids.split(',').map(id => id.trim()); // jadi array ["2","6"]
    //                 $select.val(ids).trigger("change");
    //             }

    //         },
    //         error: function() {
    //             notyf.error("Gagal ambil data group questions");
    //         }
    //     });
    // });

    //Edit
    //     $('#tbMain').on('click', '#edit', function () {
    //     let detail = $(this).data('detail');
    //     console.log(detail);

    //     // isi judul modal
    //     $('#modaltitle').text('Edit Data');

    //     // isi field dari data-detail
    //     $('#id_barang_atk').val(detail.id_barang_atk);
    //     $('#nama_barang').val(detail.nama_barang);
    //     $('#harga').val(detail.harga);
    //     $('#satuan').val(detail.satuan);
    //     $('#tgl_tambah').val(detail.tgl_tambah);

    //     // tampilkan modal
    //     $('#modalForm').modal('show');

    //     // kalau memang butuh data tambahan dari server, gunakan ini:
    //     $.ajax({
    //         url: "masteratk/editdata/" + detail.id_barang_atk,
    //         type: "GET",
    //         dataType: "json",
    //         success: function (res) {
    //             console.log("Data dari server:", res);

    //             // contoh kalau mau update field dari server
    //             $('#id_barang_atk').val(res.id_barang_atk);
    //             $('#nama_barang').val(res.nama_barang);
    //             $('#harga').val(res.harga);
    //             $('#satuan').val(res.satuan);
    //             $('#tgl_tambah').val(res.tgl_tambah);
    //         },
    //         error: function () {
    //             notyf.error("Gagal ambil data dari server");
    //         }
    //     });
    // });

    // Tambah Data
    $('#btnAdd').on('click', function () {
        $('#modaltitle').text('Tambah Data');
        $('#formData')[0].reset();   // kosongkan semua input
        $('#id').val(''); // pastikan ID kosong
        $('#modalForm').modal('show');
    });

    $('#tbMain').on('click', '#edit', function () {
        let detail = $(this).data('detail');

        $('#modaltitle').text('Edit Data');
        $('#id').val(detail.id);
        $('#kode_barang').val(detail.kode_barang);
        $('#nama_barang').val(detail.nama_barang);
        $('#harga').val(detail.harga);
        $('#satuan').val(detail.satuan);
        $('#tgl_tambah').val(detail.tgl_tambah);

        $('#modalForm').modal('show');
    });

    $('#formData').on('submit', function (e) {
        e.preventDefault();

        let formData = $(this).serialize();
        console.log("FormData:", formData);

        $.ajax({
            url: "masteratk/save",  // satu endpoint
            type: "POST",
            data: formData,
            dataType: "json",
            success: function (res) {
                if (res.status === 'success') {
                    $('#modalForm').modal('hide');
                    swal({
                        icon: "success",
                        title: "Berhasil",
                        text: res.message,
                        button: {
                            text: "OK",
                            className: "btn btn-success waves-effect"
                        }
                    });
                    $('#tbMain').DataTable().ajax.reload();
                } else {
                    swal({
                        icon: "error",
                        title: "Gagal",
                        text: res.message || 'Terjadi kesalahan saat menambahkan data.',
                        button: {
                            text: "OK",
                            className: "btn btn-danger waves-effect"
                        }
                    });
                }

                // if (res.status === 'success') {
                //     swal({
                //         icon: "success",
                //         title: "Berhasil dihapus!",
                //         text: res.message,
                //         button: {
                //             text: "OK",
                //             className: "btn btn-success waves-effect"
                //         }
                //     });
                //     reload_dt();
                // } else {
                //     swal({
                //         icon: "error",
                //         title: "Gagal",
                //         text: res.message || 'Terjadi kesalahan saat menghapus.',
                //         button: {
                //             text: "OK",
                //             className: "btn btn-danger waves-effect"
                //         }
                //     });
                // }
            },
            error: function (xhr) {
                notyf.error("Terjadi kesalahan server");
            }
        });
    });

});

function reload_dt() {
    dtIn.ajax.reload(null, false);
}