@extends('layouts.backend', ['title' => __('User Profile')])

@section('content')
    <div class="bg-gradient-primary pt-5 default-color" style="padding-bottom: 4rem !important;">
        <span class="mask opacity-8"></span>
        <div class="container-fluid d-flex align-items-center" style="margin-top: 70px;">

        </div>
    </div>
    <style>
        .alert {
            width: 500px !important;
            margin: 25px auto !important;
        }
    </style>
    <div class="container-fluid mt--7 bg-color" style="padding-top: 45px;">
    <style>
        .alert {
            width: 500px !important;
            margin: 25px auto !important;
        }
    </style>
<div class="col-xl-12 order-xl-1">
    <div class="card bg-secondary shadow">
        <div class="card-header bg-white border-0">
            <div class="row align-items-center">
                <div class="card-body">
                    {{--  success change pwd  --}}
                        @if(session()->has('FailedChangePwd'))
                        <div class="alert alert-danger">
                            {{ session()->get('FailedChangePwd') }}
                        </div>
                        <script>
                            setTimeout(function() {
                                $('.alert').fadeOut('fast');
                            }, 4500); // <-- time in milliseconds
                        </script>
                    @endif
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                <form id="form-changePassowrd" action="{{ route('editPasswordUsers') }}" method="post" enctype="multipart/form-data">
                                    {{method_field('post')}}
                                    @csrf
                                    <input type="hidden" name="id" id="id" value="{{ isset($dataUser->id) ?? $dataUser->id }}">
                                    <input type="hidden" name="user_id" id="user-id" value="{{ auth()->user()->id }}">

                                    <h6 class="heading-small text-muted mb-4">{{ __('Rubah Password') }}</h6>

                                    @if (session('status'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('status') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif

                                    <div class="form-group row">
                                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('New Password') }}</label>
                                        <div class="col-md-4">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="{{ __('New Password') }}">

                                            @error('password')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <h6>Note : Password harus terdiri dari minimum delapan karakter, setidaknya satu huruf besar, satu huruf kecil, satu angka dan satu karakter khusus</h6>
                                        </div>
                                        <div class="col-md-4">
                                            <input id="confirm_password" type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" required placeholder="{{ __('Confirm New Password') }}">

                                            @error('confirm_password')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>

                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>

@endsection

@push('css')
<link href="{{ asset('assets/vendor/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('assets/vendor/datatables/datatables.min.css') }}">
<link href="{{ asset('assets/vendor/bsdatepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush
@push('js')
<script src="{{ asset('assets/vendor/bsdatepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery/jquery-validate.bootstrap-tooltip.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/handlebars.js') }}"></script>
<script src="{{ asset('assets/vendor/selectize/js/standalone/selectize.min.js') }}"></script>
@endpush
