<div class="modal fade" id="modalUpdateCustomer" tabindex="-1" role="dialog" aria-labelledby="modalUpdateCustomerLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" id="close-modal-customers" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {{--  form salary user  --}}
                <h3 class="zheading-small text-muted mb-4">{{ __('Update Data Customer') }}</h3>
                <div class="form-group row">
                    <span class="col-md-1 col-form-label text-md-right labelclass">{{ __('Nama') }}</span>
                    <div class="col-md-3">
                        <input id="nama" type="text" class="form-control" name="nama" placeholder="{{ __('Nama Lengkap') }}" disabled>
                    </div>
                    <span class="col-md-1 col-form-label text-md-right labelclass">{{ __('KTP') }}</span>
                    <div class="col-md-3">
                        <input id="ktp" type="text" class="form-control" name="ktp" placeholder="{{ __('KTP') }}" disabled>
                    </div>
                    <span class="col-md-1 col-form-label text-md-right labelclass">{{ __('Email') }}</span>
                    <div class="col-md-3">
                      <input id="email" type="text" class="form-control" name="email" placeholder="{{ __('Email') }}" disabled>
                  </div>
                </div>
                <div class="form-group row">
                  <span class="col-md-1 col-form-label text-md-right labelclass">{{ __('No HP') }}</span>
                      <div class="col-md-3">
                          <input id="no_hp" type="text" class="form-control" name="no_hp" placeholder="{{ __('Nomor HP') }}" disabled>
                      </div>
                      <span class="col-md-1 col-form-label text-md-right labelclass">{{ __('Kontak Darurat') }}</span>
                      <div class="col-md-3">
                          <input id="no_ec" type="text" class="form-control" name="no_ec" placeholder="{{ __('Nomor Kontak Darurat') }}" disabled>
                      </div>
                      <span class="col-md-1 col-form-label text-md-right labelclass">{{ __('No Kantor') }}</span>
                      <div class="col-md-3">
                          <input id="no_kantor" type="text" class="form-control" name="no_kantor" placeholder="{{ __('Nomor Kantor') }}" disabled>
                      </div>
               </div>
               <div class="form-group row">
                    <span class="col-md-1 col-form-label text-md-right labelclass">{{ __('Facebook') }}</span>
                      <div class="col-md-3">
                          <input id="sosmed1" type="text" class="form-control" name="sosmed1" placeholder="{{ __('Sosmed 1') }}" disabled>
                      </div>
                      <span class="col-md-1 col-form-label text-md-right labelclass">{{ __('Twitter') }}</span>
                      <div class="col-md-3">
                          <input id="sosmed2" type="text" class="form-control" name="sosmed2" placeholder="{{ __('Sosmed 2') }}" disabled>
                      </div>
                      <span class="col-md-1 col-form-label text-md-right labelclass">{{ __('Instagram') }}</span>
                      <div class="col-md-3">
                          <input id="sosmed3" type="text" class="form-control" name="sosmed3" placeholder="{{ __('Sosmed 3') }}" disabled>
                      </div>
               </div>
               <div class="form-group row">
                    <span class="col-md-1 col-form-label text-md-right labelclass">{{ __('Alamat') }}</span>
                      <div class="col-md-3">
                          <textarea id="alamat" type="text" class="form-control" name="alamat" placeholder="{{ __('Alamat') }}" disabled></textarea>
                      </div>
                      <span class="col-md-1 col-form-label text-md-right labelclass">{{ __('Alamat Kontak') }}</span>
                      <div class="col-md-3">
                          <textarea id="alamat_kontak" type="text" class="form-control" name="alamat" placeholder="{{ __('Alamat') }}" disabled></textarea>
                      </div>
                      <span class="col-md-1 col-form-label text-md-right labelclass">{{ __('Platform') }}</span>
                      <div class="col-md-3">
                          <input id="platform" type="text" class="form-control" name="platform" placeholder="{{ __('Platform') }}" disabled>
                      </div>
               </div>
               <hr>
            <form id="update-customer-form" class="ajax-form" method="POST">
                <input type="hidden" name="id" id="idCustomer">
                @csrf
                <div class="form-group fieldGroup">
                    {{--  <div class="row">
                        <span class="col-md-1 col-form-label text-md-right labelclass">Nama Kontak</span>
                        <div class="col-md-1 col-form-label text-md-right labelclass">Alamat</div>
                        <div class="col-md-1 col-form-label text-md-right labelclass">Jenis Kontak</div>  --}}
                        {{--  <div class="col-md-1">Nama Instansi</div>
                        <div class="col-md-1">Jabatan</div>
                        <div class="col-md-1">Gaji Terakhir</div>  --}}
                    {{--  </div>  --}}
                    <div class="input-group">
                        <span class="col-md-1 col-form-label text-md-right labelclass">{{ __('Nama Kontak') }}</span>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="namaKontak[]" placeholder="Nama Kontak">
                        </div>
                        <span class="col-md-1 col-form-label text-md-right labelclass">{{ __('Alamat') }}</span>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="alamatKontak[]" placeholder="Alamat">
                        </div>
                        <span class="col-md-1 col-form-label text-md-right labelclass">{{ __('Jenis Kontak') }}</span>
                        <div class="col-md-2">
                            <select class="form-control selectize" id="type[]" name="typeContact[]" required>
                                <option value="" selected disabled>{{ __('Pilih Jenis') }}</option>
                                <option class="form-control" value="sendiri" >Sendiri</option>
                                <option class="form-control" value="ec">Kontak Darurat</option>
                                <option class="form-control" value="kantor" >Kontak Kantor</option>
                                {{--  <option class="form-control" value="email" >Email</option>
                                <option class="form-control" value="n_hp">Nomor HP</option>
                                <option class="form-control" value="n_ec" >Nomor Kontak Darurat</option>
                                <option class="form-control" value="n_kantor">Nomor Kantor</option>
                                <option class="form-control" value="fb">Facebook</option>
                                <option class="form-control" value="twitter">Twitter</option>
                                <option class="form-control" value="ig">Instagram</option>
                                <option class="form-control" value="alamat">Alamat</option>
                                <option class="form-control" value="platform">Platform</option>  --}}
                            </select>
                        </div>
                        <div class="input-group-addon ml-3">
                            <a href="javascript:void(0)" class="btn btn-success addMore"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-primary offset-md-3 default-button">
                            {{ __('Simpan') }}
                        </button>
                    </div>
                </div>
            </form>
            <div class="form-group fieldGroupCopy" style="display: none;">
                <div class="input-group">
                    <span class="col-md-1 col-form-label text-md-right labelclass">{{ __('Nama Kontak') }}</span>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="namaKontak[]" placeholder="Nama Kontak">
                    </div>
                    <span class="col-md-1 col-form-label text-md-right labelclass">{{ __('Alamat') }}</span>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="alamatKontak[]" placeholder="Alamat">
                    </div>
                    <span class="col-md-1 col-form-label text-md-right labelclass">{{ __('Jenis Kontak') }}</span>
                    <div class="col-md-2">
                        <select class="form-control selectize" id="type[]" name="typeContact[]" required>
                            <option value="" selected disabled>{{ __('Pilih Jenis') }}</option>
                            <option class="form-control" value="email" >Email</option>
                            <option class="form-control" value="n_hp">Nomor HP</option>
                            <option class="form-control" value="n_ec" >Nomor Kontak Darurat</option>
                            <option class="form-control" value="n_kantor">Nomor Kantor</option>
                            <option class="form-control" value="fb">Facebook</option>
                            <option class="form-control" value="twitter">Twitter</option>
                            <option class="form-control" value="ig">Instagram</option>
                            <option class="form-control" value="alamat">Alamat</option>
                            <option class="form-control" value="platform">Platform</option>
                        </select>
                    </div>
                    <div class="input-group-addon">
                        <a href="javascript:void(0)" class="btn btn-danger remove"><i class="fas fa-trash"></i></a>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>

