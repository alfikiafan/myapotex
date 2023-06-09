<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-5 mt-0 border bg-body" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-2">
    <nav>
    <h6>
        <span class="font-weight-bold mb-0">Welcome, {{auth()->user()->name??'UNKNOWN'}}</span>
        <span class="ms-5">Role: {{auth()->user()->role??'GUEST?!?!???'}}</span>
    </h6>
    </nav>
    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
        </div>
        <div class="navbar-nav justify-content-end">
        <span>{{ \Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->format('l, d-m-Y H:i') }}</span>
        </div>
    </div>
    </div>
</nav>
<!-- End Navbar -->
