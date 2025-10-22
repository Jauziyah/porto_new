<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="container py-4">
  <h1 class="mb-4 text-light fw-bold">Profile Management</h1>

  <!-- Tags Section -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0 text-light">Tags</h5>
    <button class="btn btn-primary">Add New Tag</button>
  </div>

  <div class="card custom-container-card rounded-4 p-3 border border-secondary mb-4">
    <div class="row g-3">
      <!-- Dummy Tag Card 1 -->
      <div class="col-md-3">
        <div class="card profile-card text-light rounded-4 overflow-hidden shadow-sm p-3">
          <h6 class="fw-semibold text-light mb-1">Frontend</h6>
          <p class="text-white-50 small mb-3">JavaScript, CSS, HTML</p>
          <button class="btn btn-danger w-100">Delete</button>
        </div>
      </div>

      <!-- Dummy Tag Card 2 -->
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
    <h5 class="mb-0 text-light">Tech Stack/Category</h5>
    <button class="btn btn-primary">Add New Tech Stack/Category</button>
  </div>

  <div class="card custom-container-card rounded-4 p-3 border border-secondary">
    <div class="row g-3">
      <!-- Dummy Tech Stack Card -->
      <div class="col-md-4">
        <div class="card tech-card text-light rounded-4 overflow-hidden shadow">
          <div class="tech-image placeholder-box position-relative">
            <div class="position-absolute top-50 start-50 translate-middle opacity-75 text-white fw-semibold">
              IMAGE
            </div>
          </div>
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

  .placeholder-box {
    background: linear-gradient(180deg, #243c6a, #15284f);
    height: 150px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
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
</style>

<?= $this->endSection() ?>