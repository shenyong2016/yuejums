<?php $loginedUser = $this -> session -> userdata('loginedUser');?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>订单详情</title>
  <base href="<?php echo site_url();?>">
  <link rel="stylesheet" href="assets/css/elementUI.css">
  <link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/houseManage.css">
  <link rel="stylesheet" href="assets/css/houseEidt.css">
  <style>
    .title{
      font-size: 16px;
      color: #424f63;
    }
    .house-content{
      margin-left: 30px;
      color: #000;
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- 左侧菜单 -->
    <?php include 'main_menu.php';?>
    <!-- 左侧菜单 --> 
    <div class="right-content" id="order-detail">
      <!-- 用户 -->
      <?php include 'user.php';?>
      <!-- 用户 -->
      <div style="display: flex;flex-direction: row;height: 50px; justify-content: space-between;">
        <div class="page-title" style="width: 100px;">订单详情</div>
        <a href="order/index" class="go-back">订单列表</a> 
      </div>
      <div class="mange-house">
        <el-row>
          <el-col :span="12">
            <span class="title">订&nbsp;&nbsp;单&nbsp;&nbsp;号：</span>
            <span class="house-content">{{orderInfo.order_num}}</span>
          </el-col>
          <el-col :span="12">
            <span class="title">公&nbsp;&nbsp;寓&nbsp;&nbsp;名：</span>
            <a :href="`house/house_detail/${orderInfo.house_id}`">
              <span style="color: #65CEA7;text-decoration: underline;" 
                    class="house-content">{{orderInfo.house_name}}</span>
            </a>
          </el-col>
        </el-row>
        <el-row>
          <el-col :span="12">
            <span class="title">入住时间：</span>
            <span class="house-content">{{orderInfo.start_time}}</span>
          </el-col>
          <el-col :span="12">
            <span class="title">退房时间：</span>
            <span class="house-content">{{orderInfo.end_time}}</span>
          </el-col>
        </el-row>
        <el-row>
          <el-col :span="12">
            <span class="title">预&nbsp;&nbsp;定&nbsp;&nbsp;人：</span>
            <span class="house-content">{{orderInfo.real_name}}</span>
          </el-col>
          <el-col :span="12">
            <span class="title">联系方式：</span>
            <span class="house-content">{{orderInfo.phone_num}}</span>
          </el-col>
        </el-row>
        <el-row>
          <el-col :span="12">
            <span class="title">紧急联系人：</span>
            <span class="house-content">{{orderInfo.emergency_tel}}</span>
          </el-col>
          <el-col :span="12">
            <span class="title">订单总价：</span>
            <span class="house-content">{{orderInfo.total_price}}.00元</span>
          </el-col>
        </el-row>
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
      el: '#order-detail',
      data: {
        orderNum: '',
        orderInfo: {}
      },
      methods: {
        loadOrderData(){
          axios.get('order/get_order_info', {
            params: {
              orderNum: this.orderNum
            }
          }).then(res => {
            this.orderInfo = res.data;
          });
        }
      },
      created(){
        this.orderNum = window.location.href.split('?')[1].split('=')[1];
        this.loadOrderData();
      }
    });
  
  
  
  
  
  
  
  
  
  
  </script>
</body>
</html>