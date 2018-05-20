<?php $loginedUser = $this -> session -> userdata('loginedUser');?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>房源详情</title>
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

    <div class="right-content" id="edit-house">
      <!-- 用户 -->
      <?php include 'user.php';?>
      <!-- 用户 -->
      <div style="display: flex;flex-direction: row;height: 50px; justify-content: space-between;">
        <div class="page-title" style="width: 100px;">房源详情</div>
        <a href="welcome/index" class="go-back">房源列表</a> 
      </div>
      <div class="mange-house">
        <el-row>
          <el-col :span="12">
            <span class="title">小&nbsp;&nbsp;区&nbsp;&nbsp;名：</span>
            <span class="house-content">{{village}}</span>
          </el-col>
          <el-col :span="12">
            <span class="title">房&nbsp;&nbsp;源&nbsp;&nbsp;名：</span>
            <span class="house-content">{{houseName}}</span>
          </el-col>
        </el-row>
        <el-row>
          <el-col :span="12">
            <span class="title">房屋大小：</span>
            <span class="house-content">{{houseSize}}</span>
            
          </el-col>
          <el-col :span="12">
            <span class="title">房屋类型：</span>
            <span class="house-content">{{houseType}}</span>
                            
          </el-col>
        </el-row>
        <el-row>
          <el-col :span="12">
            <span class="title">面&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;积：</span>&nbsp;&nbsp;&nbsp;&nbsp;
            使用面积    
            {{userArea}}.00平方米 &nbsp;&nbsp;&nbsp;&nbsp;
            建筑面积
            {{buildArea}}.00平方米
            
          </el-col>
          <el-col :span="12">
            <span class="title">区&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;域：</span>
            <span class="house-content">{{location}}</span>
            
          </el-col>
        </el-row>
        <el-row>
          <el-col :span="12">
            <el-col :span="8">
              <span class="title">价&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;钱：</span>
              <span class="house-content">{{price}}.00/日</span>
              
            </el-col>
            <el-col :span="2">
              {{saleType == 2 ? '可售' : '不可售'}}
            </el-col>
            <el-col :span="2">
              <span style="white-space: nowrap;">{{recommend == 1 ? '推荐房源' : ''}}</span>                
            </el-col>
          </el-col>
          <el-col :span="12">
            <span class="title">经&nbsp;&nbsp;纬&nbsp;&nbsp;度：</span>
              <span class="house-content">{{this.position}}</span>
            
          </el-col>
        </el-row>
       
        <el-row> 
          <el-col :span="12">
            <span class="title">地&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;址：</span>
            <span class="house-content">{{this.address}}</span>            
          </el-col>
        </el-row>
        <div style="margin-top: 20px;display: flex;flex-direction: row;">
          <div class="title" style="width: 80px; white-space:nowrap;">交通情况：</div>
          <div class="house-content" 
               style="">{{this.traffic}}</div>
        </div>
        
        <div style="margin-top: 20px;display: flex;flex-direction: row;">
          <div class="title" style="width: 80px; white-space:nowrap;">房源详情：</div>
          <div class="house-content" 
               >{{this.detail}}</div>
        </div>
        <div style="margin-top: 20px;display: flex;flex-direction: row;">
          <div class="title" style="width: 80px; white-space:nowrap;">入住须知：</div>
          <div class="house-content" 
               >{{this.note}}</div>
        </div>
        <div style="margin-top: 20px;display: flex;flex-direction: row;">
          <div class="title" style="white-space:nowrap;">房源图片：</div>
          <div class="house-content" 
               >
               <div class="img-container" style="margin-top: 0;">
              <div class="img-list" v-for="(item, index) in houseImgList">
                <img :src="item" alt="">
              </div>
            </div>
          </span>
        </div>
      </div>
    </div>
  </div>



  <input type="hidden" id="menu-index" value="0">
  <script src="assets/js/jquery-1.12.4.min.js"></script>
  <script src="assets/js/vue.min.js"></script>
  <script src="assets/js/axios.min.js"></script>  
  <script src="assets/js/elementUI.js"></script>
  <script src="assets/js/menu.js"></script>
  <script>
    new Vue({
      el: '#edit-house',
      data: {
        houseId: <?php echo $this->uri->segment(3) ? $this->uri->segment(3) : 0;?>,
        houseName: '',    
        village: '',
        houseSize: '',
        houseType: '',
        buildArea: '',
        userArea: '',
        location: '',
        price: '',
        position: '',
        address: '',
        traffic: '',
        detail: '',
        note: '',
        saleType: '',
        recommend: '',
        houseImgList: [],
      },
      methods: {
        loadHouseData(){
          axios.get('house/get_house_detail', {
            params: {houseId: this.houseId}
          }).then(res => {
            var houseData = res.data.house;
            var houseImgData = res.data.house_img; 
            for(var i=0; i<houseImgData.length; i++){
              this.houseImgList.push(houseImgData[i].img_src.slice(8));
            }
            console.log(houseData);
            this.village = houseData.village_name;
            this.houseName = houseData.house_name;
            this.houseSize = houseData.house_size;
            this.houseType = houseData.house_type;
            this.buildArea = houseData.house_build_area;
            this.userArea = houseData.house_user_area;
            this.location = houseData.house_location;
            this.price = houseData.house_price;
            this.saleType = houseData.sale_type;
            this.recommend = houseData.house_recommened;
            this.address = houseData.house_address;
            this.traffic = houseData.house_traffic;
            this.detail = houseData.house_details;
            this.note = houseData.house_note;
            this.traffic = houseData.house_traffic;
            this.position  = houseData.house_lng_lat;
          });
        }
      },
      created(){
        if(this.houseId){
          this.loadHouseData();
        }
      }
    });
  
  
  
  
  
  
  
  
  
  
  
  
  
  </script>
</body>
</html>