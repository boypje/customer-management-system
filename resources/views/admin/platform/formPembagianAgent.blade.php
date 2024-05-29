
<div id="showFormPembagianAgent" style="display: none;">
    <form id="manageAgent-form" class="ajax-form" enctype="multipart/form-data" >
        <input type="hidden" name="id" id="id">
        @csrf
            &nbsp&nbsp<h3 class="zheading-small text-muted mb-5">{{ __('Set Tim Agent') }}</h3>
        <div class="form-group row">
            <span class="col-md-3 col-form-label text-md-right labelclass">{{ __('Pilih Klien') }}</span>
            <div class="col-md-3">
                <!-- <input id="klien" type="text" class="form-control @error('klien') is-invalid @enderror" name="klien" value="" required autofocus placeholder="{{ __('Cari Nama Tim') }}"> -->
                <select id="klien" name="klien" required>
                    <option value="" disabled>Select an option</option>
                    @foreach($tim as $key => $value)
                        <option value="{{ $value->id }}">{{ $value->client_name }}</option>
                    @endforeach
                </select>
                @error('klien')
                    <span class="invalid-feedback" permission="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <script>
                     $("#klien").selectize({
                        allowEmptyOption: true,
                        placeholder: "Pilih Nama Tim",
                        create: false,
                        multiple: false // Enable multiple selection
                    });
                </script>
            </div>
            <span class="col-md-1 col-form-label labelclass">{{ __('Pilih Agen') }}</span>
            <div class="col-md-3">
                <!-- <input id="nama_agen" type="text" class="form-control @error('nama_agen') is-invalid @enderror" name="nama_agent[]" required autocomplete="" placeholder="{{ __('Cari Nama Agent') }}"> -->
                <select id="nama_agent" name="nama_agent[]" multiple required>
                    <option value="" disabled>Select an option</option>
                    @foreach($namaAgent as $key => $value)
                        <option value="{{ $value->id }}">{{ $value->fullname }}</option>
                    @endforeach
                </select>
                <script>
                     $("#nama_agent").selectize({
                        allowEmptyOption: true,
                        placeholder: "Pilih Nama Agent",
                        create: false,
                        multiple: true // Enable multiple selection
                    });
                </script>
                @error('nama_agen')
                    <span class="invalid-feedback" permission="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <!-- <div class="form-group row">
            <span class="col-md-3 col-form-label text-md-right labelclass">{{ __('List Agent') }}</span>
            <div class="col-md-3">
                <textarea id="listAgent" type="text" class="form-control @error('listAgent') is-invalid @enderror" name="listAgent[]" value="" style="width: 400px;height: 180px;" autofocus></textarea>
                <input type="hidden" id="listIdAgent" name="listIdAgent[]">
                @error('listAgent')
                    <span class="invalid-feedback" permission="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div> -->
        <br> 
        <div class="form-group">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary offset-md-3">
                    {{ __('Submit') }}
                </button>
                <button type="button" id="backPembagianAgent" class="btn btn-danger offset-md-1">
                    {{ __('Kembali') }}
                </button>
            </div>
        </div>
    </form>
</div>