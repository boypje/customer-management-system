@extends('layouts.backend')

@section('content')
@include('layouts.headers.cards')
<div class="container-fluid mt--7 bg-color" style="padding-top: 120px;">
    <div class="col-md-12 dashboard-bg-color">
	    <div class="card">
	        <div class="card-body">
	          <div class="tab-content mt-3">
	            <div class="text-center">
	                <h2>{{ __('Detail Report Payment Agent') }}</h2>
	            </div>

				<div class="search-container d-flex align-items-end flex-column">
	                <div align="right">
		                <ul class="pagination justify-content-right" >
			                <form action="#" method="get" role="search" id="search_logg">
			                    <input type="text" placeholder="Search.." name="search" class="form-control searchInput">
			                </form>
		                </ul>
	                </div>
	            </div>

	            <div class="form-group row" id="nama_detail_monitoring_agent-payment">
	            	<label class="col-sm-2"><b>{{ __('Nama Agent') }} :</b></label>
	            	<div><b>{{ __($data_agent->fullname) }}</b></div>
                    <div class="form-group col-md-8" >
	            		<a class="btn btn-outline-success btn-sm right" style="float: right !important;" href="{{ route('exportReportPayment',[$data_agent->id]) }}" target="_blank" title="Download Report Agent .xlsx"><i class="fas fa-file-excel"></i></a>
                    </div>
                </div>
	            <div class="table-responsive">
				    <table class="table align-items-center tb-customer">
				    <thead class="thead-light">
				        <tr>
							<th width="5%">No.</th>
							<th width="10%">No. Kontrak</th>
				            <th width="10%">Nama Nasabah</th>
				            <th width="7%">Tipe Payment</th>
				            <th width="33%">Payment Data</th>
				            <th width="10%">Nominal</th>
				            <th width="10%">Payment Date</th>
				            <th width="10%">Bukti Bayar</th>
				        </tr>
				    </thead>
				    <tbody>
					@if($data_customer_agent->count() == null || $data_customer_agent->count() == 0)
						<tr>
							<th colspan="6" class="text-center">
								"Data was not found or data is null"
							</th>
						</tr>
					@else
						@foreach($data_customer_agent as $customerDataAgent)
							<tr>
								<th scope="row">
								{{ $data_customer_agent->count() * ($data_customer_agent->currentPage() - 1) + $loop->iteration }}
								</th>
								<td>
									{{ $customerDataAgent->no_contract }}
								</td>
				                <td>
									{{ $customerDataAgent->nama_customer }}
								</td>
								<td>
									{{ $customerDataAgent->category_payment }}
								</td>
								<td>
									{{ $customerDataAgent->payments_description == null ? '-' : $customerDataAgent->payments_description }}
								</td>
								<td>
									Rp.{{ number_format(( $customerDataAgent->nominal ), 2) }}
								</td>
								<td>
									{{ $customerDataAgent->date_payments == null ? '-' : $customerDataAgent->date_payments }}
								</td>
								<td>
									<a class="btn btn-sm btn-primary" href="<?php echo asset("/store_bukti_bayar/$customerDataAgent->proof_of_payment")?>" target="_blank"><i class="far fa-eye"></i></a>
								</td>
							</tr>
						@endforeach
					@endif
				</div>
				    </tbody>
				</table><br>
				<div class="d-flex justify-content-center">
					{{ $data_customer_agent->appends($_GET)->links() }}
				</div>


	          </div>
	        </div>
	    </div>
  	</div>
</div>
<!-- core user js and form -->
<!-- end core user -->
@include('layouts.footers.auth')
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/datatables.min.css') }}">
@endpush
@push('js')
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/handlebars.js') }}"></script>
@endpush
