<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="text-light mb-0">PKL Entries</h5>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPklModal">Add New</button>
  </div>

  <?php if (!empty($pkl_list)): ?>
    <?php foreach ($pkl_list as $p): ?>
      <h5 class="text-light mb-3"><?= htmlspecialchars($p['title'] ?? '') ?></h5>

      <div class="card custom-container-card rounded-4 p-4 border border-secondary mb-4">
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label text-white-50 small">Title</label>
            <form class="d-flex gap-2" action="<?= site_url('/pkl/' . (int)($p['id'] ?? 0)) ?>" method="post">
              <input type="text" class="form-control custom-input pkl-title-input" name="title" value="<?= htmlspecialchars($p['title'] ?? '', ENT_QUOTES) ?>" data-original-value="<?= htmlspecialchars($p['title'] ?? '', ENT_QUOTES) ?>">
              <button class="btn btn-success pkl-title-save" type="submit" disabled>Save</button>
            </form>
          </div>

          <div class="col-12">
            <label class="form-label text-white-50 small">Description</label>
            <form class="d-flex gap-2" action="<?= site_url('/pkl/' . (int)($p['id'] ?? 0)) ?>" method="post">
              <textarea class="form-control custom-input pkl-description-input" name="description" rows="3" data-original-value="<?= htmlspecialchars($p['description'] ?? '', ENT_QUOTES) ?>"><?= htmlspecialchars($p['description'] ?? '') ?></textarea>
              <button class="btn btn-success pkl-description-save" type="submit" disabled>Save</button>
            </form>
          </div>

          <div class="col-md-6">
            <label class="form-label text-white-50 small">Image</label>
            <div class="d-flex flex-column gap-2">
              <div class="card profile-card text-light rounded-4 overflow-hidden shadow" style="max-width: 260px;">
                <div class="image-container d-flex align-items-center justify-content-center" style="height: 140px;">
                  <?php if (!empty($p['image_url'])): ?>
                    <img src="<?= base_url('/upload/pkl/' . $p['image_url']) ?>" alt="pkl image" class="card-image" />
                    <div class="image-overlay"></div>
                  <?php else: ?>
                    <div class="placeholder-content" id="pklPlaceholder<?= (int)($p['id'] ?? 0) ?>">
                      <i class="fas fa-image fa-2x mb-2 opacity-50"></i>
                      <div class="fw-semibold opacity-75 text-white">No Image</div>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
              <form class="d-flex gap-2" action="<?= site_url('/pkl/' . (int)($p['id'] ?? 0)) ?>" method="post" enctype="multipart/form-data">
                <input type="file" class="form-control custom-input pkl-image-input" name="image" accept="image/*">
                <button class="btn btn-success pkl-image-save" type="submit" disabled>Save</button>
              </form>
            </div>
          </div>

          <div class="col-md-6 d-flex align-items-end">
            <form action="<?= site_url('/pkl/' . (int)($p['id'] ?? 0) . '/delete') ?>" method="post">
              <button type="submit" class="btn btn-danger btn-delete">Delete</button>
            </form>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <div class="card custom-container-card rounded-4 p-4 border border-secondary mb-4">
      <div class="text-white-50 small">No PKL entries yet.</div>
    </div>
  <?php endif; ?>
</div>

<!-- Add New PKL Modal -->
<div class="modal fade" id="addPklModal" tabindex="-1" aria-labelledby="addPklModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content custom-modal">
      <div class="modal-header border-secondary">
        <h5 class="modal-title text-light" id="addPklModalLabel">Add PKL Entry</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?= site_url('/pkl') ?>" enctype="multipart/form-data" id="addPklForm">
          <div class="mb-3">
            <label for="pklTitle" class="form-label text-light">Title</label>
            <input type="text" class="form-control custom-input" id="pklTitle" name="title" placeholder="Enter title" required>
          </div>
          <div class="mb-3">
            <label for="pklDescription" class="form-label text-light">Description</label>
            <textarea class="form-control custom-input" id="pklDescription" name="description" placeholder="Enter description" rows="3"></textarea>
          </div>
          <div class="mb-3">
            <label for="pklImage" class="form-label text-light">Image</label>
            <input type="file" class="form-control custom-input" id="pklImage" name="image" accept="image/*">
          </div>
          <div class="text-end">
            <button type="submit" class="btn btn-primary" id="addPklSave" disabled>Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Delete confirmation
    document.querySelectorAll('.btn-delete').forEach(btn => {
      btn.addEventListener('click', function(e) {
        const confirmed = confirm('Are you sure you want to delete this item? This action cannot be undone.');
        if (!confirmed) {
          e.preventDefault();
        }
      });
    });

    function hasEmptyRequiredFields(form) {
      const requiredInputs = form.querySelectorAll('input[required], select[required], textarea[required]');
      for (let input of requiredInputs) {
        if (!input.value.trim()) return true;
      }
      return false;
    }

    function toggleButtonState(button, isEnabled) {
      button.disabled = !isEnabled;
      if (isEnabled) {
        button.classList.remove('btn-secondary');
        button.classList.add('btn-primary');
      } else {
        button.classList.remove('btn-primary');
        button.classList.add('btn-secondary');
      }
    }

    // Add modal validation
    const addPklForm = document.getElementById('addPklForm');
    const addPklSave = document.getElementById('addPklSave');
    if (addPklForm && addPklSave) {
      const inputs = addPklForm.querySelectorAll('input, textarea, select');
      function checkAdd() { toggleButtonState(addPklSave, !hasEmptyRequiredFields(addPklForm)); }
      checkAdd();
      inputs.forEach(inp => {
        inp.addEventListener('input', checkAdd);
        inp.addEventListener('change', checkAdd);
      });
    }

    // Inline forms: enable save when value changed from data-original-value
    const mapping = {
      '.pkl-title-input': '.pkl-title-save',
      '.pkl-description-input': '.pkl-description-save'
    };
    for (const [inputSelector, buttonSelector] of Object.entries(mapping)) {
      const inputs = document.querySelectorAll(inputSelector);
      const buttons = document.querySelectorAll(buttonSelector);
      inputs.forEach((input, idx) => {
        const btn = buttons[idx];
        if (!btn) return;
        const originalValue = input.getAttribute('data-original-value') || '';
        toggleButtonState(btn, input.value !== originalValue);
        input.addEventListener('input', function() {
          toggleButtonState(btn, this.value !== originalValue);
        });
      });
    }

    // Image forms: enable save when file selected
    document.querySelectorAll('.pkl-image-input').forEach((fileInput, idx) => {
      const buttons = document.querySelectorAll('.pkl-image-save');
      const btn = buttons[idx];
      if (!btn) return;
      fileInput.addEventListener('change', function() {
        toggleButtonState(btn, this.files && this.files.length > 0);
      });
    });
  });
</script>
<?= $this->endSection()?>