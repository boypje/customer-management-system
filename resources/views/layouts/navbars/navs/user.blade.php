<!-- User -->
<!-- <ul class="navbar-nav ml-auto align-items-center d-none d-md-flex"> -->
<ul class="navbar-nav float-right ml-4 d-md-flex">
    <li class="nav-item dropdown">
        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle img-profile-size" style="width: 60px !important;">
                    <img alt="Image placeholder" src="{{ asset('assets/img/theme/team-4-800x800.jpg') }}">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold name-user"><?php $pieces = explode(" ", auth()->user()->fullname ); echo $pieces[0]." ";  echo (count($pieces) <= 1 ? '' : $pieces[1]) ;?></span>
                </div>
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0 menu-name-user">Selamat Datang <?php $pieces = explode(" ", auth()->user()->fullname ); echo $pieces[0]." ";  echo (count($pieces) <= 1 ? '' : $pieces[1]);?></h6>
            </div>
            {{--  <a href="#" class="dropdown-item">  --}}
            <a href="{{ route('profile', auth()->user()->id) }}" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span class="menu-users">{{ __('My profile') }}</span>
            </a>
            <a href="{{ route('viewChangePassword', auth()->user()->id) }}" class="dropdown-item">
                <i class="ni ni-key-25"></i>
                <span class="menu-users">{{ __('Change Password') }}</span>
            </a>
            @hasanyrole('Super Admin')
                <a href="{{ route('resetPasswordUsers') }}" class="dropdown-item">
                    <i class="ni ni-lock-circle-open"></i>
                    <span class="menu-users">{{ __('Reset Password Users') }}</span>
                </a>
            @endhasanyrole
            <div class="dropdown-divider"></div>
            <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                <i class="ni ni-user-run"></i>
                <span class="menu-users">{{ __('Logout') }}</span>
            </a>
        </div>
    </li>
</ul>
