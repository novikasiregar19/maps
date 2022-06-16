<?php
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    ini_set('max_execution_time', 0);
    date_default_timezone_set('Asia/Jakarta');
    include "koneksi.php"
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <?php include 'header.php' ?>
    <title>Dashboard</title>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

</head>

<body class="sb-nav-fixed">
    <?php include 'menu.php' ?>
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- Widgets  -->
                <div class="row">
                    <div class="col-lg-4 col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-1">
                                        <i class="fa fa-file-text-o"></i>
                                    </div>
                                    <div class="stat-content">         
                                    <div class="text-left dib">
                                    <?php
                                            $data_alat = mysqli_query($conn,"SELECT * FROM alat");
                                            $jumlah_alat = mysqli_num_rows($data_alat);
                                            
                                            ?>
                                            <div class="stat-text"><span class="count"><?php echo $jumlah_alat; ?></span></div>
                                            <?php 
                                                if(($level == '1') OR ($level == '3')){ ?>
                                                    <div class="stat-heading"><a href="tables-alat.php">Data Alat</a></div> 
                                                <?php } 

                                                else{ ?>
                                                    <div class="stat-heading"><a href="#">Data Alat</a></div> 
                                                 <?php
                                                    }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-2">
                                        <i class="fa fa-file-text-o"></i>
                                    </div>
                                    <div class="stat-content">
                                    <div class="text-left dib">
                                    <?php
                                            $data_kegiatan = mysqli_query($conn,"SELECT * FROM kegiatan");
                                            $jumlah_kegiatan = mysqli_num_rows($data_kegiatan);
                                            ?>
                                            <div class="stat-text"><span class="count"><?php echo $jumlah_kegiatan; ?></span></div>
                                            <?php 
                                                if(($level == '1') OR ($level == '3')){ ?>
                                                    <div class="stat-heading"><a href="tables-keg.php">Data Kegiatan</a></div> 
                                                <?php } 

                                                else{ ?>
                                                    <div class="stat-heading"><a href="#">Data Kegiatan</a></div> 
                                                 <?php
                                                    }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-4">
                                        <i class="pe-7s-users"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                        <?php
                                            $data_user = mysqli_query($conn,"SELECT * FROM login");
                                            $jumlah_user = mysqli_num_rows($data_user);
                                            ?>
                                            <div class="stat-text"><span class="count"><?php echo $jumlah_user; ?></span></div>
                                            <?php 
                                                if(($level == '1') OR ($level == '3')){ ?>
                                                    <div class="stat-heading"><a href="user.php">User</a></div> 
                                                <?php } 

                                                else{ ?>
                                                    <div class="stat-heading"><a href="#">User</a></div> 
                                                 <?php
                                                    }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Widgets -->

                <!--  Traffic  -->
                <div class="row">
                    <div class="col-lg-6 col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="box-title">Data Alat </h4>
                            </div>
                            
                            <div class="col-lg-10 col-md-3">
                                <div class="card-body">     
                                    <div class="progress-box progress-1">
                                            <?php
                                                $nama_alat="SELECT DISTINCT nama_alat FROM alat limit 5";
                                                $result=mysqli_query($conn,$nama_alat);
                                                if(!$conn){
                                                    die("Could not connect to the database".mysqli_connect_error());
                                                }
                                                while($row=mysqli_fetch_array($result)){
                                            ?>
                                            <h4 class="por-title"><?= $row['nama_alat']; ?></h4>
                                            <div class="por-txt">100 Unit (60%)</div>
                                            <!-- jumlah alat yg rusak / jumlah alat * 100%  -->
                                            <div class="progress mb-2" style="height: 5px;">
                                                <div class="progress-bar bg-flat-color-1" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>

                                <?php } ?>
                                    </div><!-- /.progress -->
                                </div> <!-- /.card-body -->     
                            </div><!-- /# col 10 -->
                        </div><!-- /# card -->
                    </div><!-- /# col 5 -->

                    <div class="col-lg-6 col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="box-title">Alat Rusak</h4>
                            </div>
                            
                            <div class="col-lg-10 col-md-3">
                                <div class="card-body">     
                                    <div class="progress-box progress-1">
                                            <?php
                                                $nama_alat="SELECT DISTINCT nama_alat FROM alat limit 5";
                                                $result=mysqli_query($conn,$nama_alat);
                                                if(!$conn){
                                                    die("Could not connect to the database".mysqli_connect_error());
                                                }
                                                while($row=mysqli_fetch_array($result)){
                                            ?>
                                            <h4 class="por-title"><?= $row['nama_alat']; ?></h4>
                                            <div class="por-txt">100 Unit (60%)</div>
                                            <!-- jumlah alat yg rusak / jumlah alat * 100%  -->
                                            <div class="progress mb-2" style="height: 5px;">
                                                <div class="progress-bar bg-flat-color-1" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>

                                <?php } ?>
                                    </div><!-- /.progress -->
                                </div> <!-- /.card-body -->     
                            </div><!-- /# col 10 -->
                        </div><!-- /# card -->
                    </div><!-- /# col 5 -->

                    <div class="col-lg-12 col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="box-title">Manual Teknis</h4>
                            </div>
                            
                                <div class="card-body">     
                                <table id="tabel-data" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Judul File</th>
                                        <th scope="col">Tanggal Upload</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                        $sql="SELECT * FROM upload_file";
                                        $result=mysqli_query($conn,$sql);
                                        if(!$conn){
                                            die("Could not connect to the database".mysqli_connect_error());
                                        }
                                        while($row=mysqli_fetch_array($result)){
                                    ?>
                                    <tr>
                                        <td><a href="view.php?id=<?php echo $row['id'];?>"><?= $row['file']; ?></a></td>
                                        <td><?= date('d-m-Y', strtotime($row['tanggal_up'])); ?></td>
                                        
                                    </tr>

                                    <?php } ?>
                                </tbody>
                            </table>
                                </div> <!-- /.card-body -->     
                        </div><!-- /# card -->
                    </div>

                    <div class="col-lg-12 col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="box-title">User Activity </h4>
                            </div>
                            
                                <div class="card-body">     
                                    <table id="tabel-data" class="table table-striped table-hover">
                                
                                <thead>
 
                                    <tr>
                                        <th scope="col">Login by</th>
                                        <th scope="col">Aktivitas</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Date Time</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(isset($_POST['submit'])){
                                        $datetime = $_POST['datepicker'];
                                        }
                                        else{
                                            $datetime = date('Y-m-d');
                                        }
                                        $sql="SELECT username, aktivitas, keterangan, tanggal_log FROM log_user,login WHERE log_user.id_login = login.id_login AND tanggal_log LIKE '$datetime%' ORDER BY tanggal_log DESC limit 5";
                                        $result=mysqli_query($conn,$sql);
                                        if(!$conn){
                                            die("Could not connect to the database".mysqli_connect_error());
                                        }
                                        while($row=mysqli_fetch_array($result)){
                                        
                                    ?>
                                    <tr>
                                        <td><?= $row['username']; ?></td>
                                        <td><?= $row['aktivitas']; ?></td>
                                        <td><?= $row['keterangan']; ?></td>
                                        <td><?= date('d-m-Y H:i:s', strtotime($row['tanggal_log'])); ?></td>
                                    </tr>

                                        
                                            <?php } ?>
                                                
                                            </tbody>
                                        </table>
                                </div> <!-- /.card-body -->     
                        </div><!-- /# card -->
                    </div>

                    
                </div>
            </div>
            <!-- .animated -->
        
        <!-- /.content -->
        <div class="clearfix"></div>
        <!-- Footer -->
        <footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6">
                        Copyright &copy; 2021 Angkasa Pura
                    </div>
                    
                </div>
            </div>
        </footer>
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>

    <!--  Chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>

    <!--Chartist Chart-->
    <script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>

    <!--Local Stuff-->
    <script>
        jQuery(document).ready(function($) {
            "use strict";

            // Pie chart flotPie1
            var piedata = [
                { label: "Desktop visits", data: [[1,32]], color: '#5c6bc0'},
                { label: "Tab visits", data: [[1,33]], color: '#ef5350'},
                { label: "Mobile visits", data: [[1,35]], color: '#66bb6a'}
            ];

            $.plot('#flotPie1', piedata, {
                series: {
                    pie: {
                        show: true,
                        radius: 1,
                        innerRadius: 0.65,
                        label: {
                            show: true,
                            radius: 2/3,
                            threshold: 1
                        },
                        stroke: {
                            width: 0
                        }
                    }
                },
                grid: {
                    hoverable: true,
                    clickable: true
                }
            });
            // Pie chart flotPie1  End
            // cellPaiChart
            var cellPaiChart = [
                { label: "Direct Sell", data: [[1,65]], color: '#5b83de'},
                { label: "Channel Sell", data: [[1,35]], color: '#00bfa5'}
            ];
            $.plot('#cellPaiChart', cellPaiChart, {
                series: {
                    pie: {
                        show: true,
                        stroke: {
                            width: 0
                        }
                    }
                },
                legend: {
                    show: false
                },grid: {
                    hoverable: true,
                    clickable: true
                }

            });
            // cellPaiChart End
            // Line Chart  #flotLine5
            var newCust = [[0, 3], [1, 5], [2,4], [3, 7], [4, 9], [5, 3], [6, 6], [7, 4], [8, 10]];

            var plot = $.plot($('#flotLine5'),[{
                data: newCust,
                label: 'New Data Flow',
                color: '#fff'
            }],
            {
                series: {
                    lines: {
                        show: true,
                        lineColor: '#fff',
                        lineWidth: 2
                    },
                    points: {
                        show: true,
                        fill: true,
                        fillColor: "#ffffff",
                        symbol: "circle",
                        radius: 3
                    },
                    shadowSize: 0
                },
                points: {
                    show: true,
                },
                legend: {
                    show: false
                },
                grid: {
                    show: false
                }
            });
            // Line Chart  #flotLine5 End
            // Traffic Chart using chartist
            if ($('#traffic-chart').length) {
                var chart = new Chartist.Line('#traffic-chart', {
                  labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                  series: [
                  [0, 18000, 35000,  25000,  22000,  0],
                  [0, 33000, 15000,  20000,  15000,  300],
                  [0, 15000, 28000,  15000,  30000,  5000]
                  ]
              }, {
                  low: 0,
                  showArea: true,
                  showLine: false,
                  showPoint: false,
                  fullWidth: true,
                  axisX: {
                    showGrid: true
                }
            });

                chart.on('draw', function(data) {
                    if(data.type === 'line' || data.type === 'area') {
                        data.element.animate({
                            d: {
                                begin: 2000 * data.index,
                                dur: 2000,
                                from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
                                to: data.path.clone().stringify(),
                                easing: Chartist.Svg.Easing.easeOutQuint
                            }
                        });
                    }
                });
            }
            // Traffic Chart using chartist End
            //Traffic chart chart-js
            if ($('#TrafficChart').length) {
                var ctx = document.getElementById( "TrafficChart" );
                ctx.height = 150;
                var myChart = new Chart( ctx, {
                    type: 'line',
                    data: {
                        labels: [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul" ],
                        datasets: [
                        {
                            label: "Visit",
                            borderColor: "rgba(4, 73, 203,.09)",
                            borderWidth: "1",
                            backgroundColor: "rgba(4, 73, 203,.5)",
                            data: [ 0, 2900, 5000, 3300, 6000, 3250, 0 ]
                        },
                        {
                            label: "Bounce",
                            borderColor: "rgba(245, 23, 66, 0.9)",
                            borderWidth: "1",
                            backgroundColor: "rgba(245, 23, 66,.5)",
                            pointHighlightStroke: "rgba(245, 23, 66,.5)",
                            data: [ 0, 4200, 4500, 1600, 4200, 1500, 4000 ]
                        },
                        {
                            label: "Targeted",
                            borderColor: "rgba(40, 169, 46, 0.9)",
                            borderWidth: "1",
                            backgroundColor: "rgba(40, 169, 46, .5)",
                            pointHighlightStroke: "rgba(40, 169, 46,.5)",
                            data: [1000, 5200, 3600, 2600, 4200, 5300, 0 ]
                        }
                        ]
                    },
                    options: {
                        responsive: true,
                        tooltips: {
                            mode: 'index',
                            intersect: false
                        },
                        hover: {
                            mode: 'nearest',
                            intersect: true
                        }

                    }
                } );
            }
            //Traffic chart chart-js  End
            // Bar Chart #flotBarChart
            $.plot("#flotBarChart", [{
                data: [[0, 18], [2, 8], [4, 5], [6, 13],[8,5], [10,7],[12,4], [14,6],[16,15], [18, 9],[20,17], [22,7],[24,4], [26,9],[28,11]],
                bars: {
                    show: true,
                    lineWidth: 0,
                    fillColor: '#ffffff8a'
                }
            }], {
                grid: {
                    show: false
                }
            });
            // Bar Chart #flotBarChart End
        });
    </script>

<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="jquery.tabledit.min.js"></script>

</body>
</html>