
<div class="search-container d-flex align-items-end flex-column">
    <div align="right">
    <ul class="pagination justify-content-right" >
    <form action="{{route('customer')}}" method="get" role="search" id="search">
		<table>
			<tr>
				<th>
					<input type="text" placeholder="Cari Kode" id="kode" name="kode" class="form-control searchInput">
				</th>
				<th>
					<input type="text" placeholder="Cari Nama" id="nama" name="nama" class="form-control searchInput">
				</th>
				<th>
					<input type="text" placeholder="Cari Nomor Telp" id="phone" name="phone" class="form-control searchInput">
				</th>
				<th>
					<input type="text" placeholder="Cari Email" id="email" name="email" class="form-control searchInput">
				</th>
			</tr>
		</table>
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
			<!-- <th width="7%">Platform</th> -->
            <th width="15%">@sortablelink('nama_customer', 'Name')</th>
			<th width="10%">@sortablelink('email', 'Email')</th>
			<th width="10%">Phone</th>
			<th width="10%">Phone Spouse</th>
			<th width="10%">@sortablelink('nominal', 'Nominal')</th>
            <th width="5%">re payment</th>
            @hasanyrole('Super Admin|Desk Collection|Admin|Collection Manager')			
            <!-- <th width="15%">@sortablelink('latestRemark.remark_type', 'Coll. Remark')</th>
			<th width="15%">@sortablelink('latestRemark.remark_type', 'Call Remark')</th> -->
            <th width="10%">Action</th>
            @endhasanyrole
        </tr>
    </thead>
    <tbody>
	@if($dataTB->count() == null || $dataTB->count() == 0)
		<tr>
			<th colspan="9" class="text-center">
				"Data was not found"
			</th>
		</tr>
	@else
	
		<?php $i = 1;?>
		@foreach($dataTB as $data)
			<tr>
				<th scope="row">
					{{ $dataTB->count() * ($dataTB->currentPage() - 1) + $loop->iteration }}
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

					@if ($data->phone != null)
						<button id="ph_{{ $data->id }}" class="btn btn-sm btn-success phone" onclick="startCall('{{ $data->id }}', '{{ $data->phone }}')">Call {{ $data->phone }}</button>
					@else
						<button disabled>No Phone Available</button>
					@endif

					<!-- @if(isset(json_decode($data->others)->mobile_phone))
					{!! empty(json_decode($data->others)->mobile_phone) ? '-' : '<a href="sip:'. json_decode($data->others)->mobile_phone .'">'.json_decode($data->others)->mobile_phone .'</a>' !!}
					@else
					{!! empty(json_decode($data->others)->phone1) ? '-' : '<a href="sip:'. json_decode($data->others)->phone1 .'">'.json_decode($data->others)->phone1 .'</a>' !!}
					@endif -->
				</td>
				<td>
					-
				</td>
				<td class="tagihan">
					Rp.{!! number_format(( (int)$data->nominal ), 2) !!}
				</td>
				<td>
						Rp.{!! number_format(( (int)$data->nominal - $data->customer_payments->sum('nominal') ), 2) !!}
					@if( $data->customer_payments->where('proof_of_payment','!=',null)->sum('nominal') == 0 )

					@else
					    <br><span style="opacity: 55%; color:#13bf40;">Rp.{!! number_format(( (int)$data->customer_payments->where('proof_of_payment','!=',null)->sum('nominal') ), 2) !!}<li class="ni ni-check-bold"></li></span>
					@endif
				</td>
				@hasanyrole('Super Admin|Desk Collection|Admin|Collection Manager')
				

				<td>
					<a class="btn btn-sm btn-success" href="{{ route('viewDataCustomer',[$data->id]) }}" target="_blank">Detail</a><br>
				</td>
				@endhasanyrole
			</tr>
			<?php $i++?>
		@endforeach
	@endif
</div>
    </tbody>
</table><br>
<div class="d-flex justify-content-center">
	
	{{ $dataTB->appends($_GET)->links() }}
</div>
</div>
<input type="hidden" name="returnId" id="returnId">
@include('admin.customer.modal_remak_payment')
@include('admin.customer.modal_remak_aftercall')

