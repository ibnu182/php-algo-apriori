<?php
    @session_start();
    include "config/koneksi.php";
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Aplikasi Inventory Klinik Bahtera</title>
	<!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- Morris Chart Styles-->
   
        <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
     <!-- Google Fonts-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
</head>
<body>
    
    <div id="wrapper">
        <div class="header">
            <?php include ("template/header.php");?>
        </div>
        <!--/. NAV TOP  -->

        <div class="nav">
            <?php 
                if (@$_SESSION['level'] == 'staff'){
                    include("template/nav_staff.php");
                } else if(@$_SESSION['level'] == 'kasir'){
                    include("template/nav_kasir.php");
                } else {
                    header ("location: login.php");
                }
            ?>
        </div>
        
        <!-- /. NAV SIDE  -->

        <div id="page-wrapper" >
            <div id="page-inner">
                    <?php 
                        $page   = @$_GET['page'];
                        $action = @$_GET['action'];

                        if($page == "obat"){
                            if($action == ""){
                                include ("content/obat/md_obat.php");
                            } else if ($action == "input"){
                                include ("content/obat/form_data_obat.php");
                            } else if ($action == "hapus"){
                                include ("content/obat/hapus_obat.php");
                            }
                        } else if($page == "transaksi"){
                            if($action == ""){
                                include ("content/transaksi/md_transaksi.php");
                            } else if ($action == "input"){
                                include ("content/transaksi/form_transaksi.php");
                            } else if ($action == "detail"){
                                include ("content/transaksi/detail_transaksi.php");
                            }
                        } else if($page == "faktur"){
                            if($action == ""){
                                include ("content/faktur/md_faktur.php");
                            } else if ($action == "input"){
                                include ("content/faktur/form_faktur.php");
                            } else if ($action == "detail"){
                                include ("content/faktur/detail_faktur.php");
                            }
                        } else if($page == "laporan"){
                            if($action == ""){
                                include ("content/laporan/laporan.php");
                            } else if ($action == "hasil"){
                                include ("content/laporan/hasil_laporan.php");
                            }
                        } else if($page == "") {
                            include ("dashboard.php"); 
                        } else {
                            echo "404! Halaman tidak ditemukan";
                        } 
                    ?>
            </div>
            <!-- /. PAGE INNER  -->
            <?php include("template/footer.php");?>
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#table_id').dataTable();

                $("#fakultas").change(function(){
                var fakultas = $("#fakultas").val();
                $.ajax({
                    url: "content/prodi/ambil_prodi.php",
                    data: "fakultas="+fakultas,
                    cache: false,
                    success: function(msg){
                        //jika data sukses diambil dari server kita tampilkan
                        //di <select id=kota>
                        $("#prodi").html(msg);
                        }
                    });
                });

                $("#btnCard").change(function(){
                var btnCard = $("#btnCard").val();
                $.ajax({
                    url: "content/bimbingan/ambil_card.php",
                    data: "card="+btnCard,
                    cache: false,
                    success: function(msg){
                        //jika data sukses diambil dari server kita tampilkan
                        //di <select id=kota>
                        $("#card").html(msg);
                        }
                    });
                });
            });
            
            $(document).on("click", ".open-addCard", function () {
                 var idCard = $(this).data('id');
                 $(".modal-body #cardId").val( idCard );
                 // As pointed out in comments, 
                 // it is superfluous to have to manually call the modal.
                 // $('#addBookDialog').modal('show');
            });

            $(document).on("click", ".open-revisionCard", function () {
                 var revisionCard = $(this).data('id');
                 $(".modal-body #cardRevision").val( revisionCard );
                 // As pointed out in comments, 
                 // it is superfluous to have to manually call the modal.
                 // $('#addBookDialog').modal('show');
            });

           

    </script>
    <!-- Morris Chart Js -->
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
    <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>
    
</body>
</html>
