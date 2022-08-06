<?php 
    $page_title=(isset($_GET['color_id'])) ? 'Edit Color' : 'Add Color';
    include("includes/header.php");
    require("includes/lb_helper.php");
    require("language/language.php");
    
    $page_save=(isset($_GET['color_id'])) ? 'Save' : 'Create';
    
    if(isset($_POST['submit']) and isset($_GET['add'])){
        
        $data = array( 
            'color_name'  =>  cleanInput($_POST['color_name']),
            'color_code'  =>  trim('#'.$_POST['color_code'])
        );  
        
        $qry = Insert('tbl_color',$data);	

        
        $_SESSION['msg']="10";
        $_SESSION['class']='success';
        header( "Location:manage_color.php");
        exit;
    }
    
    if(isset($_GET['color_id'])){
        $qry="SELECT * FROM tbl_color where color_id='".$_GET['color_id']."'";
        $result=mysqli_query($mysqli,$qry);
        $row=mysqli_fetch_assoc($result);
    }
    
    if(isset($_POST['submit']) and isset($_POST['color_id'])){
        
        
        $data = array( 
           'color_name'  =>  cleanInput($_POST['color_name']),
           'color_code'  =>  trim('#'.$_POST['color_code'])
        );	

        $update=Update('tbl_color', $data, "WHERE color_id = '".$_POST['color_id']."'");

        $_SESSION['msg']="11";
        $_SESSION['class']='success';
        header( "Location:add_color.php?color_id=".$_POST['color_id']);
        exit;
    }
?>
<!-- Begin:: Theme main content -->
<main id="pb_main">
    <div class="pb-main-container">
        <div class="pb-card">
            <div class="pb-card__head">
                <span class="pb-card__title mb-2 mb-sm-0">
                    <?php if(isset($_GET['redirect'])){?>
        			    <a href="<?php $_GET['redirect']?>"><h4 class="pull-left"><i class="fa fa-arrow-left"></i> Back</h4></a>
                	<?php }else{ ?>
            		    <a href="manage_color.php"><h4 class="pull-left"><i class="fa fa-arrow-left"></i> Back</h4></a>
                	<?php } ?>
                    <?=$page_title ?>
                </span>
            </div>
            <div class="pb-card__body py-4">
                <form action="" name="addeditcategory" method="POST" enctype="multipart/form-data">
                    <input  type="hidden" name="color_id" value="<?=(isset($_GET['color_id'])) ? $_GET['color_id'] : ''?>" />
                    <div class="row">
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">Color Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="color_name" class="form-control" value="<?php if(isset($_GET['color_id'])){echo $row['color_name'];}?>" required>
                            </div>
                        </div>
                        
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">Select Color</label>
                            <div class="col-sm-9">
                                <input value="<?php if(isset($_GET['color_id'])){echo str_replace('#','',$row['color_code']);}else{ echo 'e91e63';}?>" name="color_code" 
                                 class="form-control jscolor {width:243, height:150, position:'right', borderColor:'#000', insetColor:'#FFF', backgroundColor:'#ddd'}">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <button type="submit" name="submit" class="btn btn-primary" style="min-width: 110px;"><?=$page_save?></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Begin:: Main footer -->
        <?php include("includes/main_footer.php");?> 
        <!-- End:: Main footer  -->
    </div>
</main>
<!-- End:: Theme main content -->
<?php include("includes/footer.php");?> 
<script type="text/javascript" src="assets/js/jscolor.js"></script>