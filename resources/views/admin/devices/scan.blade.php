@extends('layouts.backend') @section('content') @include('layouts.headers.cards')
<!-- Your HTML goes here -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Center Panel</title>
    <style>
        .panel {
            margin: auto;
            width: 50%;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .panel-heading {
            text-align: center;
        }
        .panel-body {
            padding: 20px;
        }
        .form-group {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .col-sm-6 {
            flex: 1;
        }
        .qr-code-img {
            max-width: 100%;
            height: auto;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .panel-footer {
            text-align: left;
            padding: 10px 20px;
        }
        .instruction-list {
            text-align: left;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function checkDeviceStatus() {
            const deviceName = "{{ $deviceName }}";
            const url = "{{ $api }}";
        
            fetch(`${url}/sessions/${deviceName}/status`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'AUTHENTICATED') {
                        fetch(`/admin/device/${deviceName}/update-status`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({status: 'AUTHENTICATED'})
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'AUTHENTICATED') {
                                Swal.fire({
                                    title: 'Success',
                                    text: 'AUTHENTICATION SUCCESSFULLY',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    window.location.href = "{{ route('devices.index') }}";
                                });
                            }
                        })
                        .catch(error => console.error('Error:', error));
                    } else if (data.status === 'DISCONNECTED') {
                        Swal.fire({
                            title: 'Failed',
                            text: 'AUTHENTICATION FAILED',                        
                            icon: 'error',
                            confirmButtonText: 'OK'
                            }).then(() => {
                                    window.location.href = "{{ route('devices.index') }}";
                            });
                    }
                })
                .catch(error => console.error('Error:', error));
        }
        
        setInterval(checkDeviceStatus, 5000);
    </script>


</head>

<body>
    <br>
    <div class='panel panel-default'>
        <div class='panel-heading'>
            <br>
            <h1>Scan Device</h1>
        </div>
        <div class='panel-body'>
            <form method='post'>
                <div class='form-group row'>
                    <div class='col-sm-6'>
                        <h4>To use WhatsApp on your computer:</h4>
                        <ol class="instruction-list">
                            <li>Open WhatsApp on your phone</li>
                            <li>
                                Tap <strong>Menu <span class="menu-icon">⋮</span></strong> or <strong>Settings <span class="settings-icon">⚙️</span></strong> and select <strong>Linked Devices</strong>
                            </li>
                            <li>Point your phone to this screen to capture the code</li>
                        </ol>
                    </div>
                    <div class='col-sm-6'>
                        <img src="{{ $result }}" alt="QR Code" class="qr-code-img">
                    </div>
                </div>
            </form>
        </div>
        <div class='panel-footer'>
            <a class='btn btn-primary' href="{{ route('devices.index') }}" value='Back'>BACK</a>
        </div>
    </div>
</body>

</html>


@include('layouts.footers.auth') @endsection @push('css')
<link href="{{ asset('assets/vendor/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('assets/vendor/datatables/datatables.min.css') }}">
<link href="{{ asset('assets/vendor/bsdatepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
<style>
    .instruction-list {
            list-style-type: decimal;
            margin-left: 20px;
        }
        .menu-icon,
        .settings-icon {
            display: inline-block;
            vertical-align: middle;
            font-size: 16px;
        }
        .qr-code-img {
            height: 300px;
        }
</style>
@endpush @push('js')
<script src="{{ asset('assets/vendor/bsdatepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery/jquery-validate.bootstrap-tooltip.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/handlebars.js') }}"></script>
<script src="{{ asset('assets/vendor/selectize/js/standalone/selectize.min.js') }}"></script>
@endpush