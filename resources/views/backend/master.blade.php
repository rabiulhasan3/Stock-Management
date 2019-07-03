    @include('backend.partial._header')
    <!-- Navbar-->
    @include('backend.partial._topbar')
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
     @include('backend.partial._sidebar')
      <main class="app-content">
        @yield('breadcrumb')
        @yield('content')
      </main>
      @include('backend.partial._footer')