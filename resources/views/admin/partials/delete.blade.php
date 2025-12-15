<!-- =======================
     MODAL KONFIRMASI HAPUS
     ======================= -->
<div id="deleteModal" class="modal-overlay" style="display:none;">
    <div class="modal-box">
        <h3>Yakin ingin menghapus?</h3>
        <p>Data yang dihapus tidak dapat dikembalikan.</p>

        <div class="modal-buttons">
            <button onclick="closeDeleteModal()" class="btn-secondary">Batal</button>
            
            <form id="deleteForm" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger">Hapus</button>
            </form>
        </div>
    </div>
</div>

<script>
function openDeleteModal(url) {
    document.getElementById('deleteForm').action = url;
    document.getElementById('deleteModal').style.display = 'flex';
}

function closeDeleteModal() {
    document.getElementById('deleteModal').style.display = 'none';
}
</script>
