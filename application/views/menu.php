<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link <?php if($this->uri->segment(1)=="" || $this->uri->segment(1)=="dashboard"){echo "active";}?>" aria-current="page" href="<?= site_url("dashboard"); ?>">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if($this->uri->segment(1)=="pasien"){echo "active";}?>" href="<?= site_url("pasien"); ?>">
              <span data-feather="user-plus"></span>
              Pasien
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if($this->uri->segment(1)=="petugas"){echo "active";}?>" href="<?= site_url("petugas"); ?>">
              <span data-feather="users"></span>
              Petugas
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if($this->uri->segment(1)=="obat"){echo "active";}?>" href="<?= site_url("obat"); ?>">
              <span data-feather="thermometer"></span>
              Obat
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if($this->uri->segment(1)=="aset"){echo "active";}?>" href="<?= site_url("aset"); ?>">
              <span data-feather="bar-chart-2"></span>
              Aset
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if($this->uri->segment(1)=="bpjs"){echo "active";}?>" href="<?= site_url("bpjs"); ?>">
              <span data-feather="layers"></span>
              BPJS
            </a>
          </li>
        </ul>

      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      