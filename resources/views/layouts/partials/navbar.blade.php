<style>
  .navbar {
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  }

  .navbar-brand {
    letter-spacing: 3px;
    color: #c24244;
  }

  .navbar-brand:hover {
    color: #c24244;
  }

  .navbar-scroll .nav-link,
  .navbar-scroll .fa-bars {
    color: #7f4722;
  }

  .navbar-scrolled .nav-link,
  .navbar-scrolled .fa-bars {
    color: #7f4722;
  }

  .navbar-scrolled {
    background-color: #ffede7;
  }

  /* Show dropdown on hover */
  .navbar-nav .dropdown:hover>.dropdown-menu {
    display: block;
    margin-top: 0;
    /* remove gap */
  }
</style>

<nav class="navbar navbar-expand-lg fixed-top navbar-scroll shadow-0" style=" width:100%;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">ClaimEase</a>

    <button class="navbar-toggler ps-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarExample01"
      aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="d-flex justify-content-start align-items-center">
        <i class="fas fa-bars"></i>
      </span>
    </button>

    <div class="collapse navbar-collapse" id="navbarExample01">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <!-- Shop Online -->
        <li class="nav-item dropdown">
          <a class="nav-link  px-3" href="#" id="dashboard" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">Dashboard</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link  px-3" href="#" id="patients" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">Patients</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link  px-3" href="#" id="claims" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">Claims</a>
        </li>

        <!-- New Collection -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle px-3" href="#" id="newDropdown" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">Payments</a>
          <ul class="dropdown-menu" aria-labelledby="newDropdown">
            <li><a class="dropdown-item" href="#">Insurance Payouts</a></li>
            <li><a class="dropdown-item" href="#">Patient Payments</a></li>
            <li><a class="dropdown-item" href="#">Capitation Payments</a></li>
            <li><a class="dropdown-item" href="#">Provider Write-Offs</a></li>
          </ul>
        </li>

        <!-- About Us -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle px-3" href="#" id="aboutDropdown" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">Reports</a>
          <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
            <li><a class="dropdown-item" href="#">Inventory Reports</a></li>
            <li><a class="dropdown-item" href="#">Claims Reports</a></li>
            <li><a class="dropdown-item" href="#">Patient Reports</a></li>
            <li><a class="dropdown-item" href="#">Aging Reports</a></li>
            <li><a class="dropdown-item" href="#">Payer Reports</a></li>
            <li><a class="dropdown-item" href="#">Payment Reports</a></li>
            <li><a class="dropdown-item" href="#">Management Reports</a></li>
            <li><a class="dropdown-item" href="#">Timely Reports</a></li>
            <li><a class="dropdown-item" href="#">Collection Reports</a></li>
            <li><a class="dropdown-item" href="#">Billing Reports</a></li>
          </ul>
        </li>

        <!-- Collaboration -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle px-3" href="#" id="collabDropdown" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">Settings</a>
          <ul class="dropdown-menu" aria-labelledby="collabDropdown">
            <li><a class="dropdown-item" href="#">Practice Setup</a></li>
            <li><a class="dropdown-item" href="#">Provider Setup</a></li>
            <li><a class="dropdown-item" href="#">Payer Setup</a></li>
            <li><a class="dropdown-item" href="#">Practice Preferences</a></li>
            <li><a class="dropdown-item" href="#">DX/ICD Setup</a></li>
            <li><a class="dropdown-item" href="#">Interface Setup</a></li>
            <li><a class="dropdown-item" href="#">Statement Setup</a></li>
            <li><a class="dropdown-item" href="#">User Setup</a></li>
            <li><a class="dropdown-item" href="#">Administration</a></li>
            <li><a class="dropdown-item" href="#">Print Setup</a></li>
          </ul>
        </li>
      </ul>

      <!-- Profile & Logout -->
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="btn btn-sm btn-outline-secondary me-2" href="#profile">Profile</a>
        </li>
        <li class="nav-item">
          <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="btn btn-sm btn-danger">Logout</button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</nav>