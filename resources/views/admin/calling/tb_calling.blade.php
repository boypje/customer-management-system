    <div class="form-group row">
        <div class="form-group col-md-1"><p><bold>Pilih Tim :</bold></p></div>
            <div class="form-group col-md-4">
                <form action="{{ route('reportCallingReportAgent') }}" method="get">
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
                    <input type="text" id="datepickerCallReport" name="date" placeholder="Pilih Tanggal">
                        <script>
                           var dateSelected = "<?php echo $dateSelected; ?>"; // Assuming $dateSelected is the PHP variable
                            // Assuming you have a datepicker input with id "datepicker"
                           $("#datepickerCallReport").datepicker("setDate", dateSelected);
                           $("#datepickerCallReport").datepicker({
                                format: "mm/dd/yyyy",
                                todayHighlight: true,
                                autoclose: true,
                            });
                        </script>
                    <button type="submit" id="btn_find_data" class="btn btn-outline-primary">Cari Data</button>
                </form>
            </div>
            <!-- <div class="form-group col-md-2">
                <button type="submit" id="btn_find_data" class="btn btn-outline-primary">Cari Data</button>
            </div> -->
        <div class="form-group col-md-7" >
            <div style="float: right !important;">
                <ul class="pagination justify-content-right" >
                    <form action="{{route('reportCallingReportAgent')}}" method="get" role="search" id="search_logg">
                        <input type="text" placeholder="Search.." name="search" class="form-control searchInput">
                    </form>
                </ul>
            </div>
        </div>
    </div>

    <div class="form-group col-md-11">
        <a id="exportCallingReportLink" class="btn btn-outline-success btn-sm right" style="float: right !important;" href="#" target="_blank" title="Download Calling Report .csv">
            <i class="fas fa-file-excel"></i>
        </a>
        <a id="collectionActivityReport" class="btn btn-outline-success btn-sm right" style="float: right !important;" href="#" target="_blank" title="Download Activity Report .csv">
            <i class="fas fa-file-excel"></i>
        </a>
    </div><br>

    <div class="table-responsive">
        <table class="table align-items-center">
        <thead class="thead-light">
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Nasabah</th>
                <th scope="col">Nomor Nasabah</th>
                <th scope="col">Waktu Awal</th>
                <th scope="col">Waktu Akhir</th>
                <th scope="col">Durasi</th>
                <th scope="col">Penelfon</th>
            </tr>
        </thead>
        <tbody>
        @if($callingreportData->count() == null || $callingreportData->count() == 0)
            <tr>
                <th colspan="7" class="text-center">
                    "Data was not found or data is null"
                </th>
            </tr>
        @else
            <?php $i = 1;?>
            @foreach($callingreportData as $callingReport)
                <tr>
                    <th scope="row">
                    {{ $callingreportData->count() * ($callingreportData->currentPage() - 1) + $loop->iteration }}
                    </th>
                    <td>
                        {{ $callingReport->nama_customer }}
                    </td>
                    <td>
                        {{ $callingReport->number }}
                    </td>
                    <td>
                        {{ $callingReport->call_start }}
                    </td>
                    <td>
                        {{ $callingReport->call_end }}
                    </td>
                    <td>
                        {{ $callingReport->duration }}
                    </td>
                    <td>
                        {{ $callingReport->fullname }}
                    </td>
                </tr>
                <?php $i++?>
            @endforeach
        @endif
    </div>
        </tbody>
    </table><br>
    <div class="d-flex justify-content-center">
        {{ $callingreportData->appends($_GET)->links() }}
    </div>

<script>
    // var valueTim = document.getElementById('id_tim_report_remark').value;
	document.addEventListener("DOMContentLoaded", function() {
        var valueTim = document.getElementById('id_tim_report_remark').value;
        var dateSelected = document.getElementById('datepickerCallReport').value;
        var parts = dateSelected.split("/");
        var formattedDate = parts[1] + "-" + parts[0] + "-" + parts[2];
        var idArray = [valueTim, formattedDate];
        var exportCallingReportLink = document.getElementById('exportCallingReportLink');
        exportCallingReportLink.href = "{{ route('exportCallingReportLink', ['id' => '']) }}" + '/' + JSON.stringify(idArray);

        // Initialize datepicker
        $('#datepickerCallReport').datepicker();
    });

    document.addEventListener("DOMContentLoaded", function() {
        var valueTim = document.getElementById('id_tim_report_remark').value;
        var dateSelected = document.getElementById('datepickerCallReport').value;
        var parts = dateSelected.split("/");
        var formattedDate = parts[1] + "-" + parts[0] + "-" + parts[2];
        var idArray = [valueTim, formattedDate];
        var collectionActivityReport = document.getElementById('collectionActivityReport');
        collectionActivityReport.href = "{{ route('collectionActivityReport', ['id' => '']) }}" + '/' + JSON.stringify(idArray);
    });
</script>