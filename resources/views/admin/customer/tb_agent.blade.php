@extends('layouts.backend')

@section('content')
@include('layouts.headers.cards')

<div class="container-fluid mt--7 bg-color" style="padding-top: 120px;">
	<div class="col-md-12">
	    <div class="card" id="id-card-cus1">
	    
	        <div class="card-body">
				<div class="table-responsive">
				    <table class="table table-striped table-sm ajax-table" id="table-agent" cellspacing="0" width="100%">
				        <thead>

				        </thead>
				        <tbody></tbody>
				    </table>
				</div>

	        </div>
	    </div>
	</div>
</div>

<script type="text/javascript">

	// var table = $('#table-agent').DataTable({
    //     language: {
    //         paginate: {
    //         next: '&lt;',
    //         previous: '&gt;'
    //         }
    //     },
    //     // responsive: true,
    //     // bDestroy: true,
    //     processing: true,
    //     // serverSide: true,
    //     // deferRender: true,
    //     serverSide: true,
	//     ordering: false,
	//     searching: false,
    //     "pageLength": 25,
    //     ajax: "{{ url('/admin/customer/getData-deskCollection') }}" /*+ '/' + idCustomer*/,
    //     columns: [
    //         {
    //             "width": "10%",
    //             'defaultContent' : '',
    //             'data'           : 'DT_RowIndex',
    //             'name'           : 'DT_RowIndex',
    //             'title'          : 'No',
    //             'render'         : null,
    //             'orderable'      : false,
    //             'searchable'     : false,
    //             'exportable'     : false,
    //             'printable'      : true,
    //             'footer'         : '',
    //         },
    //         {data: 'id_customer', name: 'id_customer', 'title': "{{ __('Number Contract') }}"},
    //         {data: 'nama_customer', name: 'nama_customer', 'title': "{{ __('Customer Name') }}"},
    //         {data: 'email', name: 'email', 'title': "{{ __('Email') }}"},
    //         {data: 'contact', name: 'contact', 'title': "{{ __('Contact') }}"},
    //         {data: 'nominal', name: 'nominal', 'title': "{{ __('Payments') }}"},
    //         // {data: 'date', name: 'date', 'title': "{{ __('Date Added') }}"},
    //         {data: 'action', name: 'action', 'orderable': false, 'searchable': false, 'title': "{{ __('Action') }}", 'exportable' : false,'printable': false}
    //     ],
    //     "order": [[ 0, 'asc' ]]
    // });

    var table = $('#table-agent').DataTable({
            language: {
                paginate: {
                next: '&lt;',
                previous: '&gt;'
                }
            },
            bDestroy: true,
            processing: true,
            serverSide: true,
            deferRender: true,
            "pageLength": 25,
            ajax: "{{ url('/admin/customer/getData-deskCollection') }}" /*+ '/' + idCustomer*/,
            columns: [
                {
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
                {data: 'id_customer', name: 'id_customer', 'title': "{{ __('Number Contract') }}"},
	            {data: 'nama_customer', name: 'nama_customer', 'title': "{{ __('Customer Name') }}"},
	            {data: 'email', name: 'email', 'title': "{{ __('Email') }}"},
	            {data: 'contact', name: 'contact', 'title': "{{ __('Contact') }}"},
	            {data: 'nominal', name: 'nominal', 'title': "{{ __('Payments') }}"},
	            // {data: 'date', name: 'date', 'title': "{{ __('Date Added') }}"},
            ],
            'columnDefs': [
                    {
                        "targets": '_all', // your case first column
                        "className": "text-center",
                        "width": "4%"
                },
                {
                        "targets": 3,
                        "className": "text-center",
                }
                ],
            "order": [[ 0, 'asc' ]]
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