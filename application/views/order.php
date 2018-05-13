<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>订单管理</title>
  <base href="<?php echo site_url();?>">
  <link rel="stylesheet" href="assets/css/elementUI.css">
  <link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/houseManage.css"> 
</head>
<body>
  <div class="container">
    <!-- 左侧菜单 -->
    <?php include 'main_menu.php';?>
    <!-- 左侧菜单 --> 
    <div class="right-content">
      <!-- 用户 -->
      <?php include 'user.php';?>
      <!-- 用户 -->
      <div class="manage-content">
        <h4>订单管理</h4>
        <div class="mange-house" id="manage-order">
          <div class="btn-group">
            <el-button type="info" icon="el-icon-plus" size="mini">添加</el-button>
            <el-button type="info" icon="el-icon-minus" size="mini"
                      >删除</el-button>
          </div>
          <div class="house-table">
            <table>
              <thead>
                <tr>
                  <th></th>
                  <th>编号</th>
                  <th>小区名</th>
                  <th>公寓名</th>
                  <th>价格</th>
                  <th>房屋类型</th>
                  <th>地址</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><input type="checkbox"></td>
                  <td>house.house_id</td>
                  <td>house.village_name</td>
                  <td>house.house_name</td>
                  <td>house.house_price.00</td>
                  <td>house.house_size</td>
                  <td>house.house_address</td>
                  <td>
                    <a href="">编辑</a>
                    <a href="javascript:;">删除</a>                  
                  </td>
                </tr>
              </tbody>
            </table>  
          </div>
    </div>
  </div>
  

  <input type="hidden" id="menu-index" value="1">
  <script src="assets/js/jquery-1.12.4.min.js"></script>
  <script src="assets/js/vue.min.js"></script>
  <script src="assets/js/axios.min.js"></script>  
  <script src="assets/js/elementUI.js"></script>
  <script src="assets/js/menu.js"></script>
  <script>
    new Vue({
      el: '#manage-order'
    });
  
  
  </script>
</body>
</html>