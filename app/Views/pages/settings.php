<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="container py-4">
  <h1 class="mb-4 text-light fw-bold">Settings</h1>

  <!-- What I Do Section -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="text-light mb-0">What I Do (Profile Metadata)</h5>
    <button class="btn btn-primary">Add New</button>
  </div>

  <div class="card custom-container-card rounded-4 p-3 border border-secondary mb-4">
    <div class="row g-3">
      <div class="col-md-3">
        <div class="card profile-card text-light rounded-4 overflow-hidden shadow">
          <div class="placeholder-box position-relative">
            <div class="position-absolute top-50 start-50 translate-middle fw-semibold opacity-75 text-white">
              IMAGE
            </div>
          </div>
          <div class="card-body">
            <h6 class="card-title mb-1">Projekt B</h6>
            <p class="card-text text-white-50 small mb-3">
              Responsive web app for managing clients and invoices.
            </p>
            <div class="d-flex gap-2">
              <button class="btn btn-primary w-50">Edit</button>
              <button class="btn btn-danger w-50">Delete</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Other Settings Section -->
  <h5 class="text-light mb-3">Other Settings</h5>

  <div class="card custom-container-card rounded-4 p-4 border border-secondary mb-4">
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label text-white-50 small">Hallo, Ich bin</label>
        <div class="d-flex gap-2">
          <input type="text" class="form-control custom-input" value="Hallo, Ich bin Maulana">
          <button class="btn btn-success">Save</button>
        </div>
      </div>

      <div class="col-md-6">
        <label class="form-label text-white-50 small">Name</label>
        <div class="d-flex gap-2">
          <input type="text" class="form-control custom-input" value="MAULANA EL JAUZIYAH AL-GHANI">
          <button class="btn btn-success">Save</button>
        </div>
      </div>

      <div class="col-md-6">
        <label class="form-label text-white-50 small">Title</label>
        <div class="d-flex gap-2">
          <input type="text" class="form-control custom-input" value="Junior PHP Developer">
          <button class="btn btn-success">Save</button>
        </div>
      </div>

      <div class="col-12">
        <label class="form-label text-white-50 small">Hero Section Profile</label>
        <div class="d-flex gap-2">
          <input type="text" class="form-control custom-input" value="Lorem ipsum dolor sit amet...">
          <button class="btn btn-success">Save</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Find Me In Section -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="text-light mb-0">Find Me In</h5>
    <button class="btn btn-primary">Add New</button>
  </div>

  <div class="card custom-container-card rounded-4 p-3 border border-secondary mb-4">
    <div class="row g-3">
      <div class="col-md-3">
        <div class="card profile-card text-light rounded-4 overflow-hidden shadow">
          <div class="placeholder-box">
            <div class="position-absolute top-50 start-50 translate-middle text-white fw-semibold opacity-75">
              IMAGE
            </div>
          </div>
          <div class="card-body">
            <h6 class="fw-semibold mb-1 text-light">Instagram</h6>
            <p class="text-white-50 small mb-3">https://instagram.com/username</p>
            <div class="d-flex gap-2">
              <button class="btn btn-primary w-50">Edit</button>
              <button class="btn btn-danger w-50">Delete</button>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card profile-card text-light rounded-4 overflow-hidden shadow">
          <div class="placeholder-box">
            <div class="position-absolute top-50 start-50 translate-middle text-white fw-semibold opacity-75">
              IMAGE
            </div>
          </div>
          <div class="card-body">
            <h6 class="fw-semibold mb-1 text-light">LinkedIn</h6>
            <p class="text-white-50 small mb-3">https://linkedin.com/in/username</p>
            <div class="d-flex gap-2">
              <button class="btn btn-primary w-50">Edit</button>
              <button class="btn btn-danger w-50">Delete</button>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card profile-card text-light rounded-4 overflow-hidden shadow">
          <div class="placeholder-box">
            <div class="position-absolute top-50 start-50 translate-middle text-white fw-semibold opacity-75">
              IMAGE
            </div>
          </div>
          <div class="card-body">
            <h6 class="fw-semibold mb-1 text-light">GitHub</h6>
            <p class="text-white-50 small mb-3">https://github.com/username</p>
            <div class="d-flex gap-2">
              <button class="btn btn-primary w-50">Edit</button>
              <button class="btn btn-danger w-50">Delete</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Best At Section -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="text-light mb-0">Best At</h5>
    <button class="btn btn-primary">Add New</button>
  </div>

  <div class="card custom-container-card rounded-4 p-3 border border-secondary">
    <div class="row g-3">
      <div class="col-md-3">
        <div class="card profile-card text-light rounded-4 overflow-hidden shadow">
          <div class="placeholder-box">
            <div class="position-absolute top-50 start-50 translate-middle text-white fw-semibold opacity-75">
              IMAGE
            </div>
          </div>
          <div class="card-body">
            <h6 class="fw-semibold mb-1 text-light">CodeIgniter</h6>
            <p class="text-white-50 small mb-3">PHP Framework</p>
            <div class="d-flex gap-2">
              <button class="btn btn-primary w-50">Edit</button>
              <button class="btn btn-danger w-50">Delete</button>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card profile-card text-light rounded-4 overflow-hidden shadow">
          <div class="placeholder-box">
            <div class="position-absolute top-50 start-50 translate-middle text-white fw-semibold opacity-75">
              IMAGE
            </div>
          </div>
          <div class="card-body">
            <h6 class="fw-semibold mb-1 text-light">MySQL</h6>
            <p class="text-white-50 small mb-3">Database System</p>
            <div class="d-flex gap-2">
              <button class="btn btn-primary w-50">Edit</button>
              <button class="btn btn-danger w-50">Delete</button>
            </div>
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
    border-radius: 12px;
  }

  .profile-card {
    background: linear-gradient(165deg, #17181d, #101114);
    border: 1px solid rgba(70, 120, 240, 0.25);
    transition: all 0.3s ease;
    border-radius: 12px;
  }

  .profile-card:hover {
    transform: translateY(-4px);
    border-color: rgba(100, 160, 255, 0.6);
    box-shadow: 0 0 18px rgba(65, 145, 255, 0.4);
  }

  .placeholder-box {
    background: linear-gradient(180deg, #243c6a, #15284f);
    height: 150px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    position: relative;
  }

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
</style>

<?= $this->endSection() ?>