<div class="row">
  <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              @hasanyrole('Super Admin|Desk Collection|Leader DC')
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Agent Data</p>
              <h5 class="font-weight-bolder">
                Total data semua agent <u><b><?php echo count($customer);?></b></u> Data
              </h5>
              @endhasanyrole
              @hasanyrole('Admin|Collection Manager')
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Customer Data</p>
              <h5 class="font-weight-bolder">
                Total data semua agent <u><b><?php echo count($customer);?></b></u> Data
              </h5>
              @endhasanyrole
              <p class="mb-0">
                <span class="text-success text-sm font-weight-bolder"></span>
              </p>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="i` icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
              <i class="ni ni-chart-pie-35" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@hasanyrole('Super Admin|Desk Collection|Leader DC|Collection Manager')
  <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Total remarked data</p>
              <h5 class="font-weight-bolder">
                Total data agent yang sudah di remark <u><b><?php echo count($remark);?></b></u> Data
              </h5>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
              <i class="ni ni-check-bold" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endhasanyrole
  <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              @hasanyrole('Super Admin|Desk Collection|Leader DC|Collection Manager')
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Payment</p>
              <h5 class="font-weight-bolder">
                Total data data customer yang sudah melakukan pembayaran adalah <u><b><?php echo count($payment);?></b></u> Data
              </h5>
              @endhasanyrole

              @hasanyrole('Admin')
              <p class="text-sm mb-0 text-uppercase font-weight-bold">verified payment data</p>
              <h5 class="font-weight-bolder">
                Total data data customer yang sudah melakukan pembayaran adalah <u><b><?php echo count($payment);?></b></u> Data
              </h5>
              @endhasanyrole
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
              <i class="ni ni-money-coins" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>