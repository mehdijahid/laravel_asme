
<nav class="navbar navbar-expand-lg" id="navbar">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center gap-2" href="#" id="navbar_title">
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
    <!-- Right: Links -->
    <div class="collapse navbar-collapse justify-content-end me-5" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{route('user.dashboard')}}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('user.historique') }}">Mon historique</a>
        </li>
        <li class="nav-item">
            <form action="{{ route('user.logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="nav-link" style="background: none; border: none; cursor: pointer;">
                    Logout
                </button>
            </form>
        </li>
      </ul>
    </div>
  </div>
</nav>

