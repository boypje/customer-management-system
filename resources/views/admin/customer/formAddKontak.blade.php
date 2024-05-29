{{--  start form contact   --}}
<form id="kontak-form" action="{{ route('addContackCustomer') }}" class="ajax-form" method="POST" style="display: none">
    <br>
    <h2>{{ __('Tambah Contact Customer') }}</h2>
    <br>
    <input type="hidden" name="id" id="idCustomer">
    @csrf
    <div class="form-group fieldGroupKontak" novalidate>
        <div class="row">
            <span class="col-md-3 col-form-label ">Nama Kontak</span>
            <div class="col-md-3 col-form-label ">Nomor Kontak</div>
            <div class="col-md-3 col-form-label ">Alamat</div>
            <div class="col-md-3 col-form-label ">Jenis Kontak</div>
        </div>
        <div class="input-group">
            <div class="col-md-3">
                <input type="text" class="form-control" name="namaKontak[]" placeholder="Nama Kontak">
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" id="nomorKontak-id" name="nomorKontak[]" placeholder="Nomor Kontak">
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" name="alamatKontak[]" placeholder="Alamat">
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control" name="type_contact[]" placeholder="Hubungan">
            </div>
            {{--  <div class="col-md-2">
                <select class="form-control selectize" id="type[]" name="type_contact[]">
                    <option value="" selected disabled>{{ __('Pilih Hubungan') }}</option>
                    <option class="form-control" value="teman" >Teman</option>
                    <option class="form-control" value="saudara">Saudara</option>
                    <option class="form-control" value="tetangga" >Tetangga</option>
                </select>
            </div>  --}}
            <div class="input-group-addon ml-3">
                <a href="javascript:void(0)" class="btn btn-success addMoreKontak"><i class="fas fa-plus"></i></a>
            </div>
        </div>
    </div>

    {{--  start form tambahan kontak   --}}
    <div class="form-group fieldGroupCopy2" style="display: none;">
        <div class="row">
            <span class="col-md-3 col-form-label ">Nama Kontak</span>
            <div class="col-md-3 col-form-label ">Nomor Kontak</div>
            <div class="col-md-3 col-form-label ">Alamat</div>
            <div class="col-md-3 col-form-label ">Hubungan</div>
        </div>
        <div class="input-group">
            <div class="col-md-3">
                <input id="tambahan-nama-kontak" type="text" class="form-control" name="namaKontak[]" placeholder="Nama Kontak">
            </div>
            <div class="col-md-3">
                <input id="tambahan-nomor-kontak" type="text" class="form-control" name="nomorKontak[]" placeholder="Nomor Kontak">
            </div>
            <div class="col-md-3">
                <input id="tambahan-alamat-kontak" type="text" class="form-control" name="alamatKontak[]" placeholder="Alamat">
            </div>
            <div class="col-md-2">
                <input id="tambahan-hub-kontak" type="text" class="form-control" name="type_contact[]" placeholder="Hubungan">
            </div>
            {{--  <div class="col-md-2">
                <select class="form-control selectize" id="type[]" name="type_contact[]">
                    <option value="" selected disabled>{{ __('Pilih Hubungan') }}</option>
                    <option class="form-control" value="teman" >Teman</option>
                    <option class="form-control" value="saudara">Saudara</option>
                    <option class="form-control" value="tetangga" >Tetangga</option>
                </select>
            </div>  --}}
            <div class="input-group-addon">
                <a href="javascript:void(0)" class="btn btn-danger remove2"><i class="fas fa-trash"></i></a>
            </div>
        </div>
    </div>
    {{--  end form tambahan kontak  --}}

    <div class="form-group">
        <div class="col-md-8">
            <button type="submit" class="btn btn-primary offset-md-3 default-button">
                {{ __('Simpan') }}
            </button>
        </div>
    </div>

</form>


{{--  end form contact   --}}
