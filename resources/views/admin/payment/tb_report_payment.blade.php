<div class="form-group row">
	<div class="form-group col-md-1"><p><bold>Pilih Tim :</bold></p></div>
		<div class="form-group col-md-4">
			<form action="{{ route('reportPayment') }}" method="get">
				<select class="selectize" id="id_tim_report_remark" name="tim">
					<option selected disabled>Nama Tim</option>
					@foreach($tim as $key_tim => $val_tim)
						@if($val_tim->id == $id_tim)
							<option selected value='{{$val_tim->id}}'>{{$val_tim->nama}}</option>
						@else
							<option value='{{$val_tim->id}}'>{{$val_tim->nama}}</option>
						@endif
					@endforeach
				</select>
				<button type="submit" id="btn_find_data" class="btn btn-outline-primary">Cari Data</button>
			</form>
		</div>
		<!-- <div class="form-group col-md-2">
			<button type="submit" id="btn_find_data" class="btn btn-outline-primary">Cari Data</button>
		</div> -->
	<div class="form-group col-md-7" >
		<div style="float: right !important;">
			<ul class="pagination justify-content-right" >
				<form action="{{route('reportPayment')}}" method="get" role="search" id="search_logg">
					<input type="text" placeholder="Search.." name="search" class="form-control searchInput">
				</form>
			</ul>
		</div>
	</div>
</div>

<div class="table-responsive">
    <table class="table align-items-center">
    <thead class="thead-light">
        <tr>
			<th scope="col">No.</th>
            <th scope="col">kontrak</th>
            <th scope="col">Customer Name</th>
			<th scope="col">@sortablelink('date_payment', 'TGL Bayar')</th>
            <th scope="col">Nominal</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
	@if($paymentData->count() == null || $paymentData->count() == 0)
		<tr>
			<th colspan="7" class="text-center">
				"Data was not found or data is null"
			</th>
		</tr>
	@else
		<?php $i = 1;?>
		@foreach($paymentData as $data)
			<tr>
				<th scope="row">
				{{ $paymentData->count() * ($paymentData->currentPage() - 1) + $loop->iteration }}
				</th>
                <td>
					{{ $data['customer_payments']->customer_id }}
				</td>
				<td>
				    {{ $data['customer_payments']->nama_customer }}
				</td>
				<td>
				    {{ ($data->date_payment == null) ? $data->created_at : $data->date_payment }}
				</td>
				<td>
				    Rp.{{ number_format(($data->nominal), 2) }}
				</td>
				<td>
					@if($data->proof_of_payment != null)
				    	<a class="btn btn-sm btn-primary" href="<?php echo asset("/store_bukti_bayar/$data->proof_of_payment")?>" target="_blank"><i class="far fa-eye"></i></a>
				    @else
				    	<a class="btn btn-sm btn-sencondary disabled" href="#" target="_blank"><i class="far fa-eye"></i></a>
				    @endif

				    @if($data->	verified == 0 && $data->proof_of_payment != null)
				    	<a class="btn btn-sm btn-success" href="{{ route('verifyProofOfPayment',[$data->id]) }}"><i class="fas fa-check"></i> verified</a>
				    @else
				    	<a class="btn btn-sm btn-sencondary disabled" href="#"><i class="fas fa-check"></i> Verif</a>
				    @endif

				</td>
			</tr>
			<?php $i++?>
		@endforeach
	@endif
</div>
    </tbody>
</table><br>
<div class="d-flex justify-content-center">
	{{ $paymentData->appends($_GET)->links() }}
</div>