<?= $this->extend('dashboard/layout/admin/template'); ?>

<?= $this->section('content'); ?>
<script src="<?= base_url(); ?>/public/sweetalert/dist/sweetalert2.all.min.js"></script>
<div class="container col-12" style="margin-top: 30px;">

    <div class="col-md-12">
        <div class="card card-success" style="padding: 20px; box-sizing: border-box; border-radius: 10px;">
            <div class="mt-1 mb-4 dis-block">
                <span>Filter</span>
                <div id="filter-container">
                </div>
            </div>
            <table class="table table-bordered table-hover table-striped" style="text-align: center;" id="example">
                <thead class="table bg-success">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">NIK</th>
                        <th scope="col">Nama Lengkap</th>
                        <th scope="col">Surat</th>
                        <th scope="col" width="10%">Status</th>
                        <th scope="col" width="18%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($datapengajuan as $row) : ?>
                        <tr>
                            <td scope="row"><?= $i; ?></td>
                            <td><?= $row['NIK']; ?></td>
                            <td><?= $row['nama_masyarakat']; ?></td>
                            <td><?= $row['nama_surat']; ?></td>
                            <td>
                                <?php if ($row['status'] == 'menunggu') : ?>
                                    <span class="btn btn-info" style="color: white; font-weight: bold;" title="Menunggu Persetujuan Admin">
                                        <i class="fa-solid fa-hourglass-half"></i>
                                    </span>
                                <?php elseif ($row['status'] == 'diproses') : ?>
                                    <span class="btn btn-primary" style="color: white; font-weight: bold;" title="Diproses">
                                        <i class="fa-solid fa-gears"></i>
                                    </span>
                                <?php elseif ($row['status'] == 'selesai') : ?>
                                    <span class="btn btn-success" style="color: white; font-weight: bold;" title="Selesai">
                                        <i class="fa-solid fa-check-double"></i>
                                    </span>
                                <?php elseif ($row['status'] == 'ditolak') : ?>
                                    <span class="btn btn-success" style="color: white; font-weight: bold;" title="Ditolak">
                                        <i class="fa-solid fa-xmark"></i>
                                    </span>
                                <?php elseif ($row['status'] == 'disetujui') : ?>
                                    <span class="btn btn-success" style="color: white; font-weight: bold;" title="Disetujui Admin">
                                        <i class="fa-solid fa-check"></i>
                                    </span>
                                <?php elseif ($row['status'] == 'disetujui2') : ?>
                                    <span class="btn btn-success" style="color: white; font-weight: bold;" title="Disetujui Lurah">
                                        <i class="fa-solid fa-circle-check"></i>
                                    </span>
                                <?php endif; ?>

                            </td>

                            <td>

                                <a href="<?= base_url(); ?>/CUtama/link_lihat_file_pengajuan_surat_sekertaris/<?= $row['file']; ?>" class="btn btn-info btn-lihat">
                                    <i class=" fa-solid fa-eye"></i>
                                </a>

                                <a href="<?= base_url(); ?>/public/Pengajuansurat/<?= $row['file']; ?>" class="btn btn-success" title="Unduh" download><i class="fa-solid fas fa-download"></i></a>

                                <a href="#" title="Ubah" class="btn btn-primary btn-edit" data-nik="<?= $row['NIK']; ?>" data-id="<?= $row['id_pengajuan_surat']; ?>" data-nama="<?= $row['nama_masyarakat']; ?>" data-surat="<?= $row['nama_surat']; ?>" data-status="<?= $row['status']; ?>" style="display: <?= ($row['status'] == 'selesai') ? 'none' : 'inline' ?>;"><i class=" fa-solid fa-pen-clip"></i></a>

                            </td>
                        </tr>
                        <?php $i++ ?>
                    <?php endforeach; ?>


                </tbody>
            </table>
        </div>
    </div>

</div>