<script>
	$(function(){
		// $(".searchInput").change(function(){
		// 	$("#search").submit();
		// });
		$(".searchInput").keydown(function(event){
			if (event.keyCode === 13) { // Check if the pressed key is Enter
				$("#search").submit(); // Submit the form with id "search"
			}
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
		case 'broken_ptp_contacted':
			var title = 'Broken PTP';
			var input_nominal = false;
			var input_file = false;
			var input_text = true;
			break;
		case 'already_paid':
			var title = 'Already Paid';
			var display_tagihan = true;
			var input_nominal = true;
			var total_payment = true; //mengisi value full_payment
			var input_file = true;
			var input_text = true;
			break;
		case 'escalated':
			var title = 'Escalated';
			var input_nominal = false;
			var input_file = false;
			var input_text = true;
			break;
		case 'language_not_communcable':
			var title = 'Language Not Communcable';
			var input_nominal = false;
			var input_file = false;
			var input_text = true;
			break;
		case 'partial_recovered':
			var title = 'Partial Recovered';
			var display_tagihan = true;
			var input_nominal = true;
			var input_file = true;
			var input_text = true;
			break;
		case 'promise_to_pay_follow_up':
			var title = 'Promise to Pay Follow Up (Contacted)';
			var input_nominal = false;
			var input_file = false;
			var input_text = true;
			break;
		case 'promise_to_settelment':
			var title = 'Promise To Settelment';
			var input_nominal = false;
			var input_file = false;
			var input_text = true;
			break;
		case 'refused_to_pay':
			var title = 'Refused To Pay';
			var input_nominal = false;
			var input_file = false;
			var input_text = true;
			break;
		case 'confirmation_pending':
			var title = 'Confirmation Pending';
			var input_nominal = false;
			var input_file = false;
			var input_text = true;
			break;
		case 'fraud_cheating':
			var title = 'Fraud/ Cheating';
			var input_nominal = false;
			var input_file = false;
			var input_text = true;
			break;
		case 'callback':
			var title = 'Callback';
			var input_nominal = false;
			var input_file = false;
			var input_text = true;
			break;
		case 'broken_ptp_uncontacted':
			var title = 'Broken PTP (Uncontacted)';
			var input_nominal = false;
			var input_file = false;
			var input_text = true;
			break;
		case 'ptp':
			var title = 'Promise To Pay';
			var input_nominal = false;
			var input_file = false;
			var input_date = true
			var input_text = true;
			break;
		case 'promise_to_pay_uncontacted':
			var title = 'Promise To Pay Follow Up (Uncontacted)';
			var input_nominal = false;
			var input_file = false;
			var input_text = true;
			break;
		case 'ringing_no_respon':
			var title = 'Ringing No Respon/Call Waiting';
			var input_nominal = false;
			var input_file = false;
			var input_text = true;
			break;
		case 'referted_over_email':
			var title = 'Referted Over Email/Phone';
			var input_nominal = false;
			var input_file = false;
			var input_text = true;
			break;
		case 'switch_off':
			var title = 'Switch off/ Not Reacheble';
			var input_nominal = false;
			var input_file = false;
			var input_text = true;
			break;
		case 'wrong_contact':
			var title = 'Wrong Cantact Number';
			var input_nominal = false;
			var input_file = false;
			var input_text = true;
			break;
		case 'invalid_assignment':
			var title = 'Invalid Assignment';
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

	  }

	  $("#RemarkModal").modal('show');
	  $("#RemarkModalAftercall").modal('hide');
	//   $("#id-remark").val(document.querySelector('.phone').id);
	  $("#id-typ-remark").val(select_val);
	  $('#usr_id').val($('#returnId').val());
	  $('#statusRemarked').val(title);
	  $("#label-remark").text(title);
	  $('#date-payment').datepicker({'format': 'yyyy-mm-dd', 'autoclose' : true});
	//   $('#date-payment').datepicker('setDate','today');
	  input_date ? $("div#datePayment").css('display', 'block') : $("div#datePayment").css('display', 'none');
	  display_tagihan ? $("div#tagihanCustomers").css('display', 'block') : $("div#tagihanCustomers").css('display', 'none');
	  input_nominal ? $("div#nominal").css('display', 'block') : $("div#nominal").css('display', 'none');
	  input_file ? $("#Bukti_Bayar").css('display', 'block') : $("#Bukti_Bayar").css('display', 'none');
	  input_text ? $("div#ket").css('display', 'block') : $("div#ket").css('display', 'none');
	  total_payment ? $("#nominalPayment").val() : $("#nominalPayment").val();
	});

	$(".remark-btn").click(function(){
		var trimStr = $.trim($(".remark-btn").text());
	  // console.log(trimStr)
	});

	

	function checkDateMatch() {
		// Get the current date
		var currentDate = new Date();
		var currentDay = currentDate.getDate();

		// Array of dates from 1 to 30
		var datesArray = Array.from({length: 30}, (_, i) => i + 1);
		// console.log(datesArray)
		// Check if the current date matches any date in the array
		if (datesArray.includes(currentDay)) {
			return 1; // Return 1 if there's a match
		}
	}

	// Call the function to check for a date match
	var result = checkDateMatch();
	if (result) {
		
		$.ajax({
			url: "{{ route('updateDPD') }}", // Replace with your server-side endpoint URL
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: 'POST',
			data: { increaseDay: result }, // Sending result as data
			success: function(response) {
				// console.log('Result posted successfully');
				console.log(response)
			},
			error: function(xhr, status, error) {
				// console.error('Error posting result:', error);
			}
		});
	}
	// console.log(result);

	function startCall(id, phoneNumber) {
        // Change button to end call button with danger class
        var button = document.getElementById("ph_" + id);
        button.innerHTML = "End Call";
        button.classList.remove("btn-primary"); // Remove primary class if any
        button.classList.add("btn-danger"); // Add danger class
        button.onclick = function() {
            endCall(id, phoneNumber);
        };
		window.open('sip:'+phoneNumber)
		var dateNowStart = new Date().toLocaleString();
		var paymentArr = ['already_paid','partial_recovered'];
		var typ_remark = $('#id-typ-remark').val();
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: "{{ route('remarkCustomer') }}",
			type: "POST",
			data: { customerId: id, dateNowStart: dateNowStart, phone:phoneNumber },
			success: function(data){
				$('#returnId').val(data[0])
				console.log(data);
			},
			error: function(data){
				console.error("Error:", data);
			}
		});
    }

    function endCall(id, phoneNumber) {
        var button = document.getElementById("ph_" + id);
        button.innerHTML = "Call " + phoneNumber;
        button.classList.remove("btn-danger"); // Remove danger class
        button.classList.add("btn-primary"); // Add primary class
        button.onclick = function() {
            startCall(id, phoneNumber);
        };
		$('#remarkCustomer')[0].reset();
		$('#id-remark').val(id);
		$("#RemarkModalAftercall").modal('show');
		var dateNowStart = new Date().toLocaleString();
		$('#dateTimeStartDashboard').val(dateNowStart);

		$('#btn-cancel-closeModal').on('click', function () {
			$("#RemarkModal").modal('hide');
			$("#remarkCustomer")[0].reset();
			$("#RemarkModalAftercall").modal('show');
			$("#remarkCustomer")[0].reset();
		});

    }
</script>