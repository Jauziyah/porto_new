<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="container py-4">
  <h1 class="mb-4 text-light fw-bold">Settings</h1>

  <!-- What I Do Section -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="text-light mb-0">What I Do (Profile Metadata)</h5>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#whatIDoModal">Add New</button>
  </div>

  <div class="card custom-container-card rounded-4 p-3 border border-secondary mb-4">
    <div class="row g-3">
      <?php if (!empty($what_i_do_list)): ?>
        <?php foreach ($what_i_do_list as $wid): ?>
          <div class="col-md-3">
            <div class="card profile-card text-light rounded-4 overflow-hidden shadow">
              <div class="image-container position-relative d-flex align-items-center justify-content-center">
                <?php if (!empty($wid['icon'])): ?>
                  <img src="<?= base_url('/upload/settings/' . $wid['icon']) ?>" alt="icon" class="card-image" />
                  <div class="image-overlay"></div>
                <?php else: ?>
                  <div class="placeholder-content">
                    <i class="fas fa-image fa-2x mb-2 opacity-50"></i>
                    <div class="fw-semibold opacity-75 text-white">No Image</div>
                  </div>
                <?php endif; ?>
              </div>
              <div class="card-body">
                <h6 class="card-title mb-1"><?= htmlspecialchars($wid['title'] ?? '') ?></h6>
                <p class="card-text text-white-50 small mb-3">
                  <?= htmlspecialchars($wid['description'] ?? '') ?>
                </p>
                <div class="d-flex gap-2">
                  <button class="btn btn-primary w-50 btn-edit-whatido" 
                          data-bs-toggle="modal" data-bs-target="#editWhatIDoModal"
                          data-id="<?= (int)($wid['id'] ?? 0) ?>"
                          data-title="<?= htmlspecialchars($wid['title'] ?? '', ENT_QUOTES) ?>"
                          data-description="<?= htmlspecialchars($wid['description'] ?? '', ENT_QUOTES) ?>">
                    Edit
                  </button>
                  <form action="<?= site_url('/settings/what-i-do/' . (int)($wid['id'] ?? 0) . '/delete') ?>" method="post" class="w-50">
                    <button type="submit" class="btn btn-danger w-100 btn-delete">Delete</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12 text-white-50 small">No items yet.</div>
      <?php endif; ?>
    </div>
  </div>

  <!-- Other Settings Section -->
  <h5 class="text-light mb-3">Other Settings</h5>

  <div class="card custom-container-card rounded-4 p-4 border border-secondary mb-4">
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label text-white-50 small">Hallo, Ich bin</label>
        <form class="d-flex gap-2" action="<?= site_url('/settings/user') ?>" method="post">
          <input type="text" class="form-control custom-input greeting-input" name="greeting" value="<?= htmlspecialchars($user['greeting'] ?? '') ?>" data-original-value="<?= htmlspecialchars($user['greeting'] ?? '') ?>">
          <button class="btn btn-success greeting-save" type="submit" disabled>Save</button>
        </form>
      </div>

      <div class="col-md-6">
        <label class="form-label text-white-50 small">Name</label>
        <form class="d-flex gap-2" action="<?= site_url('/settings/user') ?>" method="post">
          <input type="text" class="form-control custom-input name-input" name="name" value="<?= htmlspecialchars($user['name'] ?? '') ?>" data-original-value="<?= htmlspecialchars($user['name'] ?? '') ?>">
          <button class="btn btn-success name-save" type="submit" disabled>Save</button>
        </form>
      </div>

      <div class="col-md-6">
        <label class="form-label text-white-50 small">Title</label>
        <form class="d-flex gap-2" action="<?= site_url('/settings/user') ?>" method="post">
          <input type="text" class="form-control custom-input titles-input" name="titles" value="<?= htmlspecialchars(isset($titles_list) ? implode(',', $titles_list) : ($user['titles'] ?? '')) ?>" data-original-value="<?= htmlspecialchars(isset($titles_list) ? implode(',', $titles_list) : ($user['titles'] ?? '')) ?>">
          <button class="btn btn-success titles-save" type="submit" disabled>Save</button>
        </form>
      </div>

      <div class="col-12">
        <label class="form-label text-white-50 small">Hero Section Profile</label>
        <form class="d-flex gap-2" action="<?= site_url('/settings/user') ?>" method="post">
          <input type="text" class="form-control custom-input hero-description-input" name="hero_description" value="<?= htmlspecialchars($user['hero_description'] ?? '') ?>" data-original-value="<?= htmlspecialchars($user['hero_description'] ?? '') ?>">
          <button class="btn btn-success hero-description-save" type="submit" disabled>Save</button>
        </form>
      </div>

      <div class="col-md-6">
        <label class="form-label text-white-50 small">Profile Image</label>
        <div class="d-flex flex-column gap-2">
          <div class="card profile-card text-light rounded-4 overflow-hidden shadow" style="max-width: 260px;">
            <div class="image-container d-flex align-items-center justify-content-center" style="height: 140px;">
              <?php if (!empty($user['profile_image'])): ?>
                <img id="profileImagePreview" src="<?= base_url('/upload/profile/' . $user['profile_image']) ?>" alt="profile image" class="card-image" />
                <div class="image-overlay"></div>
              <?php else: ?>
                <div class="placeholder-content" id="profileImagePlaceholder">
                  <i class="fas fa-user-circle fa-2x mb-2 opacity-50"></i>
                  <div class="fw-semibold opacity-75 text-white">No Image</div>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <form class="d-flex gap-2" action="<?= site_url('/settings/profile-image') ?>" method="post" enctype="multipart/form-data">
            <input type="file" class="form-control custom-input" id="profileImageInput" name="profile_image" accept="image/*">
            <button class="btn btn-success" id="profileImageSave" type="submit" disabled>Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Find Me In Section -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="text-light mb-0">Find Me In</h5>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#findMeInModal">Add New</button>
  </div>

  <div class="card custom-container-card rounded-4 p-3 border border-secondary mb-4">
    <div class="row g-3">
      <?php if (!empty($social_links_list)): ?>
        <?php foreach ($social_links_list as $sl): ?>
          <div class="col-md-3">
            <div class="card profile-card text-light rounded-4 overflow-hidden shadow">
              <div class="image-container d-flex align-items-center justify-content-center">
                <?php if (!empty($sl['icon'])): ?>
                  <img src="<?= base_url('/upload/settings/' . $sl['icon']) ?>" alt="icon" class="card-image" />
                  <div class="image-overlay"></div>
                <?php else: ?>
                  <div class="placeholder-content">
                    <i class="fas fa-share-alt fa-2x mb-2 opacity-50"></i>
                    <div class="fw-semibold opacity-75 text-white">No Icon</div>
                  </div>
                <?php endif; ?>
              </div>
              <div class="card-body">
                <h6 class="fw-semibold mb-1 text-light"><?= htmlspecialchars($sl['platform'] ?? '') ?></h6>
                <p class="text-white-50 small mb-3"><?= htmlspecialchars($sl['url'] ?? '') ?></p>
                <div class="d-flex gap-2">
                  <button class="btn btn-primary w-50 btn-edit-social" data-bs-toggle="modal" data-bs-target="#editFindMeInModal"
                          data-id="<?= (int)($sl['id'] ?? 0) ?>"
                          data-platform="<?= htmlspecialchars($sl['platform'] ?? '', ENT_QUOTES) ?>"
                          data-url="<?= htmlspecialchars($sl['url'] ?? '', ENT_QUOTES) ?>">
                    Edit
                  </button>
                  <form action="<?= site_url('/settings/social-links/' . (int)($sl['id'] ?? 0) . '/delete') ?>" method="post" class="w-50">
                    <button type="submit" class="btn btn-danger w-100 btn-delete">Delete</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12 text-white-50 small">No social links yet.</div>
      <?php endif; ?>
    </div>
  </div>

  <!-- Best At Section -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="text-light mb-0">Best At</h5>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bestAtModal">Add New</button>
  </div>

  <div class="card custom-container-card rounded-4 p-3 border border-secondary">
    <div class="row g-3">
      <?php if (!empty($skills_list)): ?>
        <?php foreach ($skills_list as $sk): ?>
          <div class="col-md-3">
            <div class="card profile-card text-light rounded-4 overflow-hidden shadow">
              <div class="image-container d-flex align-items-center justify-content-center">
                <?php if (!empty($sk['icon'])): ?>
                  <img src="<?= base_url('/upload/settings/' . $sk['icon']) ?>" alt="icon" class="card-image" />
                  <div class="image-overlay"></div>
                <?php else: ?>
                  <div class="placeholder-content">
                    <i class="fas fa-star fa-2x mb-2 opacity-50"></i>
                    <div class="fw-semibold opacity-75 text-white">No Icon</div>
                  </div>
                <?php endif; ?>
              </div>
              <div class="card-body">
                <h6 class="fw-semibold mb-1 text-light"><?= htmlspecialchars($sk['name'] ?? '') ?></h6>
                <p class="text-white-50 small mb-3">&nbsp;</p>
                <div class="d-flex gap-2">
                  <button class="btn btn-primary w-50 btn-edit-skill" data-bs-toggle="modal" data-bs-target="#editBestAtModal"
                          data-id="<?= (int)($sk['id'] ?? 0) ?>"
                          data-name="<?= htmlspecialchars($sk['name'] ?? '', ENT_QUOTES) ?>">
                    Edit
                  </button>
                  <form action="<?= site_url('/settings/skills/' . (int)($sk['id'] ?? 0) . '/delete') ?>" method="post" class="w-50">
                    <button type="submit" class="btn btn-danger w-100 btn-delete">Delete</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12 text-white-50 small">No skills yet.</div>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- All your modals remain the same as before -->
