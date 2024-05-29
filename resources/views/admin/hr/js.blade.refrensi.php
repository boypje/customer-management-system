<script type="text/javascript">
        $('#spt-list a').on('click', function (e) {
            e.preventDefault()
            $(this).tab('show')
        });
        //show the first tab
        $('.nav-tabs a:first').tab('show')

        {{--  modalEditUser  --}}
        function editUser(id){
            //console.log(id);
            $('#modalEditUser').modal({backdrop: 'static', keyboard: true, show: true})
            $('#modalEditUser').modal('show');

            var url = "hr/editUser/" +id ;
            $.ajax({
                url: url,
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    //console.log(data);

                    $('.iduser').val(id);
                    $('#ktp').val(data.ktp);
                    $('#nama_lengkap').val(data.fullname);
                    $('#email').val(data.email);
                    $('#phone').val(data.phone);
                    $('#jabatan').val(data.jabatan);
                    $('#passport').val(data.passport);
                    $('#alamat').val(data.address);

                    $('#user-update-form').validate({
                        rules: {
                            full_name : {required: true, minlength: 3},
                            password : {required: true, minlength: 6}
                        },
                        submitHandler: function(form){
                            url = "{{ route('updateDataUser') }}";
                            $.ajax({
                                url: url,
                                type: "POST",
                                data: $('#user-update-form').serialize(),
                                success: function($data){
                                    $('#user-update-form')[0].reset();
                                    $('#users-table').DataTable().ajax.reload();
                                    $('#modalEditUser').modal('hide');
                                },
                                error: function($data){
                                }
                            });
                        }
                    });
                }
            });

        }
        //set time alert error to close it self
        setTimeout(function() {
            $('.alert').fadeOut('fast');
        }, 7000); // <-- time in milliseconds

        // menampilkan form upload
        function show() {
            document.getElementById(formUpload).style.display = "";
        }

        $('#user-form').validate({
            rules: {
                password : {required: true, minlength: 6}
            },
            submitHandler: function(form){
                url = "{{ route('inputUser') }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: $('#user-form').serialize(),
                    success: function($data){
                        $('#user-form')[0].reset();
                    },
                    error: function($data){
                    }
                });
            }
        });

        // merubah button form upload show / hide
        $(document).ready(function(){
            $('#buttonShowUploadForm').click(function(){
            let id = $('#formUpload').val();
            (id != null) ? $('#formUpload').css("display", "block") : $('#formUpload').css("display", "none");
            (id != null) ? $('#buttonHideUploadForm').css("display", "block") : $('#buttonHideUploadForm').css("display", "none");
            (id != null) ? $('#buttonShowUploadForm').css("display", "none") : $('#buttonShowUploadForm').css("display", "block");
            (id != null) ? $('#user-form').css("display", "none") : $('#user-form').css("display", "block");

            });
            $('#buttonHideUploadForm').click(function(){
                (id != null) ? $('#formUpload').css("display", "none") : $('#formUpload').css("display", "block");
                (id != null) ? $('#buttonHideUploadForm').css("display", "none") : $('#buttonHideUploadForm').css("display", "block");
                (id != null) ? $('#buttonShowUploadForm').css("display", "block") : $('#buttonShowUploadForm').css("display", "none");
                (id != null) ? $('#user-form').css("display", "block") : $('#user-form').css("display", "none");
            });
        });

        // mereset form upload after submit
        $('#btn-sumit-excel').click(function(){
            $('#formUpload')[0].reset();
        });

        // datatable get user
        let statusUser = $("#statusUserTable").val();
        {{--  let table = $('#users-table').DataTable({
            'pageLength': 15,
            language: {
                paginate: {
                next: '&gt;',
                previous: '&lt;' ,
                },
            },

            "opts": {
            "theme": "bootstrap",
            },
            processing: true,
            serverSide: true,
            ajax: "{{ url('/admin/hr/getDataUser') }}" +'/' + statusUser,
            columns: [

                //{data: 'employee_id', name: 'employee_id', 'title': "{{ __('ID Employee') }}"},
                {data: 'ktp', name: 'ktp', 'title': "{{ __('NIK') }}"},
                {data: 'employee_id', name: 'employee_id', 'title': "{{ __('ID Employee') }}"},
                {data: 'fullname', name: 'fullname', 'title': "{{ __('Nama Karyawan') }}"},
                {data: 'passport', name: 'passport', 'title': "{{ __('Passport') }}"},
                {data: 'email', name: 'email', 'title': "{{ __('Email') }}"},
                // {data: 'npwp', name: 'npwp', 'title': "{{ __('NPWP') }}"},
                {data: 'address ', name: 'address ', 'title': "{{ __('Alamat KTP') }}"},
                {data: 'phone', name: 'phone', 'title': "{{ __('Nomor Telfon') }}"},
                {data: 'status', name: 'status', 'orderable': false, 'searchable': false, 'title': "{{ __('Status') }}", 'exportable' : false,'printable': false},
                {data: 'userNote', name: 'userNote', 'title': "{{ __('Note') }}"},
                //{data: 'userNote', name: 'userNote', 'orderable': false, 'searchable': false, 'title': "{{ __('Note') }}", 'exportable' : false,'printable': false},
                {data: 'action', name: 'action', 'orderable': false, 'searchable': false, 'title': "{{ __('Action') }}", 'exportable' : false,'printable': false},
            ],
            "order": [[ 1, 'asc' ]],
        });  --}}
    // get data tabel
    var table = $('#users-table').DataTable({
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
        ajax: "{{ url('/admin/hr/getDataUser') }}" +'/' + statusUser,
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
                {data: 'employee_id', name: 'employee_id', 'title': "{{ __('Employee ID') }}"},
                {data: 'ktp', name: 'ktp', 'title': "{{ __('KTP') }}"},
                {data: 'fullname', name: 'fullname', 'title': "{{ __('Nama Lengkap') }}"},
                //{data: 'passport', name: 'passport', 'title': "{{ __('passport') }}"},
                {data: 'address', name: 'address', 'title': "{{ __('address') }}"},
                {data: 'phone', name: 'phone', 'title': "{{ __('phone') }}"},
                {data: 'status', name: 'status', 'title': "{{ __('status') }}"},
                {data: 'noteUser', name: 'noteUser', 'title': "{{ __('Note') }}"},
                {data: 'action', name: 'action', 'orderable': false, 'searchable': false, 'title': "{{ __('Action') }}", 'exportable' : false,'printable': false}
        ],
        columnDefs: [
            { "width": "150px", "targets": 3 },
            { "searchable": false, "orderable": false, "targets": 0 },
            ],
        "order": [[ 3, 'asc' ]]
    });

    // fungsi confirm non aktif user
    function nonaktif_user(id){
        let hv = $('#id').val(id);

        $('#NoteModal').modal({backdrop: 'static', keyboard: true, show: true})
        $('#NoteModal').modal('show');
        // input note after confirm
        $("#note_deactive_user").validate({

            submitHandler: function(form){
                url = "{{ route('noteDeactiveUser') }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: $('#note_deactive_user').serialize(),
                    success: function($data){
                        $('#NoteModal').modal('hide');
                        let csrf_token = $('meta[name="csrf-token"]').attr('content');
                        $.confirm({
                            title: "{{ __('Konfirmasi penonaktifan karyawan') }}",
                            content: "{{ __('Apakah anda yakin ingin menonaktifkan karyawan ini ?') }}",
                            buttons: {
                                nonaktif: {
                                    btnClass: 'btn-danger',
                                    action: function(){

                                        url = (window.location.pathname == '/admin') ? 'admin/hr/editStatusById/'+id : 'hr/editStatusById/'+id;
                                        $.ajax({
                                            url: url,
                                            type: "POST",
                                            data: {_method: 'post', '_token' : csrf_token },
                                            success: function(data){
                                                $('#note_deactive_user')[0].reset();
                                                $('#users-table').DataTable().ajax.reload();
                                            }
                                        });
                                    },
                                },
                                cancel: function(){
                                    $.alert('Canceled!');
                                }
                            }
                        });
                    },
                    error: function($data){
                    }
                });
            }
        });
    }

    // fungsi confirm aktifkan user
    function aktif_user(id){
        save_method = 'POST';
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        $.confirm({
            title: "{{ __('Notif Aktif User') }}",
            content: "{{ __('Apa anda yakin ingin mengaktifkan user ini ?') }}",
            buttons: {
                aktif: {
                    btnClass: 'btn-success',
                    action: function(){
                        // url = (window.location.pathname == '/admin') ? 'admin/hr/editStatusById/'+id : 'hr/editStatusById/'+id;
                        url = 'editStatusById/'+id;
                        $.ajax({
                            url: url,
                            type: "POST",
                            data: {_method: 'post', '_token' : csrf_token },
                            success: function(data){
                                $('#users-table').DataTable().ajax.reload();
                            }
                        });
                    },
                },
                cancel: function(){
                    $.alert('Canceled!');
                }
            }
        });
    }

</script>
