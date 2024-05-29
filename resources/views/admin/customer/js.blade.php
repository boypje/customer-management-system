<script type="text/javascript">
    $(document).ready(function(){
        $('#buttonShowImportFormCustomer').click(function(){
        let id = $('#formUploadCustomer').val();
        (id != null) ? $('#formUploadCustomer').css("display", "block") : $('#formUploadCustomer').css("display", "none");
        (id != null) ? $('#buttonHideImportFormCustomer').css("display", "block") : $('#buttonHideImportFormCustomer').css("display", "none");
        (id != null) ? $('#buttonShowImportFormCustomer').css("display", "none") : $('#buttonShowImportFormCustomer').css("display", "block");
        });
        $('#buttonHideImportFormCustomer').click(function(){
            (id != null) ? $('#formUploadCustomer').css("display", "none") : $('#formUploadCustomer').css("display", "block");
            (id != null) ? $('#buttonHideImportFormCustomer').css("display", "none") : $('#buttonHideImportFormCustomer').css("display", "block");
            (id != null) ? $('#buttonShowImportFormCustomer').css("display", "block") : $('#buttonShowImportFormCustomer').css("display", "none");
        });
        // membatasi jumlah inputan
        var maxGroup = 15;
        //melakukan proses multiple input
        $(".addMore").click(function(){
            if($('body').find('.fieldGroup').length < maxGroup){
                var fieldHTML = '<div class="form-group fieldGroup">'+$(".fieldGroupCopy").html()+'</div>';
                $('body').find('.fieldGroup:last').after(fieldHTML);
            }else{
                alert('Maximum '+maxGroup+' groups are allowed.');
            }
        });
        //remove fields group
        $("body").on("click",".remove",function(){
            $(this).parents(".fieldGroup").remove();
        });
        
        $('#buttonHideImportFormCustomer').click(function(e) {
            $('#form-upload-customer-by-excel')[0].reset();
        });

        // checking actived dropdown
        // console.log($("button.btn-down > a.dropdown-item :selected").val() == true);
        // $('select.custom-select > option').
        
    });
    $('#customer-form').validate({
        rules: {
            id_customer : {required: true, minlength: 3},
            nama_customer : {required: true, minlength: 3},
            ktp : {required: true, minlength: 10},
            email : {required: true},
            nomor_kontak : {required: true, minlength: 10},
            nomor_kontak2 : {required: true, minlength: 10},
            platform : {required: true},
        },
        submitHandler: function(form){
            url = "{{ route('insertCustomer') }}";
            $.ajax({
                url: url,
                type: "POST",
                data: $('#customer-form').serialize(),
                success: function($data){
                    $('#customer-form')[0].reset();
                    $('#success-alert').show('slow')
                    setTimeout(function() {
                        $('#success-alert').fadeOut('fast');
                    }, 4500);
                },
                error: function(error){
                    $('#fail-alert').show('slow')
                    setTimeout(function() {
                        $('#fail-alert').fadeOut('fast');
                    }, 4500);
                }
            });
        }
    });

    $('#close-modal-customers').click(function(e) {
        $('#update-customer-form')[0].reset();
    });

    function update_upload_data_dump(id){
        alert('berhasil')
    }
    $(".messageCheckbox").change(function() {
        if(this.checked) {
            if(this.value == 'ec' ||this.value == 'kantor'){
                $('#alamatKontak').show('slow');
                $('.alamatKontakLabel').show('slow');
                $('#namaKontak').show('hide');
            } else if (this.value == 'sendiri'){
                $('#alamatKontak').hide('slow');
                $('.alamatKontakLabel').hide('slow');
                $('#namaKontak').show('hide');
            }
        }
    });
    $('#submitData').click(function(e) {
        $('#namaKontak').hide('hide');
        $('#alamatKontak').hide();
        $('.alamatKontakLabel').hide();
    });



    $("#kontak").click(function(){
        $('#kontak-form').show();
            $('#sosmed-form').hide();
            $('#close-update-form').show();
            var id = $(location).attr("pathname");
            var idCustomer = id.replace(/[^0-9]/g,'');
            $('#idCustomer').val(idCustomer);
            $('#idCustomers').val();
            $(".fieldGroupCopy2 input").prop("disabled", true); //form kontak
            $(".fieldGroupCopy1 input").prop("disabled", true); //form sosmed
    });

    $('.addMoreKontak').click(function(){
        //disabled form input kontak
        $(".fieldGroupCopy2 input").prop("disabled", false);
    });

    $('.addMore').click(function(){
        //disabled form input sosmed
        $(".fieldGroupCopy1 input").prop("disabled", false);
    });

    $("#sosmed").click(function(){
        $('#kontak-form').hide();
            $('#sosmed-form').show();
            $('#close-update-form').show();
            var id = $(location).attr("pathname");
            var idCustomer = id.replace(/[^0-9]/g,'');
            $('#idCustomers').val(idCustomer);
            $('#idCustomer').val();
            $(".fieldGroupCopy2 input").prop("disabled", true);
            $(".fieldGroupCopy1 input").prop("disabled", true);
    });
    $('#close-update-form').click(function(){
        $('#sosmed-form').hide();
        $('#kontak-form').hide();
        $('#close-update-form').hide();
        $('#idCustomer').val();
        $('#idCustomers').val();
        $('#kontak-form')[0].reset();
        $('#sosmed-form')[0].reset();
        $(".fieldGroupCopy2 input").prop("disabled", true);
        $(".fieldGroupCopy1 input").prop("disabled", true);
    });

    {{--  start form   --}}
    // membatasi jumlah inputan
    var maxGroup = 15;

    //melakukan proses multiple input
    $(".addMore").click(function(){
        if($('body').find('.fieldGroup').length < maxGroup){
            var fieldHTML = '<div class="form-group fieldGroupCopy1">'+$(".fieldGroupCopy1").html()+'</div>';
            $('body').find('.fieldGroupCopy1:last').after(fieldHTML);
        }else{
            alert('Maximum '+maxGroup+' groups are allowed.');
        }
    });

    $(".addMoreKontak").click(function(){
        if($('body').find('.fieldGroupKontak').length < maxGroup){
            var fieldHTML = '<div class="form-group fieldGroupCopy2">'+$(".fieldGroupCopy2").html()+'</div>';
            $('body').find('.fieldGroupCopy2:last').after(fieldHTML);
        }else{
            alert('Maximum '+maxGroup+' groups are allowed.');
        }
    });

    //remove fields group
    $("body").on("click",".remove",function(){
        $(this).parents(".fieldGroupCopy1").remove();
    });

    $("body").on("click",".remove2",function(){
        $(this).parents(".fieldGroupCopy2").remove();
    });
    {{--  end form   --}}

    $('#update-customer-form').validate({
        rules: {
        },
        submitHandler: function(form){
            url = "{{ route('addContackCustomer') }}";
            $.ajax({
                url: url,
                type: "POST",
                data: $('#customer-form').serialize(),
                success: function($data){
                    //$('#customer-form')[0].reset();
                },
                error: function($data){
                }
            });
        }
    });

    // {{--  show modal and edit data kontak by id kontak   --}}
        function update_data_kontak(id){
            //alert(id);
            $('#modalEditKontakCustomer').modal('show');
            // "{{ url('admin/customer/edit-data-sosmed-by') }}"+ '/' + id;
            var url = "{{ url('admin/customer/get-contact-customer-by') }}" + '/' + id;
            //console.log(url)
            $.ajax({
                url: url,
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    //console.log(data);
                    $('#namaKontak').val(data.contact_name);
                    $('#nomorKontak').val(data.number_contact);
                    $('#alamatKontak').val(data.address);
                    $('#tipeKontak').val(data.type_contact);
                }
            });

            var uid = $('#idKontak').val(id);
            $('#form-edit-kontak-customer').validate({
                rules: {
                    {{--  full_name : {required: true, minlength: 3},
                    password : {required: true, minlength: 6}  --}}
                },
                submitHandler: function(form){
                    //url = "{{ route('editKontakCustomer', ".id.") }}";
                    url = "{{ url('admin/customer/edit-data-contact-by') }}" + '/' + id;
                    // console.log(url)
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: $('#form-edit-kontak-customer').serialize(),
                        success: function($data){
                            $('#form-edit-kontak-customer')[0].reset();
                            $('#modalEditKontakCustomer').modal('hide');
                            $('#contact-table').DataTable().ajax.reload();
                        },
                        error: function($data){
                        }
                    });
                }
            });
        }
        $("#close-modal-edited-kontak").click(function(){
            $('#form-edit-kontak-customer')[0].reset();
        });
        {{--  end edit kontak   --}}

        {{--  show modal dan edit data sosmed by id sosmed   --}}
        function update_data_sosmed(id){
            //alert(id);
            $('#modalEditSosmedCustomer').modal('show');
            var url = "{{ url('admin/customer/get-sosmed-customer-by') }}" + '/' + id;
            //console.log(url)
            $.ajax({
                url: url,
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    //console.log(data);
                    $('#fb').val(data.fb);
                    $('#ig').val(data.ig);
                    $('#tw').val(data.tw);
                    $('#other').val(data.other);
                }
            });

            $('#form-edit-sosmed-customer').validate({
                rules: {
                    //nama_customer : {required: true},
                    //ktp : {required: true},
                    //email : {required: true},
                    //ktp : {required: true},
                    //phone1 : {required: true},
                    //phone2 : {required: true},
                    //phone3 : {required: true},
                },
                submitHandler: function(form){
                    url = "{{ url('admin/customer/edit-data-sosmed-by') }}"+ '/' + id;
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: $('#form-edit-sosmed-customer').serialize(),
                        success: function($data){
                            $('#form-edit-sosmed-customer')[0].reset();
                            $('#modalEditSosmedCustomer').modal('hide');
                            $('#sosmed-table').DataTable().ajax.reload();
                        },
                        error: function($data){
                        }
                    });
                }
            });
        }
        $("#close-modal-edited-sosmed").click(function(){
            $('#form-edit-sosmed-customer')[0].reset();
        });

    $("#nominalPayment").keypress(function (e){
      var charCode = (e.which) ? e.which : e.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        $("#nominalPayment").val("");
        $("#nominalPayment").css("border", "1px solid red");
        return false;
      }else{
        $("#nominalPayment").css("border","1px solid black");
      }
    });

    $("#nomorKontak-id").keypress(function (e){
      var charCode = (e.which) ? e.which : e.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        $("#nomorKontak-id").val("");
        $("#nomorKontak-id").css("border", "1px solid red");
        return false;
      }else{
        $("#nomorKontak-id").css("border","1px solid black");
      }
    });

    $("#nomorKontak-id").keypress(function (e){
      var charCode = (e.which) ? e.which : e.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        $("#tambahan-nomor-kontak").val("");
        $("#tambahan-nomor-kontak").css("border", "1px solid red");
        return false;
      }else{
        $("#tambahan-nomor-kontak").css("border","1px solid black");
      }
    });

    //create payment
    // $("#remarkCustomer").submit(function(e) {
    //     e.preventDefault();
    //     var nominal = $('.nominalPayment').val();
    //     var typ_remark = $('#id-typ-remark').val();
    //     if( (nominal != null && typ_remark == 'partial_payment') || (nominal != null && typ_remark ==  'full_payment') ){
            
    //         var formData = new FormData(this);

    //         $.ajax({
    //             type: "POST",
    //             data: formData,
    //             cache:false,
    //             contentType: false,
    //             processData: false,
    //             url: "{{route('createPayment')}}",
    //             dataType: "json",
    //             success: function(data) {
    //                 $("#remarkCustomer")[0].reset();
    //                 $('#RemarkModal').modal('hide');
    //                 $('#payment-table').DataTable().ajax.reload();
    //                 $('#remark-table').DataTable().ajax.reload();
    //             },
    //             error: function() {
    //                 // $('#imageerror').html('data.file');
    //             }
    //         });
    //     }

    // });

    //create remark
    $("#remarkCustomer").submit(function(e){ //save remark from modal
        e.preventDefault();
        //initiate global variable
        var paymentArr = ['already_paid','partial_recovered'];        
        var typ_remark = $('#id-typ-remark').val();
        url = ($.inArray(typ_remark, paymentArr) == -1) ?  "{{ route('remarkCustomer') }}" : "{{route('createPayment')}}";
        // alert(url);
        var formData = new FormData(this);

        $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                //method: 'POST',
                url: url,
                type: "POST",
                data: formData,
                //dataType: "json",
                success: function(data){
                    // console.log(data);
                    //$.alert('Data Berhasil di Remark');
                    $('#RemarkModal').modal('hide');
                    $("#remarkCustomer")[0].reset();
                    $('#remark-table').DataTable().ajax.reload();
                    $('#payment-table').DataTable().ajax.reload();

                    if(data.success !== '' && data.error == null){ //check are return json error or successfull
                        $('#flash-msg').slideDown(function() {
                            $('#flash-msg').addClass("alert-success"); //giving class
                            $('#flash-msg').html('<center>Data successful insert</center>'); //giving content message 
                            setTimeout(function() {
                                $('#flash-msg').html(''); 
                                $("#flash-msg").slideUp();
                                $('#flash-msg').removeClass("alert-success");
                                $("#remarkCustomer")[0].reset();
                                
                            }, 1500);
                        });

                    }else{
                        $('#flash-msg').slideDown(function() {
                            $('#flash-msg').addClass("alert-danger"); //giving class
                            $('#flash-msg').html("<center>Please try again because "+data.error+"<br/></center>"); //giving content message 
                            setTimeout(function() {
                                $('#flash-msg').html(''); 
                                $("#flash-msg").slideUp();
                                $('#flash-msg').removeClass("alert-danger");
                            }, 2500);
                        });
                    }

                },
                contentType: false,
                cache: false,
                processData: false,
                error: function(err){
                    // console.log(err);
                    // $('#RemarkModal').modal('hide');
                    // $("#remarkCustomer")[0].reset();
                    //$.alert('Data Gagal di Remark');
                }
            });

    });

    // import excel 
    // $("#form-upload-customer-by-excel").submit(function(e){
    //     e.preventDefault();
    //     var formData = new FormData(this);
    //     url = "{{ route('uploadDataCustomer') }}";
    //     $.ajax({
    //         type: "POST",
    //         data: formData,
    //         cache:false,
    //         contentType: false,
    //         processData: false,
    //         url: url,
    //         dataType: "json",
    //         success: function(data) {
    //             $("#form-upload-customer-by-excel")[0].reset();
    //             $('#formUploadCustomer').css("display", "none");
    //             $('#buttonHideImportFormCustomer').css("display", "none")
    //             $('#buttonShowImportFormCustomer').css("display", "block")
                
    //             if(data.success !== '' && data.error == null){ //check are return json error or successfull
    //                 $('#flash-msg').slideDown(function() {
    //                     $('#flash-msg').addClass("alert-success"); //giving class
    //                     $('#flash-msg').html('<center>Data successful insert</center>'); //giving content message 
    //                     setTimeout(function() {
    //                         $('#flash-msg').html(''); 
    //                         $("#flash-msg").slideUp();
    //                         $('#flash-msg').removeClass("alert-success");
    //                     }, 1500);
    //                 });

    //             }else{
    //                 $('#flash-msg').slideDown(function() {
    //                     $('#flash-msg').addClass("alert-danger"); //giving class
    //                     $('#flash-msg').html("<center>Please try again because "+data.error+"<br/></center>"); //giving content message 
    //                     setTimeout(function() {
    //                         $('#flash-msg').html(''); 
    //                         $("#flash-msg").slideUp();
    //                         $('#flash-msg').removeClass("alert-danger");
    //                     }, 2500);
    //                 });
    //             }
                
    //         },
    //         error: function() {
    //             // $('#imageerror').html('data.file');
    //         }
    //     });
    // });

    $("#close-remark-modal").click(function(){
        $("#RemarkModal").modal('hide');
        $("#remarkCustomer")[0].reset();
        
    });

    $("#btn-cancel-closeModal").click(function(){
        $("#RemarkModal").modal('hide');
        $("#remarkCustomer")[0].reset();
    });


    $('#date-payment-detail-cus').datepicker({
        // format: "dd/mm/yyyy",
        "setDate": new Date(),
        autoclose: true,
    });

    $("#date-payment-detail-cus").keypress(function (e){
      var charCode = (e.which) ? e.which : e.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
      }
    });

    $("#nominalPayment-detail-cus").keypress(function (e){
      var charCode = (e.which) ? e.which : e.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        $("#nominalPayment-detail-cus").val("");
        $("#nominalPayment-detail-cus").css("border", "1px solid red");
        return false;
      }else{
        $("#nominalPayment-detail-cus").css("border","1px solid black");
      }
    });

    function upload_bukti_bayar(id){
        // alert(id);
        $('#modalUPloadBuktiBayar').modal('show');
        $('#id-payment').val(id);
    }

    $('#UploadBuktiBayarCustomer').submit(function() {

        // need to get form data as below
        var formData = new FormData($(this)[0]);

        $.ajax({
            data: formData,
            contentType: false,
            processData: false,
            type: $(this).attr('method'),
            url: "{{ route('uploadBuktiBayar') }}",
            success: function(response) {
                // $('#content').html(response);
                $('#modalUPloadBuktiBayar').modal('hide');
                $('#UploadBuktiBayarCustomer')[0].reset();
            }
        });
        return false;
    });

</script>