{{--  start form sosmed customer  --}}

<form id="sosmed-form" action="{{ route('addSosmedCustomer') }}" class="ajax-form" method="POST" style="display: none">
    <br>
    <h2>{{ __('Update Sosial Media Customer') }}</h2>
    <br>
    <input type="hidden" name="id" id="idCustomers">
    @csrf
    <div class="form-group fieldGroup">
        <div class="row">
            <span class="col-md-3 col-form-label ">Facebook</span>
            <div class="col-md-3 col-form-label ">Twitter</div>
            <div class="col-md-2 col-form-label ">Instagram</div>
            <div class="col-md-3 col-form-label ">Lain - Lain</div>
        </div>
        <div class="input-group">
            <div class="col-md-3">
                <input type="text" class="form-control" name="fb[]" placeholder="Facebook">
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" name="tw[]" placeholder="Twitter">
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control" name="ig[]" placeholder="Instagram">
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" name="oth[]" placeholder="Lain - lain">
            </div>
            <div class="input-group-addon ml-3">
                <a href="javascript:void(0)" class="btn btn-success addMore"><i class="fas fa-plus"></i></a>
            </div>
        </div>

    </div>

    {{--  start add form tambahan  --}}
    <div class="form-group fieldGroupCopy1" style="display: none;">
        <div class="row">
            <span class="col-md-3 col-form-label ">Facebook</span>
            <div class="col-md-3 col-form-label ">Twitter</div>
            <div class="col-md-2 col-form-label ">Instagram</div>
            <div class="col-md-3 col-form-label ">Lain - Lain</div>
        </div>
        <div class="input-group">
            <div class="col-md-3">
                <input type="text" class="form-control" name="fb[]" placeholder="Facebook">
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" name="tw[]" placeholder="Twitter">
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control" name="ig[]" placeholder="Instagram">
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" name="oth[]" placeholder="Lain - lain">
            </div>
            <div class="input-group-addon">
                <a href="javascript:void(0)" class="btn btn-danger remove"><i class="fas fa-trash"></i></a>
            </div>
        </div>
    </div>
    {{--  end add form  tambahan --}}

    <div class="form-group">
        <div class="col-md-8">
            <button type="submit" class="btn btn-primary offset-md-3 default-button">
                {{ __('Simpan') }}
            </button>
        </div>
    </div>
</form>
{{--  end form sosmed costomer  --}}
</div>
{{--  end display data customer  --}}
