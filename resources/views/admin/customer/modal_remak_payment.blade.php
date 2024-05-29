<div class="modal" id="RemarkModal" tabindex="-1" role="dialog" aria-labelledby="RemarkModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content container">
      <div class="modal-header">
      	<span class="col-md-11 col-form-label text-md-center labelclass" id="label-remark">{{ __('Note') }}</span>
        <button type="button" id="close-remark-modal" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <!-- form remark -->
          <form  id="remarkCustomer" enctype="multipart/form-data">
            {{method_field('post')}}
            @csrf
          	<input type="hidden" name="id" id="id-remark">
          	<input type="hidden" name="typ_remark" id="id-typ-remark">
            <input type="hidden" name="dateTimeStart" id="dateTimeStartDashboard">
            <input type="hidden" name="statusRemarked" id="statusRemarked">
            <input type="hidden" name="usr_id" id="usr_id">

              <!-- <div id="tagihanCustomers">
                <div class="form-group row">
                  <span class="col-md-4 col-form-label labelclass">{{ __('Tagihan') }}</span>
                    <div class="col-md-8">
                        <input id="tagihanCustomer" type="input" class="form-control">
                    </div>
                </div>
              </div> -->
              <div id="datePayment">
                <div class="form-group row">
                  <span class="col-md-4 col-form-label labelclass">{{ __('Tanggal') }}</span>
                    <div class="col-md-8">
                        <input id="date-payment" type="input" class="form-control tgl_ptp" name="date_payment" placeholder="yyyy-mm-dd" readonly='true' required>
                    </div>
                </div>
              </div>

              <div id="nominal">
                <div class="form-group row">
                  <span class="col-md-4 col-form-label labelclass">{{ __('Nominal') }}</span>
                    <div class="col-md-8">
                        <input type="input" class="form-control nominalPayment" name="nominal" id="nominalPayment"></input>
                    </div>
                </div>
              </div>

              <div id="ket">
                <div class="form-group row">
                  <span class="col-md-4 col-form-label labelclass">{{ __('Keterangan') }}</span>
                    <div class="col-md-8">
                      <textarea type="input" class="form-control keterangan" name="keterangan" id="keterangan" required></textarea>
                  </div>
                </div>
              </div>

              <div id="Bukti_Bayar">
                <div class="form-group row">
                  <span class="col-md-4 col-form-label labelclass">{{ __('Bukti Bayar') }}</span>
                    <div class="col-md-8">
                        <input id="id-bukti-bayar" type="file" class="form-control" name="nama_bukti_bayar" placeholder="{{ __('Bukti Bayar') }}">
                    </div>
                </div>
              </div>


              <div class="modal-footer">
                <button id="btn-cancel-closeModal" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button id="btn-remark-save" type="submit" class="btn btn-success">Save</button>
              </div>
          </form>
      </div>
    </div>
  </div>
</div>

