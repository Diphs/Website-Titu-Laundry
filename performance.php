<?php

use LDAP\Result;

session_start();
require "session.php";
require "koneksi.php";
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="css/performance.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title> Admin Dashboard Panel </title>
</head>

<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="./img/vmware.svg" alt="">
            </div>
            <span class="logo_name">Titu Laundry</span>
        </div>
        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="index.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Dashboard</span>
                    </a></li>
                <li><a href="product.php">
                        <i class="uil uil-box"></i>
                        <span class="link-name">Product</span>
                    </a></li>
                <li><a href="voucher.php">
                        <i class="uil uil-pricetag-alt"></i>
                        <span class="link-name">Voucher</span>
                    </a></li>
                <li><a href="adsbanner.php">
                        <i class="uil uil-layer-group"></i>
                        <span class="link-name">Ads banner</span>
                    </a></li>
                <li><a href="order.php">
                        <i class="uil uil-shopping-cart"></i>
                        <span class="link-name">Order</span>
                    </a></li>
                <li><a href="performance.php" style=" background-color: rgba(47, 128, 237, 0.16); border-radius: 8px;">
                        <i class="uil uil-tachometer-fast-alt" style="color: #2F80ED;"></i>
                        <span class="link-name" style="color: #2F80ED; font-weight: 500;">Performance</span>
                    </a></li>
            </ul>
            <ul class="logout-mode">
                <li><a href="login.php" onclick="return confirm('Apakah anda yakin ingin keluar?')">
                        <i class="uil uil-signout"></i>
                        <span class="link-name">Logout</span> </a> </li>
                <li class="mode" style="display: none;">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                        <span class="link-name">Dark mode</span>
                    </a>
                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <img src="./img/profile.svg" alt="">
        </div>
        <?php
        $searchbox = "";
        if (isset($_POST['search-box'])) {
            $searchbox = htmlspecialchars($_POST['search-box']);
        }  ?>
        <div class="dash-content">

            <div class="dategroup">
                <div class="menu">
                    <input type="radio" name="select" id="option-1" checked>
                    <input type="radio" name="select" id="option-2">
                    <input type="radio" name="select" id="option-3">
                    <input type="radio" name="select" id="option-4">
                    <label for="option-1" class="option option-1" onclick="opsiMenu(event, 'minggu')" id="defaultOpen">
                        <script>
                            // Untuk autoclick kategori "Diproses" saat halaman diload
                            window.onload = function() {
                                document.getElementById("defaultOpen").click();
                            }
                        </script>
                        <div class="dot"></div>
                        <span>Minggu Ini</span>
                    </label>
                    <label for="option-2" class="option option-2" onclick="opsiMenu(event, 'bulan')">
                        <div class="dot"></div>
                        <span>Bulan Ini</span>
                    </label>
                    <label for="option-3" class="option option-3" onclick="opsiMenu(event, 'tahun')">
                        <div class="dot"></div>
                        <span>Tahun Ini</span>
                    </label>
                    <label for="option-4" class="option option-4" onclick="opsiMenu(event, 'infinity')">
                        <div class="dot"></div>
                        <span>Semua</span>
                    </label>
                </div>
                <!-- <button id="tesbtn">HIDE</button> -->
                <form action="" method="GET">
                    <div class="inputdate">
                        <div class="tglmulai">
                            <input type="date" name="tgl_mulai" class="mulai" value="<?php if (isset($_GET['tgl_mulai'])) {
                                                                                            echo $_GET['tgl_mulai'];
                                                                                        } else {
                                                                                            echo date('Y-m-d');
                                                                                        } ?>">
                        </div>

                        <div id="txtsampai">
                            <span>Sampai</span>
                        </div>
                        <div class="tglakhir">
                            <input type="date" name="tgl_selesai" class="selesai" value="<?php if (isset($_GET['tgl_selesai'])) {
                                                                                                echo $_GET['tgl_selesai'];
                                                                                            } else {
                                                                                                echo date('Y-m-d');
                                                                                            } ?>">
                        </div>

                        <div>
                            <button id="tampilkandata" class="tampilkandata">Filter</button>
                        </div>
                    </div>
                </form>



                <!-- <script>
                    var button = document.getElementById('tesbtn'); // Assumes element with id='button'

                    button.onclick = function() {
                        var div = document.getElementById('minggu', 'bulan', 'tahun', 'infinity');
                        if (div.style.display !== 'none') {
                            div.style.display = 'none';
                        } else {
                            div.style.display = 'block';
                        }
                    };
                </script> -->
            </div>

            <div class="overview">
                <?php
                $query = mysqli_query($koneksi, "SELECT SUM(total_harga) FROM pesanan WHERE status_pesanan='Pesanan selesai' AND YEARWEEK(tanggal)=YEARWEEK(NOW())");
                $row = mysqli_fetch_array($query);
                $pendapatan = $row['SUM(total_harga)'];
                if ($pendapatan != "") {
                    $pendapatan = $row['SUM(total_harga)'];
                } else {
                    $pendapatan = "0";
                }

                $query1 = mysqli_query($koneksi, "SELECT COUNT(id_pesanan) FROM pesanan WHERE status_pesanan='Pesanan selesai' AND YEARWEEK(tanggal)=YEARWEEK(NOW())");
                $row1 = mysqli_fetch_array($query1);
                $pesanan = $row1['COUNT(id_pesanan)'];

                $query2Minggu = mysqli_query($koneksi, "SELECT COUNT(id_user) FROM user WHERE YEARWEEK(tanggalJoin)=YEARWEEK(NOW())");
                $row2Minggu = mysqli_fetch_array($query2Minggu);
                $user = $row2Minggu['COUNT(id_user)'];

                $query3 = mysqli_query($koneksi, "SELECT SUM(total_berat) FROM pesanan WHERE status_pesanan='Pesanan selesai' AND YEARWEEK(tanggal)=YEARWEEK(NOW())");
                $row3 = mysqli_fetch_array($query3);
                $cucian = $row3['SUM(total_berat)'];
                if ($cucian != "") {
                    $cucian = $row3['SUM(total_berat)'];
                } else {
                    $cucian = "0";
                }

                // -------------------------BULAN INI-----------------------------
                $query = mysqli_query($koneksi, "SELECT SUM(total_harga) FROM pesanan WHERE status_pesanan='Pesanan selesai' AND MONTH(tanggal) = MONTH(CURRENT_DATE()) AND YEAR(tanggal) = YEAR(CURRENT_DATE())");
                $row = mysqli_fetch_array($query);
                $pendapatanBulan = $row['SUM(total_harga)'];
                if ($pendapatanBulan != "") {
                    $pendapatanBulan = $row['SUM(total_harga)'];
                } else {
                    $pendapatanBulan = "0";
                }

                $query1 = mysqli_query($koneksi, "SELECT COUNT(id_pesanan) FROM pesanan WHERE status_pesanan='Pesanan selesai' AND MONTH(tanggal) = MONTH(CURRENT_DATE()) AND YEAR(tanggal) = YEAR(CURRENT_DATE())");
                $row1 = mysqli_fetch_array($query1);
                $pesananBulan = $row1['COUNT(id_pesanan)'];

                $query2Bulan = mysqli_query($koneksi, "SELECT COUNT(id_user) FROM user WHERE MONTH(tanggalJoin) = MONTH(CURRENT_DATE()) AND YEAR(tanggalJoin) = YEAR(CURRENT_DATE())");
                $row2Bulan = mysqli_fetch_array($query2Bulan);
                $userBulan = $row2Bulan['COUNT(id_user)'];

                $query3 = mysqli_query($koneksi, "SELECT SUM(total_berat) FROM pesanan WHERE status_pesanan='Pesanan selesai' AND MONTH(tanggal) = MONTH(CURRENT_DATE()) AND YEAR(tanggal) = YEAR(CURRENT_DATE())");
                $row3 = mysqli_fetch_array($query3);
                $cucianBulan = $row3['SUM(total_berat)'];
                if ($cucianBulan != "") {
                    $cucianBulan = $row3['SUM(total_berat)'];
                } else {
                    $cucianBulan = "0";
                }

                // -------------------------TAHUN INI-----------------------------
                $query = mysqli_query($koneksi, "SELECT SUM(total_harga) FROM pesanan WHERE status_pesanan='Pesanan selesai' AND YEAR(tanggal) = YEAR(CURRENT_DATE())");
                $row = mysqli_fetch_array($query);
                $pendapatanTahun = $row['SUM(total_harga)'];
                if ($pendapatanTahun != "") {
                    $pendapatanTahun = $row['SUM(total_harga)'];
                } else {
                    $pendapatanTahun = "0";
                }

                $query1 = mysqli_query($koneksi, "SELECT COUNT(id_pesanan) FROM pesanan WHERE status_pesanan='Pesanan selesai' AND YEAR(tanggal) = YEAR(CURRENT_DATE())");
                $row1 = mysqli_fetch_array($query1);
                $pesananTahun = $row1['COUNT(id_pesanan)'];

                $query2 = mysqli_query($koneksi, "SELECT COUNT(id_user) FROM user WHERE YEAR(tanggalJoin) = YEAR(CURRENT_DATE())");
                $row2 = mysqli_fetch_array($query2);
                $userTahun = $row2['COUNT(id_user)'];

                $query3 = mysqli_query($koneksi, "SELECT SUM(total_berat) FROM pesanan WHERE status_pesanan='Pesanan selesai' AND YEAR(tanggal) = YEAR(CURRENT_DATE())");
                $row3 = mysqli_fetch_array($query3);
                $cucianTahun = $row3['SUM(total_berat)'];
                if ($cucianTahun != "") {
                    $cucianTahun = $row3['SUM(total_berat)'];
                } else {
                    $cucianTahun = "0";
                }

                // -------------------------SEPANJANGA WAKTU-----------------------------
                $query = mysqli_query($koneksi, "SELECT SUM(total_harga) FROM pesanan WHERE status_pesanan='Pesanan selesai'");
                $row = mysqli_fetch_array($query);
                $pendapatanInfinity = $row['SUM(total_harga)'];
                if ($pendapatanInfinity != "") {
                    $pendapatanInfinity = $row['SUM(total_harga)'];
                } else {
                    $pendapatanInfinity = "0";
                }

                $query1 = mysqli_query($koneksi, "SELECT COUNT(id_pesanan) FROM pesanan WHERE status_pesanan='Pesanan selesai'");
                $row1 = mysqli_fetch_array($query1);
                $pesananInfinity = $row1['COUNT(id_pesanan)'];

                $query2 = mysqli_query($koneksi, "SELECT COUNT(id_user) FROM user");
                $row2 = mysqli_fetch_array($query2);
                $userInfinity = $row2['COUNT(id_user)'];

                $query3 = mysqli_query($koneksi, "SELECT SUM(total_berat) FROM pesanan WHERE status_pesanan='Pesanan selesai'");
                $row3 = mysqli_fetch_array($query3);
                $cucianInfinity = $row3['SUM(total_berat)'];
                if ($cucianInfinity != "") {
                    $cucianInfinity = $row3['SUM(total_berat)'];
                } else {
                    $cucianInfinity = "0";
                }

                ?>

                <div id="minggu" class="boxes">
                    <div class="box box1">
                        <i class="uil uil-money-withdraw"></i>
                        <span class="text">Pendapatan</span>
                        <span class="number">Rp. <?php echo $pendapatan ?></span>
                    </div>
                    <div class="box box2">
                        <i class="uil uil-shopping-cart"></i>
                        <span class="text">Pesanan berhasil</span>
                        <span class="number"><?php echo $pesanan ?></span>
                    </div>
                    <div class="box box3">
                        <i class="uil uil-weight"></i>
                        <span class="text">Total cucian</span>
                        <span class="number"><?php echo $cucian ?> Kg</span>
                    </div>
                    <div class="box box4">
                        <i class="uil uil-user"></i>
                        <span class="text">Pengguna baru</span>
                        <span class="number"><?php echo $user ?></span>
                    </div>
                </div>

                <div id="bulan" class="boxes">
                    <div class="box box1">
                        <i class="uil uil-money-withdraw"></i>
                        <span class="text">Pendapatan</span>
                        <span class="number">Rp. <?php echo $pendapatanBulan ?></span>
                    </div>
                    <div class="box box2">
                        <i class="uil uil-shopping-cart"></i>
                        <span class="text">Pesanan berhasil</span>
                        <span class="number"><?php echo $pesananBulan ?></span>
                    </div>
                    <div class="box box3">
                        <i class="uil uil-weight"></i>
                        <span class="text">Total cucian</span>
                        <span class="number"><?php echo $userBulan ?> Kg</span>
                    </div>
                    <div class="box box4">
                        <i class="uil uil-user"></i>
                        <span class="text">Pengguna baru</span>
                        <span class="number"><?php echo $userBulan ?></span>
                    </div>
                </div>

                <div id="tahun" class="boxes">
                    <div class="box box1">
                        <i class="uil uil-money-withdraw"></i>
                        <span class="text">Pendapatan</span>
                        <span class="number">Rp. <?php echo $pendapatanTahun ?></span>
                    </div>
                    <div class="box box2">
                        <i class="uil uil-shopping-cart"></i>
                        <span class="text">Pesanan berhasil</span>
                        <span class="number"><?php echo $pesananTahun ?></span>
                    </div>
                    <div class="box box3">
                        <i class="uil uil-weight"></i>
                        <span class="text">Total cucian</span>
                        <span class="number"><?php echo $cucianTahun ?> Kg</span>
                    </div>
                    <div class="box box4">
                        <i class="uil uil-user"></i>
                        <span class="text">Pengguna baru</span>
                        <span class="number"><?php echo $userTahun ?></span>
                    </div>
                </div>

                <div id="infinity" class="boxes">
                    <div class="box box1">
                        <i class="uil uil-money-withdraw"></i>
                        <span class="text">Pendapatan</span>
                        <span class="number">Rp. <?php echo $pendapatanInfinity ?></span>
                    </div>
                    <div class="box box2">
                        <i class="uil uil-shopping-cart"></i>
                        <span class="text">Pesanan berhasil</span>
                        <span class="number"><?php echo $pesananInfinity ?></span>
                    </div>
                    <div class="box box3">
                        <i class="uil uil-weight"></i>
                        <span class="text">Total cucian</span>
                        <span class="number"><?php echo $cucianInfinity ?> Kg</span>
                    </div>
                    <div class="box box4">
                        <i class="uil uil-user"></i>
                        <span class="text">Pengguna</span>
                        <span class="number"><?php echo $userInfinity ?></span>
                    </div>
                </div>

                <div id="pembanding" class="pembanding"><span class="text">Dibandingkan dengan periode <?php
                                                                                                        $tgl_mulai = date_create($_GET['tgl_mulai']);
                                                                                                        $tgl_selesai = date_create($_GET['tgl_selesai']);
                                                                                                        $interval = date_diff($tgl_mulai, $tgl_selesai);
                                                                                                        $tgl_mulai = $_GET['tgl_mulai'];
                                                                                                        $tgl_selesai = $_GET['tgl_selesai'];
                                                                                                        echo $tgl_mulai, " hingga ", $tgl_selesai, $interval->format(' (%a hari)') ?>
                    </span>
                </div>

                <div id="boxescstm" class="boxescstm">
                    <?php
                    // -------------------------CUSTOM PAKE BETWEEN MASBRO-----------------------------
                    $tgl_mulai = $_GET['tgl_mulai'];
                    $tgl_selesai = $_GET['tgl_selesai'];

                    $query = mysqli_query($koneksi, "SELECT SUM(total_harga) FROM pesanan WHERE tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai' AND status_pesanan='Pesanan selesai'");
                    $row = mysqli_fetch_array($query);
                    $pendapatanCustom = $row['SUM(total_harga)'];
                    if ($pendapatanCustom != "") {
                        $pendapatanCustom = $row['SUM(total_harga)'];
                    } else {
                        $pendapatanCustom = "0";
                    }

                    $query1 = mysqli_query($koneksi, "SELECT COUNT(id_pesanan) FROM pesanan WHERE tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai' AND status_pesanan='Pesanan selesai'");
                    $row1 = mysqli_fetch_array($query1);
                    $pesananCustom = $row1['COUNT(id_pesanan)'];

                    $query2 = mysqli_query($koneksi, "SELECT COUNT(id_user) FROM user WHERE tanggalJoin BETWEEN '$tgl_mulai' AND '$tgl_selesai'");
                    $row2 = mysqli_fetch_array($query2);
                    $userCustom = $row2['COUNT(id_user)'];

                    $query3 = mysqli_query($koneksi, "SELECT SUM(total_berat) FROM pesanan WHERE tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai' AND status_pesanan='Pesanan selesai'");
                    $row3 = mysqli_fetch_array($query3);
                    $cucianCustom = $row3['SUM(total_berat)'];
                    if ($cucianCustom != "") {
                        $cucianCustom = $row3['SUM(total_berat)'];
                    } else {
                        $cucianCustom = "0";
                    }
                    ?>
                    <div class="box box1">
                        <i class="uil uil-money-withdraw"></i>
                        <span class="text">Pendapatan</span>
                        <span class="number">Rp. <?php echo $pendapatanCustom ?></span>
                    </div>
                    <div class="box box2">
                        <i class="uil uil-shopping-cart"></i>
                        <span class="text">Pesanan berhasil</span>
                        <span class="number"><?php echo $pesananCustom ?></span>
                    </div>
                    <div class="box box3">
                        <i class="uil uil-weight"></i>
                        <span class="text">Total cucian</span>
                        <span class="number"><?php echo $cucianCustom ?> Kg</span>
                    </div>
                    <div class="box box4">
                        <i class="uil uil-user"></i>
                        <span class="text">Pengguna baru</span>
                        <span class="number"><?php echo $userCustom ?></span>
                    </div>
                </div>

                <script>
                    var getUrl = window.location.href;
                    console.log(getUrl);

                    var activity = document.getElementById("boxescstm")
                    var bxs = document.getElementById("pembanding")

                    if (getUrl === "http://localhost/Titu-Laundry-Admin-Website/performance.php") {
                        activity.style.display = 'none';
                        bxs.style.display = 'none';
                        console.log("it is equal");
                    } else {
                        // bxs.style.display = 'none';
                        activity.style.display = 'flex';
                        console.log("it is not equal");
                    };
                </script>
            </div>
            <?php
            $query =  mysqli_query($koneksi, "SELECT monthname(tanggal) AS bulan, SUM(total_harga) AS amount FROM pesanan WHERE YEAR(tanggal) = YEAR(CURRENT_DATE()) GROUP BY MONTH(tanggal)");

            foreach ($query as $data) {
                $month[] = $data['bulan'];
                $amount[] = $data['amount'];
            }  ?>
            <div class="chart" style="height: auto; width: auto;">
                <canvas id="barchart"></canvas>
            </div>
            <script>
                const ctx = document.getElementById('barchart');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: <?php echo json_encode($month) ?>,
                        datasets: [{
                            label: 'Pedapatan',
                            data: <?php echo json_encode($amount) ?>,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        </div>

    </section>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="performance.js"></script>
    <!-- <script src="css/chart.js"></script> -->
    <script src="script.js"></script>

</body>

</html>