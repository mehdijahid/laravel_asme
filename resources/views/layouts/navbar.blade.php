<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

<nav class="navbar navbar-expand-lg p-0" id="navbar">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center p-0" href="#" id="navbar_title">
      <img src="{{ asset('images/image.png') }}" alt="Asme Vision Logo" id="navbar_logo">
      <span>Asme vision</span>
    </a>
    <button
      class="navbar-toggler"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarNav"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end me-5" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{route('home')}}">
            <i class="bi bi-house-door-fill"></i>
            Home
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('loginform')}}">
            <i class="bi bi-box-arrow-in-right"></i>
            Login
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('registerform')}}">
            <i class="bi bi-person-plus-fill"></i>
            Register
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>