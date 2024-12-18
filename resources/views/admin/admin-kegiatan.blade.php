@extends('layouts.adminlayout')
@section('child')
    <main class="content px-3 py-2">
        <div class="container-fluid" id="admin-kegiatan">
            <div class="mt-3 mb-3">
                <h4>Kelola Kegiatan</h4>
            </div>
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="card" id="kelolaKegiatanCard">
                                <div class="card-body">
                                    <h5>Kelola Kegiatan
                                        <hr>
                                    </h5>
                                    <!-- Form Input Kegiatan -->
                                    <form id="tambahKegiatanForm" method="POST" action="{{ route('kegiatan.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row mb-3">
                                            <label for="namaKegiatan" class="col-lg-2 col-md-3 col-sm-4 form-label">Nama
                                                Kegiatan:</label>
                                            <div class="col-lg-10 col-md-9 col-sm-8">
                                                <input name="nama_kegiatan" type="text" class="form-control"
                                                    id="namaKegiatan" required>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3">
                                            <label for="fotoKegiatan"
                                                class="col-lg-2 col-md-3 col-sm-4 form-label">Foto:</label>
                                            <div class="col-lg-10 col-md-9 col-sm-8">
                                                <input name="gambar_kegiatan" type="file" class="form-control"
                                                    id="fotoKegiatan" accept="image/*" required>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end mt-4">
                                            <button type="submit" class="btn btn-simpan">Simpan</button>
                                            <button type="button" onclick="resetForm()"
                                                class="btn btn-batal ms-2">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel Kegiatan -->
                    <table class="table table-bordered" id="kegiatanTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kegiatan</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="kegiatanTableBody">
                            <!-- Data kegiatan akan ditampilkan di sini -->
                        </tbody>
                    </table>

                    <!-- Modal untuk Edit Kegiatan -->
                    <div class="modal fade" id="editKegiatanModal" tabindex="-1" aria-labelledby="editKegiatanModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editKegiatanModalLabel">Edit Kegiatan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="editKegiatanForm" method="POST" enctype="multipart/form-data">
                                        @method('put')
                                        @csrf
                                        <div class="mb-3">
                                            <label for="editNamaKegiatan" class="form-label">Nama Kegiatan</label>
                                            <input name="nama_kegiatan" type="text" class="form-control"
                                                id="editNamaKegiatan" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editFotoKegiatan" class="form-label">Foto</label>
                                            <img alt="" id="previewImage" class="img-thumbnail"
                                                style="width: 50px; height: 50px;">
                                            <input name="gambar_kegiatan" type="file" class="form-control"
                                                id="editFotoKegiatan" accept="image/*">
                                        </div>
                                        <button type="submit" class="btn btn-edit">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('kodejs')
    <script>
        function loadEditData(lembagadesa) {
            // Isi nilai input dengan data dari parameter
            document.getElementById('editId').value = lembagadesa.id;
            document.getElementById('editFotoKegiatan').value = lembagadesa.gambar_kegiatan;
            document.getElementById('editNamaKegiatan').value = lembagadesa.nama_kegiatan;
            const previewImage = document.getElementById('previewImage');
            if (lembagadesa.gambar_kegiatan) {
                previewImage.src = `/storage/${lembagadesa.gambar_kegiatan}`;
            } else {
                previewImage.src = ''; // Kosongkan jika tidak ada foto
            }

            // Ubah action form untuk mengarahkan ke route update yang sesuai
            const editForm = document.getElementById('editKegiatanForm');
            editForm.action = `/kegiatan/${lembagadesa.id}`;
        }

        function changeImage(event) {
            const previewImage = document.getElementById('previewImage');
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    console.log(e.target.result);

                    previewImage.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }

        function resetForm() {
            document.getElementById("tambahKegiatanForm").reset();
        }
    </script>
@endsection
