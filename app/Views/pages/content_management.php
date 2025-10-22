<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="container py-4">
  <h1 class="mb-4 text-light fw-bold">Content Management</h1>

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0 text-light">Project</h5>
    <div>
      <button class="btn btn-danger me-2">Add Project</button>
      <button class="btn btn-primary me-2">Add Category</button>
      <button class="btn btn-success">Add Tag</button>
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
              <button class="btn btn-sm btn-primary w-50"><i class="bi bi-pencil"></i> Edit</button>
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
</style>

<?= $this->endSection() ?>