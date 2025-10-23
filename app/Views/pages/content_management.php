<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="container py-4">
  <h1 class="mb-4 text-light fw-bold">Content Management</h1>

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0 text-light">Project</h5>
    <div>
      <button class="btn btn-danger me-2" data-bs-toggle="modal" data-bs-target="#addProjectModal">Add new Project</button>
    </div>
  </div>

  <!-- Project Container -->
  <div class="card custom-container-card rounded-4 p-3 border border-secondary">
    <div class="row g-3">
      <?php if (!empty($projects)): ?>
        <?php foreach ($projects as $proj): ?>
          <div class="col-md-4">
            <div class="card project-card text-light rounded-4 overflow-hidden shadow">
              <div class="position-relative placeholder-box">
                <?php $imgs = $proj['images'] ?? []; $hasImages = !empty($imgs); $carouselId = 'projCarousel' . (int)$proj['id']; ?>
                <?php if ($hasImages): ?>
                  <div id="<?= $carouselId ?>" class="carousel slide h-100" data-bs-ride="carousel">
                    <div class="carousel-inner h-100">
                      <?php foreach ($imgs as $idx => $img): ?>
                        <div class="carousel-item <?= $idx === 0 ? 'active' : '' ?> h-100">
                          <img src="<?= base_url('upload/project/' . ($img['id_or_url'] ?? '')) ?>"
                               class="d-block w-100"
                               alt="<?= htmlspecialchars($img['name_or_alt'] ?? 'Project image') ?>"
                               style="height:100%; object-fit:cover;" />
                        </div>
                      <?php endforeach; ?>
                    </div>
                    <?php if (count($imgs) > 1): ?>
                      <button class="carousel-control-prev" type="button" data-bs-target="#<?= $carouselId ?>" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                      </button>
                      <button class="carousel-control-next" type="button" data-bs-target="#<?= $carouselId ?>" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                      </button>
                    <?php endif; ?>
                  </div>
                <?php else: ?>
                  <div class="position-absolute top-50 start-50 translate-middle text-white fw-semibold opacity-75">NO IMAGE</div>
                <?php endif; ?>
                <?php if ((int)($proj['published'] ?? 0) !== 1): ?>
                  <span class="badge bg-danger position-absolute top-0 start-0 m-2 rounded-pill px-2 py-1">Draft</span>
                <?php endif; ?>
                <?php if ((int)($proj['featured'] ?? 0) === 1): ?>
                  <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-2 rounded-pill px-2 py-1">Featured</span>
                <?php endif; ?>
              </div>

              <div class="card-body">
                <h5 class="card-title mb-1" style="color: #AC274F;"><?= htmlspecialchars($proj['title'] ?? '') ?></h5>
                <p class="card-text text-white-50 small mb-3"><?= htmlspecialchars($proj['description'] ?? '') ?></p>

                <div class="d-flex justify-content-between text-white small mb-3">
                  <span><i class="bi bi-calendar"></i> <?= htmlspecialchars($proj['created_at'] ?? '') ?></span>
                  <span><i class="bi bi-arrow-repeat"></i> <?= htmlspecialchars($proj['updated_at'] ?? '') ?></span>
                </div>

                <div class="d-flex gap-2">
                  <button class="btn btn-sm btn-primary w-50 btn-edit-project" data-bs-toggle="modal" data-bs-target="#editProjectModal"
                          data-id="<?= (int)$proj['id'] ?>"
                          data-title='<?= htmlspecialchars($proj['title'] ?? '', ENT_QUOTES) ?>'
                          data-description='<?= htmlspecialchars($proj['description'] ?? '', ENT_QUOTES) ?>'
                          data-demo='<?= htmlspecialchars($proj['demo_link'] ?? '', ENT_QUOTES) ?>'
                          data-github='<?= htmlspecialchars($proj['github_link'] ?? '', ENT_QUOTES) ?>'
                          data-featured="<?= (int)($proj['featured'] ?? 0) ?>"
                          data-published="<?= (int)($proj['published'] ?? 0) ?>"
                          data-categories='<?= json_encode(array_map(function($c){return $c['id_or_url'];}, $proj['categories'] ?? [])) ?>'
                          data-tags='<?= json_encode(array_map(function($t){return $t['id_or_url'];}, $proj['tags'] ?? [])) ?>'>
                    <i class="bi bi-pencil"></i> Edit
                  </button>
                  <form action="<?= site_url('/projects/' . (int)$proj['id'] . '/delete') ?>" method="post" class="w-50">
                    <button class="btn btn-sm btn-danger w-100 btn-delete"><i class="bi bi-trash"></i> Delete</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12 d-flex align-items-center justify-content-center text-muted" style="min-height: 300px;">
          No projects yet.
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- Add Project Modal -->
<div class="modal fade" id="addProjectModal" tabindex="-1" aria-labelledby="addProjectModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content custom-modal-content rounded-4">
      <div class="modal-header custom-modal-header border-0">
        <h5 class="modal-title text-light fw-bold" id="addProjectModalLabel">Add New Project</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body custom-modal-body">
        <form id="addProjectForm" method="post" action="<?= site_url('/projects') ?>" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="projectTitle" class="form-label text-light">Project Title</label>
            <input type="text" class="form-control custom-input" id="projectTitle" name="title" placeholder="Enter project title" required>
          </div>
          
          <div class="mb-3">
            <label for="projectDescription" class="form-label text-light">Project Description</label>
            <textarea class="form-control custom-textarea" id="projectDescription" name="description" rows="5" placeholder="Enter project description"></textarea>
          </div>
          
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label text-light">Categories</label>
              <div class="custom-checkbox-container">
                <?php if (!empty($categories)): ?>
                  <?php foreach ($categories as $cat): ?>
                    <div class="form-check">
                      <input class="form-check-input custom-checkbox" type="checkbox" value="<?= (int)$cat['id'] ?>" name="category_ids[]" id="category<?= (int)$cat['id'] ?>">
                      <label class="form-check-label text-light" for="category<?= (int)$cat['id'] ?>">
                        <?= htmlspecialchars($cat['name']) ?>
                      </label>
                    </div>
                  <?php endforeach; ?>
                <?php else: ?>
                  <div class="text-white-50 small">No categories found.</div>
                <?php endif; ?>
              </div>
            </div>
            
            <div class="col-md-6">
              <label class="form-label text-light">Tech Stack</label>
              <div class="custom-checkbox-container">
                <?php if (!empty($tags)): ?>
                  <?php foreach ($tags as $tag): ?>
                    <div class="form-check">
                      <input class="form-check-input custom-checkbox" type="checkbox" value="<?= (int)$tag['id'] ?>" name="tag_ids[]" id="tag<?= (int)$tag['id'] ?>">
                      <label class="form-check-label text-light" for="tag<?= (int)$tag['id'] ?>">
                        <?= htmlspecialchars($tag['name']) ?>
                      </label>
                    </div>
                  <?php endforeach; ?>
                <?php else: ?>
                  <div class="text-white-50 small">No tags found.</div>
                <?php endif; ?>
              </div>
            </div>
          </div>
          
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="projectStatus" class="form-label text-light">Status</label>
              <select class="form-select custom-select" id="projectStatus" name="published">
                <option value="0">Draft</option>
                <option value="1">Published</option>
              </select>
            </div>
            <div class="col-md-6">
              <div class="form-check mt-4 pt-2">
                <input class="form-check-input custom-checkbox" type="checkbox" id="featuredProject" name="featured" value="1">
                <label class="form-check-label text-light" for="featuredProject">
                  Featured Project
                </label>
              </div>
            </div>
          </div>
          
          <div class="mb-3">
            <label for="projectImage" class="form-label text-light">Project Images</label>
            <input class="form-control custom-input" type="file" id="projectImage" name="images[]" multiple>
          </div>
        </form>
      </div>
      <div class="modal-footer custom-modal-footer border-0">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" form="addProjectForm" class="btn btn-primary">Save Project</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit Project Modal -->
