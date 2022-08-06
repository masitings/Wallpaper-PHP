<?php 
    $page_title=(isset($_GET['wallpaper_id'])) ? 'Edit Wallpaper' : 'Add Wallpaper';
    include("includes/header.php");
    require("includes/lb_helper.php");
    require("language/language.php");
    require_once("thumbnail_images.class.php");
    
    $page_save=(isset($_GET['wallpaper_id'])) ? 'Save' : 'Create';
    
    if(isset($_POST['submit']) and isset($_GET['add'])){
        
        $count = count($_FILES['wallpaper_image']['name']);
        
        for($i=0;$i<$count;$i++){
            
            $file_name= str_replace(" ","-",$_FILES['wallpaper_image']['name'][$i]);
            $albumimgnm=rand(0,99999)."_".$file_name;
            
            $tpath1='images/'.$albumimgnm;	
            $pic1=$_FILES['wallpaper_image']['tmp_name'][$i];   
            copy($pic1,$tpath1);

            $date=date('Y-m-j');
            
            $data = array( 
                'pay'  =>  $_POST['pay'],
                'image_date'  =>  $date,
                'image'  =>  $albumimgnm
            );    
            
            $qry = Insert('tbl_wallpaper_gif',$data); 
        }
        
        $_SESSION['msg']="10";
        $_SESSION['class']='success';
        header( "Location:add_animation.php?add=yes");
        exit;
    }
    
    if(isset($_GET['wallpaper_id'])){
        $qry="SELECT * FROM tbl_wallpaper_gif where id='".$_GET['wallpaper_id']."'";
        $result=mysqli_query($mysqli,$qry);
        $row=mysqli_fetch_assoc($result);
    }
    
    if(isset($_POST['submit']) and isset($_POST['wallpaper_id'])){
        
        if($_FILES['wallpaper_image']['name']!=""){
            
            if($row['image']!=""){
                unlink('images/'.$row['image']);
            }
            
            $file_name= str_replace(" ","-",$_FILES['wallpaper_image']['name']);
            $albumimgnm=rand(0,99999)."_".$file_name;
            
            //Main Image
            $tpath1='images/'.$albumimgnm;   
            $pic1=$_FILES['wallpaper_image']['tmp_name'];   
            copy($pic1,$tpath1);
         
        }else{
            $albumimgnm=$row['image'];
        }
        
         $data = array( 
            'pay'  =>  $_POST['pay'],
            'image'  =>  $albumimgnm,
        );
        
        $qry=Update('tbl_wallpaper_gif', $data, "WHERE id = '".$_POST['wallpaper_id']."'");
        
        $_SESSION['msg']="11";
        $_SESSION['class']='success';
        header( "Location:add_animation.php?wallpaper_id=".$_POST['wallpaper_id']);
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
                            <label class="col-sm-3 col-form-label">Select GIF Image</label>
                            <div class="col-sm-9">
                                <?php if(isset($_GET['wallpaper_id'])){?>
                                   <input type="file" class="form-control-file" name="wallpaper_image" accept=".gif, .GIF" onchange="fileValidation2()" id="fileupload" >
                                <?php }else{?>  
                                    <input type="file" class="form-control-file" name="wallpaper_image[]" accept=".gif, .GIF" onchange="fileValidation2()" id="fileupload" multiple>
                                <?php }?>  
                                
                            </div>
                        </div>
                        
                        <?php if(isset($_GET['wallpaper_id'])){?>
                        
                            <div class="form-group row mb-4">
                                <label class="col-sm-3 col-form-label">&nbsp;</label>
                                <div class="col-sm-9">
                                    <div class="fileupload_img" id="imagePreview">
                                        <?php if(isset($_GET['wallpaper_id'])) {?>
                                            <img class="col-sm-3 img-thumbnail" type="image" src="images/<?php echo $row['image'];?>" alt="image" />
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

<script type="text/javascript">
    function fileValidation2(){
        var fileInput = document.getElementById('fileupload');
        var filePath = fileInput.value;
        var allowedExtensions = /(\.gif|.GIF)$/i;
        if(!allowedExtensions.exec(filePath)){
            if(filePath!='')
            fileInput.value = '';
            $.notify('Please upload file having extension .gif, .GIF only.', { position:"top right",className: 'error'} ); 
            return false;
        }else{
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#imagePreview").find("img").attr("src", e.target.result);
                };
                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    }
</script> 