<!-- Modal for Adding What I Do -->
<div class="modal fade" id="whatIDoModal" tabindex="-1" aria-labelledby="whatIDoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content custom-modal">
      <div class="modal-header border-secondary">
        <h5 class="modal-title text-light" id="whatIDoModalLabel">Add What I Do</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?= site_url('/settings/what-i-do') ?>" enctype="multipart/form-data" id="whatIDoForm">
          <div class="mb-3">
            <label for="whatIDoTitle" class="form-label text-light">Title</label>
            <input type="text" class="form-control custom-input" id="whatIDoTitle" name="title" placeholder="Enter title" required>
          </div>
          <div class="mb-3">
            <label for="whatIDoDescription" class="form-label text-light">Description</label>
            <textarea class="form-control custom-input" id="whatIDoDescription" name="description" placeholder="Enter description" rows="3"></textarea>
          </div>
          <div class="mb-3">
            <label for="whatIDoImage" class="form-label text-light">Image</label>
            <input type="file" class="form-control custom-input" id="whatIDoImage" name="image" accept="image/*">
          </div>
          <div class="text-end">
            <button type="submit" class="btn btn-primary" id="whatIDoSave" disabled>Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal for Editing What I Do -->
<div class="modal fade" id="editWhatIDoModal" tabindex="-1" aria-labelledby="editWhatIDoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content custom-modal">
      <div class="modal-header border-secondary">
        <h5 class="modal-title text-light" id="editWhatIDoModalLabel">Edit What I Do</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formEditWhatIDo" method="post" action="#" enctype="multipart/form-data">
          <input type="hidden" id="editWhatIDoOriginalTitle" value="">
          <input type="hidden" id="editWhatIDoOriginalDescription" value="">
          <div class="mb-3">
            <label for="editWhatIDoTitle" class="form-label text-light">Title</label>
            <input type="text" class="form-control custom-input" id="editWhatIDoTitle" name="title" required>
          </div>
          <div class="mb-3">
            <label for="editWhatIDoDescription" class="form-label text-light">Description</label>
            <textarea class="form-control custom-input" id="editWhatIDoDescription" name="description" rows="3"></textarea>
          </div>
          <div class="mb-3">
            <label for="editWhatIDoImage" class="form-label text-light">Image</label>
            <input type="file" class="form-control custom-input" id="editWhatIDoImage" name="image" accept="image/*">
            <div class="form-text text-info">Leave empty to keep current image</div>
          </div>
          <div class="text-end">
            <button type="submit" class="btn btn-primary" id="editWhatIDoUpdate" disabled>Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal for Adding Find Me In -->
