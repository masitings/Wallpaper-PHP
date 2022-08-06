<?php 
    $page_title="Settings";
    include("includes/header.php");
    require("includes/lb_helper.php");
    require("language/language.php");
    
    $privacy_policy_file_path = getBaseUrl().'privacy_policy.php';
    $terms_file_path = getBaseUrl().'terms.php';
    
    $qry="SELECT * FROM tbl_settings where id='1'";
    $result=mysqli_query($mysqli,$qry);
    $settings_data=mysqli_fetch_assoc($result);
    
    if(isset($_POST['submit'])){
        
        if($_FILES['app_logo']['name']!=""){
            
            $img_res=mysqli_query($mysqli,"SELECT * FROM tbl_settings WHERE id='1'");
            $img_row=mysqli_fetch_assoc($img_res);
            
            if($img_row['app_logo']!=""){
                unlink('images/'.$img_row['app_logo']);
            }
            
            $ext = pathinfo($_FILES['app_logo']['name'], PATHINFO_EXTENSION);
            $app_logo=rand(0,99999)."_logo.".$ext;
            $tpath1='images/'.$app_logo;
            
            if($ext!='png')  {
                $pic1=compress_image($_FILES["app_logo"]["tmp_name"], $tpath1, 80);
            }else{
                $tmp = $_FILES['app_logo']['tmp_name'];
                move_uploaded_file($tmp, $tpath1);
            }
            
            $data = array(
                'app_name'  =>  $_POST['app_name'],
                'app_logo'  =>  $app_logo,
            );
            
        }else{
        
            $data = array(
                'app_name'  =>  $_POST['app_name']
            );
        }
        
        $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");
        $_SESSION['msg']="11";
        header( "Location:settings.php");
        exit;
        
    }else if(isset($_POST['about_submit'])){
        
        $data = array(
            'app_email'  =>  $_POST['app_email'],
            'app_author'  =>  $_POST['app_author'],
            'app_contact'  =>  $_POST['app_contact'],
            'app_website'  =>  $_POST['app_website'],
            'app_developed_by'  =>  $_POST['app_developed_by'],
            'app_description'  =>  addslashes($_POST['app_description']) 
        );
        
        $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");
        $_SESSION['msg']="11";
        header( "Location:settings.php");
        exit;
        
    }else if(isset($_POST['app_submit'])){
        
        $data = array(
            'isRTL'  =>  ($_POST['isRTL']) ? 'true' : 'false',
            'isMaintenance'  =>  ($_POST['isMaintenance']) ? 'true' : 'false',
            'isScreenshot'  =>  ($_POST['isScreenshot']) ? 'true' : 'false',
            'isLogin'  =>  ($_POST['isLogin']) ? 'true' : 'false',
            'isGoogleLogin'  =>  ($_POST['isGoogleLogin']) ? 'true' : 'false',
            
            'isVPN'  =>  ($_POST['isVPN']) ? 'true' : 'false',
            'isAPK'  =>  ($_POST['isAPK']) ? 'true' : 'false',
            'isSubscription'  =>  ($_POST['isSubscription']) ? 'true' : 'false'
            
            
        );
        
        $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");
        $_SESSION['msg']="11";
        header("Location:settings.php");
        exit;
        
    }else if(isset($_POST['policy_submit'])){
        
        $data = array(
            'app_privacy_policy'  =>  addslashes($_POST['app_privacy_policy']) 
        );
        
        $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");
        $_SESSION['msg']="11";
        header( "Location:settings.php");
        exit;
        
    }else if(isset($_POST['terms_submit'])){
        
        $data = array(
            'app_terms'  =>  addslashes($_POST['app_terms']) 
        );
        
        $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");
        $_SESSION['msg']="11";
        header( "Location:settings.php");
        exit;

    }else if(isset($_POST['ads_submit'])){
        
        $data = array(
            'banner_ad'  =>  ($_POST['banner_ad']) ? 'true' : 'false',
            'banner_ad_type'  =>  $_POST['banner_ad_type'],
            'banner_size'  =>  $_POST['banner_size'],
            'banner_size_fb'  =>  $_POST['banner_size_fb'],
            'banner_size_iron'  =>  $_POST['banner_size_iron'],
            
            'banner_ad_id'  =>  $_POST['banner_ad_id'],
            'banner_facebook_id'  =>  $_POST['banner_facebook_id'],
            'banner_startapp_id'  =>  $_POST['banner_startapp_id'],
            'banner_unity_id'  =>  $_POST['banner_unity_id'],
            'banner_iron_id'  =>  $_POST['banner_iron_id'],
            
            'interstital_ad'  =>  ($_POST['interstital_ad']) ? 'true' : 'false',
            'interstital_ad_type'  =>  $_POST['interstital_ad_type'],
            'interstital_ad_id'  =>  $_POST['interstital_ad_id'],
            'interstital_facebook_id'  =>  $_POST['interstital_facebook_id'],
            'interstital_startapp_id'  =>  $_POST['interstital_startapp_id'],
            'interstital_unity_id'  =>  $_POST['interstital_unity_id'],
            'interstital_iron_id'  =>  $_POST['interstital_iron_id'],
            'interstital_ad_click'  =>  $_POST['interstital_ad_click'],
            
            'native_ad'  =>  ($_POST['native_ad']) ? 'true' : 'false',
            'native_ad_type'  =>  $_POST['native_ad_type'],
            'native_ad_id'  =>  $_POST['native_ad_id'],
            'native_facebook_id'  =>  $_POST['native_facebook_id'],
            'native_startapp_id'  =>  $_POST['native_startapp_id'],
            'native_unity_id'  =>  $_POST['native_unity_id'],
            'native_iron_id'  =>  $_POST['native_iron_id'],
            'native_position'  =>  $_POST['native_position'],
            
            'ads_limits'  =>  ($_POST['ads_limits']) ? 'true' : 'false',
            'ads_count_click'  =>  $_POST['ads_count_click'],
            
            'custom_ads'  =>  ($_POST['custom_ads']) ? 'true' : 'false',
            'custom_ads_img'  =>  $_POST['custom_ads_img'],
            'custom_ads_link'  =>  $_POST['custom_ads_link'],
            'custom_ads_clicks'  =>  $_POST['custom_ads_clicks']
        );
        
        $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");
        $_SESSION['msg']="11";
        header( "Location:settings.php");
        exit;
    }
