<div class="modal" id="RemarkConfirmModalAftercall" tabindex="-1" role="dialog" aria-labelledby="RemarkModalLabel" aria-hidden="true">
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
          <form enctype="multipart/form-data">
            {{method_field('post')}}
            @csrf

              <div class="modal-footer">
                <button id="btn-endcall-closeModal" type="button" class="btn btn-danger" data-dismiss="modal">End Call</button>
              </div>
          </form>
      </div>
    </div>
  </div>
</div>