<div class="modal fade" id="findMeInModal" tabindex="-1" aria-labelledby="findMeInModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content custom-modal">
      <div class="modal-header border-secondary">
        <h5 class="modal-title text-light" id="findMeInModalLabel">Add Social Media</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?= site_url('/settings/social-links') ?>" enctype="multipart/form-data" id="findMeInForm">
          <div class="mb-3">
            <label for="socialMediaPlatform" class="form-label text-light">Platform</label>
            <select class="form-control custom-input" id="socialMediaPlatform" name="platform" required>
              <option value="">Select Platform</option>
              <option value="instagram">Instagram</option>
              <option value="linkedin">LinkedIn</option>
              <option value="github">GitHub</option>
              <option value="twitter">Twitter</option>
              <option value="facebook">Facebook</option>
              <option value="other">Other</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="socialMediaUrl" class="form-label text-light">URL</label>
            <input type="url" class="form-control custom-input" id="socialMediaUrl" name="url" placeholder="https://" required>
          </div>
          <div class="mb-3">
            <label for="socialMediaImage" class="form-label text-light">Icon/Image</label>
            <input type="file" class="form-control custom-input" id="socialMediaImage" name="image" accept="image/*">
          </div>
          <div class="text-end">
            <button type="submit" class="btn btn-primary" id="findMeInSave" disabled>Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal for Editing Find Me In -->
