<script type="text/javascript">
    $('bucketKlien-form').validate({
        rules: {
            nama_bucket : {required: true},
            dpd : {required: true}
        },
        submitHandler: function(form){
            url = "{{ route('storeSubPlatform') }}";
            $.ajax({
                url: url,
                type: "POST",
                data: $('#platform-form').serialize(),
                success: function($data){
                    $('#bucketKlien-form')[0].reset();
                    $("#rows").show('slow');
                    $("#msg").show('slow');
                    $("#msg").html("Data Telah Tersimpan");
                    $("#msg").fadeOut(6000);
                },
                error: function($data){

                }
            });
        }
    });

    $('#platform-form').validate({
        rules: {
            nama_platform : {required: true, minlength: 3}
        },
        submitHandler: function(form){
            url = "{{ route('storePlatform') }}";
            $.ajax({
                url: url,
                type: "POST",
                data: $('#platform-form').serialize(),
                success: function($data){
                    $('#platform-form')[0].reset();
                    $("#rows").show('slow');
                    $("#msg").show('slow');
                    $("#msg").html("Data Telah Tersimpan");
                    $("#msg").fadeOut(6000);
                },
                error: function($data){
                }
            });
        }
    });

    $('#manageAgent-form').validate({
        rules: {
            klien : {required: true},
            nama_agent : {required: true}
        },
        submitHandler: function(form){
            url = "{{ route('manageAgent') }}";
            $.ajax({
                url: url,
                type: "POST",
                data: $('#manageAgent-form').serialize(),
                success: function($data){
                    $('#manageAgent-form')[0].reset();
                    $("#rows").show('slow');
                    $("#msg").show('slow');
                    $("#msg").html("Data Telah Tersimpan");
                    $("#msg").fadeOut(6000);
                    $("#showFormPembagianAgent").hide('slow');
                    $("#showFormSettingTeam").show('slow');
                    $("#hideFormSettingTeam").hide('slow');
                    $('#manageAgen-table').DataTable().ajax.reload();
                },
                error: function($data){
                }
            });
        }
    });

    {{--  datatable  --}}
    var table = $('#platform-table').DataTable({
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
        ajax: "{{ route('dataPlatform') }}",
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
            {data: 'nama', name: 'nama', 'title': "{{ __('Klien') }}"},
                //{data: 'ktp', name: 'ktp', 'title': "{{ __('KTP') }}"},
                //{data: 'action', name: 'action', 'orderable': false, 'searchable': false, 'title': "{{ __('Action') }}", 'exportable' : false,'printable': false}
        ],
        'columnDefs': [
                {
                    "targets": '_all', // your case first column
                    "className": "text-center",
                    "width": "4%"
            },
            {
                    "targets": 1,
                    "className": "text-center",
            }
            ],
        "order": [[ 0, 'asc' ]]
    });

    var table = $('#sub-client-tables').DataTable({
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
        ajax: "{{ route('getDataBucketClinet') }}",
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
            {data: 'nama', name: 'nama', 'title': "{{ __('Klien') }}"},
                {data: 'dpd', name: 'dpd', 'title': "{{ __('dpd') }}"},
                //{data: 'action', name: 'action', 'orderable': false, 'searchable': false, 'title': "{{ __('Action') }}", 'exportable' : false,'printable': false}
        ],
        'columnDefs': [
                {
                    "targets": '_all', // your case first column
                    "className": "text-center",
                    "width": "4%"
            },
            {
                    "targets": 1,
                    "className": "text-center",
            }
            ],
        "order": [[ 0, 'asc' ]]
    });

    $('#manageAgen-table').DataTable({
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
        ajax: "{{ route('getDataClinet') }}",
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
            {data: 'client_name', name: 'client_name', 'title': "{{ __('Klien') }}"},
            {data: 'total_agent', name: 'total_agent', 'title': "{{ __('Jumlah Agent') }}"},
            // {
            //     data: null,
            //     orderable: false,
            //     searchable: false,
            //     className: 'dt-control',
            //     render: function (data, type, row) {
            //         // Assuming that your array has a property 'propertyName'
            //         return '<i class="fa fa-plus-square control-icon"></i> ' + row.propertyName;
            //     }
            // }
            {data: 'action', name: 'action', 'orderable': false, 'searchable': false, 'title': "{{ __('Action') }}", 'exportable' : false,'printable': false}
        ],
        'columnDefs': [
                {
                    "targets": '_all', // your case first column
                    "className": "text-center",
                    "width": "4%"
            },
            {
                    "targets": 1,
                    "className": "text-center",
            }
            ],
        "order": [[ 0, 'asc' ]]
    });

    $('#manageAgen-table tbody').on('click', 'td.dt-control', function () {
        var tr = $(this).closest('tr');
        var row = $('#manageAgen-table').DataTable().row(tr);

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });

    $('#showFormSettingTeam').click(function(){
        // console.log('jalan')
        $("#hideFormSettingTeam").show('slow');
        $("#showFormPembagianAgent").show('slow');
        $("#showFormSettingTeam").hide('slow');

        

    });

    $('#hideFormSettingTeam').click(function(){
        $('#manageAgent-form')[0].reset();
        $("#showFormPembagianAgent").hide('slow');
        $("#showFormSettingTeam").show('slow');
        $("#hideFormSettingTeam").hide('slow');
    })

    

    
</script>

