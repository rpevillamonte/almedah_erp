<script>
    /*
    window.onload = function() {

        var dataPoints = [];

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2",
            zoomEnabled: true,
            title: {
                text: "Bitcoin Price - 2017"
            },
            axisY: {
                title: "Price in USD",
                titleFontSize: 24,
                prefix: "$"
            },
            data: [{
                type: "line",
                yValueFormatString: "$#,##0.00",
                dataPoints: dataPoints
            }]
        });

        function addData(data) {
            var dps = data.price_usd;
            for (var i = 0; i < dps.length; i++) {
                dataPoints.push({
                    x: new Date(dps[i][0]),
                    y: dps[i][1]
                });
            }
            chart.render();
        }

        $.getJSON("https://canvasjs.com/data/gallery/php/bitcoin-price.json", addData);

    }
    */
</script>

<div class="row">
    <div class="col-lg-12">
        <div class="card p-3">
            <h4 class="p-2 font-weight-bold text-black">Today's Report</h4>
            <!--Area Chart
            <div class="row">
              <div class="col-xl-12 col-lg-7">
                <div class="card shadow mb-4">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                  </div>
                  <div class="card-body">
                    <div class="chart-area"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                    <canvas id="myAreaChart" style="display: block; width: 401px; height: 160px;" width="802" height="320" class="chartjs-render-monitor"></canvas>
                  </div>
                </div>
              </div>
            </div>
            </div>-->
            <div class="row">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Sales (Monthly)
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">₱40,000</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Sales (Annual)
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">₱215,000</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-money-bill fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example
               <div class="col-xl-3 col-md-6 mb-4">
               <div class="card border-left-info shadow h-100 py-2">
               <div class="card-body">
               <div class="row no-gutters align-items-center">
               <div class="col mr-2">
               <div class="text-xs font-weight-bold text-info text-uppercase mb-1">FOR DELIVERY
               </div>
               <div class="row no-gutters align-items-center">
               <div class="col-auto">
               <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
               </div>
               <div class="col">
               <div class="progress progress-sm mr-2">
               <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
               </div>
               </div>
               </div>
               </div>
               <div class="col-auto">
               <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
               </div>
               </div>
               </div>
               </div>
               </div>
               -->
                <!-- Return Items Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Work Orders
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">8</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-box fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Return Items Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        Back Logs
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row body-dashboard mt-2">
    <div class="col-lg-12">
        <div class="card p-3">
            <h4 class="p-2 font-weight-bold text-black">Dashboard Menu</h4>
            <div class="row">
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="row no-gutters align-items-center">
                        <a href="#submenuManufacturing" data-toggle="collapse" class="menu btn btn-outline-secondary btn-lg btn-block text-black btn-shadow py-3">
                            <strong>
                                <i class="fas fa-tools" aria-hidden="true"></i><span class="ml-3">ITEM</span>
                            </strong>
                        </a>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="row no-gutters align-items-center">
                        <a href="#submenuManufacturing" data-toggle="collapse" class="menu btn btn-outline-secondary btn-lg btn-block text-black btn-shadow py-3">
                            <strong>
                                <i class="fa fa-barcode" aria-hidden="true"></i><span class="ml-3">INVENTORY</span>
                            </strong>
                        </a>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="row no-gutters align-items-center">
                        <a href="#submenuManufacturing" data-toggle="collapse" class="menu btn btn-outline-secondary btn-lg btn-block text-black btn-shadow py-3">
                            <strong>
                                <i class="fa fa-users" aria-hidden="true"></i><span class="ml-3">HUMAN RESOURCE</span>
                            </strong>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>