<?php
 include 'aksi.php'; 
 session_start();
 ob_start();

 if(isset($_SESSION['session_username'])){
    header("location:admin.php");
    exit();
}
?>
<!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->

<div class="container my-4 " >    
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
        <div class="panel panel-info" style="  border-color: #6f887b;">
            <div class="panel-heading" style=" background: linear-gradient(59deg, #6f887b, #6f887b, #16222A); " >
                <div class="panel-title" style=" background: linear-gradient(59deg, #6f887b, #6f887b, #16222A);" >Login dan Masuk Ke Sistem</div>
            </div>      
            <div style="padding-top:30px" class="panel-body" >
                <?php if($err){  ?>
                    <div id="login-alert" class="alert alert-danger col-sm-12">
                        <ul><?php echo $err ?></ul>
                    </div>
                <?php } ?>     
                
                <?php if($_POST) ;?>
                <form id="loginform" class="form-horizontal" action="" method="post" role="form">       
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="login-username" type="text" class="form-control" name="username" value="<?php echo $username ?>" placeholder="username">                                        
                    </div>
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
                    </div>
                    <div class="input-group">
                        <div class="checkbox">
                        <label>
                            <input id="login-remember" type="checkbox" name="ingataku" value="1" <?php if($ingataku == '1') echo "checked"?>> Ingat Aku
                        </label>
                        </div>
                    </div>
                    <div style="margin-top:10px" class="form-group">
                        <div class="col-sm-12 controls">
                            <input type="submit" name="login" class="btn btn-success" value="Login"/>
                        </div>
                    </div>
                </form>    
            </div>                     
        </div>  


        
</div>
</div>
