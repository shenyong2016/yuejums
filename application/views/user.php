<div class="user">
  <?php if($loginedUser){?>
    <a href=""><?php echo $loginedUser->username;?></a>
  <?php
    }else{
  ?>
    <a href="welcome/login">登录</a>
  <?php
    }
  ?>
  
</div>