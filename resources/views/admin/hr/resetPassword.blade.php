<style>
    .alert {
        width: 500px !important;
        margin: 25px auto !important;
    }
</style>
@extends('layouts.backend')

@section('content')
@include('layouts.headers.cards')

<div class="container-fluid mt--7 bg-color" style="margin-top: 20px  !important;">
    <div class="row">
        <div class="col">

           <div class="card shadow" id="check-calon-karyawan-card">
                <div class="card-body">
                    @if(session()->has('successResetPWD'))
                        <div class="alert alert-success">
                            {{ session()->get('successResetPWD') }}
                        </div>
                        <script>
                            setTimeout(function() {
                                $('.alert').fadeOut('fast');
                            }, 4500); // <-- time in milliseconds
                        </script>
                    @endif
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                <form id="form-changePassowrd" action="{{ route('sendIDKaryawan') }}" method="post">
                                    {{method_field('post')}}
                                    @csrf
                                    <input type="hidden" name="id" id="id">

                                    <h6 class="heading-small text-muted mb-4">{{ __('Reset Password Karyawan') }}</h6>

                                    <div class="form-group row">
                                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('ID Karyawan') }}</label>
                                        <div class="col-md-4">
                                            <input id="reset-password" type="text" class="form-control @error('reset-password') is-invalid @enderror" name="id_karyawan" required placeholder="{{ __('Enter ID Karyawan') }}">

                                            @error('reset-password')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            {{--  <h6>Note : Password harus terdiri dari minimum delapan karakter, setidaknya satu huruf besar, satu huruf kecil, satu angka dan satu karakter khusus</h6>  --}}
                                        </div>
                                    </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Reset Password') }}</button>
                                </div>

                                </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@include('admin.hr.js')
@include('layouts.footers.auth')
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/datatables.min.css') }}">
@endpush
@push('js')
    <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery-validate.bootstrap-tooltip.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/handlebars.js') }}"></script>
@endpush
