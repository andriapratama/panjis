<nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
            <a href="/home" class="nav-link">
               <i class="nav-icon fas fa-home"></i>
              <p>Home</p>
            </a>
          </li>
      @if (auth()->user()->level==1)
          <li class="nav-item">
            <a href="/sekretaris" class="nav-link">
               <i class="nav-icon fas fa-book"></i>
              <p>Sekretaris</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/bendahara" class="nav-link">
               <i class="nav-icon fas fa-edit"></i>
              <p>Bendahara</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/pengembangan" class="nav-link">
               <i class="nav-icon fas fa-chart-pie"></i>
              <p>Pengembangan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/publikasi" class="nav-link">
               <i class="nav-icon fas fa-image"></i>
              <p>Publikasi</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Data Keanggotaan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/pengurus" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengurus</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/anggota" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Anggota</p>
                </a>
              </li>
            </ul>
          </li>
      @elseif(auth()->user()->level==2)
          <li class="nav-item">
            <a href="/sekretaris" class="nav-link">
               <i class="nav-icon fas fa-book"></i>
              <p>Sekretaris</p>
            </a>
          </li>
      @elseif(auth()->user()->level==3)
          <li class="nav-item">
            <a href="/bendahara" class="nav-link">
               <i class="nav-icon fas fa-edit"></i>
              <p>Bendahara</p>
            </a>
          </li>
      @elseif(auth()->user()->level==4)
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Data Keanggotaan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/pengurus" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengurus</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/anggota" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Anggota</p>
                </a>
              </li>
            </ul>
          </li>
      @elseif(auth()->user()->level==5)
          <li class="nav-item">
            <a href="/pengembangan" class="nav-link">
               <i class="nav-icon fas fa-chart-pie"></i>
              <p>Pengembangan</p>
            </a>
          </li>
      @elseif(auth()->user()->level==6)
          <li class="nav-item">
            <a href="/publikasi" class="nav-link">
               <i class="nav-icon fas fa-image"></i>
              <p>Publikasi</p>
            </a>
          </li>
      @endif
</nav>