<header class="navbar navbar-light sticky-top bg-light flex-md-nowrap p-0 shadow">
  <div class="container">
    <a class="navbar-brand href="#">
      <img src="../icon/logo.png" alt="" width="80" height="70">
    </a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="navbar-nav">
      <div class="nav-item text-nowrap">
  
        <form action="/logout" method="post">
          @csrf
          {{-- <button type="submit" class="nav-link px-3 bg-light border-0">Logout <span data-feather="log-out"></span></button> --}}
          <button type="submit" class="btn btn-outline-dark">Logout</button>
        </form>
      </div>
    </div>
  </div>
</header>