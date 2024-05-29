<script type="text/javascript">
        $('#spt-list a').on('click', function (e) {
            e.preventDefault()
            $(this).tab('show')
        });
        //show the first tab
        $('.nav-tabs a:first').tab('show')

        $("#jabatan").selectize({
            allowEmptyOption: true,
            placeholder: "Pilih Jabatan",
            create: false,
        });
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		})

        {{--  modalEditUser  --}}
        function editUser(id){
            //console.log(id);
            $('#modalEditUser').modal({backdrop: 'static', keyboard: true, show: true})
            $('#modalEditUser').modal('show');
            $('#user-update-form')[0].reset();
            var url = "hr/editUser/" +id ;
            $.ajax({
                url: url,
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    console.log(data[0])
                    //let jabatan = data[1][0].id;
                    //console.log(jabatan)
                    $('.iduser').val(data[0].employee_id);
                    $('#ktp').val(data[0].ktp);
                    $('#kk').val(data[0].kk);
                    $('#passport').val(data[0].passport);
                    $('#npwp').val(data[0].npwp);
                    $('#email').val(data[0].email);
                    $('#nama_lengkap').val(data[0].fullname);
                    $('#alamat_domisili').val(data[0].almt_domisili);
                    $('#phone_rumah').val(data[0].tlp_rumah);
                    $('#alamat_ktp').val(data[0].almt_ktp);
                    $('#phone_hp').val(data[0].tlp_hp);
                    $('#jabatan')[0].selectize.setValue(data[0].id);
                    $('#divisi').val(data[0].divisi);
                    $('#status_pernikahan').val(data[0].status_pernikahan);
                    $('#agama').val(data[0].agama);
                    $('#darah').val(data[0].golongan_darah);
                    $('#tempat_lahir').val(data[0].tempat_lahir);
                    //$('#tanggal_lahir').val(data[0].tanggal_lahir);
                    $('#tanggal_lahir').datepicker('setDate', new Date(data[0].tanggal_lahir));
                    $('#kewarganegaraan').val(data[0].kewarganegaraan);

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
                        //$('#user-form')[0].reset();
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
        {{--  $('#btn-sumit-excel').click(function(){
            $('#formUpload')[0].reset();
        });  --}}

        $('.close').click(function(){
            $("#note").val("");
            $("#id").val("");
        });

        $('#btn-close_modal').click(function(){
            $('#NoteModal').modal('hide');
            $("#note").val("");
            $("#id").val("");
        });

        // datatable get user
        let statusUser = $("#statusUserTable").val();
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
            "pageLength": 25,
            ajax: "{{ url('/admin/hr/getDataUserbyStatus') }}" +'/' + statusUser,
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
                    //{data: 'ktp', name: 'ktp', 'title': "{{ __('KTP') }}"},
                    {data: 'fullname', name: 'fullname', 'title': "{{ __('Nama Lengkap') }}"},
                    //{data: 'passport', name: 'passport', 'title': "{{ __('passport') }}"},
                    //{data: 'domisili', name: 'domisili', 'title': "{{ __('address') }}"},
                    {data: 'jabatan', name: 'jabatan', 'title': "{{ __('Jabatan') }}"},
                    {data: 'status', name: 'status', 'title': "{{ __('status') }}"},
                    //{data: 'noteUser', name: 'noteUser', 'title': "{{ __('Note') }}"},
                    {data: 'action', name: 'action', 'orderable': false, 'searchable': false, 'title': "{{ __('Action') }}", 'exportable' : false,'printable': false}
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

        // fungsi confirm non aktif user
        function nonaktif_user(id){
            let hv = $('#id').val(id);

            $('#NoteModal').modal({backdrop: 'static', keyboard: true, show: true})
            $('#NoteModal').modal('show');
        }

        $("#btn-note_deactive_user").click(function(){
            var noteValue = $("#note").val();
            var noteId = $("#id").val();
            // console.log(noteValue);
            // console.log(noteId);

            var dataNote = {'id':noteId,'noteValue':noteValue};
            // console.log(dataNote);
            $.confirm({
                title: 'Perhatian!',
                content: 'Apa anda yakin menonaktifkan karyawan ini!',
                autoClose: 'Tidak|10000',
                buttons: {
                    deleteUser: {
                        text: 'Ya',
                        btnClass: 'btn-danger',
                        action: function () {
                            url = "{{ route('noteDeactiveUser') }}";
                                $.ajax({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    url: url,
                                    type: "POST",
                                    data: dataNote,
                                    success: function($data){
                                        $('#NoteModal').modal('hide');
                                        $("#note").val("");
                                        $("#id").val("");
                                        $('#users-table').DataTable().ajax.reload();
                                        $.alert('karyawan berhasil di nonaktifkan!');
                                    },
                                    error: function($data){
                                        // console.log(data);
                                    }
                                });


                        }
                    },
                    Tidak: function () {
                        $.alert('Proses telah dibatalkan !');
                        $('#NoteModal').modal('hide');
                        $("#note").val("");
                        $("#id").val("");
                    }
                }
            });
        });

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

        //download file user
        function downloadCV(id){
            url = "hr/download-cv/"+id;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "GET",
                data: id,
                success: function(data){
                    //console.log(data[0].employee_id);
                    if(data[0].resume == null){
                        alert('maaf data yang anda cari tidak ada');
                    }else{
                        window.location.href = '/file_upload/' + data[0].employee_id + '/' + data[0].resume;
                    }
                },
                error: function(data){

                }
            });
        }

        function downloadKK(id){
            url = "hr/download-kk/"+id;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "GET",
                data: id,
                success: function(data){
                    //console.log(data[0].employee_id);
                    if(data[0].f_kk == null){
                        alert('maaf data yang anda cari tidak ada');
                    }else{
                        window.location.href = '/file_upload/' + data[0].employee_id + '/' + data[0].f_kk;
                    }
                },
                error: function(data){

                }
            });
        }

        function downloadKTP(id){
            url = "hr/download-ktp/"+id;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "GET",
                data: id,
                success: function(data){
                    //console.log(data[0].employee_id);
                    if(data[0].f_ktp == null){
                        alert('maaf data yang anda cari tidak ada');
                    }else{
                        window.location.href = '/file_upload/' + data[0].employee_id + '/' + data[0].f_ktp;
                    }
                },
                error: function(data){

                }
            });
        }

        function downloadFoto(id){
            url = "hr/download-fdiri/"+id;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "GET",
                data: id,
                success: function(data){
                    //console.log(data[0].employee_id);
                    if(data[0].f_diri == null){
                        alert('maaf data yang anda cari tidak ada');
                    }else{
                        window.location.href = '/file_upload/' + data[0].employee_id + '/' + data[0].f_diri;
                    }
                },
                error: function(data){

                }
            });
        }

        function downloadIjazah(id){
            url = "hr/download-ijazah/"+id;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "GET",
                data: id,
                success: function(data){
                    //console.log(data[0].employee_id);
                    if(data[0].f_ijazah == null){
                        alert('maaf data yang anda cari tidak ada');
                    }else{
                        window.location.href = '/file_upload/' + data[0].employee_id + '/' + data[0].f_ijazah;
                    }
                },
                error: function(data){

                }
            });
        }

</script>