<div class="modal fade" id="editProjectModal" tabindex="-1" aria-labelledby="editProjectModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content custom-modal-content rounded-4">
      <div class="modal-header custom-modal-header border-0">
        <h5 class="modal-title text-light fw-bold" id="editProjectModalLabel">Edit Project</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body custom-modal-body">
        <form id="editProjectForm" method="post" action="#" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="editProjectTitle" class="form-label text-light">Project Title</label>
            <input type="text" class="form-control custom-input" id="editProjectTitle" name="title">
          </div>
          
          <div class="mb-3">
            <label for="editProjectDescription" class="form-label text-light">Project Description</label>
            <textarea class="form-control custom-textarea" id="editProjectDescription" name="description" rows="5"></textarea>
          </div>
          
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label text-light">Categories</label>
              <div class="custom-checkbox-container">
                <?php if (!empty($categories)): ?>
                  <?php foreach ($categories as $cat): ?>
                    <div class="form-check">
                      <input class="form-check-input custom-checkbox edit-category" type="checkbox" value="<?= (int)$cat['id'] ?>" name="category_ids[]" id="editCategory<?= (int)$cat['id'] ?>">
                      <label class="form-check-label text-light" for="editCategory<?= (int)$cat['id'] ?>">
                        <?= htmlspecialchars($cat['name']) ?>
                      </label>
                    </div>
                  <?php endforeach; ?>
                <?php else: ?>
                  <div class="text-white-50 small">No categories found.</div>
                <?php endif; ?>
              </div>
            </div>
            
            <div class="col-md-6">
              <label class="form-label text-light">Tech Stack</label>
              <div class="custom-checkbox-container">
                <?php if (!empty($tags)): ?>
                  <?php foreach ($tags as $tag): ?>
                    <div class="form-check">
                      <input class="form-check-input custom-checkbox edit-tag" type="checkbox" value="<?= (int)$tag['id'] ?>" name="tag_ids[]" id="editTag<?= (int)$tag['id'] ?>">
                      <label class="form-check-label text-light" for="editTag<?= (int)$tag['id'] ?>">
                        <?= htmlspecialchars($tag['name']) ?>
                      </label>
                    </div>
                  <?php endforeach; ?>
                <?php else: ?>
                  <div class="text-white-50 small">No tags found.</div>
                <?php endif; ?>
              </div>
            </div>
          </div>
          
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="editProjectStatus" class="form-label text-light">Status</label>
              <select class="form-select custom-select" id="editProjectStatus" name="published">
                <option value="0">Draft</option>
                <option value="1">Published</option>
              </select>
            </div>
            <div class="col-md-6">
              <div class="form-check mt-4 pt-2">
                <input class="form-check-input custom-checkbox" type="checkbox" id="editFeaturedProject" name="featured" value="1">
                <label class="form-check-label text-light" for="editFeaturedProject">
                  Featured Project
                </label>
              </div>
            </div>
          </div>
          
          <div class="mb-3">
            <label for="editProjectImage" class="form-label text-light">Project Image</label>
            <input class="form-control custom-input" type="file" id="editProjectImage" name="images[]" multiple>
          </div>
        </form>
      </div>
      <div class="modal-footer custom-modal-footer border-0">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" form="editProjectForm" class="btn btn-primary">Update Project</button>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Delete confirmation
    document.querySelectorAll('.btn-delete').forEach(btn => {
      btn.addEventListener('click', function(e){
        if(!confirm('Delete this project? This cannot be undone.')){
          e.preventDefault();
        }
      });
    });

    // Populate Edit Project modal
    document.querySelectorAll('.btn-edit-project').forEach(btn => {
      btn.addEventListener('click', function(){
        const id = this.getAttribute('data-id');
        const title = this.getAttribute('data-title') || '';
        const description = this.getAttribute('data-description') || '';
        const demo = this.getAttribute('data-demo') || '';
        const github = this.getAttribute('data-github') || '';
        const featured = parseInt(this.getAttribute('data-featured') || '0');
        const published = parseInt(this.getAttribute('data-published') || '0');
        const categories = JSON.parse(this.getAttribute('data-categories') || '[]');
        const tags = JSON.parse(this.getAttribute('data-tags') || '[]');

        document.getElementById('editProjectTitle').value = title;
        document.getElementById('editProjectDescription').value = description;
        document.getElementById('editProjectStatus').value = published;
        document.getElementById('editFeaturedProject').checked = featured === 1;

        // Optional links
        // Create or ensure inputs exist
        let demoInput = document.getElementById('editProjectDemo');
        if (!demoInput) {
          demoInput = document.createElement('input');
          demoInput.type = 'url';
          demoInput.className = 'form-control custom-input mt-2';
          demoInput.id = 'editProjectDemo';
          demoInput.name = 'demo_link';
          document.getElementById('editProjectForm').insertBefore(demoInput, document.getElementById('editProjectForm').firstChild.nextSibling.nextSibling);
        }
        demoInput.placeholder = 'Demo link (optional)';
        demoInput.value = demo;

        let ghInput = document.getElementById('editProjectGithub');
        if (!ghInput) {
          ghInput = document.createElement('input');
          ghInput.type = 'url';
          ghInput.className = 'form-control custom-input mt-2';
          ghInput.id = 'editProjectGithub';
          ghInput.name = 'github_link';
          document.getElementById('editProjectForm').insertBefore(ghInput, document.getElementById('editProjectForm').firstChild.nextSibling.nextSibling);
        }
        ghInput.placeholder = 'GitHub link (optional)';
        ghInput.value = github;

        // Clear checks then re-check
        document.querySelectorAll('.edit-category').forEach(cb => cb.checked = false);
        categories.forEach(cid => {
          const cb = document.getElementById('editCategory' + cid);
          if (cb) cb.checked = true;
        });
        document.querySelectorAll('.edit-tag').forEach(cb => cb.checked = false);
        tags.forEach(tid => {
          const cb = document.getElementById('editTag' + tid);
          if (cb) cb.checked = true;
        });

        // Set form action
        document.getElementById('editProjectForm').setAttribute('action', `<?= site_url('/projects') ?>/${id}`);
      });
    });
  });
