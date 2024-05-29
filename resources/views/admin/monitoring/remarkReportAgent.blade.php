@extends('layouts.backend')

@section('content')
@include('layouts.headers.cards')
<div class="container-fluid mt--7 bg-color" style="padding-top: 120px;">
    <div class="col-md-12 dashboard-bg-color">
	    <div class="card">
	        <div class="card-body">
	          <div class="tab-content mt-3">
	            <div class="text-center">
	                <h2>{{ __('Monitoring Remark Agent') }}</h2>
	            </div><br>


	            <div class="form-group row">
	            	<div class="form-group col-md-1"><p><bold>Pilih Tim :</bold></p></div>
		            	<div class="form-group col-md-2">
	            		<form action="{{ route('reportRemarkAgent') }}" method="get">
		            		<select class="selectize" id="id_tim_report_remark" name="tim">
		            			<option selected disabled>Nama Tim</option>
			            		@foreach($tim as $key_tim => $val_tim)
			            			<!-- <option value='{{$val_tim->id}}'>{{$val_tim->nama}}</option> -->
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
                    <div class="form-group col-md-9" >
                    	<div style="float: right !important;">
		            		<ul class="pagination justify-content-right" >
				                <form action="{{route('reportRemarkAgent')}}" method="get" role="search" id="search_logg">
				                    <input type="text" placeholder="Search.." name="search" class="form-control searchInput">
				                </form>
			                </ul>
		            	</div>
                    </div>
                </div>

				<div class="form-group col-md-11">
					<a id="exportReportLink" class="btn btn-outline-success btn-sm right" style="float: right !important;" href="#" target="_blank" title="Download Report Agent .xlsx">
						<i class="fas fa-file-excel"></i>
					</a>
				</div>
	            <div class="table-responsive">
				    <table class="table align-items-center">
				    <thead class="thead-light">
				        <tr>
							<th scope="col">No.</th>
				            <th scope="col">Name Agent</th>
				            <th scope="col">Jumlah Data Agent</th>
				            <th scope="col">Remark Agent</th>
							<!-- <th scope="col">Payment Agent</th> -->
				            <th scope="col">Action</th>
				        </tr>
				    </thead>
				    <tbody>
					@if($data_remark->count() == null || $data_remark->count() == 0)
						<tr>
							<th colspan="6" class="text-center">
								"Data was not found or data is null"
							</th>
						</tr>
					@else
						@foreach($data_remark as $dataAgentRemarks)
							<tr>
								<th scope="row">
								{{ $data_remark->count() * ($data_remark->currentPage() - 1) + $loop->iteration }}
								</th>
				                <td>
									{{ $dataAgentRemarks->fullname }}
								</td>
								<td>
									{{ count($dataAgentRemarks['customer']) }}
								</td>
								<td>
									{{ count($dataAgentRemarks['remarks']) }}
								</td>
								<td>
									<a class="btn btn-sm btn-primary" href="{{ route('detailReportRemark',[$dataAgentRemarks->id]) }}" target="_blank">Detail</a><br>
								</td>
							</tr>
						@endforeach
					@endif
				</div>
				    </tbody>
				</table><br>
				<div class="d-flex justify-content-center">
					{{ $data_remark->appends($_GET)->links() }}
				</div>


	          </div>
	        </div>
	    </div>
  	</div>
</div>
<script type="text/javascript">
	$('#id_tim_report_remark').selectize({      
		// sortField: 'text',
		allowEmptyOption: false,
		create: false,
		onchange: function(value){
				
		},
	});
	// var valueTim = document.getElementById('id_tim_report_remark').value;
	document.addEventListener("DOMContentLoaded", function() {
        var valueTim = document.getElementById('id_tim_report_remark').value;
        var exportReportLink = document.getElementById('exportReportLink');
		// console.log(valueTim);
        exportReportLink.href = "{{ route('exportTimReportRemark', ['id' => '']) }}" + '/' + valueTim;
    });
	// $('#exportBtn').click(function() {
	// 	var valueTim = document.getElementById('id_tim_report_remark').value;
	// 	$.ajax({
	// 		type: 'GET',
	// 		url: '{{ route('exportTimReportRemark', ['id' => ':valueTim']) }}'.replace(':valueTim', valueTim),
	// 		data: {},
	// 		success: function(response) {
	// 			// Handle success response here
	// 			window.open(response, '_blank');
	// 		},
	// 		error: function(xhr, status, error) {
	// 			// Handle error response here
	// 			console.error(xhr.responseText);
	// 		}
	// 	});
	// });
</script>
<!-- core user js and form -->
<!-- end core user -->
@include('layouts.footers.auth')
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/datatables.min.css') }}">
    <link href="{{ asset('assets/vendor/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" />
@endpush
@push('js')
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/handlebars.js') }}"></script>
    <script src="{{ asset('assets/vendor/selectize/js/standalone/selectize.min.js') }}"></script>
@endpush
