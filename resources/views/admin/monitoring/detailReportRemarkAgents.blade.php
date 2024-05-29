@extends('layouts.backend')

@section('content')
@include('layouts.headers.cards')
<div class="container-fluid mt--7 bg-color" style="padding-top: 120px;">
    <div class="col-md-12 dashboard-bg-color">
	    <div class="card">
	        <div class="card-body">
	          <div class="tab-content mt-3">
	            <div class="text-center">
	                <h2>{{ __('Detail Report Remark Agent') }}</h2>
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

	            <div class="form-group row" id="nama_detail_monitoring_agent">
	            </div>

	            <div class="form-group row" id="id_select_remark_cus">
	            	<label class="col-sm-2"><b>{{ __('Nama Agent') }} :</b></label>
	            	<div><b>{{ __($data_agent->fullname) }}</b></div>
                    <div class="form-group col-md-8" >
	            		<a class="btn btn-outline-success btn-sm right" style="float: right !important;" href="{{ route('exportReportRemark',[$data_agent->id]) }}" target="_blank" title="Download Report Agent .xlsx"><i class="fas fa-file-excel"></i></a>
                    </div>
                </div><br>
	            <div class="table-responsive">
				    <table class="table align-items-center">
				    <thead class="thead-light">
				        <tr>
							<th scope="col">No.</th>
							<th scope="col">No. Kontrak</th>
				            <th scope="col">Nama Nasabah</th>
				            <th scope="col">Tipe Remark</th>
				            <th scope="col">Remark Data</th>
							<th scope="col">Remark Kategori</th>
				            <th scope="col">Remark Date</th>
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
									{{ $customerDataAgent->remark_type }}
								</td>
								<td>
									{{ $customerDataAgent->date_remark == null ? '-' : $customerDataAgent->remark_description }}
								</td>
								<td>
									{{ $customerDataAgent->category == null ? '-' : $customerDataAgent->category }}
								</td>
								<td>
									{{ $customerDataAgent->date_remark == null ? '-' : $customerDataAgent->date_remark }}
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
