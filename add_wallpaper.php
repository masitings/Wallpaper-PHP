<?php 
    $page_title=(isset($_GET['wallpaper_id'])) ? 'Edit Wallpaper' : 'Add Wallpaper';
    include("includes/header.php");
    require("includes/lb_helper.php");
    require("language/language.php");
    require_once("thumbnail_images.class.php");
    
    $page_save=(isset($_GET['wallpaper_id'])) ? 'Save' : 'Create';
    
    $cat_qry="SELECT * FROM tbl_category WHERE status='1' ORDER BY category_name";
    $cat_result=mysqli_query($mysqli,$cat_qry); 
    
    $col_qry="SELECT * FROM tbl_color WHERE color_status='1' ORDER BY color_name";
    $col_result=mysqli_query($mysqli,$col_qry);
    
    if(isset($_POST['submit']) and isset($_GET['add'])){
        
        $count = count($_FILES['wallpaper_image']['name']);
        
        for($i=0;$i<$count;$i++){
            $file_name= str_replace(" ","-",$_FILES['wallpaper_image']['name'][$i]);
            $albumimgnm=rand(0,99999)."_".$file_name;
            
            //Main Image
            $tpath1='categories/'.$_POST['cat_id'].'/'.$albumimgnm;      
            $pic1=compress_image($_FILES["wallpaper_image"]["tmp_name"][$i], $tpath1, 70); 
            
            $date=date('Y-m-j');
            
            $data = array( 
                'cat_id'  =>  $_POST['cat_id'],
                'pay'  =>  $_POST['pay'],
                'image_date'  =>  $date,
                'image'  =>  $albumimgnm,
                'wall_colors'  =>  implode(',', $_POST['wall_colors'])
            );    
            
            $qry = Insert('tbl_wallpaper',$data); 
        }
        
        $_SESSION['msg']="10";
        $_SESSION['class']='success';
        header( "Location:add_wallpaper.php?add=yes");
        exit;
    }
    
    if(isset($_GET['wallpaper_id'])){
        $qry="SELECT * FROM tbl_wallpaper where id='".$_GET['wallpaper_id']."'";
        $result=mysqli_query($mysqli,$qry);
        $row=mysqli_fetch_assoc($result);
    }
    
    if(isset($_POST['submit']) and isset($_POST['wallpaper_id'])){
        
        if($_FILES['wallpaper_image']['name']!=""){
            
            if($row['image']!=""){
                $curr_File='categories/'.$row['cat_id'].'/'.$row['image'];
                unlink($curr_File);
            }
            
            $file_name= str_replace(" ","-",$_FILES['wallpaper_image']['name']);

            $albumimgnm=rand(0,99999)."_".$file_name;
    
            //Main Image
            $tpath1='categories/'.$_POST['cat_id'].'/'.$albumimgnm;       
            $pic1=compress_image($_FILES["wallpaper_image"]["tmp_name"], $tpath1, 70);
         
        }else{
            $albumimgnm=$row['image'];
        }
        
         $data = array( 
            'cat_id'  =>  $_POST['cat_id'],
            'pay'  =>  $_POST['pay'],
            'image'  =>  $albumimgnm,
            'wall_colors'  =>  implode(',', $_POST['wall_colors'])
        );
        
        $qry=Update('tbl_wallpaper', $data, "WHERE id = '".$_POST['wallpaper_id']."'");
        
        $_SESSION['msg']="11";
        $_SESSION['class']='success';
        header( "Location:add_wallpaper.php?wallpaper_id=".$_POST['wallpaper_id']);
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
            		    <a href="manage_wallpaper.php"><h4 class="pull-left"><i class="fa fa-arrow-left"></i> Back</h4></a>
                	<?php } ?>
                    <?=$page_title ?>
                </span>
            </div>
            <div class="pb-card__body py-4">
                <form action="" name="addeditlive" method="POST" enctype="multipart/form-data">
                <input  type="hidden" name="wallpaper_id" value="<?=(isset($_GET['wallpaper_id'])) ? $_GET['wallpaper_id'] : ''?>" />
                <div class="row">
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">Category</label>
                            <div class="col-sm-9">
                                <select name="cat_id" id="cat_id" class="form-control basic" required>
                                    <option value="">--Select Category--</option>
                                    <?php while($cat_row=mysqli_fetch_array($cat_result)){ ?>      
                                        <?php if(isset($_GET['wallpaper_id'])){ ?>
                  							<option value="<?php echo $cat_row['cid'];?>" <?php if($cat_row['cid']==$row['cat_id']){?>selected<?php }?>><?php echo $cat_row['category_name'];?></option>	          							 
                                        <?php }else{ ?>
                  						        <option value="<?php echo $cat_row['cid'];?>"><?php echo $cat_row['category_name'];?></option>   							 
                                        <?php } ?>
                                    <?php } ?> 
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">Type</label>
                            <div class="col-sm-9">
                                <select name="pay" id="pay" class="form-control" required>
                                    <?php if(isset($_GET['wallpaper_id'])){ ?>
                                        <option value="free" <?php if($row['pay']=='free'){?>selected<?php }?>>Free</option>
                                        <option value="premium" <?php if($row['pay']=='premium'){?>selected<?php }?>>Premium</option>
                                    
                                    <?php }else{ ?>
                                    	<option value="free">Free</option>
                                        <option value="premium">Premium</option>
                                    <?php } ?> 
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">Wallpaper Colors</label>
                            <div class="col-sm-9">
                                <select name="wall_colors[]" id="wall_colors" class="form-control tagging " required multiple="multiple">
                                    <option value="">--Select Colors--</option>
                                    <?php if(isset($_GET['wallpaper_id'])){?>
                                        <?php
                                          $db_colors=explode(',', $row['wall_colors']);
                                          while($colors=mysqli_fetch_array($col_result)){
                                          ?>                       
                                            <option value="<?php echo $colors['color_id'];?>" <?php if(in_array($colors['color_id'],$db_colors)){ echo 'selected'; } ?>><?php echo $colors['color_name'];?></option>                           
                                            <?php } ?>
                                    <?php }else{?>  
                                        <?php while($colors=mysqli_fetch_array($col_result)){ ?> 
                                            <option value="<?php echo $colors['color_id'];?>"><?php echo $colors['color_name'];?></option>
                                        <?php } ?>
                                    <?php }?>   
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">Select Image</label>
                            <div class="col-sm-9">
                                <?php if(isset($_GET['wallpaper_id'])){?>
                                   <input type="file" class="form-control-file" name="wallpaper_image" accept=".png, .jpg, .jpeg, .svg" onchange="fileValidation()" id="fileupload" >
                                <?php }else{?>  
                                    <input type="file" class="form-control-file" name="wallpaper_image[]" accept=".png, .jpg, .jpeg, .svg" onchange="fileValidation()" id="fileupload" multiple>
                                <?php }?>  
                                
                            </div>
                        </div>
                        
                        <?php if(isset($_GET['wallpaper_id'])){?>
                        
                            <div class="form-group row mb-4">
                                <label class="col-sm-3 col-form-label">&nbsp;</label>
                                <div class="col-sm-9">
                                    <div class="fileupload_img" id="imagePreview">
                                        <?php if(isset($_GET['wallpaper_id']) AND file_exists('categories/'.$row['cat_id'].'/'.$row['image'])) {?>
                                            <img class="col-sm-3 img-thumbnail" type="image" src="categories/<?php echo $row['cat_id'];?>/<?php echo $row['image'];?>" alt="image" />
                                        <?php }else{?>
                                          <img class="col-sm-3 img-thumbnail" type="image" src="assets/images/300x300.jpg" alt="image" />
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        
                        <?php }?>  
                        
                        <div class="form-group row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <button type="submit" name="submit" class="btn btn-primary" style="min-width: 110px;"><?=$page_save ?></button>
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