<!-- Form Ubah Surat -->
<form action="<?= base_url(); ?>/CSekertaris/ubah_pengajuan_surat_sekertaris" method="post" enctype="multipart/form-data">
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfmasi Pengajuan Surat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_pengajuan_surat" class="col-form-label">Id Pengajuan Surat</label>
                        <input type="text" class="form-control id_pengajuan_surat" id="id_pengajuan_surat" readonly name="id_pengajuan_surat" required>
                    </div>
                    <div class="form-group">
                        <label for="nik" class="col-form-label">NIK</label>
                        <input type="text" class="form-control nik" id="nik" readonly name="nik" required>
                    </div>
                    <div class="form-group">
                        <label for="nama" class="col-form-label">Nama</label>
                        <input type="text" class="form-control nama" id="nama" readonly name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="surat" class="col-form-label">Surat</label>
                        <input type="text" class="form-control surat" id="surat" readonly name="surat" required>
                    </div>

                    <div class="form-group">
                        <label for="status" class="col-form-label">Status</label>
                        <select class="form-control status" style="width: 100%;" name="status">
                            <option>-- Pilih Status --</option>
                            <option value="menunggu">Menunggu</option>
                            <option value="disetujui">Disetujui Admin</option>
                            <option value="disetujui2">Disetujui Lurah</option>
                            <option value="ditolak">Ditolak</option>
                            <option value="diproses">Diproses</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>

                    <div class="form-group d-none" id="file-surat">
                        <label for="input-file-surat" class="form-label">Unggah Surat</label>
                        <input type="file" class="form-control" id="input-file-surat" name="file">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Form Ubah -->






