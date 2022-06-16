    <!-- Left Panel -->
    <?php
include "cekstart.php";

    ?>
    
      <aside id="left-panel" class="left-panel">
<?php
    if ($level==1){
?>
  
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="dashboard.php"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>
                    
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-folder"></i>Master Data</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-folder-open"></i><a href="tables-alat.php">Alat</a></li>
                            <li><i class="fa fa-folder-open"></i><a href="tables-merk.php">Merk</a></li>
                            <li><i class="fa fa-folder-open"></i><a href="tables-kom.php">Komponen Alat</a></li>
                            <li><i class="fa fa-folder-open"></i><a href="tables-keg.php">Kegiatan</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-folder"></i>Pemeliharaan</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-folder-open"></i><a href="tables-pem.php">Harian</a></li>
                            <li><i class="fa fa-folder-open"></i><a href="pem_ming.php">Mingguan</a></li>
                            <li><i class="fa fa-folder-open"></i><a href="pem_bul.php">Bulanan</a></li>

                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user"></i>User</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-folder-open"></i><a href="karyawan.php">Karyawan</a></li>
                            <li><i class="fa fa-folder-open"></i><a href="sign.php">Sign</a></li>
                            <li><i class="fa fa-folder-open"></i><a href="user.php">User</a></li>
                            <li><i class="fa fa-folder-open"></i><a href="log_user.php">Log User</a></li>
                        </ul>
                    </li>      
                    
                    <li class="active">
                        <a href="entry.php"><i class="menu-icon fa fa-table"></i>Entry</a>
                    </li>

                    <li class="active">
                        <a href="verifi.php"><i class="menu-icon fa fa-table"></i>Verifikasi</a>
                    </li>

                    <li class="active">
                        <a href="report.php"><i class="menu-icon fa fa-file-text-o"></i>Report</a>
                    </li>

                    <li class="active">
                        <a href="rpn.php"><i class="menu-icon fa fa-table"></i>RPN</a>
                    </li>

                    <li class="active">
                        <a href="teknis.php"><i class="menu-icon fa fa-file-pdf-o"></i>Manual Teknis</a>
                    </li>
    
        </nav>

<?php
 }

    else if ($level==2){
?>

            <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="dashboard.php"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>
                    
                    <li class="active">
                        <a href="report.php"><i class="menu-icon fa fa-table"></i>Report</a>
                    </li>

                    <li class="active">
                        <a href="teknis.php"><i class="menu-icon fa fa-file-pdf-o"></i>Manual Teknis</a>
                    </li>
        </nav>

<?php
 }

    else if ($level==3){
?>
            <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="dashboard.php"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>
                    
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-folder"></i>Master Data</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-folder-open"></i><a href="tables-alat.php">Alat</a></li>
                            <li><i class="fa fa-folder-open"></i><a href="tables-merk.php">Merk</a></li>
                            <li><i class="fa fa-folder-open"></i><a href="tables-keg.php">Kegiatan</a></li>

                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-folder"></i>Pemeliharaan</a>
                        <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-folder-open"></i><a href="tables-pem.php">Harian</a></li>
                            <li><i class="fa fa-folder-open"></i><a href="pem_ming.php">Mingguan</a></li>
                            <li><i class="fa fa-folder-open"></i><a href="pem_bul.php">Bulanan</a></li>

                        </ul>
                    </li>
                    
                    <li class="active">
                        <a href="verifi.php"><i class="menu-icon fa fa-table"></i>Verifikasi</a>
                    </li>

                    <li class="active">
                        <a href="teknis_lihat.php"><i class="menu-icon fa fa-file-pdf-o"></i>Manual Teknis</a>
                    </li>

        </nav>
<?php
 } 


    else if ($level==4){
?>
        <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="dashboard.php"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                </li>
                                
                <li class="active">
                    <a href="entry.php"><i class="menu-icon fa fa-table"></i>Entry</a>
                </li>

                <li class="active">
                    <a href="teknis_lihat.php"><i class="menu-icon fa fa-file-pdf-o"></i>Manual Teknis</a>
                </li>

    </nav>
<?php
 }
?>
    </aside>
    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#"><img src="images/maps.png" alt="Logo"></a>
                    <a class="navbar-brand hidden" href="#"><img src="images/maps.png" alt="Logo"></a>
                    
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    
                    <div class="user-area dropdown float-right">
                        <a href="" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/logo5.png" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa-user"></i><?php echo $username; ?></a>

                            <a class="nav-link" href="change_pass.php?id_login=<?php echo $id_login; ?>"><i class="fa fa-cog"></i>Change Password</a>

                            <a class="nav-link" href="logout.php?id_login=<?php echo $id_login; ?>&&username=<?php echo $username; ?>"><i class="fa fa-power-off"></i>Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </header><!-- /header -->
    