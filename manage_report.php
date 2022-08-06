<?php 
    $page_title = "Manage Reports";
    include("includes/header.php");
    require("includes/lb_helper.php");
    require("language/language.php");
    
    $tableName="tbl_reports";   
    $targetpage = "manage_report.php"; 
    $limit = 15; 

    $query = "SELECT COUNT(*) as num FROM $tableName";
    $total_pages = mysqli_fetch_array(mysqli_query($mysqli,$query));
    $total_pages = $total_pages['num'];
    
    $stages = 3;
    $page=0;
    if(isset($_GET['page'])){
        $page = mysqli_real_escape_string($mysqli,$_GET['page']);
    }
    if($page){
        $start = ($page - 1) * $limit; 
    }else{
        $start = 0; 
    } 
    
    $sql_query="SELECT * FROM tbl_reports ORDER BY tbl_reports.`id` DESC LIMIT $start, $limit"; 
    $result=mysqli_query($mysqli,$sql_query) or die(mysqli_error($mysqli));
    
    function wallpaper_info($id) {
    
        global $mysqli;
    
        $qry_user="SELECT * FROM tbl_wallpaper WHERE id='".$id."'";
        $query1=mysqli_query($mysqli,$qry_user);
        $row_user = mysqli_fetch_array($query1);
    
        $num_rows1 = mysqli_num_rows($query1);
    
        if ($num_rows1 > 0){     
            // return the result
            return "categories/".$row_user['cat_id']."/".$row_user['image'];
        }else{
          return "assets/images/300x300.jpg";
        }
    }
    
    function gif_info($id) {
    
        global $mysqli;
    
        $qry_user="SELECT * FROM tbl_wallpaper_gif WHERE id='".$id."'";
        $query1=mysqli_query($mysqli,$qry_user);
        $row_user = mysqli_fetch_array($query1);
    
        $num_rows1 = mysqli_num_rows($query1);
    
        if ($num_rows1 > 0){     
            // return the result
            return "images/".$row_user['image'];
        }else{
          return "assets/images/300x300.jpg";
        }
    }

?>
<!-- Begin:: Theme main content -->
<main id="pb_main">
    <div class="pb-main-container">
        <div class="pb-card">
            <div class="pb-card__head d-sm-flex align-items-sm-center">
                <span class="pb-card__title mb-2 mb-sm-0">
                    <?php if (isset($_SERVER['HTTP_REFERER'])) { echo '<a href="' . $_SERVER['HTTP_REFERER'] . '"><h4 class="pull-left"><i class="fa fa-arrow-left"></i> Back</h4></a>'; }?>
                    <?=$page_title ?>
                </span>
            </div>
            <div class="pb-card__body py-4">
                <div class="table-responsive">
                    <?php if(mysqli_num_rows($result) > 0){ ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Images</th>
                                    <th>Uset</th>
                                    <th>Report</th>
                                    <th class="text-center">Date</th>
                                    <th style="width: 200px;" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0; while($row=mysqli_fetch_array($result)) { ?>
                                <tr>
                                    <td>
                                        <?php if($row['post_type']=="wallpaper"){?>
                                            <img src="<?php echo wallpaper_info($row['post_id']);?>" class="pb-avatar__image" alt="">
                                        <?php }else{?>
                                            <img src="<?php echo gif_info($row['post_id']);?>" class="pb-avatar__image" alt="">
                                        <?php }?>
                                    </td>
                                    <td><?php echo user_info($row['user_id'],"user_name");?></td>
                                    <td><?php echo $row['report_msg'];?></td>
                                    <td class="text-center"><?php echo date('d-m-Y',$row['report_on']);?></td>
                                    <td class="pb-link-icon text-center">
                                    <a href="" class="btn btn-danger delete_data" data-id="<?php echo $row['id'];?>" data-table="<?=$tableName ?>" data-bs-toggle="tooltip" data-placement="top" title="Delete" style="padding: 10px 10px !important;"> 
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    </td>
                                </tr>
                                <?php $i++; } ?> 
                            </tbody>
                        </table>
                    <?php }else{ ?>
                        <ul class="p-5">
                            <h1 class="text-center">No data found</h1>
                        </ul>
                    <?php } ?>
                </div>
                <!-- Begin:: Pagination -->
                <?php include("pagination.php"); ?>
                <!-- End:: Pagination -->
            </div>
        </div>
        <!-- Begin:: Main footer -->
        <?php include("includes/main_footer.php");?> 
        <!-- End:: Main footer  -->
    </div>
</main>
<!-- End:: Theme main content -->
<?php include("includes/footer.php");?> 