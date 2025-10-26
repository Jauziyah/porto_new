<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="container py-4">
  <h1 class="mb-4 text-light fw-bold">Profile Management</h1>

  <!-- Categories Section -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0 text-light">Categories</h5>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoryModal">Add New Categories</button>
  </div>

  <div class="card custom-container-card rounded-4 p-3 border border-secondary mb-4">
    <div class="row g-3">
      <?php if (!empty($categories)): ?>
        <?php foreach ($categories as $cat): ?>
          <div class="col-md-3">
            <div class="card profile-card text-light rounded-4 overflow-hidden shadow-sm p-3 h-100">
              <h6 class="fw-semibold text-light mb-1"><?= esc($cat['name']) ?></h6>
              <p class="text-white-50 small mb-2">Slug: <?= esc($cat['slug']) ?></p>
              <div class="d-flex gap-2 mt-auto">
                <button
                  class="btn btn-warning w-50 btn-edit-category"
                  data-bs-toggle="modal"
                  data-bs-target="#editCategoryModal"
                  data-id="<?= (int)$cat['id'] ?>"
                  data-name="<?= esc($cat['name']) ?>">Edit</button>
                <form method="post" action="/profile/categories/<?= (int)$cat['id'] ?>/delete" class="w-50 m-0 p-0 delete-form">
                  <button type="submit" class="btn btn-danger w-100 btn-delete">Delete</button>
                </form>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12">
          <div class="text-white-50">No categories yet.</div>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- Tech Stack Section -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0 text-light">Tech Stack</h5>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#techStackModal">Add New Tech Stack</button>
  </div>

  <div class="card custom-container-card rounded-4 p-3 border border-secondary">
    <div class="row g-3">
      <?php if (!empty($tech_stacks)): ?>
        <?php foreach ($tech_stacks as $tech): ?>
          <div class="col-md-4">
            <div class="card tech-card text-light rounded-4 overflow-hidden shadow h-100">
              <div class="card-body d-flex flex-column">
                <?php if (!empty($tech['image_url'])): ?>
                  <div class="mb-2">
                    <img  
                      src="/upload/tech_stack/<?= esc($tech['image_url']) ?>"
                      alt="<?= esc($tech['name']) ?>"
                      class="img-fluid rounded"
                      style="
      max-height: 160px;
      width: 100%;
      object-fit: cover;
      border: 1px solid rgba(255,255,255,0.1);
      box-shadow: 0 2px 8px rgba(0,0,0,0.5);
    ">
                  </div>
                <?php endif; ?>
                <h6 class="card-title mb-1"><?= esc($tech['name']) ?></h6>
                <p class="text-white-50 small mb-1">Slug: <?= esc($tech['slug']) ?></p>
                <p class="card-text text-white-50 small mb-3">Type: <?= esc($tech['type'] ?? '-') ?></p>
                <div class="d-flex gap-2 mt-auto">
                  <button
                    class="btn btn-warning w-50 btn-edit-tech"
                    data-bs-toggle="modal"
                    data-bs-target="#editTechStackModal"
                    data-id="<?= (int)$tech['id'] ?>"
                    data-name="<?= esc($tech['name']) ?>"
                    data-type="<?= esc($tech['type'] ?? '') ?>">Edit</button>
                  <form method="post" action="/profile/tech/<?= (int)$tech['id'] ?>/delete" class="w-50 m-0 p-0 delete-form">
                    <button type="submit" class="btn btn-danger w-100 btn-delete">Delete</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12">
          <div class="text-white-50">No tech stacks yet.</div>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- Certificates Section -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0 text-light">Certificates</h5>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#certificateModal">
      Add New Certificate
    </button>
  </div>

  <div class="card custom-container-card rounded-4 p-3 border border-secondary mb-4">
    <div class="row g-3">
      <?php if (!empty($certificates)): ?>
        <?php foreach ($certificates as $cert): ?>
          <div class="col-md-4">
            <div class="card tech-card text-light rounded-4 overflow-hidden shadow h-100">
              <div class="card-body d-flex flex-column">
                <?php if (!empty($cert['image_url'])): ?>
                  <div class="mb-2">
                    <?php
                      $img = (string) ($cert['image_url'] ?? '');
                      $isAbsolute = (strpos($img, 'http://') === 0) || (strpos($img, 'https://') === 0) || (strpos($img, '/') === 0);
                      $src = $isAbsolute ? $img : '/upload/profile/' . $img;
                    ?>
                    <img
                      src="<?= esc($src) ?>"
                      alt="<?= esc($cert['title']) ?>"
                      class="img-fluid rounded"
                      style="
      max-height: 160px;
      width: 100%;
      object-fit: cover;
      border: 1px solid rgba(255,255,255,0.1);
      box-shadow: 0 2px 8px rgba(0,0,0,0.5);
    ">
                  </div>
                <?php endif; ?>
                <h6 class="card-title mb-1"><?= esc($cert['title']) ?></h6>
                <p class="text-white-50 small mb-1">
                  Issued by <?= esc($cert['issued_by'] ?? '-') ?>
                  <?php if (!empty($cert['achieved_at'])): ?>
                    • <?= esc(date('Y', strtotime($cert['achieved_at']))) ?>
                  <?php endif; ?>
                </p>
                <div class="d-flex gap-2 mt-auto">
                  <button
                    class="btn btn-warning w-50 btn-edit-certificate"
                    data-bs-toggle="modal"
                    data-bs-target="#editCertificateModal"
                    data-id="<?= (int)$cert['id'] ?>"
                    data-title="<?= esc($cert['title']) ?>"
                    data-description="<?= esc($cert['description'] ?? '') ?>"
                    data-issuer="<?= esc($cert['issued_by'] ?? '') ?>"
                    data-date="<?= esc(!empty($cert['achieved_at']) ? date('Y-m-d', strtotime($cert['achieved_at'])) : '') ?>">
                    Edit
                  </button>
                  <form method="post" action="/profile/certificates/<?= (int)$cert['id'] ?>/delete" class="w-50 m-0 p-0 delete-form">
                    <button type="submit" class="btn btn-danger w-100 btn-delete">Delete</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12">
          <div class="text-white-50">No certificates yet.</div>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- Modal for Adding New Category -->
  <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content custom-modal">
        <div class="modal-header border-secondary">
          <h5 class="modal-title text-light" id="categoryModalLabel">Add New Category</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post" action="/profile/categories" id="addCategoryForm">
            <div class="mb-3">
              <label for="categoryName" class="form-label text-light">Category Name</label>
              <input name="name" type="text" class="form-control custom-input" id="categoryName" placeholder="Enter category name" required maxlength="50">
              <div class="form-text text-warning">
                <span id="categoryCharCount">0</span>/50 characters
              </div>
            </div>
            <div class="text-end">
              <button type="submit" class="btn btn-primary" id="addCategoryBtn" disabled>Save Category</button>
            </div>
          </form>
        </div>
        <div class="modal-footer border-secondary"></div>
      </div>
    </div>
  </div>

  <!-- Modal for Editing Category -->
  <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content custom-modal">
        <div class="modal-header border-secondary">
          <h5 class="modal-title text-light" id="editCategoryModalLabel">Edit Category</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="editCategoryForm" method="post" action="#">
            <input type="hidden" id="originalCategoryName" value="">
            <div class="mb-3">
              <label for="editCategoryName" class="form-label text-light">Category Name</label>
              <input name="name" type="text" class="form-control custom-input" id="editCategoryName" value="" required maxlength="50">
              <div class="form-text text-warning">
                <span id="editCategoryCharCount">0</span>/50 characters
              </div>
            </div>
            <div class="text-end">
              <button type="submit" class="btn btn-primary" id="editCategoryBtn" disabled>Update Category</button>
            </div>
          </form>
        </div>
        <div class="modal-footer border-secondary"></div>
      </div>
    </div>
  </div>

  <!-- Modal for Adding New Tech Stack -->
  <div class="modal fade" id="techStackModal" tabindex="-1" aria-labelledby="techStackModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content custom-modal">
        <div class="modal-header border-secondary">
          <h5 class="modal-title text-light" id="techStackModalLabel">Add New Tech Stack</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post" action="/profile/tech" enctype="multipart/form-data" id="addTechForm">
            <div class="mb-3">
              <label for="techName" class="form-label text-light">Technology Name</label>
              <input name="name" type="text" class="form-control custom-input" id="techName" placeholder="Enter technology name" required maxlength="50">
              <div class="form-text text-warning">
                <span id="techCharCount">0</span>/50 characters
              </div>
            </div>
            <div class="mb-3">
              <label for="techType" class="form-label text-light">Type</label>
              <input name="type" type="text" class="form-control custom-input" id="techType" placeholder="e.g. frontend, backend, database" required maxlength="50">
              <div class="form-text text-warning">
                <span id="typeCharCount">0</span>/50 characters
              </div>
            </div>
            <div class="mb-3">
              <label for="techImage" class="form-label text-light">Image</label>
              <input name="image" type="file" class="form-control custom-input" id="techImage" accept="image/*" required>
            </div>
            <div class="text-end">
              <button type="submit" class="btn btn-primary" id="addTechBtn" disabled>Save Tech Stack</button>
            </div>
          </form>
        </div>
        <div class="modal-footer border-secondary"></div>
      </div>
    </div>
  </div>

  <!-- Modal for Editing Tech Stack -->
  <div class="modal fade" id="editTechStackModal" tabindex="-1" aria-labelledby="editTechStackModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content custom-modal">
        <div class="modal-header border-secondary">
          <h5 class="modal-title text-light" id="editTechStackModalLabel">Edit Tech Stack</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="editTechForm" method="post" action="#" enctype="multipart/form-data">
            <input type="hidden" id="originalTechName" value="">
            <input type="hidden" id="originalTechType" value="">
            <div class="mb-3">
              <label for="editTechName" class="form-label text-light">Technology Name</label>
              <input name="name" type="text" class="form-control custom-input" id="editTechName" value="" required maxlength="50">
              <div class="form-text text-warning">
                <span id="editTechCharCount">0</span>/50 characters
              </div>
            </div>
            <div class="mb-3">
              <label for="editTechType" class="form-label text-light">Type</label>
              <input name="type" type="text" class="form-control custom-input" id="editTechType" value="" required maxlength="50">
              <div class="form-text text-warning">
                <span id="editTypeCharCount">0</span>/50 characters
              </div>
            </div>
            <div class="mb-3">
              <label for="editTechImage" class="form-label text-light">Image</label>
              <input name="image" type="file" class="form-control custom-input" id="editTechImage" accept="image/*">
              <div class="form-text text-info">Leave empty to keep current image</div>
            </div>
            <div class="text-end">
              <button type="submit" class="btn btn-primary" id="editTechBtn" disabled>Update Tech Stack</button>
            </div>
          </form>
        </div>
        <div class="modal-footer border-secondary"></div>
      </div>
    </div>
  </div>

  <!-- Certificate Modal for Adding New Certificate -->
