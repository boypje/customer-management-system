{{--  nav button import and insert user  --}}
<ul class="nav nav-tabs" /**id="spt-list"**/ style="border-bottom: 0;" role="tablist">
    <button type="button" class="btn btn-outline-success btn-sm" onclick="window.location='{{ route('uploadView') }}'">{{ __('Tambah Data Karyawan') }}</button>
    <button type="button" class="btn btn-outline-success btn-sm"  id="buttonShowUploadForm">{{ __('Upload Data Karyawan') }}</button>
    <button type="button" class="btn btn-outline-danger btn-sm" style="display: none;" id="buttonHideUploadForm">{{ __('Tutup Upload Data Karyawan') }}</button>
    <a href="{{route('getTamplate')}}" class="btn btn-outline-primary btn-sm">Download Format Data Karyawan</a>
</ul>

{{--  modal note user  --}}
<div class="modal fade" id="NoteModal" tabindex="-1" role="dialog" aria-labelledby="NoteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <span class="col-md-11 col-form-label text-md-center labelclass" id="label-non-aktif-karayawan" style="font-weight: bold;">{{ __('Form Note') }}</span>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {{--  form note user  --}}
            <div  id="note_deactive_user"  novalidate>
                <input type="hidden" name="id" id="id">
                <div class="form-group row">
                    <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('Note') }}</span>
                    <div class="col-md-6">
                        <textarea type="file" class="form-control" name="note" id="note" style="resize:none;width:300px;height:100px;" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                  <button id="btn-close_modal" type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                  <button id="btn-note_deactive_user" type="button" class="btn btn-danger">Non Aktifkan</button>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