<div class="flash-data" data-flashdata="<?= session()->getFlashdata('tambah'); ?>"></div>
<div class="flash-data2" data-flashdata="<?= session()->getFlashdata('hapus'); ?>"></div>
<div class="flash-data3" data-flashdata="<?= session()->getFlashdata('edit'); ?>"></div>
<div class="flash-data4" data-flashdata="<?= session()->getFlashdata('kosong'); ?>"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> -->
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
<script>
    const filterContainer = $("#filter-container");
    const clearButton = `<button type="button" class="btn btn-default mr-2" onclick="location.href='<?= base_url() ?>/CUtama/link_pengajuan_surat_sekertaris'">Semua</button>`;
    const alphabet = [{
            name: "A",
            active: false,
            disabled: true
        },
        {
            name: "B",
            active: false,
            disabled: true
        },
        {
            name: "C",
            active: false,
            disabled: true
        },
        {
            name: "D",
            active: false,
            disabled: true
        },
        {
            name: "E",
            active: false,
            disabled: true
        },
        {
            name: "F",
            active: false,
            disabled: true
        },
        {
            name: "G",
            active: false,
            disabled: true
        },
        {
            name: "H",
            active: false,
            disabled: true
        },
        {
            name: "I",
            active: false,
            disabled: true
        },
        {
            name: "J",
            active: false,
            disabled: true
        },
        {
            name: "K",
            active: false,
            disabled: true
        },
        {
            name: "L",
            active: false,
            disabled: true
        },
        {
            name: "M",
            active: false,
            disabled: true
        },
        {
            name: "N",
            active: false,
            disabled: true
        },
        {
            name: "O",
            active: false,
            disabled: true
        },
        {
            name: "P",
            active: false,
            disabled: true
        },
        {
            name: "Q",
            active: false,
            disabled: true
        },
        {
            name: "R",
            active: false,
            disabled: true
        },
        {
            name: "S",
            active: false,
            disabled: true
        },
        {
            name: "T",
            active: false,
            disabled: true
        },
        {
            name: "U",
            active: false,
            disabled: true
        },
        {
            name: "V",
            active: false,
            disabled: true
        },
        {
            name: "W",
            active: false,
            disabled: true
        },
        {
            name: "X",
            active: false,
            disabled: true
        },
        {
            name: "Y",
            active: false,
            disabled: true
        },
        {
            name: "Z",
            active: false,
            disabled: true
        },
    ];

    const filterButton = () => {
        alphabet.forEach((a, index) => {
            filterContainer.append(`<button class="btn btn-filter ${(!a.disabled && !a.active) ? 'btn-default' : ''} ${a.active && !a.disabled ? 'btn-success': ''}" data-name="${a.name}" data-index="${index}" ${a.disabled ? "disabled": ""}>${a.name}</button>`)
        });
    }

    // get perihal data from db
    $.ajax({
        url: '<?php echo base_url(); ?>/pengajuan_surat/nama?type=mandiri',
        beforeSend: function() {
            filterContainer.append(clearButton);
            filterButton();
        },
        success: function(response) {
            filterContainer.empty();
            filterContainer.append(clearButton);
            // for all alphabet that contain 'perihal' set disabled to false 
            alphabet.forEach(al => {
                response.forEach(res => {
                    if (res.name.charAt(0).toUpperCase() === al.name) {
                        al.disabled = false
                    }
                })
            })

            // get filter data from url
            var filter = window.location.search.substring(1).split('=')[1];

            // set button to active when selected
            alphabet.forEach((element) => {
                element.active = true
                if (element.name !== filter) {
                    element.active = false;
                } else if (filter === undefined) {
                    element.active = false
                }
            });

            // render all filter button
            filterButton();
            $(document).on("click", ".btn-filter", function() {
                const name = $(this).attr("data-name");
                const index = $(this).attr("data-index");
                alphabet[index].active = true;
                alphabet.forEach((element) => {
                    if (element.name !== name) {
                        element.active = false;
                    }
                });
                location.href = `<?= base_url() ?>/CUtama/link_pengajuan_surat_sekertaris?filter=${name}`
            })
        }
    });

    const flashData = $('.flash-data').data('flashdata');
    if (flashData) {
        Swal.fire({
            position: 'center',
            icon: 'success',
            text: 'Data Pengajuan berhasil ditambahkan',
            title: 'Ditambahkan',
            showConfirmButton: false,
            timer: 2000
        })
    }

    const flashData2 = $('.flash-data2').data('flashdata');
    if (flashData2) {


        Swal.fire({
            position: 'center',
            icon: 'success',
            text: 'Data Pengajuan berhasil dihapus',
            title: 'Dihapus',
            showConfirmButton: false,
            timer: 2000
        })
    }

    const flashData3 = $('.flash-data3').data('flashdata');
    if (flashData3) {


        Swal.fire({
            position: 'center',
            icon: 'success',
            text: 'Data Pengajuan berhasil diubah',
            title: 'Diubah',
            showConfirmButton: false,
            timer: 2000
        })
    }

    const flashData4 = $('.flash-data4').data('flashdata');
    if (flashData4) {


        Swal.fire({
            position: 'center',
            icon: 'warning',
            text: 'Data tidak ditemukan!',
            title: 'Tidak ditemukan!',
            showConfirmButton: false,
            timer: 2000
        })
    }

    $(document).on('click', '.btn-hapus2', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');
        console.log(href);
        Swal.fire({
            position: 'center',
            title: 'Yakin ingin menghapus?',
            text: 'Data yang dihapus tidak bisa dikembalikan',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#21756E',
            confirmButtonText: 'Ya, Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = href;
            }
        })

    });



    $(document).ready(function() {
        $('#example').on('click', '.btn-edit', function() {
            // get data from button edit
            const id = $(this).data('id');
            const nik = $(this).data('nik');
            const nama = $(this).data('nama');
            const surat = $(this).data('surat');
            const status = $(this).data('status');
            const fileSurat = $('#file-surat');
            if (status === "diproses") {
                fileSurat.removeClass('d-none');
            }
            // Set data to Form Edit
            $('.id_pengajuan_surat').val(id);
            $('.nik').val(nik);
            $('.nama').val(nama);
            $('.surat').val(surat);
            $('.status').val(status);
            // Call Modal Edit
            $('#editModal').modal('show');

            $('.status').on('change', function() {
                let status2 = $(this).val();
                if (status2 === 'diproses' || status2 === "selesai") {
                    fileSurat.removeClass('d-none');
                } else {
                    fileSurat.addClass('d-none');
                }
            })
        })
    });
</script>

<?= $this->endSection(); ?>