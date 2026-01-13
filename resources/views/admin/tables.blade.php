<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>DarkPan - Bootstrap 5 Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('startbootstrap/admin/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('startbootstrap/admin/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('startbootstrap/admin/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    @vite(['resources/css/startbootstrap/admin/bootstrap.min.css'])

    <!-- Template Stylesheet -->
    @vite(['resources/css/startbootstrap/admin/style.css'])
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border" style="width: 3rem; height: 3rem; color: #ffd000;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="{{route('admin.dashboard')}}" class="navbar-brand mx-4 mb-3">
                    <h3 style="color: #ffd000;"><i class="fa fa-user-edit me-2"></i>DarkPan</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="{{ asset('startbootstrap/admin/img/user.jpg') }}" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">{{ Auth::user()->nom ?? 'John Doe' }}</h6>
                        <span>{{ Auth::user()->role ?? 'Admin' }}</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="{{route('admin.dashboard')}}" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="{{route('admin.tables')}}" class="nav-item nav-link active"><i class="fa fa-table me-2"></i>Tables</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="{{route('admin.dashboard')}}" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="mb-0" style="color: #ffd000;"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="{{ asset('startbootstrap/admin/img/user.jpg') }}" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">{{ Auth::user()->nom ?? 'John Doe' }}</span>
                        </a>
                       <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
    <a href="#" class="dropdown-item">My Profile</a>
    <a href="#" class="dropdown-item">Settings</a>

    <!-- Logout form -->
    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- Logout button -->
    <a href="#" class="dropdown-item"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
       Log Out
    </a>
</div>

                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


            <!-- Messages de succès/erreur -->
            @if(session('success'))
                <div class="container-fluid pt-4 px-4">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="container-fluid pt-4 px-4">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif


            <!-- Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <!-- Table des utilisateurs -->
                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Liste des Utilisateurs</h6>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nom</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Rôle</th>
                                            <th scope="col">Date de création</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($userstable as $user)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $user->nom }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <span class="badge" style="background-color: {{ $user->role === 'admin' ? '#ffd000' : '#6C7293' }}; color: {{ $user->role === 'admin' ? '#000' : '#fff' }};">
                                                    {{ ucfirst($user->role) }}
                                                </span>
                                            </td>
                                            <td>{{ $user->created_at ? $user->created_at->format('d/m/Y') : 'N/A' }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm" style="background-color: #ffd000; color: #000;" 
                                                        data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id }}">
                                                    <i class="fa fa-edit"></i> Modifier
                                                </button>
                                                <form action="{{ route('admin.destroy', $user->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fa fa-trash"></i> Supprimer
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Modal de modification -->
                                        <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content bg-secondary">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel{{ $user->id }}">Modifier l'utilisateur</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('admin.update', $user->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="nom{{ $user->id }}" class="form-label">Nom</label>
                                                                <input type="text" class="form-control bg-dark border-0" id="nom{{ $user->id }}" name="nom" value="{{ $user->nom }}" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="email{{ $user->id }}" class="form-label">Email</label>
                                                                <input type="email" class="form-control bg-dark border-0" id="email{{ $user->id }}" name="email" value="{{ $user->email }}" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="role{{ $user->id }}" class="form-label">Rôle</label>
                                                                <select class="form-select bg-dark border-0" id="role{{ $user->id }}" name="role" required>
                                                                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="password{{ $user->id }}" class="form-label">Nouveau mot de passe (optionnel)</label>
                                                                <input type="password" class="form-control bg-dark border-0" id="password{{ $user->id }}" name="password" placeholder="Laisser vide pour ne pas modifier">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="password_confirmation{{ $user->id }}" class="form-label">Confirmer le mot de passe</label>
                                                                <input type="password" class="form-control bg-dark border-0" id="password_confirmation{{ $user->id }}" name="password_confirmation">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                            <button type="submit" class="btn" style="background-color: #ffd000; color: #000;">
                                                                <i class="fa fa-save"></i> Enregistrer
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Fin Modal -->

                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Aucun utilisateur trouvé</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Table des images par utilisateur -->
                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Nombre d'Images par Utilisateur</h6>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nom</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Nombre d'Images</th>
                                            <th scope="col">Rôle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($userstable as $user)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $user->nom }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <span class="badge" style="background-color: #ffd000; color: #000;">{{ $user->images_count }} image(s)</span>
                                            </td>
                                            <td>{{ ucfirst($user->role) }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Aucun utilisateur trouvé</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table End -->


            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Your Site Name</a>, All Right Reserved. 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                            <br>Distributed By: <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-lg-square back-to-top" style="background-color: #ffd000; border-color: #ffd000; color: white;"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('startbootstrap/admin/lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('startbootstrap/admin/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('startbootstrap/admin/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('startbootstrap/admin/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('startbootstrap/admin/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('startbootstrap/admin/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('startbootstrap/admin/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    @vite(['resources/js/startbootstrap/admin/main.js'])
</body>
</html>