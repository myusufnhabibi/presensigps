<form id="formApproval" action="/approval/update" method="post">
    @csrf
    <div class="mb-3">
        <input type="hidden" name="id" value="{{ $id }}">
        <label class="form-label">Status</label>
        <select required name="status" class="form-select" id="status">
            <option value="">-- Pilih Status --</option>
            <option value="1">Accept</option>
            <option value="2">Decline</option>
        </select>
    </div>
    <div class="form-group text-end">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
