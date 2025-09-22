<style>
  .navbar {
    font-family: "Segoe UI", Tahoma, Verdana, Arial, sans-serif;
    font-weight: 700;
    /* bold */
    font-size: 16px;
    /* adjust as needed */
    line-height: 1;
    /* tighter like UI text */
    letter-spacing: 1px;
    /* slight spacing between letters */
    text-transform: none;
    /* keep Title Case; use uppercase if desired */
    color: #57564F;
    /* change to match your background */
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-rendering: optimizeLegibility;
    display: inline-block;
    padding: 6px 10px;
    /* spacing around text */
    margin: 0 6px;
    cursor: pointer;
  }

  .navbar .nav-link:hover {
    color: #57564F !important;
  }

  .dropdown-menu .dropdown-item:hover {
    background-color: #d3fbff;
    /* match navbar background */
    color: #57564F !important;
  }

  .navbar-brand {
    letter-spacing: 3px;
    color: #00A6D9;
  }

  .navbar-brand:hover {
    color: #57564F;
  }

  .nav-item:hover {
    color: #57564F;
  }

  .navbar-scroll .nav-link,
  .navbar-scroll .fa-bars {
    color: #00A6D9;
  }

  .navbar-scrolled .nav-link,
  .navbar-scrolled .fa-bars {
    color: #57564F;
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
<?php

use Illuminate\Support\Facades\Auth;
use App\Models\User;

$uid = Auth::user()->id;
$user = User::where('id', $uid)->first();
$fname = $user['first_name'];
$lname = isset($user['first_name']) ? $user['first_name'] : '';
$userName = $fname . ' ' . $lname;
?>
<nav class="navbar navbar-expand-lg fixed-top navbar-scroll" style="background-color:#d3fbff; width:100%;">
  <div class="container-fluid">
    <a class="navbar-brand" href="/admin-dashboard"> <img src="{{ asset('/assets/auth/claimease.jpg') }}" style="height: 50px; width: 100px;" alt="logo"></a>

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
          <a class="nav-link  px-3" href="/admin-dashboard">Dashboard</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link  px-3" href="/patients">Patients</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link  px-3" href="/claims">Claims</a>
        </li>

        <!-- New Collection -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle px-3" href="#" id="newDropdown" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">Payments</a>
          <ul class="dropdown-menu" aria-labelledby="newDropdown">
            <li><a class="dropdown-item" href="/insurance-payouts">Insurance Payouts</a></li>
            <li><a class="dropdown-item" href="/patient-payments">Patient Payments</a></li>
            <li><a class="dropdown-item" href="/capitation-payments">Capitation Payments</a></li>
            <li><a class="dropdown-item" href="/provider-writeoffs">Provider Write-Offs</a></li>
          </ul>
        </li>

        <!-- About Us -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle px-3" href="#" id="aboutDropdown" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">Reports</a>
          <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
            <li><a class="dropdown-item" href="/inventory-reports">Inventory Reports</a></li>
            <li><a class="dropdown-item" href="/claim-reports">Claims Reports</a></li>
            <li><a class="dropdown-item" href="/patient-reports">Patient Reports</a></li>
            <li><a class="dropdown-item" href="/aging-reports">Aging Reports</a></li>
            <li><a class="dropdown-item" href="/payer-reports">Payer Reports</a></li>
            <li><a class="dropdown-item" href="/payments-reports">Payment Reports</a></li>
            <li><a class="dropdown-item" href="/management-reports">Management Reports</a></li>
            <li><a class="dropdown-item" href="/timely-reports">Timely Reports</a></li>
            <li><a class="dropdown-item" href="/collection-reports">Collection Reports</a></li>
            <li><a class="dropdown-item" href="/billing-reports">Billing Reports</a></li>
          </ul>
        </li>

        <!-- Collaboration -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle px-3" href="#" id="collabDropdown" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">Settings</a>
          <ul class="dropdown-menu" aria-labelledby="collabDropdown">
            <li><a class="dropdown-item" href="/practice-setup">Practice Setup</a></li>
            <li><a class="dropdown-item" href="/provider-setup">Provider Setup</a></li>
            <li><a class="dropdown-item" href="/payer-setup">Payer Setup</a></li>
            <li><a class="dropdown-item" href="/practice-references">Practice Preferences</a></li>
            <li><a class="dropdown-item" href="/dxicd-setup">DX/ICD Setup</a></li>
            <li><a class="dropdown-item" href="/interface-setup">Interface Setup</a></li>
            <li><a class="dropdown-item" href="/statement-setup">Statement Setup</a></li>
            <li><a class="dropdown-item" href="/user-setup">User Setup</a></li>
            <li><a class="dropdown-item" href="/administration">Administration</a></li>
            <li><a class="dropdown-item" href="/print-setup">Print Setup</a></li>
          </ul>
        </li>
      </ul>

      <!-- Profile & Logout -->
      <ul class="navbar-nav ms-auto" style="font-family: ' Segoe UI', Tahoma, Verdana, Arial, sans-serif;
        font-weight: 700;      
        font-size: 16px;
        cursor: pointer;">
        <form class="d-flex input-group w-auto">
          <input type="search" class="form-control" placeholder="Find patient, claim, or" aria-label="Search" />
          <button class="btn btn-sm" type="button" data-mdb-ripple-init data-mdb-ripple-color="dark">
            <i class="fa-solid fa-magnifying-glass"></i>
          </button>
        </form>
        <li class="nav-item">
          <a class="btn btn-sm  me-2" style="color:#00A6D9;" href="#profile">{{$userName}}</a>
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