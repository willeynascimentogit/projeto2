<div class="sidebar" data-color="#5d9af7" data-background-color="" data-image="{{ asset('material') }}/img/">"
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="#" class="simple-text logo-normal">
        <img width="150" src="{{asset('img/logo.png')}}" alt="">
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">


      @if(Auth::user()->nivel == 2)

          <!-- <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
              <i><img style="width:25px" src="{{ asset('material') }}/img/laravel.svg"></i>
              <p>{{ __('Laravel Examples') }}
                <b class="caret"></b>
              </p>
            </a> -->

            <!-- <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <i class="material-icons">settings_applications</i>
                <span class="sidebar-normal">{{ __('Perfil') }} </span>
              </a>
            </li> -->
            <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('home') }}">
                <i class="material-icons">dashboard</i>
                  <p>{{ __('Dashboard') }}</p>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'product-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('produtos.index') }}">
                <i class="material-icons">home_work</i>
                <span class="sidebar-normal"> {{ __('Produtos') }} </span>
              </a>
            </li>

            <li class="nav-item{{ $activePage == 'group-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('grupos.index') }}">
                <i class="material-icons">content_paste</i>
                <span class="sidebar-normal"> {{ __('Grupos') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'company-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('companhias.index') }}">
                <i class="material-icons">business_center</i>
                <span class="sidebar-normal"> {{ __('Companhias') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'par-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('parametros.choose') }}">
                <i class="material-icons">P</i>
                <span class="sidebar-normal"> {{ __('Parâmetros') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('user.index') }}">
                <i class="material-icons">people</i>
                <span class="sidebar-normal"> {{ __('Usuários') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'icons' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('calculos.index') }}">
                <i class="material-icons">attach_money</i>
                <p>{{ __('Simulações') }}</p>
              </a>
            </li>

          <!-- <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('table') }}">
              <i class="material-icons">content_paste</i>
                <p>{{ __('Table List') }}</p>
            </a>
          </li> -->
          <!-- <li class="nav-item{{ $activePage == 'typography' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('typography') }}">
              <i class="material-icons">library_books</i>
                <p>{{ __('Typography') }}</p>
            </a>
          </li> -->
          <!-- <li class="nav-item{{ $activePage == 'icons' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('icons') }}">
              <i class="material-icons">bubble_chart</i>
              <p>{{ __('Icons') }}</p>
            </a>
          </li> -->
          <!-- <li class="nav-item{{ $activePage == 'map' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('map') }}">
              <i class="material-icons">location_ons</i>
                <p>{{ __('Maps') }}</p>
            </a>
          </li> -->
          <!-- <li class="nav-item{{ $activePage == 'notifications' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('notifications') }}">
              <i class="material-icons">notifications</i>
              <p>{{ __('Notifications') }}</p>
            </a>
          </li>
          <li class="nav-item{{ $activePage == 'language' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('language') }}">
              <i class="material-icons">language</i>
              <p>{{ __('RTL Support') }}</p>
            </a>
          </li>
          <li class="nav-item active-pro{{ $activePage == 'upgrade' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('upgrade') }}">
              <i class="material-icons">unarchive</i>
              <p>{{ __('Upgrade to PRO') }}</p>
            </a>
          </li> -->

      @elseif(Auth::user()->nivel == 1)
      <li class="nav-item{{ $activePage == 'icons' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('calculos.create') }}">
          <i class="material-icons">attach_money</i>
          <p>{{ __('Simulação') }}</p>
        </a>
      </li>
      @endif

    </ul>
  </div>
</div>
