<form id="formKaryawan" action="/karyawan/update" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label class="form-label">NIK</label>
        <input type="text" readonly id="nik" value="{{ $karyawan->nik }}" class="form-control" name="nik"
            placeholder="Ex: 123">
        <small id="peringatan" class="text-danger"></small>
    </div>
    <div class="mb-3">
        <label class="form-label">Nama Lengkap</label>
        <input type="text" id="nama" value="{{ $karyawan->nama_lengkap }}" class="form-control" name="nama"
            placeholder="Ex: Sujadmi">
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="mb-3">
                <label class="form-label">Departemen</label>
                <select name="kode_dep" class="form-select" id="">
                    @foreach ($dep as $item)
                        <option {{ $karyawan->kode_dep == $item->kode_dep ? 'selected' : null }}
                            value="{{ $item->kode_dep }}">{{ $item->nama_dep }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Jabatan</label>
                <select name="jabatan" class="form-select">
                    <option {{ $karyawan->jabatan == 'Staff' ? 'selected' : null }} value="Staff">Staff</option>
                    <option {{ $karyawan->jabatan == 'Kabid' ? 'selected' : null }} value="Kabid">Kabid</option>
                    <option {{ $karyawan->jabatan == 'Kabag' ? 'selected' : null }} value="Kabag">Kabag</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input id="password" type="password" class="form-control" name="password">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">No. HP</label>
                <input type="text" value="{{ $karyawan->no_hp }}" id="nohp" class="form-control" name="nohp">
            </div>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Foto</label>
        <input type="hidden" value="{{ $karyawan->foto }}" name="old_foto">
        <input type="hidden" value="{{ $karyawan->password }}" name="pw_lama">
        <input type="file" class="form-control" name="foto">
    </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
            Cancel
        </a>
        <button id="simpan" class="btn btn-primary">
            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->

            Simpan
        </button>
    </div>
</form>
