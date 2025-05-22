<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        
        <div class="sidebar-brand-text mx-3">Klinik Sederhana</div>
      </a>
      {{-- <hr class="sidebar-divider "> --}}
      <li class="nav-item {{ Request::is('Dashboard') ?  'active' : '' }} my-1">
        <a class="nav-link" href="{{ route('dashboard') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      {{-- <hr class="sidebar-divider"> --}}

      <li class="nav-item {{ Request::is('Data Pasien') ?  'active' : '' }} my-0">
        <a class="nav-link" href="{{ route('datapasien') }}">
          <i class="fas fa-fw fa-user"></i>
          <span>Data Pasien</span>
        </a>
      </li>
      
      <li class="nav-item {{ Request::is('Riwayat Kunjungan') ?  'active' : '' }} my-1">
        <a class="nav-link" href="{{ route('riwayatkunjungan') }}">
          <i class="fas fa-fw fa-list"></i>
          <span>Kunjungan</span>
        </a>
      </li>
      
      <li class="nav-item {{ Request::is('Data Dokter') ?  'active' : '' }} my-1">
      <a class="nav-link" href="{{ route('datadokter') }}">
          <i class="fas fa-fw fa-stethoscope"></i>
          <span>Data Dokter</span>
        </a>
      </li>
      
      <li class="nav-item {{ Request::is('Data Poli') ?  'active' : '' }} my-1">
      <a class="nav-link" href="{{ route('datapoli') }}">
          <i class="fas fa-fw fa-hospital"></i>
          <span>Data Poli</span>
        </a>
      </li>

    </ul>