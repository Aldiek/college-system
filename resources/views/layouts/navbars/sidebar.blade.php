<div class="sidebar" data-color="azure" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="#" class="simple-text logo-normal">
      <img src="{{asset('img/Tishreen_University_logo.png')}}" style="width: 50px;height: 50px;">

      {{ __('مجلس الكليات') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
          <p>{{ __('الرئيسية') }}</p>
        </a>
      </li>
      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
          <i class="material-icons">people_alt</i>
          <p>{{ __('المستخدمون') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="laravelExample">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal">{{ __('الحساب الشخصي') }} </span>
              </a>
            </li>
            @if(Auth::user()->is_super_admin())
              <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('user.index') }}">
                  <span class="sidebar-mini"> UM </span>
                  <span class="sidebar-normal"> {{ __('إدارة المستخدمين') }} </span>
                </a>
              </li>

              <li class="nav-item{{ $activePage == 'faculties' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('faculties.index') }}">
                  <i class="material-icons"> account_balance</i>
                  <p>{{ __('الكليات') }}</p>
                </a>
              </li>
            @endif

          </ul>
        </div>

      </li>
      @if(!Auth::User()->is_super_admin)
      <li class="nav-item{{ $activePage == 'decision' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('decision.index') }}">
          <i class="material-icons">assignment</i>
          <p>{{ __('القرارات') }}</p>
        </a>
      </li>
      @endif
    @if(Auth::User()->is_secretary_council())
      <li class="nav-item{{ $activePage == 'sessions' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('facultySession.index') }}">
          <i class="material-icons">meeting_room</i>
          <p>{{ __('الجلسات') }}</p>
        </a>
      </li>

            <li class="nav-item{{ $activePage == 'advertisement' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('advertisement.index') }}">
                    <i class="material-icons">fiber_new</i>
                    <p>{{ __('الإعلانات') }}</p>
                </a>
            </li>
      @endif


    </ul>
  </div>
</div>