<div class="modal fade" id="certificateModal" tabindex="-1" aria-labelledby="certificateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content custom-modal">
      <div class="modal-header border-secondary">
        <h5 class="modal-title text-light" id="certificateModalLabel">Add New Certificate</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="/profile/certificates" enctype="multipart/form-data" id="addCertificateForm">
          <div class="mb-3">
            <label for="certificateTitle" class="form-label text-light">Title</label>
            <input name="title" type="text" class="form-control custom-input" id="certificateTitle" placeholder="Enter certificate title" required maxlength="100">
            <div class="form-text text-warning">
              <span id="titleCharCount">0</span>/100 characters
            </div>
          </div>
          <div class="mb-3">
            <label for="certificateDescription" class="form-label text-light">Description</label>
            <textarea name="description" class="form-control custom-input" id="certificateDescription" rows="3" placeholder="Enter certificate description" maxlength="500"></textarea>
            <div class="form-text text-warning">
              <span id="descriptionCharCount">0</span>/500 characters
            </div>
          </div>
          <div class="mb-3">
            <label for="certificateIssuer" class="form-label text-light">Issued By</label>
            <input name="issuer" type="text" class="form-control custom-input" id="certificateIssuer" placeholder="Enter issuer name" required maxlength="100">
            <div class="form-text text-warning">
              <span id="issuerCharCount">0</span>/100 characters
            </div>
          </div>
          <div class="mb-3">
            <label for="certificateDate" class="form-label text-light">Achieved At</label>
            <input name="achieved_at" type="date" class="form-control custom-input" id="certificateDate" required>
          </div>
          <div class="mb-3">
            <label for="certificateImage" class="form-label text-light">Certificate Image</label>
            <input name="image" type="file" class="form-control custom-input" id="certificateImage" accept="image/*" required>
            <div class="form-text text-info">Upload certificate image (JPG, PNG, etc.)</div>
          </div>
          <div class="text-end">
            <button type="submit" class="btn btn-primary" id="addCertificateBtn" disabled>Save Certificate</button>
          </div>
        </form>
      </div>
      <div class="modal-footer border-secondary"></div>
    </div>
  </div>
