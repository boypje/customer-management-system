<div class="modal fade" id="modalEditSosmedCustomer" tabindex="-1" role="dialog" aria-labelledby="modalEditSosmedCustomerLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-fullscreen" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" id="close-modal-edited-sosmed" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {{--  form Edit Customer Kontak  --}}
            <h3 class="zheading-small text-muted mb-4">{{ __('Edit Sosial Media Customer') }}</h3>
            <form id="form-edit-sosmed-customer" class="ajax-form>
                <input type="hidden" name="id" id="idKontak">
                @csrf
                <div class="form-group row">
                    <span class="col-md-1 col-form-label text-md-right labelclass">{{ __('Facebook') }}</span>
                    <div class="col-md-5">
                        <input id="fb" type="text" class="form-control" name="fb" placeholder="{{ __('Facebook') }}" >
                    </div>
                    <span class="col-md-1 col-form-label text-md-right labelclass">{{ __('Instagram') }}</span>
                    <div class="col-md-5">
                        <input id="ig" type="text" class="form-control" name="ig" placeholder="{{ __('Instagram') }}" >
                    </div>
                </div>
                <div class="form-group row">
                    <span class="col-md-1 col-form-label text-md-right labelclass">{{ __('Twitter') }}</span>
                    <div class="col-md-5">
                        <input id="tw" type="text" class="form-control" name="tw" placeholder="{{ __('Twitter') }}" >
                    </div>
                    <span class="col-md-1 col-form-label text-md-right labelclass">{{ __('Lain - lain') }}</span>
                    <div class="col-md-5">
                        <input id="other" type="text" class="form-control" name="other" placeholder="{{ __('Lain - lain') }}" >
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary default-button">
                        {{ __('Simpan Perubahan') }}
                    </button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>

