<div class="modal fade" id="modalEditKontakCustomer" tabindex="-1" role="dialog" aria-labelledby="modalEditKontakCustomerLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-fullscreen" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" id="close-modal-edited-kontak" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <!-- form Edit Customer Kontak -->
          <h3 class="zheading-small text-muted mb-4">{{ __('Edit Kontak Customer') }}</h3>
          <form id="form-edit-kontak-customer" class="ajax-form">
              <input type="hidden" name="id" id="idKontak">
              @csrf
              <div class="form-group row">
                  <span class="col-md-1 col-form-label text-md-right labelclass">{{ __('Nama Kontak') }}</span>
                  <div class="col-md-5">
                      <input id="namaKontak" type="text" class="form-control" name="nama_kontak" placeholder="{{ __('Nama Kontak') }}">
                  </div>
                  <span class="col-md-1 col-form-label text-md-right labelclass">{{ __('Nomor Kontak') }}</span>
                  <div class="col-md-5">
                      <input id="nomorKontak" type="text" class="form-control" name="nomor_kontak" placeholder="{{ __('Nomor Kontak') }}" >
                  </div>
              </div>
              <div class="form-group row">
                  <span class="col-md-1 col-form-label text-md-right labelclass">{{ __('Alamat Kontak') }}</span>
                  <div class="col-md-5">
                      <textarea id="alamatKontak" type="text" class="form-control" name="alamat_kontak" placeholder="{{ __('Alamat Kontak') }}" ></textarea>
                  </div>
                  <span class="col-md-1 col-form-label text-md-right labelclass">{{ __('Tipe Kontak') }}</span>
                  <div class="col-md-5">
                      <input id="tipeKontak" type="text" class="form-control" name="tipe_kontak" placeholder="{{ __('Tipe Kontak') }}" >
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



