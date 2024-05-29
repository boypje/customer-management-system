@extends('layouts.backend')

@section('content')
@include('layouts.headers.cards')

@if(session()->has('SuccessUpdataDataCustomer'))
     <div class="alert alert-success">
         {{ session()->get('SuccessUpdataDataCustomer') }}
     </div>
     <script>
         setTimeout(function() {
             $('.alert').fadeOut('fast');
         }, 4500); // <-- time in milliseconds
     </script>
 @endif

<div class="container-fluid mt--7 bg-color" style="padding-top: 120px;">
<div class="col-md-12">
    <div class="card" id="id-card-cus1">
    
        <div class="card-body">
            {{--  display data customer   --}}
          <div class="tab-content mt-3" style="font-size: 12px !important;">
                <div id="detail-info-view">
                    <div class="text-center">
                        <h2>{{ __('Customer Detail Informations') }}</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-4 row">
                            <div class="col-md-4">{{ __('Name') }} :</div>
                            <div class="col">{{ ($data['Customer']->nama_customer == '') ? '-' :  $data['Customer']->nama_customer }}</div>
                        </div>
                        <div class="col-md-4 row">
                            <div class="col-md-4">{{ __('Nation ID') }} :</div>
                            <div class="col">{{ ($data['Customer']->ktp == '') ? '-' : $data['Customer']->ktp }}</div>
                        </div>
                        <div class="col-md-4 row">
                            <div class="col-md-4">{{ __('Email') }} :</div>
                            <div class="col">{{ ($data['Customer']->email == '') ? '-' : $data['Customer']->email }}</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 row">
                            <div class="col-md-4">{{ __('Address') }} :</div>
                            <div class="col">{{$data['Customer']->address}}</div>
                        </div>
                        <div class="col-md-4 row">
                            <div class="col-md-4">{{ __('Client') }} :</div>
                            <div class="col">{{ $data['platform'] }}</div>
                        </div>
                        <div class="col-md-4 row">
                            <div class="col-md-4">{{ __('Total bill') }} :</div>
                            <div class="col tagihan" data-infokey="{{number_format(( $data['Customer']->nominal ), 2)}}">Rp. {{ number_format(( $data['Customer']->nominal ), 2) }}</div>
                        </div>
                    </div>
                </div>
                
            <div id="other-info-view">
                @if(!empty($data['Customer']->others))
                    @include('admin.customer.otherInfo')
                @else
                
                @endif
            </div>
        </div> 
        <!-- end tab content -->
    </div>
</div><br>

<div class="card" id="id-card-cus3">
    <div class="row">
        <div class="col">
            <!-- <div class="card shadow"> -->
                <div class="col-md-12">
                    
                    
                    <div id="flash-msg" class="alert" style="width: 70%;display: none;"></div>
                    <div class="text-center">
                        <h2>{{ __('Collection Remarks Table') }}</h2>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm ajax-table" id="remark-table" cellspacing="0" width="100%">
                            <thead>

                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            <!-- </div> -->
        </div>
    </div>
</div>
    <br>
<div class="card" id="id-card-cus4">
    <div class="row">
        <div class="col">
            <!-- <div class="card shadow"> -->
                <div class="col-md-12">
                    <div class="text-center">
                        <h2>{{ __('Collection Payment Table') }}</h2>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm ajax-table" id="payment-table" cellspacing="0" width="100%">
                            <thead>

                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            <!-- </div> -->
        </div>
    </div>
</div>


</div>
</div>

@include('admin.customer.modalEditKontak')
@include('admin.customer.modalEditSosmed')
@include('admin.customer.modalUploadBuktiBayar')
@include('admin.customer.modal_detail_customer_remak')
@include('admin.customer.js')

