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
      <!-- Dummy Category Card 1 -->
      <div class="col-md-3">
        <div class="card profile-card text-light rounded-4 overflow-hidden shadow-sm p-3">
          <h6 class="fw-semibold text-light mb-1">Frontend</h6>
          <p class="text-white-50 small mb-3">JavaScript, CSS, HTML</p>
          <button class="btn btn-danger w-100">Delete</button>
        </div>
      </div>

      <!-- Dummy Category Card 2 -->
      <div class="col-md-3">
        <div class="card profile-card text-light rounded-4 overflow-hidden shadow-sm p-3">
          <h6 class="fw-semibold text-light mb-1">Backend</h6>
          <p class="text-white-50 small mb-3">Node.js, PHP, SQL</p>
          <button class="btn btn-danger w-100">Delete</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Tech Stack Section -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0 text-light">Tech Stack</h5>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#techStackModal">Add New Tech Stack</button>
  </div>

  <div class="card custom-container-card rounded-4 p-3 border border-secondary">
    <div class="row g-3">
      <!-- Dummy Tech Stack Card -->
      <div class="col-md-4">
        <div class="card tech-card text-light rounded-4 overflow-hidden shadow">
          <div class="card-body">
            <h6 class="card-title mb-1">ReactJS</h6>
            <p class="card-text text-white-50 small mb-3">A JavaScript library for building UIs.</p>
            <button class="btn btn-danger w-100">Delete</button>
          </div>
        </div>
      </div>
    </div>
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
        <form>
          <div class="mb-3">
            <label for="categoryName" class="form-label text-light">Category Name</label>
            <input type="text" class="form-control custom-input" id="categoryName" placeholder="Enter category name">
          </div>
          <div class="mb-3">
            <label for="categoryDescription" class="form-label text-light">Description</label>
            <textarea class="form-control custom-input" id="categoryDescription" rows="3" placeholder="Enter category description"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer border-secondary">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save Category</button>
      </div>
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
        <form>
          <div class="mb-3">
            <label for="techName" class="form-label text-light">Technology Name</label>
            <input type="text" class="form-control custom-input" id="techName" placeholder="Enter technology name">
          </div>
          <div class="mb-3">
            <label for="techDescription" class="form-label text-light">Description</label>
            <textarea class="form-control custom-input" id="techDescription" rows="3" placeholder="Enter technology description"></textarea>
          </div>
          <div class="mb-3">
            <label for="techCategory" class="form-label text-light">Category</label>
            <select class="form-select custom-input" id="techCategory">
              <option selected>Select a category</option>
              <option value="1">Frontend</option>
              <option value="2">Backend</option>
              <option value="3">Database</option>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer border-secondary">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save Tech Stack</button>
      </div>
    </div>
  </div>
</div>

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

  .profile-card {
    background: linear-gradient(165deg, #17181d, #101114);
    border: 1px solid rgba(70, 120, 240, 0.25);
    transition: all 0.3s ease;
  }

  .profile-card:hover {
    transform: translateY(-4px);
    border-color: rgba(100, 160, 255, 0.6);
    box-shadow: 0 0 18px rgba(65, 145, 255, 0.4);
  }

  .tech-card {
    background: linear-gradient(165deg, #17181d, #101114);
    border: 1px solid rgba(70, 120, 240, 0.25);
    transition: all 0.3s ease;
  }

  .tech-card:hover {
    transform: translateY(-4px);
    border-color: rgba(100, 160, 255, 0.6);
    box-shadow: 0 0 18px rgba(65, 145, 255, 0.4);
  }

  .btn-primary {
    background: linear-gradient(135deg, #377aff, #275de6);
    border: none;
  }

  .btn-danger {
    background: linear-gradient(135deg, #ff4b4b, #d63636);
    border: none;
  }

  .btn:hover {
    opacity: 0.9;
  }

  .card,
  .custom-container-card {
    border-radius: 12px;
  }

  h6.text-light {
    color: #e84a6b !important;
  }

  /* Modal Styling */
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

  .form-select.custom-input:focus {
    background-color: #17181d;
    color: #e0e0e0;
  }

  .modal-header, .modal-footer {
    border-color: rgba(100, 100, 120, 0.3) !important;
  }

  .btn-close-white {
    filter: invert(1) grayscale(100%) brightness(200%);
  }
</style>

<?= $this->endSection() ?>