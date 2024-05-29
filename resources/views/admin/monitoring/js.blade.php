<script>
    // {{--  datatable  --}}
    // var table = $('#monitoring-table').DataTable({
    //     language: {
    //         paginate: {
    //         next: '&lt;',
    //         previous: '&gt;'
    //         }
    //     },
    //     bDestroy: true,
    //     processing: true,
    //     serverSide: true,
    //     deferRender: true,
    //     "pageLength": 25,
    //     ajax: "{{ url('admin/monitoring/get-data-monitoring') }}",
    //     columns: [
    //         {
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
    //         {data: 'nama', name: 'nama', 'title': "{{ __('Name') }}"},
    //         {data: 'userRecord', name: 'userRecord', 'title': "{{ __('Record User') }}"},
    //         {data: 'userRecordData', name: 'userRecordData', 'title': "{{ __('Detail Record') }}"},
    //         {data: 'datetime', name: 'datetime', 'title': "{{ __('Date') }}"},
            
    //         // {data: 'action', name: 'action', 'orderable': false, 'searchable': false, 'title': "{{ __('Action') }}", 'exportable' : false,'printable': false}
    //     ],
    //     'columnDefs': [
    //             {
    //                 "targets": '_all', // your case first column
    //                 "className": "text-center",
    //                 "width": "4%"
    //         },
    //         {
    //                 "targets": 1,
    //                 "className": "text-center",
    //         }
    //         ],
    //     "order": [[ 0, 'asc' ]]
    // });

    $(function(){
        $(".searchInput").change(function(){
            $("#search_logg").submit();
        });
    });

    function lihatDataCustomer(id){

        $('#modalLihatUserCustomer').modal('show');

    }
</script>
