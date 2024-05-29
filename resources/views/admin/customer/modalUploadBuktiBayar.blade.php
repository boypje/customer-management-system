<div class="modal" id="modalUPloadBuktiBayar" tabindex="-1" role="dialog" aria-labelledby="modalUPloadBuktiBayarLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content container">
      <div class="modal-header">
        <h3 class="zheading-small text-muted mb-4">{{ __('Upload Bukti Bayar Customer') }}</h3>
        <button type="button" id="close-bukti-bayar-modal" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <!-- form remark -->
          <form  id="UploadBuktiBayarCustomer" Method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_payment" id="id-payment">
                @csrf
              <div id="datePayment">
                <div class="form-group row">
                  <span class="col-md-3 col-form-label text-md-right labelclass">{{ __('Bukti Bayar') }}</span>
                    <div class="col-md-9">
                        <input id="id-bukti-bayar" type="file" class="form-control" name="nama_bukti_bayar" placeholder="{{ __('Bukti Bayar') }}" required>
                    </div>
                </div>
              </div>

              <div class="text-center">
                  <button type="submit" class="btn btn-primary default-button">
                      {{ __('Upload Bukti Bayar') }}
                  </button>
              </div>
          </form>
      </div>
    </div>
  </div>
</div>