<!-- core user js and form -->
<script>

    var id = $(location).attr("pathname");
    var idCustomer = id.replace(/[^0-9]/g,'');
    // var idCustomer = id.substr(id.length - 1);
    $('#idCustomer').val(idCustomer);
    // console.log(id)

    var url = "{{ url('admin/customer/get-data-detail-customer-by') }}" + '/' + idCustomer;
        //console.log(url)
        $.ajax({
            url: url,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                // console.log(data);
                
            }
        });

        $('#remark-table').DataTable({
            language: {
                paginate: {
                next: '&lt;',
                previous: '&gt;'
                }
            },
            bDestroy: true,
            processing: true,
            serverSide: true,
            // deferRender: true,
            "pageLength": 25,
            ajax: "{{ url('/admin/remark/getdate-remark') }}" + '/' + idCustomer,
            columns: [
                {
                    "width": "10%",
                    'defaultContent' : '',
                    'data'           : 'DT_RowIndex',
                    'name'           : 'DT_RowIndex',
                    'title'          : 'No',
                    'render'         : null,
                    'orderable'      : false,
                    'searchable'     : false,
                    'exportable'     : false,
                    'printable'      : true,
                    'footer'         : '',
                },
                {data: 'date_remark', name: 'date_remark', 'title': "{{ __('Date Remark') }}"},
                {data: 'customer_name', name: 'customer_name', 'title': "{{ __('Customer Name') }}"},
                {data: 'type_remark', name: 'type_remark', 'title': "{{ __('Collection Status') }}"},
                {data: 'ket', name: 'ket', 'title': "{{ __('Description') }}"},
                {data: 'user_remark', name: 'user_remark', 'title': "{{ __('PIC Remark') }}"},
                // {data: 'action', name: 'action', 'orderable': false, 'searchable': false, 'title': "{{ __('Action') }}", 'exportable' : false,'printable': false}
            ],
            'columnDefs': [
                    {"targets": '_all',"className": "text-center",width: '20%'},{"targets": 1,"className": "text-center"}
                ],
            "order": [[ 0, 'asc' ]]
        });

        $('#payment-table').DataTable({
            language: {
                paginate: {
                next: '&lt;',
                previous: '&gt;'
                }
            },
            bDestroy: true,
            processing: true,
            serverSide: true,
            // deferRender: true,
            "pageLength": 25,
            ajax: "{{ url('/admin/payment/getdata-payment') }}" + '/' + idCustomer,
            columns: [
                {
                    "width": "10%",
                    'defaultContent' : '',
                    'data'           : 'DT_RowIndex',
                    'name'           : 'DT_RowIndex',
                    'title'          : 'No',
                    'render'         : null,
                    'orderable'      : false,
                    'searchable'     : false,
                    'exportable'     : false,
                    'printable'      : true,
                    'footer'         : '',
                },
                {data: 'waktu_pembayaran', name: 'waktu_pembayaran', 'title': "{{ __('Date Payment') }}"},
                {data: 'customer_name', name: 'customer_name', 'title': "{{ __('Customer Name') }}"},
                {data: 'category_payment', name: 'category_payment', 'title': "{{ __('Category Payment') }}"},
                {data: 'nominal', name: 'nominal', 'title': "{{ __('Payment') }}"},
                {data: 'user_remark', name: 'user_remark', 'title': "{{ __('PIC') }}"},
                {data: 'action', name: 'action', 'orderable': false, 'searchable': false, 'title': "{{ __('Action') }}", 'exportable' : false,'printable': false}
            ],
            'columnDefs': [
                    {"targets": '_all',"className": "text-center",width: '20%'},{"targets": 1,"className": "text-center"}
                ],
            "order": [[ 0, 'asc' ]]
        });

    $('#id_select_remark').on('change', function () {
// var total_nominal = {{ $data['Customer']->nominal - $data['payment']->sum('nominal') }};
        var date = new Date();
        // document.getElementById("remarkCustomer").reset();
        var input_nominal = false;
        var input_file = false;
        var input_text = false;
        var total_payment = false;
        var select_val = this.value;
        // var arrayId = $(this).attr("id").split("-");
        var id = idCustomer;
        switch(select_val){
            case 'no_wa':
                var title = 'No WA';
                var input_nominal = false;
                var input_file = false;
                var input_text = true;
                break;
            case 'broken_ptp_contacted':
                var title = 'Broken PTP';
                var input_nominal = false;
                var input_file = false;
                var input_text = true;
                break;
            case 'already_paid':
                var title = 'Already Paid';
                var tagihan = true;
                var input_nominal = true;
                var total_payment = true; //mengisi value full_payment
                var input_file = true;
                var input_text = true;
                break;
            case 'escalated':
                var title = 'Escalated';
                var input_nominal = false;
                var input_file = false;
                var input_text = true;
                break;
            case 'language_not_communcable':
                var title = 'Language Not Communcable';
                var input_nominal = false;
                var input_file = false;
                var input_text = true;
                break;
            case 'partial_recovered':
                var title = 'Partial Recovered';
                var tagihan = true;
                var input_nominal = true;
                var input_file = true;
                var input_text = true;
                break;
            case 'promise_to_pay_follow_up':
                var title = 'Promise to Pay Follow Up (Contacted)';
                var input_nominal = false;
                var input_file = false;
                var input_text = true;
                break;
            case 'promise_to_settelment':
                var title = 'Promise To Settelment';
                var input_nominal = false;
                var input_file = false;
                var input_text = true;
                break;
            case 'refused_to_pay':
                var title = 'Refused To Pay';
                var input_nominal = false;
                var input_file = false;
                var input_text = true;
                break;
            case 'confirmation_pending':
                var title = 'Confirmation Pending';
                var input_nominal = false;
                var input_file = false;
                var input_text = true;
                break;
            case 'fraud_cheating':
                var title = 'Fraud/ Cheating';
                var input_nominal = false;
                var input_file = false;
                var input_text = true;
                break;
            case 'callback':
                var title = 'Callback';
                var input_nominal = false;
                var input_file = false;
                var input_text = true;
                break;
            case 'broken_ptp_uncontacted':
                var title = 'Broken PTP (Uncontacted)';
                var input_nominal = false;
                var input_file = false;
                var input_text = true;
                break;
            case 'promise_to_pay_uncontacted':
                var title = 'Promise To Pay Follow Up (Uncontacted)';
                var input_nominal = false;
                var input_file = false;
                var input_text = true;
                break;
            case 'ringing_no_respon':
                var title = 'Ringing No Respon/Call Waiting';
                var input_nominal = false;
                var input_file = false;
                var input_text = true;
                break;
            case 'referted_over_email':
                var title = 'Referted Over Email/Phone';
                var input_nominal = false;
                var input_file = false;
                var input_text = true;
                break;
            case 'switch_off':
                var title = 'Switch off/ Not Reacheble';
                var input_nominal = false;
                var input_file = false;
                var input_text = true;
                break;
            case 'wrong_contact':
                var title = 'Wrong Cantact Number';
                var input_nominal = false;
                var input_file = false;
                var input_text = true;
                break;
            case 'invalid_assignment':
                var title = 'Invalid Assignment';
                var input_nominal = false;
                var input_file = false;
                var input_text = true;
                break;
            case 'invalid_number':
                var title = 'Invalid Number';
                var input_nominal = false;
                var input_file = false;
                var input_text = true;
                break;
        }

        $("#RemarkModal").modal('show');
        $("#id-remark").val(id);
        $("#id-typ-remark").val(select_val);
        $('#statusRemarkeds').val(title);
        $('#detailCus').val(true);
        $("#label-remark").text(title);
        $('#date-payment').datepicker({'format': 'yyyy-mm-dd', 'autoclose' : true});
        $('#date-payment').datepicker('setDate','today');
        input_nominal ? $("div#detail_customer_nominal").css('display', 'block') : $("div#detail_customer_nominal").css('display', 'none');
        input_file ? $("#detail_customer_Bukti_Bayar").css('display', 'block') : $("#detail_customer_Bukti_Bayar").css('display', 'none');
        tagihan ? $("#tagihan").css('display', 'block') : $("#tagihan").css('display', 'none');
        input_text ? $("div#ket").css('display', 'block') : $("div#ket").css('display', 'none');
        total_payment ? $("#nominalPayment").val({{ $data['Customer']->nominal - $data['payment']->where('promise_to_pay',null)->sum('nominal') }}) : $("#nominalPayment").val();
        // console.log({{ $data['Customer']->nominal - $data['payment']->sum('nominal') }})
    });