?>
<!-- Begin:: Theme main content -->
<main id="pb_main">
    <div class="pb-main-container">
        <div class="pb-card">
            <div class="pb-card__head">
                <span class="pb-card__title mb-2 mb-sm-0">
                    <?php if (isset($_SERVER['HTTP_REFERER'])) { echo '<a href="' . $_SERVER['HTTP_REFERER'] . '"><h4 class="pull-left"><i class="fa fa-arrow-left"></i> Back</h4></a>'; }?>
                    <?=$page_title ?>
                </span>
            </div>
    
            <div class="pb-card__body">
                <ul class="nav nav-pills mb-3 pills_bar" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"  role="tab" aria-controls="pills-home" aria-selected="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                            Admin Panel
                        </a>
                    </li>
                    
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-about-tab" data-bs-toggle="pill" data-bs-target="#pills-about"  role="tab" aria-controls="pills-about" aria-selected="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                            About
                        </a>
                    </li>
                    
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-app-tab" data-bs-toggle="pill" data-bs-target="#pills-app" role="tab" aria-controls="pills-app" aria-selected="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                            App Settings
                        </a>
                    </li>
                    
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-policy" role="tab" aria-controls="pills-policy" aria-selected="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                            Privacy Policy
                        </a>
                    </li>
                    
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-terms-tab" data-bs-toggle="pill" data-bs-target="#pills-terms" role="tab" aria-controls="pills-terms" aria-selected="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                            Terms
                        </a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-ads-tab" data-bs-toggle="pill" data-bs-target="#pills-ads" role="tab" aria-controls="pills-ads" aria-selected="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-slack"><path d="M14.5 10c-.83 0-1.5-.67-1.5-1.5v-5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5v5c0 .83-.67 1.5-1.5 1.5z"></path><path d="M20.5 10H19V8.5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"></path><path d="M9.5 14c.83 0 1.5.67 1.5 1.5v5c0 .83-.67 1.5-1.5 1.5S8 21.33 8 20.5v-5c0-.83.67-1.5 1.5-1.5z"></path><path d="M3.5 14H5v1.5c0 .83-.67 1.5-1.5 1.5S2 16.33 2 15.5 2.67 14 3.5 14z"></path><path d="M14 14.5c0-.83.67-1.5 1.5-1.5h5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5h-5c-.83 0-1.5-.67-1.5-1.5z"></path><path d="M15.5 19H14v1.5c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5-.67-1.5-1.5-1.5z"></path><path d="M10 9.5C10 8.67 9.33 8 8.5 8h-5C2.67 8 2 8.67 2 9.5S2.67 11 3.5 11h5c.83 0 1.5-.67 1.5-1.5z"></path><path d="M8.5 5H10V3.5C10 2.67 9.33 2 8.5 2S7 2.67 7 3.5 7.67 5 8.5 5z"></path></svg>
                            Ads Settings
                        </a>
                    </li>
                </ul>
                
                <div class="tab-content" id="pills-tabContent">
                    
                    <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="row">
                            <form action="" name="settings_home" method="POST" enctype="multipart/form-data">
                                <div class="form-group row mb-4">
                                    <label class="col-sm-3 col-form-label" for="app_name">Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="app_name" id="app_name" value="<?php echo $settings_data['app_name']?>"  class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-sm-3 col-form-label">Select logo</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="file"  name="app_logo"  accept=".png, .jpg, .JPG .PNG" onchange="fileValidation()" id="fileupload">
                                     </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-sm-3 col-form-label">&nbsp;</label>
                                    <div class="col-sm-9">
                                        <div class="fileupload_img" id="imagePreview">
                                            <?php if ($settings_data['app_logo'] !='' AND file_exists('images/'.$settings_data['app_logo'])) { ?>
                                                <img class="col-sm-3 img-thumbnail" type="image" src="images/<?=$settings_data['app_logo']?>" alt="image" />
                                            <?php } else { ?>
                                                <img class="col-sm-3 img-thumbnail" type="image" src="assets/images/300x300.jpg" alt="image" />
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-4">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9">
                                        <button type="submit" name="submit" class="btn btn-primary" style="min-width: 100px;">Save</button>
                                     </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade" id="pills-about" role="tabpanel" aria-labelledby="pills-about-tab">
                        <div class="row">
                            <form action="" name="settings_about" method="POST" enctype="multipart/form-data">
                                <div class="form-group row mb-4">
                                    <label class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="app_email" id="app_email" value="<?php echo $settings_data['app_email']?>"  class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-sm-3 col-form-label">Author</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="app_author" id="app_author" value="<?php echo $settings_data['app_author']?>"  class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-sm-3 col-form-label">Contact</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="app_contact" id="app_contact" value="<?php echo $settings_data['app_contact']?>"  class="form-control">
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-4">
                                    <label class="col-sm-3 col-form-label">Website</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="app_website" id="app_website" value="<?php echo $settings_data['app_website']?>"  class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-sm-3 col-form-label">Developed By</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="app_developed_by" id="app_developed_by" value="<?php echo $settings_data['app_developed_by']?>"  class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-sm-3 col-form-label">App Description</label>
                                    <div class="col-sm-9">
                                        <textarea name="app_description" id="app_description" class="form-control"><?php echo stripslashes($settings_data['app_description']); ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9">
                                        <button type="submit" name="about_submit" class="btn btn-primary" style="min-width: 100px;">Save</button>
                                     </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade" id="pills-app" role="tabpanel" aria-labelledby="pills-app-tab">
                        <div class="row">
                            <form action="" name="settings_app" method="POST" enctype="multipart/form-data">
                                <div class="form-group row mb-4">
                                    <label class="col-sm-3 col-form-label">RTL</label>
                                    <div class="col-sm-9">
                                        <label class="switch">
                                            <input type="checkbox" id="isRTL" name="isRTL" value="true" class="cbx hidden" <?php if($settings_data['isRTL']=='true'){ echo 'checked'; }?>/>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-sm-3 col-form-label">GIF</label>
                                    <div class="col-sm-9">
                                        <label class="switch">
                                            <input type="checkbox" id="isVPN" name="isVPN" value="true" class="cbx hidden" <?php if($settings_data['isVPN']=='true'){ echo 'checked'; }?>/>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-sm-3 col-form-label">Color</label>
                                    <div class="col-sm-9">
                                        <label class="switch">
                                            <input type="checkbox" id="isAPK" name="isAPK" value="true" class="cbx hidden" <?php if($settings_data['isAPK']=='true'){ echo 'checked'; }?>/>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-sm-3 col-form-label">Subscription</label>
                                    <div class="col-sm-9">
                                        <label class="switch">
                                            <input type="checkbox" id="isSubscription" name="isSubscription" value="true" class="cbx hidden" <?php if($settings_data['isSubscription']=='true'){ echo 'checked'; }?>/>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-sm-3 col-form-label">App Maintenance</label>
                                    <div class="col-sm-9">
                                        <label class="switch">
                                            <input type="checkbox" id="isMaintenance" name="isMaintenance" value="true" class="cbx hidden" <?php if($settings_data['isMaintenance']=='true'){ echo 'checked'; }?>/>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-sm-3 col-form-label">Disable Screenshot</label>
                                    <div class="col-sm-9">
                                        <label class="switch">
                                            <input type="checkbox" id="isScreenshot" name="isScreenshot" value="true" class="cbx hidden" <?php if($settings_data['isScreenshot']=='true'){ echo 'checked'; }?>/>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-sm-3 col-form-label">First Open Login Screen</label>
                                    <div class="col-sm-9">
                                        <label class="switch">
                                            <input type="checkbox" id="isLogin" name="isLogin" value="true" class="cbx hidden" <?php if($settings_data['isLogin']=='true'){ echo 'checked'; }?>/>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-sm-3 col-form-label">Google Login</label>
                                    <div class="col-sm-9">
                                        <label class="switch">
                                            <input type="checkbox" id="isGoogleLogin" name="isGoogleLogin" value="true" class="cbx hidden" <?php if($settings_data['isGoogleLogin']=='true'){ echo 'checked'; }?>/>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9">
                                        <button type="submit" name="app_submit" class="btn btn-primary" style="min-width: 100px;">Save</button>
                                     </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade" id="pills-policy" role="tabpanel" aria-labelledby="pills-policy-tab">
                        <div class="row">
                            <form action="" name="settings_policy" method="POST" enctype="multipart/form-data">
                                <div class="pb-card__body">
                                    <div class="pb-clipboard">
                                        <span class="pb-clipboard__url" id="pb_clipboard_url"><?=$privacy_policy_file_path ?></span>
                                        <a class="pb-clipboard__link" href="javascript:void(0);" data-clipboard-action="copy" data-clipboard-target="#pb_clipboard_url">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <textarea id="editor" name="app_privacy_policy" cols="30" rows="10"><?php echo stripslashes($settings_data['app_privacy_policy']); ?></textarea>
                                </div>
                                <button type="submit" name="policy_submit" class="btn btn-primary" style="min-width: 100px;">Save</button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade" id="pills-terms" role="tabpanel" aria-labelledby="pills-terms-tab">
                        <div class="row">
                            <form action="" name="settings_terms"  method="POST" enctype="multipart/form-data">
                                <div class="pb-card__body">
                                    <div class="pb-clipboard">
                                        <span class="pb-clipboard__url" id="pb_clipboard_url"><?=$terms_file_path ?></span>
                                        <a class="pb-clipboard__link" href="javascript:void(0);" data-clipboard-action="copy" data-clipboard-target="#pb_clipboard_url">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <textarea id="editor2" name="app_terms" cols="30" rows="10"><?php echo stripslashes($settings_data['app_terms']); ?></textarea>
                                </div>
                                <button type="submit" name="terms_submit" class="btn btn-primary" style="min-width: 100px;">Save</button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade" id="pills-ads" role="tabpanel" aria-labelledby="pills-ads-tab">
                        <div class="row">
                            <form action="" name="settings_ads" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="ads_view">
                                            <div class="ads_view_header">
                                                <label class="control-label">Banner Ads</label>
                                                <div class="row toggle_btn">
                                                    <label class="switch">
                                                        <input type="checkbox" id="checked1" name="banner_ad" value="true" class="cbx hidden" <?php if($settings_data['banner_ad']=='true'){ echo 'checked'; }?>/>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-12 p-2">
                                                <div class="form-group">
                                                    <p class="mb-1">Banner Ad Type</p>
                                                    <div class="col-md-12">
                                                        <select name="banner_ad_type" id="banner_ad_type" class="form-control">
                                                            <option value="admob" <?php if ($settings_data['banner_ad_type'] == 'admob') { ?>selected<?php } ?>>Admob</option>
                                                            <option value="facebook" <?php if ($settings_data['banner_ad_type'] == 'facebook') { ?>selected<?php } ?>>Facebook</option>
                                                            <option value="startapp" <?php if ($settings_data['banner_ad_type'] == 'startapp') { ?>selected<?php } ?>>Startapp</option>
                                                            <option value="unity" <?php if ($settings_data['banner_ad_type'] == 'unity') { ?>selected<?php } ?>>UnityAds</option>
                                                            <option value="iron" <?php if ($settings_data['banner_ad_type'] == 'iron') { ?>selected<?php } ?>>IronSource</option>
                                                        </select>
                                                    </div>
                                                    <p class="mb-1 mt-1 banner_size_add">AdSize</p>
                                                    <div class="col-md-12 banner_size" style="display: none">
                                                        <select name="banner_size" id="banner_size" class="form-control">
                                                            <option value="BANNER" <?php if($settings_data['banner_size']=='BANNER'){?>selected<?php }?>>BANNER</option>
                                                            <option value="SMART_BANNER" <?php if($settings_data['banner_size']=='SMART_BANNER'){?>selected<?php }?>>SMART_BANNER</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12 banner_size_fb" style="display: none">
                                                        <select name="banner_size_fb" id="banner_size_fb" class="form-control">
                                                            <option value="BANNER_HEIGHT_50" <?php if($settings_data['banner_size_fb']=='BANNER_HEIGHT_50'){?>selected<?php }?>>BANNER_HEIGHT_50</option>
                                                            <option value="BANNER_HEIGHT_90" <?php if($settings_data['banner_size_fb']=='BANNER_HEIGHT_90'){?>selected<?php }?>>BANNER_HEIGHT_90</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12 banner_size_iron" style="display: none">
                                                        <select name="banner_size_iron" id="banner_size_iron" class="form-control">
                                                            <option value="BANNER_HEIGHT_50" <?php if($settings_data['banner_size_iron']=='BANNER_HEIGHT_50'){?>selected<?php }?>>BANNER</option>
                                                            <option value="BANNER_HEIGHT_90" <?php if($settings_data['banner_size_iron']=='BANNER_HEIGHT_90'){?>selected<?php }?>>LARGE_BANNER</option>
                                                        </select>
                                                    </div>
                                                    
                                                    <p class="mb-1 p_ad_id" >Banner Ad ID</p>
                                                    <p class="mb-1 p_app_id" >App ID</p>
                                                    <p class="mb-1 p_game_id" >Game ID</p>
                                                    <p class="mb-1 p_app_key" >APP KEY</p>
                                                    
                                                    <div class="col-md-12 banner_ad_id" style="display: none">
                                                        <input type="text" name="banner_ad_id" id="banner_ad_id" value="<?php echo $settings_data['banner_ad_id']; ?>" class="form-control">
                                                    </div>
                                                    <div class="col-md-12 banner_facebook_id" style="display: none">
                                                        <input type="text" name="banner_facebook_id" id="banner_facebook_id" value="<?php echo $settings_data['banner_facebook_id']; ?>" class="form-control">
                                                    </div>
                                                    <div class="col-md-12 banner_startapp_id" style="display: none">
                                                        <input type="text" name="banner_startapp_id" id="banner_startapp_id" value="<?php echo $settings_data['banner_startapp_id']; ?>" class="form-control">
                                                    </div>
                                                    <div class="col-md-12 banner_unity_id" style="display: none">
                                                        <input type="text" name="banner_unity_id" id="banner_unity_id" value="<?php echo $settings_data['banner_unity_id']; ?>" class="form-control">
                                                    </div>
                                                    <div class="col-md-12 banner_iron_id" style="display: none">
                                                        <input type="text" name="banner_iron_id" id="banner_iron_id" value="<?php echo $settings_data['banner_iron_id']; ?>" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="ads_view">
                                            <div class="ads_view_header">
                                                <label class="control-label">Interstitial Ads</label>
                                                <div class="row toggle_btn">
                                                    <label class="switch">
                                                        <input type="checkbox" id="checked2" name="interstital_ad" value="true" class="cbx hidden" <?php if($settings_data['interstital_ad']=='true'){ echo 'checked'; }?>/>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-12 p-2">
                                                 <div class="form-group">
                                                    <p class="mb-1 ">Interstitial Ad Type</p>
                                                    <div class="col-md-12">
                                                        <select name="interstital_ad_type" id="interstital_ad_type" class="form-control">
                                                            <option value="admob" <?php if ($settings_data['interstital_ad_type'] == 'admob') { ?>selected<?php } ?>>Admob</option>
                                                            <option value="facebook" <?php if ($settings_data['interstital_ad_type'] == 'facebook') { ?>selected<?php } ?>>Facebook</option>
                                                            <option value="startapp" <?php if ($settings_data['interstital_ad_type'] == 'startapp') { ?>selected<?php } ?>>Startapp</option>
                                                            <option value="unity" <?php if ($settings_data['interstital_ad_type'] == 'unity') { ?>selected<?php } ?>>UnityAds</option>
                                                            <option value="iron" <?php if ($settings_data['interstital_ad_type'] == 'iron') { ?>selected<?php } ?>>IronSource</option>
                                                        </select>
                                                    </div>
                                                    <p class="mb-1 mt-1 i_ad_id" >Interstitial Ad ID</p>
                                                    <p class="mb-1 mt-1 i_app_id" >App ID</p>
                                                    <p class="mb-1 mt-1 i_game_id" >Game ID</p>
                                                    <p class="mb-1 mt-1 i_app_key" >APP KEY</p>
                                                    
                                                    <div class="col-md-12 interstital_ad_id" style="display: none">
                                                        <input type="text" name="interstital_ad_id" id="interstital_ad_id" value="<?php echo $settings_data['interstital_ad_id']; ?>" class="form-control">
                                                    </div>
                                                    <div class="col-md-12 interstital_facebook_id" style="display: none">
                                                        <input type="text" name="interstital_facebook_id" id="interstital_facebook_id" value="<?php echo $settings_data['interstital_facebook_id']; ?>" class="form-control">
                                                    </div>
                                                    <div class="col-md-12 interstital_startapp_id" style="display: none">
                                                        <input type="text" name="interstital_startapp_id" id="interstital_startapp_id" value="<?php echo $settings_data['interstital_startapp_id']; ?>" class="form-control">
                                                    </div>
                                                    <div class="col-md-12 interstital_unity_id" style="display: none">
                                                        <input type="text" name="interstital_unity_id" id="interstital_unity_id" value="<?php echo $settings_data['interstital_unity_id']; ?>" class="form-control">
                                                    </div>
                                                    <div class="col-md-12 interstital_iron_id" style="display: none">
                                                        <input type="text" name="interstital_iron_id" id="interstital_iron_id" value="<?php echo $settings_data['interstital_iron_id']; ?>" class="form-control">
                                                    </div>
                                                    <p class="mb-1">Interstitial Ad Clicks</p>
                                                    <div class="col-md-12">
                                                        <input type="text" name="interstital_ad_click" id="interstital_ad_click" value="<?php echo $settings_data['interstital_ad_click']; ?>" class="form-control ads_click">
                                                    </div>
                                                    
                                                 </div>
                                            </div>
                                    </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="ads_view">
                                            <div class="ads_view_header">
                                                <label class="control-label">Native Ads</label>
                                                <div class="row toggle_btn">
                                                    <label class="switch">
                                                        <input type="checkbox" id="checked4" name="native_ad" value="true" class="cbx hidden" <?php if($settings_data['native_ad']=='true'){ echo 'checked'; }?>/>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-12 p-2">
                                                 <div class="form-group">
                                                     <p class="mb-1 ">Native Ad Type</p>
                                                     <div class="col-md-12">
                                                        <select name="native_ad_type" id="native_ad_type" class="form-control">
                                                            <option value="admob" <?php if ($settings_data['native_ad_type'] == 'admob') { ?>selected<?php } ?>>Admob</option>
                                                            <option value="facebook" <?php if ($settings_data['native_ad_type'] == 'facebook') { ?>selected<?php } ?>>Facebook</option>
                                                            <option value="startapp" <?php if ($settings_data['native_ad_type'] == 'startapp') { ?>selected<?php } ?>>Startapp</option>
                                                            <option value="unity" <?php if ($settings_data['native_ad_type'] == 'unity') { ?>selected<?php } ?>>UnityAds</option>
                                                            <option value="iron" <?php if ($settings_data['native_ad_type'] == 'iron') { ?>selected<?php } ?>>IronSource</option>
                                                        </select>
                                                    </div>
                                                    <p class="mb-1 mt-1 n_ad_id" >Native Ad ID</p>
                                                    <p class="mb-1 mt-1 n_app_id" >App ID</p>
                                                    <p class="mb-1 mt-1 n_game_id" >Game ID</p>
                                                    <p class="mb-1 mt-1 n_app_key" >APP KEY</p>
                                                    
                                                    <div class="col-md-12 native_ad_id" style="display: none">
                                                        <input type="text" name="native_ad_id" id="native_ad_id" value="<?php echo $settings_data['native_ad_id']; ?>" class="form-control">
                                                    </div>
                                                    <div class="col-md-12 native_facebook_id" style="display: none">
                                                        <input type="text" name="native_facebook_id" id="native_facebook_id" value="<?php echo $settings_data['native_facebook_id']; ?>" class="form-control">
                                                    </div>
                                                    <div class="col-md-12 native_startapp_id" style="display: none">
                                                        <input type="text" name="native_startapp_id" id="native_startapp_id" value="<?php echo $settings_data['native_startapp_id']; ?>" class="form-control">
                                                    </div>
                                                    <div class="col-md-12 native_unity_id" style="display: none">
                                                        <input type="text" name="native_unity_id" id="native_unity_id" value="<?php echo $settings_data['native_unity_id']; ?>" class="form-control">
                                                    </div>
                                                    <div class="col-md-12 native_iron_id" style="display: none">
                                                        <input type="text" name="native_iron_id" id="native_iron_id" value="<?php echo $settings_data['native_iron_id']; ?>" class="form-control">
                                                    </div>
                                                    <p class="mb-1">Position of Ads</p>
                                                    <div class="col-md-12">
                                                        <input type="text" name="native_position" id="native_position" value="<?php echo $settings_data['native_position']; ?>" class="form-control ads_click">
                                                    </div>
                                                    
                                                 </div>
                                            </div>
                                    </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="ads_view">
                                            <div class="ads_view_header">
                                                <label class="control-label">Ads Click Limits</label>
                                                <div class="row toggle_btn">
                                                    <label class="switch">
                                                        <input type="checkbox" id="checked2" name="ads_limits" value="true" class="cbx hidden" <?php if($settings_data['ads_limits']=='true'){ echo 'checked'; }?>/>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-12 p-2">
                                                 <div class="form-group">
                                                    
                                                    <p class="mb-1 ">Ad Clicks</p>
                                                    <div class="col-md-12" >
                                                        <input type="text" name="ads_count_click" id="ads_count_click" value="<?php echo $settings_data['ads_count_click']; ?>" class="form-control">
                                                    </div>
                                                    <p class="mb-1 mt-1" style="font-size: 12px;">This feature will help you To avoid invalid clicks on your ads accounts.</p>
                                                    <p class="mb-1 mt-2" style="font-size: 12px;">How this works ?</p>
                                                    <p class="mb-1 mt-1" style="font-size: 12px;">We have set limits for ads click in oneDay by an user.</p>
                                                    <p class="mb-1 mt-1" style="font-size: 12px;">After he exceed limitations ads will not be shown to that user for next 24 hours.</p>
                                                    <p class="mb-1 mt-1" style="font-size: 12px;">This will help to secure your ads account from fraud clicks.</p>
                                                    
                                                 </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="ads_view">
                                            <div class="ads_view_header">
                                                <label class="control-label">Custom ads</label>
                                                <div class="row toggle_btn">
                                                    <label class="switch">
                                                        <input type="checkbox" id="checked2" name="custom_ads" value="true" class="cbx hidden" <?php if($settings_data['custom_ads']=='true'){ echo 'checked'; }?>/>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-12 p-2">
                                                 <div class="form-group">
                                                    
                                                    <p class="mb-1 ">Image URL</p>
                                                    <div class="col-md-12" >
                                                        <input type="text" name="custom_ads_img" id="custom_ads_img" value="<?php echo $settings_data['custom_ads_img']; ?>" class="form-control">
                                                    </div>
                                                    <p class="mb-1 ">Ad URL</p>
                                                    <div class="col-md-12" >
                                                        <input type="text" name="custom_ads_link" id="custom_ads_link" value="<?php echo $settings_data['custom_ads_link']; ?>" class="form-control">
                                                    </div>
                                                    <p class="mb-1 ">Ad Clicks</p>
                                                    <div class="col-md-12" >
                                                        <input type="text" name="custom_ads_clicks" id="custom_ads_clicks" value="<?php echo $settings_data['custom_ads_clicks']; ?>" class="form-control ads_click">
                                                    </div>
                                                 </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="ads_submit" class="btn btn-primary" style="min-width: 100px;">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Begin:: Main footer -->
        <?php include("includes/main_footer.php");?> 
        <!-- End:: Main footer  -->
    </div>
</main>
<!-- End:: Theme main content -->
<?php include("includes/footer.php");?> 