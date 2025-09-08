(function (global) {
  function renderFields(fields) {
    return (fields || []).map(f => `
      <div class="mb-3">
        ${f.label ? `<label class="form-label" for="${f.name}">${f.label}</label>` : ''}
        ${f.type === 'textarea' ? `
          <textarea class="form-control" id="${f.name}" name="${f.name}" placeholder="${f.placeholder || ''}">${f.value || ''}</textarea>
        ` : `
          <input type="${f.type || 'text'}" class="form-control" id="${f.name}" name="${f.name}" value="${f.value ?? ''}" placeholder="${f.placeholder || ''}">
        `}
      </div>
    `).join('');
  }

  function createFormModal(title, fields, onSubmit, options = {}) {
    // hapus modal lama jika ada
    const old = document.getElementById('dynamicModal');
    if (old) old.remove();

    const sizeClass = options.size ? `modal-${options.size}` : '';
    const modalHtml = `
      <div class="modal fade" id="dynamicModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered ${sizeClass}">
          <div class="modal-content">
            <form id="dynamicForm">
              <div class="modal-header">
                <h5 class="modal-title">${title || ''}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                ${renderFields(fields)}
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">${options.submitText || 'Simpan'}</button>
              </div>
            </form>
          </div>
        </div>
      </div>`;

    document.body.insertAdjacentHTML('beforeend', modalHtml);

    const el = document.getElementById('dynamicModal');
    if (!global.bootstrap || !global.bootstrap.Modal) {
      console.error('Bootstrap JS tidak ditemukan. Pastikan bootstrap.bundle.min.js sudah di-load.');
      return;
    }
    const modal = new bootstrap.Modal(el);
    modal.show();

    document.getElementById('dynamicForm').addEventListener('submit', function (e) {
      e.preventDefault();
      const formData = Object.fromEntries(new FormData(this).entries());
      if (typeof onSubmit === 'function') onSubmit(formData, modal);
    });
  }

  // EKSPOS KE GLOBAL → supaya bisa dipanggil dari file/script lain
  global.createFormModal = createFormModal;
})(window);
