<div class="modal" id="RemarkModalAftercall" tabindex="-1" role="dialog" aria-labelledby="RemarkModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content container">
      <div class="modal-header">
      	<span class="col-md-11 col-form-label text-md-center labelclass" id="label-remark">{{ __('Remark') }}</span>
        <button type="button" id="close-remark-modal" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <!-- form remark -->
          <form  id="remarkCustomerAftercall" enctype="multipart/form-data">
            {{method_field('post')}}
            @csrf
          	<input type="hidden" name="id_aftercall_remark" id="id-aftercall-remark">

              <div>
                <div class="form-group row">
                  <span class="col-md-3 col-form-label">{{ __('Remark') }}</span>
                  <div class="form-group">
                    <select class="custom-select" id="valRemark" name="valRemark">
                      <option selected="selected" value="quick" disabled>Quick Remark</option>
                      <!-- <option value="partial_payment">Partial Payment</option>
                      <option value="full_payment">Full Payment</option> -->
                      <option value="already_paid">Already Paid</option>
                      <option value="broken_ptp_contacted">Broken PTP (Contacted)</option>
                      <option value="escalated">Escalated</option>
                      <option value="language_not_communcable">Language Not Communcable</option>
                      <option value="partial_recovered">Partial Recovered</option>
                      <option value="promise_to_pay_follow_up">Promise To Pay Follow Up</option>
                      <option value="promise_to_settelment">Promise To Settelment</option>
                      <option value="ptp">Promise To Pay</option>
                      <option value="refused_to_pay">Refused To Pay</option>
                      <option value="confirmation_pending">Confirmation Pending</option>
                      <option value="fraud_cheating">Fraud/ Cheating</option>
                      <option value="callback">Callback</option>
                      <option value="broken_ptp_uncontacted">Broken PTP (Uncontacted)</option>
                      <option value="promise_to_pay_uncontacted">Promise To Pay Follow Up (Uncontacted)</option>
                      <option value="ringing_no_respon">Ringing No Respon/Call Waiting</option>
                      <option value="referted_over_email">Referted Over Email/Phone</option>
                      <option value="switch_off">Switch off/ Not Reacheble</option>
                      <option value="wrong_contact">Wrong Cantact Number</option>
                      <option value="invalid_assignment">Invalid Assignment</option>
                      <option value="invalid_number">Invalid Number</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="modal-footer">
                <button id="btn-cancel-closeModal" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <!-- <button id="saveRemarkAfterCall" type="submit" class="btn btn-success">Save</button> -->
              </div>
          </form>
      </div>
    </div>
  </div>
</div>

