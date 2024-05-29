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
        {{-- session show message --}}
        @if(session()->has('SuccessChangePassword'))
            <div class="alert alert-success">
                {{ session()->get('SuccessChangePassword') }}
            </div>
        @endif
        <div class="row">
            @include('admin.profile.form')
        </div>
    </div>
    <script type="text/javascript">
        //set time alert error to close it self
        setTimeout(function() {
            $('.alert').fadeOut('fast');
        }, 7000); // <-- time in milliseconds

        $(".ajax-form").validate({
            rules: {
                //first_name : {required: true, minlength: 3},
                //last_name : {required: true, minlength: 3},
                //email : {required: true, email:true},
                //address : { minlength: 6}
            },
            submitHandler: function(form){
                /*form.preventDefault();*/
                var id = $('#id').val();
                base_url = "profile";
                url =  "{{route('editPassword')}}";

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: $('.ajax-form').serialize(),
                    success: function(data){
                        $('.ajax-form')[0].reset();
                        /*$.alert('Profile updated!')*/
                    },
                    error: function(data){
                        console.log('Error:', $data);
                    }
                });
            }
        });
    </script>
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