</script>

<style>
  body {
    background-color: #0c0e12; /* deep neutral charcoal */
    color: #e0e0e0;
  }

  /* Main project container */
  .custom-container-card {
    background: linear-gradient(145deg, #1a1b20, #121317); /* subtle depth shading */
    border: 1px solid rgba(100, 100, 120, 0.3);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.6);
  }

  /* Project card */
  .project-card {
    background: linear-gradient(165deg, #17181d, #101114);
    border: 1px solid rgba(70, 120, 240, 0.25);
    transition: all 0.3s ease;
  }

  .project-card:hover {
    transform: translateY(-4px);
    border-color: rgba(100, 160, 255, 0.6);
    box-shadow: 0 0 18px rgba(65, 145, 255, 0.4);
  }

  /* Placeholder area */
  .placeholder-box {
    background: linear-gradient(180deg, #2b4e8c, #20396d);
    height: 200px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  }

  /* Text styling */
  .card-text,
  .card-body span,
  .card-body p {
    color: #d6d6d6;
  }

  .card-title {
    color: #e84a6b; /* elegant magenta accent */
    font-weight: 600;
  }

  /* Buttons refinement */
  .btn-primary {
    background: linear-gradient(135deg, #377aff, #275de6);
    border: none;
  }

  .btn-danger {
    background: linear-gradient(135deg, #ff4b4b, #d63636);
    border: none;
  }

  .btn-success {
    background: linear-gradient(135deg, #3ebd71, #2c954e);
    border: none;
  }

  .btn:hover {
    opacity: 0.9;
  }

  /* Subtle rounded and soft edges */
  .card, .custom-container-card {
    border-radius: 12px;
  }

  /* Badges */
  .badge {
    font-size: 0.75rem;
    box-shadow: 0 0 6px rgba(0, 0, 0, 0.3);
  }

  /* Modal Styling */
  .custom-modal-content {
    background: linear-gradient(145deg, #1a1b20, #121317);
    border: 1px solid rgba(100, 100, 120, 0.3);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.7);
  }

  .custom-modal-header {
    background: linear-gradient(165deg, #17181d, #101114);
    border-radius: 12px 12px 0 0 !important;
    padding: 1.5rem;
  }

  .custom-modal-body {
    padding: 1.5rem;
    max-height: 70vh;
    overflow-y: auto;
  }

  .custom-modal-footer {
    background: linear-gradient(165deg, #17181d, #101114);
    border-radius: 0 0 12px 12px !important;
    padding: 1.5rem;
  }

  /* Form Controls */
  .custom-input, .custom-select, .custom-textarea {
    background: rgba(30, 30, 40, 0.7);
    border: 1px solid rgba(100, 100, 120, 0.4);
    color: #e0e0e0;
    border-radius: 8px;
  }

  .custom-input:focus, .custom-select:focus, .custom-textarea:focus {
    background: rgba(40, 40, 50, 0.8);
    border-color: rgba(70, 120, 240, 0.6);
    color: #ffffff;
    box-shadow: 0 0 0 0.2rem rgba(70, 120, 240, 0.25);
  }

  .custom-textarea {
    resize: vertical;
    min-height: 120px;
  }

  /* Checkbox Styling */
  .custom-checkbox-container {
    background: rgba(30, 30, 40, 0.5);
    border-radius: 8px;
    padding: 1rem;
    max-height: 180px;
    overflow-y: auto;
  }

  .custom-checkbox {
    background-color: rgba(50, 50, 60, 0.7);
    border: 1px solid rgba(100, 100, 120, 0.4);
  }

  .custom-checkbox:checked {
    background-color: #377aff;
    border-color: #377aff;
  }

  .form-check-label {
    margin-left: 8px;
  }

  /* Scrollbar Styling */
  .custom-checkbox-container::-webkit-scrollbar {
    width: 6px;
  }

  .custom-checkbox-container::-webkit-scrollbar-track {
    background: rgba(30, 30, 40, 0.5);
    border-radius: 3px;
  }

  .custom-checkbox-container::-webkit-scrollbar-thumb {
    background: rgba(100, 100, 120, 0.5);
    border-radius: 3px;
  }

  .custom-checkbox-container::-webkit-scrollbar-thumb:hover {
    background: rgba(120, 120, 140, 0.7);
  }
</style>

<?= $this->endSection() ?>