</div>

<!-- Edit Certificate Modal -->
<div class="modal fade" id="editCertificateModal" tabindex="-1" aria-labelledby="editCertificateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content custom-modal">
      <div class="modal-header border-secondary">
        <h5 class="modal-title text-light" id="editCertificateModalLabel">Edit Certificate</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editCertificateForm" method="post" action="#" enctype="multipart/form-data">
          <input type="hidden" id="originalCertificateTitle" value="">
          <div class="mb-3">
            <label for="editCertificateTitle" class="form-label text-light">Title</label>
            <input name="title" type="text" class="form-control custom-input" id="editCertificateTitle" value="" required maxlength="100">
            <div class="form-text text-warning">
              <span id="editTitleCharCount">0</span>/100 characters
            </div>
          </div>
          <div class="mb-3">
            <label for="editCertificateDescription" class="form-label text-light">Description</label>
            <textarea name="description" class="form-control custom-input" id="editCertificateDescription" rows="3" maxlength="500"></textarea>
            <div class="form-text text-warning">
              <span id="editDescriptionCharCount">0</span>/500 characters
            </div>
          </div>
          <div class="mb-3">
            <label for="editCertificateIssuer" class="form-label text-light">Issued By</label>
            <input name="issuer" type="text" class="form-control custom-input" id="editCertificateIssuer" value="" required maxlength="100">
            <div class="form-text text-warning">
              <span id="editIssuerCharCount">0</span>/100 characters
            </div>
          </div>
          <div class="mb-3">
            <label for="editCertificateDate" class="form-label text-light">Achieved At</label>
            <input name="achieved_at" type="date" class="form-control custom-input" id="editCertificateDate" required>
          </div>
          <div class="mb-3">
            <label for="editCertificateImage" class="form-label text-light">Certificate Image</label>
            <input name="image" type="file" class="form-control custom-input" id="editCertificateImage" accept="image/*">
            <div class="form-text text-info">Leave empty to keep current image</div>
          </div>
          <div class="text-end">
            <button type="submit" class="btn btn-primary" id="editCertificateBtn" disabled>Update Certificate</button>
          </div>
        </form>
      </div>
      <div class="modal-footer border-secondary"></div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Populate edit certificate modal with all data
  const editCertificateButtons = document.querySelectorAll('.btn-edit-certificate');
  const editCertificateForm = document.getElementById('editCertificateForm');
  const editCertificateTitle = document.getElementById('editCertificateTitle');
  const editCertificateDescription = document.getElementById('editCertificateDescription');
  const editCertificateIssuer = document.getElementById('editCertificateIssuer');
  const editCertificateDate = document.getElementById('editCertificateDate');
  const originalCertificateTitle = document.getElementById('originalCertificateTitle');
  const editTitleCharCount = document.getElementById('editTitleCharCount');
  const editDescriptionCharCount = document.getElementById('editDescriptionCharCount');
  const editIssuerCharCount = document.getElementById('editIssuerCharCount');
  const editCertificateBtn = document.getElementById('editCertificateBtn');
  
  editCertificateButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      const id = btn.getAttribute('data-id');
      const title = btn.getAttribute('data-title') || '';
      const description = btn.getAttribute('data-description') || '';
      const issuer = btn.getAttribute('data-issuer') || '';
      const date = btn.getAttribute('data-date') || '';
      
      // Set form action and populate fields
      editCertificateForm.action = `/profile/certificates/${id}`;
      editCertificateTitle.value = title;
      editCertificateDescription.value = description;
      editCertificateIssuer.value = issuer;
      editCertificateDate.value = date;
      originalCertificateTitle.value = title;
      
      // Update character counts
      editTitleCharCount.textContent = title.length;
      editDescriptionCharCount.textContent = description.length;
      editIssuerCharCount.textContent = issuer.length;
      
      updateEditCertificateButton();
    });
  });

  // Character count and validation for Add Certificate form
  const certificateTitle = document.getElementById('certificateTitle');
  const certificateDescription = document.getElementById('certificateDescription');
  const certificateIssuer = document.getElementById('certificateIssuer');
  const certificateDate = document.getElementById('certificateDate');
  const certificateImage = document.getElementById('certificateImage');
  const titleCharCount = document.getElementById('titleCharCount');
  const descriptionCharCount = document.getElementById('descriptionCharCount');
  const issuerCharCount = document.getElementById('issuerCharCount');
  const addCertificateBtn = document.getElementById('addCertificateBtn');

  certificateTitle.addEventListener('input', function() {
    const length = this.value.length;
    titleCharCount.textContent = length;
    updateAddCertificateButton();
  });

  certificateDescription.addEventListener('input', function() {
    const length = this.value.length;
    descriptionCharCount.textContent = length;
    updateAddCertificateButton();
  });

  certificateIssuer.addEventListener('input', function() {
    const length = this.value.length;
    issuerCharCount.textContent = length;
    updateAddCertificateButton();
  });

  certificateDate.addEventListener('change', updateAddCertificateButton);
  certificateImage.addEventListener('change', updateAddCertificateButton);

  function updateAddCertificateButton() {
    const titleValid = certificateTitle.value.trim().length > 0 && certificateTitle.value.length <= 100;
    const issuerValid = certificateIssuer.value.trim().length > 0 && certificateIssuer.value.length <= 100;
    const dateValid = certificateDate.value !== '';
    const imageValid = certificateImage.files.length > 0;
    
    addCertificateBtn.disabled = !(titleValid && issuerValid && dateValid && imageValid);
  }

  // Character count and validation for Edit Certificate form
  editCertificateTitle.addEventListener('input', function() {
    const length = this.value.length;
    editTitleCharCount.textContent = length;
    updateEditCertificateButton();
  });

  editCertificateDescription.addEventListener('input', function() {
    const length = this.value.length;
    editDescriptionCharCount.textContent = length;
    updateEditCertificateButton();
  });

  editCertificateIssuer.addEventListener('input', function() {
    const length = this.value.length;
    editIssuerCharCount.textContent = length;
    updateEditCertificateButton();
  });

  editCertificateDate.addEventListener('change', updateEditCertificateButton);

  function updateEditCertificateButton() {
    const currentTitle = editCertificateTitle.value.trim();
    const originalTitle = originalCertificateTitle.value.trim();
    
    const titleValid = currentTitle.length > 0 && currentTitle.length <= 100;
    const issuerValid = editCertificateIssuer.value.trim().length > 0 && editCertificateIssuer.value.length <= 100;
    const dateValid = editCertificateDate.value !== '';
    
    // Check if any changes were made
    const titleChanged = currentTitle !== originalTitle;
    const descriptionChanged = editCertificateDescription.value !== '';
    const issuerChanged = editCertificateIssuer.value !== '';
    const dateChanged = editCertificateDate.value !== '';
    
    const hasChanges = titleChanged || descriptionChanged || issuerChanged || dateChanged;
    
    editCertificateBtn.disabled = !(titleValid && issuerValid && dateValid) || !hasChanges;
  }

  // Initialize button states
  updateAddCertificateButton();
});
</script>

  <!-- Delete Confirmation Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const deleteButtons = document.querySelectorAll('.btn-delete');
      deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
          const confirmed = confirm('Are you sure you want to delete this item?');
          if (!confirmed) {
            e.preventDefault();
            return false;
          }
        });
      });

      // Populate edit category modal
      const editCategoryButtons = document.querySelectorAll('.btn-edit-category');
      const editCategoryForm = document.getElementById('editCategoryForm');
      const editCatName = document.getElementById('editCategoryName');
      const originalCategoryName = document.getElementById('originalCategoryName');
      const editCategoryCharCount = document.getElementById('editCategoryCharCount');
      const editCategoryBtn = document.getElementById('editCategoryBtn');
      
      editCategoryButtons.forEach(btn => {
        btn.addEventListener('click', () => {
          const id = btn.getAttribute('data-id');
          const name = btn.getAttribute('data-name') || '';
          editCategoryForm.action = `/profile/categories/${id}`;
          editCatName.value = name;
          originalCategoryName.value = name;
          editCategoryCharCount.textContent = name.length;
          updateEditCategoryButton();
        });
      });

      // Populate edit tech modal
      const editTechButtons = document.querySelectorAll('.btn-edit-tech');
      const editTechForm = document.getElementById('editTechForm');
      const editTechName = document.getElementById('editTechName');
      const editTechType = document.getElementById('editTechType');
      const originalTechName = document.getElementById('originalTechName');
      const originalTechType = document.getElementById('originalTechType');
      const editTechCharCount = document.getElementById('editTechCharCount');
      const editTypeCharCount = document.getElementById('editTypeCharCount');
      const editTechBtn = document.getElementById('editTechBtn');
      const editTechImage = document.getElementById('editTechImage');
      
      editTechButtons.forEach(btn => {
        btn.addEventListener('click', () => {
          const id = btn.getAttribute('data-id');
          const name = btn.getAttribute('data-name') || '';
          const type = btn.getAttribute('data-type') || '';
          
          editTechForm.action = `/profile/tech/${id}`;
          editTechName.value = name;
          editTechType.value = type;
          originalTechName.value = name;
          originalTechType.value = type;
          editTechCharCount.textContent = name.length;
          editTypeCharCount.textContent = type.length;
          editTechImage.value = ''; // Reset file input
          updateEditTechButton();
        });
      });

      // Character count and validation for Add Category form
      const categoryName = document.getElementById('categoryName');
      const categoryCharCount = document.getElementById('categoryCharCount');
      const addCategoryBtn = document.getElementById('addCategoryBtn');

      categoryName.addEventListener('input', function() {
        const length = this.value.length;
        categoryCharCount.textContent = length;
        updateAddCategoryButton();
      });

      function updateAddCategoryButton() {
        const isValid = categoryName.value.trim().length > 0 && categoryName.value.length <= 50;
        addCategoryBtn.disabled = !isValid;
      }

      // Character count and validation for Edit Category form
      editCatName.addEventListener('input', function() {
        const length = this.value.length;
        editCategoryCharCount.textContent = length;
        updateEditCategoryButton();
      });

      function updateEditCategoryButton() {
        const currentValue = editCatName.value.trim();
        const originalValue = originalCategoryName.value.trim();
        const isValid = currentValue.length > 0 && currentValue.length <= 50;
        const hasChanges = currentValue !== originalValue;
        
        editCategoryBtn.disabled = !isValid || !hasChanges;
      }

      // Character count and validation for Add Tech Stack form
      const techName = document.getElementById('techName');
      const techType = document.getElementById('techType');
      const techImage = document.getElementById('techImage');
      const techCharCount = document.getElementById('techCharCount');
      const typeCharCount = document.getElementById('typeCharCount');
      const addTechBtn = document.getElementById('addTechBtn');

      techName.addEventListener('input', function() {
        const length = this.value.length;
        techCharCount.textContent = length;
        updateAddTechButton();
      });

      techType.addEventListener('input', function() {
        const length = this.value.length;
        typeCharCount.textContent = length;
        updateAddTechButton();
      });

      techImage.addEventListener('change', updateAddTechButton);

      function updateAddTechButton() {
        const nameValid = techName.value.trim().length > 0 && techName.value.length <= 50;
        const typeValid = techType.value.trim().length > 0 && techType.value.length <= 50;
        const imageValid = techImage.files.length > 0;
        
        addTechBtn.disabled = !(nameValid && typeValid && imageValid);
      }

      // Character count and validation for Edit Tech Stack form
      editTechName.addEventListener('input', function() {
        const length = this.value.length;
        editTechCharCount.textContent = length;
        updateEditTechButton();
      });

      editTechType.addEventListener('input', function() {
        const length = this.value.length;
        editTypeCharCount.textContent = length;
        updateEditTechButton();
      });

      editTechImage.addEventListener('change', updateEditTechButton);

      function updateEditTechButton() {
        const currentName = editTechName.value.trim();
        const currentType = editTechType.value.trim();
        const originalName = originalTechName.value.trim();
        const originalType = originalTechType.value.trim();
        
        const nameValid = currentName.length > 0 && currentName.length <= 50;
        const typeValid = currentType.length > 0 && currentType.length <= 50;
        
        // Check if any changes were made
        const nameChanged = currentName !== originalName;
        const typeChanged = currentType !== originalType;
        const imageChanged = editTechImage.files.length > 0;
        
        const hasChanges = nameChanged || typeChanged || imageChanged;
        
        editTechBtn.disabled = !(nameValid && typeValid) || !hasChanges;
      }

      // Initialize button states
      updateAddCategoryButton();
      updateAddTechButton();
    });
  </script>

  <style>
    body {
      background-color: #0c0e12;
      color: #e0e0e0;
    }

    .custom-container-card {
      background: linear-gradient(145deg, #1a1b20, #121317);
      border: 1px solid rgba(100, 100, 120, 0.3);
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.6);
    }

    .profile-card,
    .tech-card {
      background: linear-gradient(165deg, #17181d, #101114);
      border: 1px solid rgba(70, 120, 240, 0.25);
      transition: all 0.3s ease;
    }

    .profile-card:hover,
    .tech-card:hover {
      transform: translateY(-4px);
      border-color: rgba(100, 160, 255, 0.6);
      box-shadow: 0 0 18px rgba(65, 145, 255, 0.4);
    }

    .btn-primary {
      background: linear-gradient(135deg, #377aff, #275de6);
      border: none;
    }

    .btn-primary:disabled {
      background: linear-gradient(135deg, #6c757d, #5a6268);
      border: none;
      opacity: 0.6;
      cursor: not-allowed;
    }

    .btn-danger {
      background: linear-gradient(135deg, #ff4b4b, #d63636);
      border: none;
    }

    .btn-warning {
      background: linear-gradient(135deg, #ffc107, #e0a800);
      border: none;
      color: #121317;
      font-weight: 600;
    }

    .btn-warning:hover,
    .btn-danger:hover,
    .btn-primary:hover:not(:disabled) {
      opacity: 0.9;
    }

    h6.text-light {
      color: #e84a6b !important;
    }

    .custom-modal {
      background: linear-gradient(145deg, #1a1b20, #121317);
      border: 1px solid rgba(100, 100, 120, 0.3);
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.6);
    }

    .custom-input {
      background-color: #17181d;
      border: 1px solid rgba(100, 100, 120, 0.3);
      color: #e0e0e0;
      border-radius: 8px;
    }

    .custom-input:focus {
      background-color: #17181d;
      border-color: rgba(70, 120, 240, 0.6);
      color: #e0e0e0;
      box-shadow: 0 0 0 0.2rem rgba(70, 120, 240, 0.25);
    }

    .form-select.custom-input {
      background-color: #17181d;
      color: #e0e0e0;
    }

    .modal-header,
    .modal-footer {
      border-color: rgba(100, 100, 120, 0.3) !important;
    }

    .btn-close-white {
      filter: invert(1) grayscale(100%) brightness(200%);
    }

    .form-text {
      font-size: 0.875rem;
    }
  </style>

  <?= $this->endSection() ?>