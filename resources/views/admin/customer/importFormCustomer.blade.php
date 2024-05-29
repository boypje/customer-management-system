{{--  sukses import data  --}}
@if(session()->has('SuccessImportExcel'))
</center><div class="alert alert-success center" style="width: 50%;">
    <center>{{ session()->get('SuccessImportExcel') }}</center>
</div>
@elseif(session()->has('ErrorImportExcel'))
</center><div class="alert alert-danger center" style="width: 50%;">
    <center>{{ session()->get('ErrorImportExcel') }}</center>
</div>
@endif
<script>
    setTimeout(function() {
        $('.alert').fadeOut('fast');
    }, 4500); // <-- time in milliseconds
</script>

 @if (session('error'))
     <div class="alert alert-danger center" style="width: 50%;"><center>Mohon cek kembali pada {{ session('error') }}</center></div>
@endif
{{--  form upload user  --}}
<div id="formUploadCustomer" style="display: none;margin: 15px;">
    <h3 class="zheading-small text-muted mb-4">{{ __('Upload Data Customer') }} </h3>
    <form id="form-upload-customer-by-excel" action="{{ route('uploadDataCustomer') }}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" id="id">
        {{method_field('post')}}
	@csrf
        <div class="form-group row">
            <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('Platform / Klien') }}</span>
            <div class="col-md-6">
                <select class="form-control selectize" id="platform" name="platform">
                    <option value="" selected disabled>{{ __('Pilih Platform') }}</option>
                    @foreach($platform as $platforms)
                        <option class="form-control" value="{{$platforms->id}}" >{{ $platforms->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('Periode Awal') }}</span>
            <div class="col-md-3">
                
                <input id="datepicker-start" type="text" class="form-control datepick" name="tanggal_awal" autocomplete="off" required="" placeholder="Tanggal Awal" data-date-format="dd-mm-yyyy">
                @if($errors->has('tanggal_awal'))
                    <span class="text-danger">{{ $errors->first('tanggal_awal') }}</span>
                @endif

                <script>
                    $('#datepicker-start').datepicker({
                        format: "yy/mm/dd",
                        autoclose: true,
                    });
                    
                </script>
            </div>

            <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('Periode Akhir') }}</span>
            <div class="col-md-3">
                
                <input id="datepicker-akhir" type="text" class="form-control datepick" name="tanggal_akhir" autocomplete="off" required="" placeholder="Tanggal Akhir" data-date-format="dd-mm-yyyy">
                @if($errors->has('tanggal_akhir'))
                    <span class="text-danger">{{ $errors->first('tanggal_akhir') }}</span>
                @endif
                <script>
                    $('#datepicker-akhir').datepicker({
                        format: "yy/mm/dd",
                        autoclose: true,
                    });
                    
                </script>
            </div>
        </div>
        
        <div class="form-group row">
            <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('Upload File Excel') }}</span>
            <div class="col-md-6">
                <input type="file" class="form-control" name="file_excel_customer" id="file_excel_customer" required>
                <small class="form-text text-muted" style="font-size: 16px;">Silahkan masukkan File Excel dengan Max ukuran file ... MB dengan format (xlsx)</small>
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-md-8">
                <button id="btn-submit-excel" type="submit" class="btn btn-primary offset-md-3 default-button">
                    {{ __('Submit') }}
                </button>
            </div>
        </div>
        <script>
            $("#platform").selectize({
                allowEmptyOption: true,
                placeholder: "Pilih Platform",
                create: false,
            });
        </script>

    </form>

</div>