<div class="modal fade" id="editFindMeInModal" tabindex="-1" aria-labelledby="editFindMeInModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content custom-modal">
      <div class="modal-header border-secondary">
        <h5 class="modal-title text-light" id="editFindMeInModalLabel">Edit Social Media</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formEditSocial" method="post" action="#" enctype="multipart/form-data">
          <input type="hidden" id="editSocialOriginalPlatform" value="">
          <input type="hidden" id="editSocialOriginalUrl" value="">
          <div class="mb-3">
            <label for="editSocialMediaPlatform" class="form-label text-light">Platform</label>
            <select class="form-control custom-input" id="editSocialMediaPlatform" name="platform" required>
              <option value="instagram">Instagram</option>
              <option value="linkedin">LinkedIn</option>
              <option value="github">GitHub</option>
              <option value="twitter">Twitter</option>
              <option value="facebook">Facebook</option>
              <option value="other">Other</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="editSocialMediaUrl" class="form-label text-light">URL</label>
            <input type="url" class="form-control custom-input" id="editSocialMediaUrl" name="url" required>
          </div>
          <div class="mb-3">
            <label for="editSocialMediaImage" class="form-label text-light">Icon/Image</label>
            <input type="file" class="form-control custom-input" id="editSocialMediaImage" name="image" accept="image/*">
            <div class="form-text text-info">Leave empty to keep current image</div>
          </div>
          <div class="text-end">
            <button type="submit" class="btn btn-primary" id="editSocialUpdate" disabled>Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal for Adding Best At -->
