<form id="formDepartemen" action="/departemen/update" method="post">
    @csrf
    <div class="mb-3">
        <label class="form-label">Kode Departemen</label>
        <input type="text" readonly id="dep" value="{{ $departemen->kode_dep }}" class="form-control" name="dep"
            placeholder="Ex: 123">
        <small id="peringatan" class="text-danger"></small>
    </div>
    <div class="mb-3">
        <label class="form-label">Nama Departemen</label>
        <input type="text" id="nama" value="{{ $departemen->nama_dep }}" class="form-control" name="nama"
            placeholder="Ex: Keuangan">
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