//     $('#id_select_remark').selectize({      
//        // sortField: 'text',
//        allowEmptyOption: false,
//        create: false,
//        onchange: function(value){
        
//        },
//   });
    $('.detail_phone').on('click', function(e){
        var infoKey = $(this).data('infokey');
            setTimeout(function() {
                var phoneNumberElement = document.querySelector('.col.detail_phone a');
                var id = {{ $data['Customer']->id }}
                // Get the phone number from the href attribute of the <a> element
                var phoneNumber = phoneNumberElement.getAttribute('href').replace('sip:', '');
                var dateNowStart = new Date().toLocaleString();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('remarkCustomer') }}",
                    type: "POST",
                    data: { customerId: id, dateNowStart: dateNowStart, phone:phoneNumber },
                    success: function(data){
                        $('#rmk_id').val(data[0])
                        // console.log(data);
                    },
                    error: function(data){
                        console.error("Error:", data);
                    }
                });
                $("#DetailCustomerRemarkModal").modal('show');
                // console.log(url)
                
                $('#selectedPhone').val(phoneNumber);
                
                $('#applicant_type').val(infoKey)
                $('#dateTimeStartDetail').val(dateNowStart);
                var tagihanText = document.querySelector('.tagihan').textContent;
                $('#tagihans').val(tagihanText);
                // console.log(tagihanText)
            }, 5000);
    });

    $('#saveDetailCustomerRemarkAfterCall').on('click', function(e){
        $('#RemarkConfirmModalAftercall').modal('show')
        clearTimeout($('#RemarkConfirmModalAftercall').data('hideInteval'))
        var id = setTimeout(function(){
            $('#RemarkConfirmModalAftercall').modal('hide');
        });
    })
    
    $('#btn-endcall-closeModal').on('click', function(e){
        console.log(e)
    });
    // $('#saveDetailCustomerRemarkForm').on('click', function(e){
    //     $('#DetailCustomerRemarkForm')[0].reset();
    //     console.log('form detail remark already cleared');
    // });
    

    $('#DetailCustomerRemarkForm').validate({
        rules: {
            {{--  full_name : {required: true, minlength: 3},
            password : {required: true, minlength: 6}  --}}
        },
        submitHandler: function(form){
            var paymentArr = ['already_paid','partial_recovered'];
            var typ_remark = $('#id-typ-remark').val();
            var formData = new FormData(form); // Create FormData object from the form
            url = ($.inArray(typ_remark, paymentArr) == -1) ? "{{ route('recordDetailRemarkCall') }}" : "{{ route('createPayment') }}";
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "POST",
                data: formData, // Use FormData object for data
                contentType: false, // Set contentType to false, FormData will automatically set it
                processData: false, // Set processData to false, FormData will automatically process it
                success: function(data){
                    console.log('form detail remark already cleared');
                    $('#payment-table').DataTable().ajax.reload();
                    $('#remark-table').DataTable().ajax.reload();
                    $('#DetailCustomerRemarkForm')[0].reset();
                    $("#DetailCustomerRemarkModal").modal('hide');
                },
                error: function(data){
                    console.error("Error:", data);
                }
            });
            return false; // Prevent default form submission
        }
    });
        

</script>

<!-- end core user -->
@include('layouts.footers.auth')
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
