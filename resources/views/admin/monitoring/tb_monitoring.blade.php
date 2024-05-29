<div class="search-container d-flex align-items-end flex-column">
    <div align="right">
    <ul class="pagination justify-content-right" >
    <form action="{{route('monitoringView')}}" method="get" role="search" id="search_logg">
        <input type="text" placeholder="Search.." name="search" class="form-control searchInput">
        <!-- <button type="submit" class="btn btn-primary"><i class="fa fa-search fa-sm"></i></button> -->
        </form>
        </ul>
    </div>
</div>

<div class="table-responsive">
    <table class="table align-items-center">
    <thead class="thead-light">
        <tr>
			<th scope="col">No.</th>
            <th scope="col">Name</th>
            <th scope="col">Record User</th>
			<th scope="col">Detail Record</th>
            <th scope="col">Date</th>
        </tr>
    </thead>
    <tbody>
	@if($monitoringData->count() == null || $monitoringData->count() == 0)
		<tr>
			<th colspan="6" class="text-center">
				"Data was not found or data is null"
			</th>
		</tr>
	@else
		<?php $i = 1;?>
		@foreach($monitoringData as $monitoring)
			<tr>
				<th scope="row">
				{{ $monitoringData->count() * ($monitoringData->currentPage() - 1) + $loop->iteration }}
				</th>
                <td>
					{{ $monitoring->fullname }}
				</td>
				<td>
				    {{ $monitoring->transaction_type }}
				</td>
				<td>
				    {{ $monitoring->transaction_val }}
				</td>
				<td>
				    {{ $monitoring->date_upload }}
				</td>
			</tr>
			<?php $i++?>
		@endforeach
	@endif
</div>
    </tbody>
</table><br>
<div class="d-flex justify-content-center">
	{{ $monitoringData->appends($_GET)->links() }}
</div>