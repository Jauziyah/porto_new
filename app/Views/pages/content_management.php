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
      <!-- 1st Dummy Card -->
      <div class="col-md-4">
        <div class="card project-card text-light rounded-4 overflow-hidden shadow">
          <!-- Placeholder "image" -->
          <div class="position-relative placeholder-box">
            <div class="position-absolute top-50 start-50 translate-middle text-white fw-semibold opacity-75">
              PLACEHOLDER
            </div>
            <span class="badge bg-danger position-absolute top-0 start-0 m-2 rounded-pill px-2 py-1">Draft</span>
            <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-2 rounded-pill px-2 py-1">Featured</span>
          </div>

          <div class="card-body">
            <h5 class="card-title mb-1" style="color: #AC274F;">Etwas</h5>
            <p class="card-text text-white-50 small mb-3">Sample description text.</p>

            <div class="d-flex justify-content-between text-white small mb-3">
              <span><i class="bi bi-calendar"></i> Oct 13, 2025</span>
              <span><i class="bi bi-arrow-repeat"></i> Oct 13, 2025</span>
            </div>

            <div class="d-flex gap-2">
              <button class="btn btn-sm btn-primary w-50" data-bs-toggle="modal" data-bs-target="#editProjectModal"><i class="bi bi-pencil"></i> Edit</button>
              <button class="btn btn-sm btn-danger w-50"><i class="bi bi-trash"></i> Delete</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Empty layout placeholder -->
      <div class="col-md-8 d-flex align-items-center justify-content-center text-muted" style="min-height: 300px;">
      </div>
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
        <form id="addProjectForm">
          <div class="mb-3">
            <label for="projectTitle" class="form-label text-light">Project Title</label>
            <input type="text" class="form-control custom-input" id="projectTitle" placeholder="Enter project title">
          </div>
          
          <div class="mb-3">
            <label for="projectDescription" class="form-label text-light">Project Description</label>
            <textarea class="form-control custom-textarea" id="projectDescription" rows="5" placeholder="Enter project description"></textarea>
          </div>
          
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label text-light">Categories</label>
              <div class="custom-checkbox-container">
                <div class="form-check">
                  <input class="form-check-input custom-checkbox" type="checkbox" value="" id="category1">
                  <label class="form-check-label text-light" for="category1">
                    Web Development
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input custom-checkbox" type="checkbox" value="" id="category2">
                  <label class="form-check-label text-light" for="category2">
                    Mobile App
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input custom-checkbox" type="checkbox" value="" id="category3">
                  <label class="form-check-label text-light" for="category3">
                    UI/UX Design
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input custom-checkbox" type="checkbox" value="" id="category4">
                  <label class="form-check-label text-light" for="category4">
                    E-commerce
                  </label>
                </div>
              </div>
            </div>
            
            <div class="col-md-6">
              <label class="form-label text-light">Tags</label>
              <div class="custom-checkbox-container">
                <div class="form-check">
                  <input class="form-check-input custom-checkbox" type="checkbox" value="" id="tag1">
                  <label class="form-check-label text-light" for="tag1">
                    JavaScript
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input custom-checkbox" type="checkbox" value="" id="tag2">
                  <label class="form-check-label text-light" for="tag2">
                    React
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input custom-checkbox" type="checkbox" value="" id="tag3">
                  <label class="form-check-label text-light" for="tag3">
                    Bootstrap
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input custom-checkbox" type="checkbox" value="" id="tag4">
                  <label class="form-check-label text-light" for="tag4">
                    API Integration
                  </label>
                </div>
              </div>
            </div>
          </div>
          
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="projectStatus" class="form-label text-light">Status</label>
              <select class="form-select custom-select" id="projectStatus">
                <option selected>Select status</option>
                <option value="draft">Draft</option>
                <option value="published">Published</option>
                <option value="archived">Archived</option>
              </select>
            </div>
            <div class="col-md-6">
              <div class="form-check mt-4 pt-2">
                <input class="form-check-input custom-checkbox" type="checkbox" id="featuredProject">
                <label class="form-check-label text-light" for="featuredProject">
                  Featured Project
                </label>
              </div>
            </div>
          </div>
          
          <div class="mb-3">
            <label for="projectImage" class="form-label text-light">Project Image</label>
            <input class="form-control custom-input" type="file" id="projectImage">
          </div>
        </form>
      </div>
      <div class="modal-footer custom-modal-footer border-0">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Save Project</button>
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
        <form id="editProjectForm">
          <div class="mb-3">
            <label for="editProjectTitle" class="form-label text-light">Project Title</label>
            <input type="text" class="form-control custom-input" id="editProjectTitle" value="Etwas">
          </div>
          
          <div class="mb-3">
            <label for="editProjectDescription" class="form-label text-light">Project Description</label>
            <textarea class="form-control custom-textarea" id="editProjectDescription" rows="5">Sample description text.</textarea>
          </div>
          
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label text-light">Categories</label>
              <div class="custom-checkbox-container">
                <div class="form-check">
                  <input class="form-check-input custom-checkbox" type="checkbox" value="" id="editCategory1" checked>
                  <label class="form-check-label text-light" for="editCategory1">
                    Web Development
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input custom-checkbox" type="checkbox" value="" id="editCategory2">
                  <label class="form-check-label text-light" for="editCategory2">
                    Mobile App
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input custom-checkbox" type="checkbox" value="" id="editCategory3">
                  <label class="form-check-label text-light" for="editCategory3">
                    UI/UX Design
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input custom-checkbox" type="checkbox" value="" id="editCategory4">
                  <label class="form-check-label text-light" for="editCategory4">
                    E-commerce
                  </label>
                </div>
              </div>
            </div>
            
            <div class="col-md-6">
              <label class="form-label text-light">Tags</label>
              <div class="custom-checkbox-container">
                <div class="form-check">
                  <input class="form-check-input custom-checkbox" type="checkbox" value="" id="editTag1" checked>
                  <label class="form-check-label text-light" for="editTag1">
                    JavaScript
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input custom-checkbox" type="checkbox" value="" id="editTag2">
                  <label class="form-check-label text-light" for="editTag2">
                    React
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input custom-checkbox" type="checkbox" value="" id="editTag3" checked>
                  <label class="form-check-label text-light" for="editTag3">
                    Bootstrap
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input custom-checkbox" type="checkbox" value="" id="editTag4">
                  <label class="form-check-label text-light" for="editTag4">
                    API Integration
                  </label>
                </div>
              </div>
            </div>
          </div>
          
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="editProjectStatus" class="form-label text-light">Status</label>
              <select class="form-select custom-select" id="editProjectStatus">
                <option value="draft" selected>Draft</option>
                <option value="published">Published</option>
                <option value="archived">Archived</option>
              </select>
            </div>
            <div class="col-md-6">
              <div class="form-check mt-4 pt-2">
                <input class="form-check-input custom-checkbox" type="checkbox" id="editFeaturedProject" checked>
                <label class="form-check-label text-light" for="editFeaturedProject">
                  Featured Project
                </label>
              </div>
            </div>
          </div>
          
          <div class="mb-3">
            <label for="editProjectImage" class="form-label text-light">Project Image</label>
            <input class="form-control custom-input" type="file" id="editProjectImage">
          </div>
        </form>
      </div>
      <div class="modal-footer custom-modal-footer border-0">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Update Project</button>
      </div>
    </div>
  </div>
</div>

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