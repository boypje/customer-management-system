
<div class="search-container d-flex align-items-end flex-column">
    <div align="right">
    <ul class="pagination justify-content-right" >
    <form action="{{route('customer')}}" method="get" role="search" id="search">
        <input type="text" placeholder="Search.." name="search" class="form-control searchInput">
        <!-- <button type="submit" class="btn btn-primary"><i class="fa fa-search fa-sm"></i></button> -->
        </form>
        </ul>
    </div>
</div>
<div id="flash-msg" class="alert" style="width: 20%;display: none;"></div>
<div class="table-responsive tb-customer">
    <table class="table align-items-center" id="customer-table" width="100%">
    <thead class="thead-light">
        <tr>
        	<th width="5%">NO</th>
            <th width="10%">@sortablelink('customer_id', 'Kode')</th>
            <th width="15%">@sortablelink('nama_customer', 'Name')</th>
			<th width="10%">@sortablelink('email', 'Email')</th>
			<th width="10%">Number</th>
			<th width="10%">@sortablelink('nominal', 'Nominal')</th>
            <th width="10%">re payment</th>
        </tr>
    </thead>
    <tbody>
	@if($dataCustomer->count() == null || $dataCustomer->count() == 0)
		<tr>
			<th colspan="9" class="text-center">
				"Data was not found"
			</th>
		</tr>
	@else
		<?php $i = 1;?>
		@foreach($dataCustomer as $data)
			<tr>
				<th scope="row">
					{{ $dataCustomer->count() * ($dataCustomer->currentPage() - 1) + $loop->iteration }}
				</th>
				<td>
					{{ $data->customer_id }}
				</td>
				<td>
					{{ $data->nama_customer }}
				</td>
				<td>
					{{ $data->email == null ? '-' : $data->email }}
				</td>
				<td>
					
				{{ $data['contacts'][0]->number_contact }}
				</td>
				<td>
					Rp.{{ number_format(( $data->nominal ), 2) }}
				</td>
				<td>
						Rp.{{ number_format(( $data->nominal - $data->customer_payments->sum('nominal') ), 2) }}
					@if( $data->customer_payments->where('proof_of_payment','!=',null)->sum('nominal') == 0 )
					
					@else
					    <br><span style="opacity: 55%; color:#13bf40;">Rp.{{ number_format(( $data->customer_payments->where('proof_of_payment','!=',null)->sum('nominal') ), 2) }}<li class="ni ni-check-bold"></li></span>
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
	
	{{ $dataCustomer->appends($_GET)->links() }}
</div>
</div>


<script>
	$(function(){
		$(".searchInput").change(function(){
			$("#search").submit();
		});
	});

	$('.custom-select').on('change', function () {
	  //ways to retrieve selected option and text outside handler	  
	  var date = new Date();	  
	  document.getElementById("remarkCustomer").reset();	  
	  var input_nominal = false;
	  var input_file = false;
	  var input_text = false;
	  var total_payment = false;
	  var select_val = this.value;
	  var arrayId = $(this).attr("id").split("-");
	  var id = arrayId[2];
	  switch(select_val){
		case 'partial_payment':
			var title = 'Partial Payment';
			var input_nominal = true;
			var input_file = true;
			var input_text = true;
			break;
		case 'full_payment':
			var title = 'Full Payment';
			var input_nominal = true;
			var total_payment = true; //mengisi value full_payment
			var input_file = true;
			var input_text = true;
			break;
		case 'promise_to_pay':
			var title = 'Promise to Pay';
			var input_nominal = false;
			var input_file = false;
			var input_text = true;
			break;
		case 'no_answer':
			var title = 'No Answer';
			var input_nominal = false;
			var input_file = false;
			var input_text = true;
			break;
		case 'other':
			var title = 'Other Reason';
			var input_nominal = false;
			var input_file = false;
			var input_text = true;
			break;
		case 'invalid_number':
			var title = 'Invalid Number';
			var input_nominal = false;
			var input_file = false;
			var input_text = true;
			break;
		case 'centang1':
			var title = 'Centang 1';
			var input_nominal = false;
			var input_file = false;
			var input_text = true;
			break;
		case 'centang2':
			var title = 'Centang 2';
			var input_nominal = false;
			var input_file = false;
			var input_text = true;
			break;
		case 'no_wa':
			var title = 'No WA';
			var input_nominal = false;
			var input_file = false;
			var input_text = true;
			break;
	  }
	  $("#RemarkModal").modal('show');
	  $("#id-remark").val(id);
	  $("#id-typ-remark").val(select_val);
	  $("#label-remark").text(title);
	  $('#date-payment').datepicker({'format': 'yyyy-mm-dd', 'autoclose' : true});
	  $('#date-payment').datepicker('setDate','today');
	  input_nominal ? $("div#nominal").css('display', 'block') : $("div#nominal").css('display', 'none');
	  input_file ? $("#Bukti_Bayar").css('display', 'block') : $("#Bukti_Bayar").css('display', 'none');
	  input_text ? $("div#ket").css('display', 'block') : $("div#ket").css('display', 'none');
	  total_payment ? $("#nominalPayment").val(arrayId[3] - arrayId[4]) : $("#nominalPayment").val();
	});

	$(".remark-btn").click(function(){
		var trimStr = $.trim($(".remark-btn").text());
	  // console.log(trimStr)
	});


</script>