<div class="modal fade" id="bestAtModal" tabindex="-1" aria-labelledby="bestAtModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content custom-modal">
      <div class="modal-header border-secondary">
        <h5 class="modal-title text-light" id="bestAtModalLabel">Add Skill</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?= site_url('/settings/skills') ?>" enctype="multipart/form-data" id="bestAtForm">
          <div class="mb-3">
            <label for="skillName" class="form-label text-light">Skill Name</label>
            <input type="text" class="form-control custom-input" id="skillName" name="name" placeholder="Enter skill name" required>
          </div>
          <div class="mb-3">
            <label for="skillCategory" class="form-label text-light">Category</label>
            <input type="text" class="form-control custom-input" id="skillCategory" placeholder="e.g., PHP Framework, Database System" disabled>
          </div>
          <div class="mb-3">
            <label for="skillImage" class="form-label text-light">Icon/Image</label>
            <input type="file" class="form-control custom-input" id="skillImage" name="image" accept="image/*">
          </div>
          <div class="text-end">
            <button type="submit" class="btn btn-primary" id="bestAtSave" disabled>Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal for Editing Best At -->
<div class="modal fade" id="editBestAtModal" tabindex="-1" aria-labelledby="editBestAtModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content custom-modal">
      <div class="modal-header border-secondary">
        <h5 class="modal-title text-light" id="editBestAtModalLabel">Edit Skill</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formEditSkill" method="post" action="#" enctype="multipart/form-data">
          <input type="hidden" id="editSkillOriginalName" value="">
          <div class="mb-3">
            <label for="editSkillName" class="form-label text-light">Skill Name</label>
            <input type="text" class="form-control custom-input" id="editSkillName" name="name" required>
          </div>
          <div class="mb-3">
            <label for="editSkillCategory" class="form-label text-light">Category</label>
            <input type="text" class="form-control custom-input" id="editSkillCategory" value="" disabled>
          </div>
          <div class="mb-3">
            <label for="editSkillImage" class="form-label text-light">Icon/Image</label>
            <input type="file" class="form-control custom-input" id="editSkillImage" name="image" accept="image/*">
            <div class="form-text text-info">Leave empty to keep current image</div>
          </div>
          <div class="text-end">
            <button type="submit" class="btn btn-primary" id="editSkillUpdate" disabled>Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Delete Confirmation Script -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Delete confirmation for all delete buttons
    const deleteButtons = document.querySelectorAll('.btn-delete');
    deleteButtons.forEach(button => {
      button.addEventListener('click', function(e) {
        const confirmed = confirm('Are you sure you want to delete this item? This action cannot be undone.');
        if (!confirmed) {
          e.preventDefault();
          return false;
        }
      });
    });

    // Platform-specific handling for social media forms
    const socialMediaPlatform = document.getElementById('socialMediaPlatform');
    const socialMediaUrl = document.getElementById('socialMediaUrl');
    
    if (socialMediaPlatform && socialMediaUrl) {
      socialMediaPlatform.addEventListener('change', function() {
        const platform = this.value;
        let placeholder = 'https://';
        
        switch(platform) {
          case 'instagram':
            placeholder = 'https://instagram.com/username';
            break;
          case 'linkedin':
            placeholder = 'https://linkedin.com/in/username';
            break;
          case 'github':
            placeholder = 'https://github.com/username';
            break;
          case 'twitter':
            placeholder = 'https://twitter.com/username';
            break;
          case 'facebook':
            placeholder = 'https://facebook.com/username';
            break;
          default:
            placeholder = 'https://';
        }
        
        socialMediaUrl.placeholder = placeholder;
      });
    }

    // Function to check if form has empty required fields
    function hasEmptyRequiredFields(form) {
      const requiredInputs = form.querySelectorAll('input[required], select[required], textarea[required]');
      for (let input of requiredInputs) {
        if (!input.value.trim()) {
          return true;
        }
      }
      return false;
    }

    // Function to check if form values have changed from original (including file inputs)
    function hasFormChanged(form, originalValues) {
      // Check text/select/textarea fields
      for (let field in originalValues) {
        const input = form.querySelector(`[name="${field}"]`);
        if (input && input.type !== 'file' && input.value !== originalValues[field]) {
          return true;
        }
      }
      
      // Check file inputs
      const fileInputs = form.querySelectorAll('input[type="file"]');
      for (let fileInput of fileInputs) {
        if (fileInput.files.length > 0) {
          return true;
        }
      }
      
      return false;
    }

    // Function to toggle button state
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

    // Add modal form validation (grey out if empty required fields)
    const addModals = {
      'whatIDoForm': 'whatIDoSave',
      'findMeInForm': 'findMeInSave',
      'bestAtForm': 'bestAtSave'
    };

    for (const [formId, buttonId] of Object.entries(addModals)) {
      const form = document.getElementById(formId);
      const button = document.getElementById(buttonId);
      
      if (form && button) {
        // Initial check
        toggleButtonState(button, !hasEmptyRequiredFields(form));
        
        // Check on input change for all inputs including file inputs
        const inputs = form.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
          input.addEventListener('input', function() {
            toggleButtonState(button, !hasEmptyRequiredFields(form));
          });
        });
        
        // Special handling for file inputs (use change event)
        const fileInputs = form.querySelectorAll('input[type="file"]');
        fileInputs.forEach(fileInput => {
          fileInput.addEventListener('change', function() {
            toggleButtonState(button, !hasEmptyRequiredFields(form));
          });
        });
      }
    }

    // Edit modal form validation (grey out if no changes)
    const editModals = {
      'formEditWhatIDo': {
        button: 'editWhatIDoUpdate',
        fields: ['title', 'description'],
        originalPrefix: 'editWhatIDoOriginal'
      },
      'formEditSocial': {
        button: 'editSocialUpdate',
        fields: ['platform', 'url'],
        originalPrefix: 'editSocialOriginal'
      },
      'formEditSkill': {
        button: 'editSkillUpdate',
        fields: ['name'],
        originalPrefix: 'editSkillOriginal'
      }
    };

    // Function to check changes for edit modals
    function checkEditModalChanges(formId, config) {
      const form = document.getElementById(formId);
      const button = document.getElementById(config.button);
      
      if (form && button) {
        const originalValues = {};
        config.fields.forEach(field => {
          originalValues[field] = document.getElementById(`${config.originalPrefix}${field.charAt(0).toUpperCase() + field.slice(1)}`).value;
        });
        
        const hasChanged = hasFormChanged(form, originalValues);
        toggleButtonState(button, hasChanged);
      }
    }

    // Set up event listeners for edit modals
    for (const [formId, config] of Object.entries(editModals)) {
      const form = document.getElementById(formId);
      const button = document.getElementById(config.button);
      
      if (form && button) {
        // Listen to all input events including file inputs
        const inputs = form.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
          input.addEventListener('input', function() {
            checkEditModalChanges(formId, config);
          });
          input.addEventListener('change', function() {
            checkEditModalChanges(formId, config);
          });
        });
        
        // Special handling for file inputs
        const fileInputs = form.querySelectorAll('input[type="file"]');
        fileInputs.forEach(fileInput => {
          fileInput.addEventListener('change', function() {
            checkEditModalChanges(formId, config);
          });
        });
      }
    }

    // Other settings form validation
    const settingForms = {
      '.greeting-input': '.greeting-save',
      '.name-input': '.name-save',
      '.titles-input': '.titles-save',
      '.hero-description-input': '.hero-description-save'
    };

    for (const [inputClass, buttonClass] of Object.entries(settingForms)) {
      const inputs = document.querySelectorAll(inputClass);
      const buttons = document.querySelectorAll(buttonClass);
      
      inputs.forEach((input, index) => {
        const button = buttons[index];
        if (input && button) {
          const originalValue = input.getAttribute('data-original-value') || '';
          
          // Initial check
          toggleButtonState(button, input.value !== originalValue);
          
          // Check on input change
          input.addEventListener('input', function() {
            toggleButtonState(button, this.value !== originalValue);
          });
        }
      });
    }

    // Profile Image preview and enable save on file select
    const profileImageInput = document.getElementById('profileImageInput');
    const profileImageSave = document.getElementById('profileImageSave');
    const profileImagePlaceholder = document.getElementById('profileImagePlaceholder');
    let profileImagePreview = document.getElementById('profileImagePreview');

    if (profileImageInput && profileImageSave) {
      profileImageInput.addEventListener('change', function () {
        const file = this.files && this.files[0];
        toggleButtonState(profileImageSave, !!file);
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function (e) {
          if (!profileImagePreview) {
            const container = (profileImagePlaceholder && profileImagePlaceholder.parentElement) || null;
            if (container) {
              // remove placeholder if present
              if (profileImagePlaceholder) {
                profileImagePlaceholder.remove();
              }
              // create preview image
              profileImagePreview = document.createElement('img');
              profileImagePreview.id = 'profileImagePreview';
              profileImagePreview.className = 'card-image';
              container.prepend(profileImagePreview);
            }
          }
          if (profileImagePreview) {
            profileImagePreview.src = e.target.result;
          }
        };
        reader.readAsDataURL(file);
      });
    }

    // Populate Edit What I Do modal
    document.querySelectorAll('.btn-edit-whatido').forEach(btn => {
      btn.addEventListener('click', () => {
        const id = btn.getAttribute('data-id');
        const title = btn.getAttribute('data-title') || '';
        const description = btn.getAttribute('data-description') || '';
        
        document.getElementById('editWhatIDoTitle').value = title;
        document.getElementById('editWhatIDoDescription').value = description;
        document.getElementById('editWhatIDoOriginalTitle').value = title;
        document.getElementById('editWhatIDoOriginalDescription').value = description;
        
        const form = document.getElementById('formEditWhatIDo');
        form.setAttribute('action', `<?= site_url('/settings/what-i-do') ?>/${id}`);
        
        // Reset button state
        toggleButtonState(document.getElementById('editWhatIDoUpdate'), false);
      });
    });

    // Populate Edit Social modal
    document.querySelectorAll('.btn-edit-social').forEach(btn => {
      btn.addEventListener('click', () => {
        const id = btn.getAttribute('data-id');
        const platform = btn.getAttribute('data-platform') || '';
        const url = btn.getAttribute('data-url') || '';
        
        document.getElementById('editSocialMediaPlatform').value = platform;
        document.getElementById('editSocialMediaUrl').value = url;
        document.getElementById('editSocialOriginalPlatform').value = platform;
        document.getElementById('editSocialOriginalUrl').value = url;
        
        const form = document.getElementById('formEditSocial');
        form.setAttribute('action', `<?= site_url('/settings/social-links') ?>/${id}`);
        
        // Reset button state
        toggleButtonState(document.getElementById('editSocialUpdate'), false);
      });
    });

    // Populate Edit Skill modal
    document.querySelectorAll('.btn-edit-skill').forEach(btn => {
      btn.addEventListener('click', () => {
        const id = btn.getAttribute('data-id');
        const name = btn.getAttribute('data-name') || '';
        
        document.getElementById('editSkillName').value = name;
        document.getElementById('editSkillOriginalName').value = name;
        
        const form = document.getElementById('formEditSkill');
        form.setAttribute('action', `<?= site_url('/settings/skills') ?>/${id}`);
        
        // Reset button state
        toggleButtonState(document.getElementById('editSkillUpdate'), false);
      });
    });

    // Reset add modals when they're closed
    const addModalIds = ['whatIDoModal', 'findMeInModal', 'bestAtModal'];
    addModalIds.forEach(modalId => {
      const modal = document.getElementById(modalId);
      if (modal) {
        modal.addEventListener('hidden.bs.modal', function() {
          const form = this.querySelector('form');
          if (form) {
            form.reset();
            const saveButton = form.querySelector('button[type="submit"]');
            if (saveButton) {
              toggleButtonState(saveButton, false);
            }
          }
        });
      }
    });

    // Reset edit modals when they're closed
    const editModalIds = ['editWhatIDoModal', 'editFindMeInModal', 'editBestAtModal'];
    editModalIds.forEach(modalId => {
      const modal = document.getElementById(modalId);
      if (modal) {
        modal.addEventListener('hidden.bs.modal', function() {
          const saveButton = this.querySelector('button[type="submit"]');
          if (saveButton) {
            toggleButtonState(saveButton, false);
          }
        });
      }
    });
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
    border-radius: 12px;
  }

  .profile-card {
    background: linear-gradient(165deg, #17181d, #101114);
    border: 1px solid rgba(70, 120, 240, 0.25);
    transition: all 0.3s ease;
    border-radius: 12px;
    overflow: hidden;
  }

  .profile-card:hover {
    transform: translateY(-4px);
    border-color: rgba(100, 160, 255, 0.6);
    box-shadow: 0 0 18px rgba(65, 145, 255, 0.4);
  }

  /* Beautiful Image Container Styles */
  .image-container {
    height: 160px;
    background: linear-gradient(135deg, #243c6a, #15284f);
    position: relative;
    overflow: hidden;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  }

  .card-image {
    max-height: 100%;
    max-width: 100%;
    object-fit: contain;
    padding: 20px;
    transition: all 0.3s ease;
    filter: brightness(0.9) saturate(1.1);
  }

  .profile-card:hover .card-image {
    transform: scale(1.05);
    filter: brightness(1) saturate(1.2);
  }

  .image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(65, 145, 255, 0.1), rgba(100, 160, 255, 0.05));
    opacity: 0;
    transition: opacity 0.3s ease;
  }

  .profile-card:hover .image-overlay {
    opacity: 1;
  }

  .placeholder-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: rgba(255, 255, 255, 0.7);
    text-align: center;
    padding: 20px;
  }

  .placeholder-content i {
    font-size: 2.5rem;
    margin-bottom: 8px;
    opacity: 0.6;
  }

  /* Different background gradients for different sections */
  .profile-card:nth-child(4n+1) .image-container {
    background: linear-gradient(135deg, #243c6a, #15284f);
  }

  .profile-card:nth-child(4n+2) .image-container {
    background: linear-gradient(135deg, #2d4f7c, #1a3359);
  }

  .profile-card:nth-child(4n+3) .image-container {
    background: linear-gradient(135deg, #1e3a5f, #0f2540);
  }

  .profile-card:nth-child(4n+4) .image-container {
    background: linear-gradient(135deg, #2a5285, #183661);
  }

  .btn-primary {
    background: linear-gradient(135deg, #377aff, #275de6);
    border: none;
  }

  .btn-secondary {
    background: linear-gradient(135deg, #6c757d, #5a6268);
    border: none;
    opacity: 0.6;
    cursor: not-allowed;
  }

  .btn-danger {
    background: linear-gradient(135deg, #ff4b4b, #d63636);
    border: none;
  }

  .btn-success {
    background: linear-gradient(135deg, #3ebd71, #2c954e);
    border: none;
  }

  .btn:hover:not(:disabled) {
    opacity: 0.9;
    transform: translateY(-1px);
  }

  .btn:disabled {
    cursor: not-allowed;
  }

  .custom-input {
    background-color: #15161a;
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: #ffffff;
    border-radius: 8px;
  }

  .custom-input:focus {
    border-color: rgba(65, 145, 255, 0.6);
    box-shadow: 0 0 0 2px rgba(65, 145, 255, 0.3);
    background-color: #18191e;
    outline: none;
    color: #ffffff;
  }

  label {
    color: #c9c9c9;
  }

  /* Modal Styles */
  .custom-modal {
    background: linear-gradient(145deg, #1a1b20, #121317);
    border: 1px solid rgba(100, 100, 120, 0.3);
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.6);
  }

  .modal-header {
    border-color: rgba(100, 100, 120, 0.3) !important;
  }

  .btn-close-white {
    filter: invert(1) grayscale(100%) brightness(200%);
  }

  .form-text {
    font-size: 0.875rem;
  }

  /* Card body improvements */
  .card-body {
    padding: 1.25rem;
  }

  .card-title {
    font-size: 1rem;
    font-weight: 600;
  }

  .card-text {
    line-height: 1.4;
  }
</style>

<?= $this->endSection() ?>