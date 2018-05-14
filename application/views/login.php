<!DOCTYPE html>
<!-- saved from url=(0058)http://www.gigahome.cn/newapp/index.php/Admin/Public/login -->
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="Author" content="zhouquan">
    <title>悦居后台管理系统</title>
    <base href="<?php echo site_url();?>">
    <style type="text/css">
        html,body,div,p,h1,ul,li,form{margin:0;padidng:0;}
        html{min-height:100%;height:100%;overflow:hidden;}
        body{position:relative;min-height:100%;font:14px/20px '\5FAE\8F6F\96C5\9ED1','\5b8b\4f53',arial,tahoma, Srial, helvetica, sans-serif;color:#666;background-color:#65CEA7;}
        li{list-style:none;}
        a, button, input, :focus{outline:none;}
        em{font-style:normal;}
        .v-2{vertical-align:-2px;}
        /* .mt50{margin-top:50px;} */
        .cor-white{color:#fff;}
        .login-box{z-index:2;position:absolute;top:50%;left:50%;width:420px;height:420px;margin:-210px 0 0 -210px;}
        .login-list li{margin:10px 0;padding-left:35px;}
        .inpBar{display:inline-block;width:200px;line-height:30px;padding:0 15px;border-radius:15px;background-color:#fff;overflow:hidden;}
        .text{display:inline-block;width:130px;line-height:20px;margin-left:10px;padding:5px 10px;font:14px/20px '\5FAE\8F6F\96C5\9ED1','\5b8b\4f53',arial,tahoma, Srial, helvetica, sans-serif;color:#666;border:none 0;background-color:#fff;transition:all .2s ease-in-out;vertical-align:middle;}
        input.text:focus{box-shadow:-5px -3px 8px rgba(102, 175, 233, .3);}
        .btn{width:125px;line-height:20px;margin:5px 0 0 50px;padding:5px 0;font-weight:bold;color:#fff;font-size:15px;border:solid 1px #ffffff;border-radius:15px;background-color:#65CEA7;cursor:pointer;transition:all .2s ease-in-out;}
        .btn:hover{color:#65CEA7;background-color:#fff;transition:all .2s ease-in-out;}
        .result{ display:inline-block !important;margin-left:10px;color:#f00;}
        .wel{padding:50px 55px 0 0;text-align:center;color:#fff;}
        .login-bottom{position:absolute;bottom:0;left:0;width:100%;height:20px;background-color:#0f64a5;}
        .login-bg{position:relative;top:-20px;height:20px;background:url(/newapp/Application/Admin/View/Public/images/login_bg.png) center 100% no-repeat;}
        #code_check{width:110px;border:none;}
        #get_code{border:none;width:85px;text-align:center;color:#666;font-size:12px;cursor:pointer;}
        #get_code:hover{color:#1e8fda;}
        .get_codeDisabled{background-color:#eee;color:#bbbbbb !important;}
        .get_codeDisabled:hover{background-color:#eee;color:#bbbbbb !important;}
    </style>
</head>
  <body>
    <div class="login-box">
        <img src="assets/img/login_logo.jpg" width="420" height="119">
        <form method="post" id="form1" name="form1" class="mt50">
            <ul class="login-list">
                <li>
                    <label class="inpBar">
                        账户
                        <input type="text" id="account" autocomplete="off" name="account" value="" class="text" required="" maxlength="25">
                    </label>
                </li>
                <li>
                    <label class="inpBar">
                        密码
                        <input type="password" id="password" autocomplete="off" name="password" value="" class="text" required="" maxlength="25">
                    </label>
                </li>
                <li>
                    <span id="result" class="result"></span>
                    <p class="mt10" id="tisi"></p>
                </li>
                <li>
                    <input type="button" class="btn z-loginBtn" value="登&nbsp;&nbsp;录" id="denglu">
                </li>
            </ul>
        </form>
        <p class="wel">欢迎使用悦居后台管理系统</p>
    </div>
    <script type="text/javascript" src="assets/js/jquery-1.12.4.min.js"></script>    
    <script>

      $('.z-loginBtn').on('click', function(){
        var username = $('#account').val();
        var password = $('#password').val();
        var $result = $('#result');
        $.post('welcome/check_login', {
          username, password
        }, function(res){
          if(res == 'success'){
            window.location.href = "welcome/index";
          }else{
            alert('登录失败');        
          }
        },'text');
      });
    
    
    
    </script>
  </body>
</html>