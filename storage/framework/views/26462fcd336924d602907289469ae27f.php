<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa - Manajemen Informatika</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row mb-4">
        <div class="col-md-8">
            <h3 class="fw-bold text-dark"><i class="bi bi-people-fill text-primary me-2"></i>Data Mahasiswa</h3>
            <p class="text-secondary mb-0">Program Studi Manajemen Informatika</p>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <!-- Tombol Tambah Data -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="bi bi-plus-lg me-1"></i> Tambah Mahasiswa
            </button>
        </div>
    </div>

    <!-- Alert Notifikasi Flash Session -->
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i><?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Tabel Data Mahasiswa -->
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">No</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Program Studi</th>
                            <th>Jenis Kelamin</th>
                            <th>No. HP</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $mahasiswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="ps-4"><?php echo e($loop->iteration); ?></td>
                            <td class="fw-bold"><?php echo e($item->nim); ?></td>
                            <td><?php echo e($item->nama); ?></td>
                            <td><span class="badge bg-info text-dark"><?php echo e($item->prodi); ?></span></td>
                            <td><?php echo e($item->jenis_kelamin); ?></td>
                            <td><?php echo e($item->no_hp); ?></td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <!-- Detail (Read) -->
                                    <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#modalDetail<?php echo e($item->nim); ?>">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                    <!-- Edit (Update) -->
                                    <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalEdit<?php echo e($item->nim); ?>">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <!-- Hapus (Delete) -->
                                    <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?php echo e($item->nim); ?>">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- ================= MODAL DETAIL DINAMIS ================= -->
                        <div class="modal fade" id="modalDetail<?php echo e($item->nim); ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-info text-white">
                                        <h5 class="modal-title"><i class="bi bi-person-badge-fill me-2"></i>Detail Mahasiswa</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-borderless">
                                            <tr><th class="w-40 text-secondary">NIM</th><td>: <?php echo e($item->nim); ?></td></tr>
                                            <tr><th class="text-secondary">Nama</th><td>: <?php echo e($item->nama); ?></td></tr>
                                            <tr><th class="text-secondary">Prodi</th><td>: <?php echo e($item->prodi); ?></td></tr>
                                            <tr><th class="text-secondary">TTL</th><td>: <?php echo e($item->tempat_lahir); ?>, <?php echo e($item->tanggal_lahir); ?></td></tr>
                                            <tr><th class="text-secondary">Jenis Kelamin</th><td>: <?php echo e($item->jenis_kelamin); ?></td></tr>
                                            <tr><th class="text-secondary">No. HP</th><td>: <?php echo e($item->no_hp); ?></td></tr>
                                            <tr><th class="text-secondary">Email</th><td>: <?php echo e($item->email); ?></td></tr>
                                            <tr><th class="text-secondary">Alamat</th><td>: <?php echo e($item->alamat); ?></td></tr>
                                        </table>
                                    </div>
                                    <div class="modal-footer bg-light">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ================= MODAL EDIT DINAMIS ================= -->
                        <div class="modal fade" id="modalEdit<?php echo e($item->nim); ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="<?php echo e(route('mahasiswa.update', $item->nim)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <div class="modal-header bg-warning text-white">
                                            <h5 class="modal-title"><i class="bi bi-pencil-square me-2"></i>Edit Data Mahasiswa</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">NIM</label>
                                                <input type="text" name="nim" class="form-control" value="<?php echo e($item->nim); ?>" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Nama Mahasiswa</label>
                                                <input type="text" name="nama" class="form-control" value="<?php echo e($item->nama); ?>" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Tempat Lahir</label>
                                                <input type="text" name="tempat_lahir" class="form-control" value="<?php echo e($item->tempat_lahir); ?>" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Tanggal Lahir</label>
                                                <input type="date" name="tanggal_lahir" class="form-control" value="<?php echo e($item->tanggal_lahir); ?>" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Jenis Kelamin</label>
                                                <select name="jenis_kelamin" class="form-select" required>
                                                    <option value="Laki-laki" <?php echo e($item->jenis_kelamin == 'Laki-laki' ? 'selected' : ''); ?>>Laki-laki</option>
                                                    <option value="Perempuan" <?php echo e($item->jenis_kelamin == 'Perempuan' ? 'selected' : ''); ?>>Perempuan</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Program Studi</label>
                                                <input type="text" name="prodi" class="form-control" value="<?php echo e($item->prodi); ?>" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Nomor HP</label>
                                                <input type="text" name="no_hp" class="form-control" value="<?php echo e($item->no_hp); ?>" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Email</label>
                                                <input type="email" name="email" class="form-control" value="<?php echo e($item->email); ?>" required>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label fw-semibold">Alamat</label>
                                                <textarea name="alamat" class="form-control" rows="2"><?php echo e($item->alamat); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-warning text-white"><i class="bi bi-check-lg me-1"></i>Update Data</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- ================= MODAL HAPUS DINAMIS ================= -->
                        <div class="modal fade" id="modalHapus<?php echo e($item->nim); ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form action="<?php echo e(route('mahasiswa.destroy', $item->nim)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title"><i class="bi bi-exclamation-triangle-fill me-2"></i>Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center py-4">
                                            <p class="mb-1">Apakah Anda yakin ingin menghapus data mahasiswa ini?</p>
                                            <strong class="text-danger fs-5"><?php echo e($item->nama); ?> (<?php echo e($item->nim); ?>)</strong>
                                        </div>
                                        <div class="modal-footer bg-light justify-content-center">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill me-1"></i>Ya, Hapus Data</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <!-- Contoh Tampilan Statis Carmelita Anabel -->
                        <tr>
                            <td class="ps-4">1</td>
                            <td class="fw-bold">25781030</td>
                            <td>Carmelita Anabel</td>
                            <td><span class="badge bg-info text-dark">Manajemen Informatika</span></td>
                            <td>Perempuan</td>
                            <td>088274130155</td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <!-- Button Detail Statis -->
                                    <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#modalDetailStatis">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                    <!-- Button Edit Statis -->
                                    <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalEditStatis">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <!-- Button Hapus Statis -->
                                    <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalHapusStatis">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </div>

                                <!-- MODAL DETAIL STATIS -->
                                <div class="modal fade text-start" id="modalDetailStatis" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-info text-white">
                                                <h5 class="modal-title"><i class="bi bi-person-badge-fill me-2"></i>Detail Mahasiswa</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table table-borderless mb-0">
                                                    <tr><th class="w-40 text-secondary">NIM</th><td>: 25781030</td></tr>
                                                    <tr><th class="text-secondary">Nama</th><td>: Carmelita Anabel</td></tr>
                                                    <tr><th class="text-secondary">Prodi</th><td>: Manajemen Informatika</td></tr>
                                                    <tr><th class="text-secondary">TTL</th><td>: Jambi, 15-08-2007</td></tr>
                                                    <tr><th class="text-secondary">Jenis Kelamin</th><td>: Perempuan</td></tr>
                                                    <tr><th class="text-secondary">No. HP</th><td>: 088274130155</td></tr>
                                                    <tr><th class="text-secondary">Email</th><td>: 25781030@polinela.ac.id</td></tr>
                                                    <tr><th class="text-secondary">Alamat</th><td>: Perumahan Panorama Alam, Untung Suropati</td></tr>
                                                </table>
                                            </div>
                                            <div class="modal-footer bg-light">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- MODAL EDIT STATIS -->
                                <div class="modal fade text-start" id="modalEditStatis" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form action="<?php echo e(route('mahasiswa.update', '25781030')); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PUT'); ?>
                                                <div class="modal-header bg-warning text-white">
                                                    <h5 class="modal-title"><i class="bi bi-pencil-square me-2"></i>Edit Data Mahasiswa</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body row g-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-semibold">NIM</label>
                                                        <input type="text" name="nim" class="form-control" value="25781030" readonly>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-semibold">Nama Mahasiswa</label>
                                                        <input type="text" name="nama" class="form-control" value="Carmelita Anabel" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-semibold">Tempat Lahir</label>
                                                        <input type="text" name="tempat_lahir" class="form-control" value="Jambi" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-semibold">Tanggal Lahir</label>
                                                        <input type="date" name="tanggal_lahir" class="form-control" value="2007-08-15" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-semibold">Jenis Kelamin</label>
                                                        <select name="jenis_kelamin" class="form-select" required>
                                                            <option value="Laki-laki">Laki-laki</option>
                                                            <option value="Perempuan" selected>Perempuan</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-semibold">Program Studi</label>
                                                        <input type="text" name="prodi" class="form-control" value="Manajemen Informatika" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-semibold">Nomor HP</label>
                                                        <input type="text" name="no_hp" class="form-control" value="088274130155" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-semibold">Email</label>
                                                        <input type="email" name="email" class="form-control" value="25781030@polinela.ac.id" required>
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="form-label fw-semibold">Alamat</label>
                                                        <textarea name="alamat" class="form-control" rows="2">Perumahan Panorama Alam, Untung Suropati</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer bg-light">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-warning text-white"><i class="bi bi-check-lg me-1"></i>Update Data</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- MODAL HAPUS STATIS -->
                                <div class="modal fade text-start" id="modalHapusStatis" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="<?php echo e(route('mahasiswa.destroy', '25781030')); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title"><i class="bi bi-exclamation-triangle-fill me-2"></i>Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center py-4">
                                                    <p class="mb-1">Apakah Anda yakin ingin menghapus data mahasiswa ini?</p>
                                                    <strong class="text-danger fs-5">Carmelita Anabel (25781030)</strong>
                                                </div>
                                                <div class="modal-footer bg-light justify-content-center">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill me-1"></i>Ya, Hapus Data</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH DATA -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?php echo e(route('mahasiswa.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="bi bi-person-plus-fill me-2"></i>Tambah Data Mahasiswa</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">NIM</label>
                        <input type="text" name="nim" class="form-control" placeholder="Masukkan NIM" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nama Mahasiswa</label>
                        <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Lengkap" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" placeholder="Kota Lahir" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select" required>
                            <option value="" selected disabled>-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Program Studi</label>
                        <input type="text" name="prodi" class="form-control" value="Manajemen Informatika" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nomor HP</label>
                        <input type="text" name="no_hp" class="form-control" placeholder="08xxxxxxxxxx" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="contoh@polinela.ac.id" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="2" placeholder="Masukkan Alamat Lengkap"></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Skrip Bootstrap JS (PENTING: Wajib di paling bawah sebelum </body>) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html><?php /**PATH C:\projek laravelbreeze\resources\views/mahasiswa/index.blade.php ENDPATH**/ ?>