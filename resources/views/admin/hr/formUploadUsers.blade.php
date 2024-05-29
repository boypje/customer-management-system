{{--  form upload user  --}}
<div id="formUpload" style="display: none;">
    <h3 class="zheading-small text-muted mb-4">{{ __('Upload File Kepegawaian') }} </h3>
    <form id="form-upload" action="{{ route('uploadData') }}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" id="id">
        {{method_field('post')}}
	@csrf
        <div class="form-group row">
            <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('Upload File') }}</span>
            <div class="col-md-6">
                <input type="file" class="form-control" name="file_excel_karyawan" id="file_excel_karyawan">
                <small class="form-text text-muted" style="font-size: 16px;">Silahkan masukkan File Excel dengan Max ukuran file ...MB dengan format (xlsx)</small>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-8">
                <button id="btn-sumit-excel" type="submit" class="btn btn-primary offset-md-3 default-button">
                    {{ __('Submit') }}
                </button>
            </div>
        </div>

    </form>

</div>
