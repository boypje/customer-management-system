{{-- Navbar for unauthenticated users--}}
<nav class="navbar navbar-top navbar-expand-md navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            <!-- penambahan style gambar logo hir -->
            <img src="{{ asset('assets/img/logoSSS.png') }}" style="height:50px !important; margin-left: 50%;" />
            <!-- sampai hir -->
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('admin') }}">
                            <img src="{{ asset('assets/img/logoSSS.png') }}">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Navbar items -->
            <ul class="navbar-nav mr-auto ml-4 d-md-flex">

                <li class="nav-item dropdown">
                    @hasanyrole('Super Admin|Desk Collection|Admin|Collection Manager|Leader DC')
                    <a class="nav-link nav-link-icon dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false">
                        <i class="ikon ni ni-archive-2"></i>
                        <span class="nav-link-inner--text">{{ __('Customers Data') }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                        
                        <a class="dropdown-item" href="{{ route('customer') }}"><i class="ikon ni ni-folder-17"></i><span>{{ __('Customers Data') }}</span></a>
                        @hasanyrole('Super Admin|IT Manager|IT Staff')
                        <a class="dropdown-item" href="{{ route('platform') }}"><i class="ikon ni ni-building"></i><span>{{ __('Platform Data') }}</span></a>
                        @endhasanyrole
                    @endhasanyrole
                </li>

                @hasanyrole('Super Admin')
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="{{ route('monitoringView') }}">
                        <i class="ni ni-book-bookmark"></i>
                        <span class="nav-link-inner--text">{{ __('logging') }}</span>
                    </a>
                </li>
                @endhasanyrole

                @hasanyrole('Super Admin|Admin')
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="{{ route('reportPayment') }}">
                        <i class="fas fa-chart-bar"></i>
                        <span class="nav-link-inner--text">{{ __('Report Payment') }}</span>
                    </a>
                </li>
                @endhasanyrole

                <li class="nav-item dropdown">
                    @hasanyrole('Super Admin')
                    <a class="nav-link nav-link-icon dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false">
                        <i class="ni ni-chart-pie-35"></i>
                        <span class="nav-link-inner--text">{{ __('Report Agent') }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                        
                        <a class="dropdown-item" href="{{ route('reportRemarkAgent') }}"><i class="fas fa-file-invoice"></i><span>{{ __('Remark') }}</span></a>
                        <a class="dropdown-item" href="{{ route('reportPaymentAgent') }}"><i class="fas fa-file-invoice-dollar"></i><span>{{ __('Payment') }}</span></a>
                        <a class="dropdown-item" href="{{ route('reportCallingReportAgent') }}"><i class="fas fa-file-invoice-dollar"></i><span>{{ __('Calling Report') }}</span></a>
                    </div>
                    @endhasanyrole
                </li>

                <li class="nav-item dropdown">
                    @hasanyrole('Super Admin')
                    <a class="nav-link nav-link-icon dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false">
                        <i class="ni ni-ruler-pencil"></i>
                        <span class="nav-link-inner--text">{{ __('Manage Tim') }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                        
                        <a class="dropdown-item" href="{{ route('viewAgentManage') }}"><i class="fas fa-users"></i><span>{{ __('Manage Agent') }}</span></a>
                        <a class="dropdown-item" href="#"><i class="ni ni-curved-next"></i><span>{{ __('Swap Agent') }}</span></a>
                    </div>
                    @endhasanyrole
                </li>

                <li class="nav-item dropdown">
                    @hasanyrole('Super Admin')
                    <a class="nav-link nav-link-icon dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false">
                       <i class="ni ni-single-02"></i>
                        <span class="nav-link-inner--text">{{ __('User Settings') }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                        @hasanyrole('Super Admin|HR Staff|HR Manager|HR Staff Senior')
                        <a  class="dropdown-item" href="{{ route('hr') }}"><i class="ikon fa fa-users"></i><span id="menu_id">{{ __('Data Pegawai') }}</span></a>
                        <a  class="dropdown-item" href="{{route('userTidakAktif')}}"><i class="ikon fa fa-users"></i><span id="menu_id">{{ __('Data Pegawai Tidak Aktif') }}</span></a>
                        @endhasanyrole
                        <a  class="dropdown-item" href="{{ route('roles.index') }}"><i class="ikon ni ni-lock-circle-open"></i><span id="menu_id">{{ __('Role') }}</span></a>
                        <a class="dropdown-item" href="{{ route('permissions.index') }}"><i class="ikon ni ni-check-bold"></i><span id="menu_id">{{ __('Permission') }}</span></a>
                    </div>
                    @endhasanyrole
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-icon dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false">
                       <i class="fa fa-phone"></i>
                        <span class="nav-link-inner--text">{{ __('Kirim Pesan') }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                        <a  class="dropdown-item" href="{{ route('devices.index') }}"><i class="ikon fa fa-mobile"></i><span id="menu_id">{{ __('Perangkat') }}</span></a>
                        <a  class="dropdown-item" href="{{route('outbox.index')}}"><i class="ikon fas fa-comment"></i><span id="menu_id">{{ __('Pesan') }}</span></a>
                    </div>
                </li>
            </ul>


            @if(config('rivela.searchbar')==true)
            <!-- Form search-->
            <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
                <div class="form-group mb-0">
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input class="form-control" placeholder="Search" type="text">
                    </div>
                </div>
            </form>
            @endif

            @include('layouts.navbars.navs.user')
        </div>
    </div>
</nav>
