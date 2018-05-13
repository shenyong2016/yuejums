<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>编辑房源</title>
  <base href="<?php echo site_url();?>">
  <link rel="stylesheet" href="assets/css/elementUI.css">
  <link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/houseManage.css">
  <link rel="stylesheet" href="assets/css/houseEidt.css">
  
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
      <h4>{{houseId ? '编辑房源' : '添加房源'}}</h4>
      <div class="mange-house">
        <el-row>
          <el-col :span="12">
            <span>小&nbsp;&nbsp;区&nbsp;&nbsp;名</span>
            <el-select v-model="village" placeholder="请选择">
              <el-option
                v-for="item in villageOptions"
                :key="item.value"
                :label="item.label"
                :value="item.value">
              </el-option>
            </el-select>
          </el-col>
          <el-col :span="12">
            <span>房&nbsp;&nbsp;源&nbsp;&nbsp;名</span>
            <el-input v-model="houseName" placeholder="请输入房源名"></el-input>
          </el-col>
        </el-row>
        <el-row>
          <el-col :span="12">
            <span>房屋大小</span>
            <el-select v-model="houseSize" placeholder="请选择">
              <el-option
                v-for="item in houseSizeOptions"
                :key="item.value"
                :label="item.label"
                :value="item.value">
              </el-option>
            </el-select>
          </el-col>
          <el-col :span="12">
            <span>房屋类型</span>
            <el-input size="mini" v-model="room"></el-input>室
            <el-input size="mini" v-model="hall"></el-input>厅          
            <el-input size="mini" v-model="toilet"></el-input>卫                                  
          </el-col>
        </el-row>
        <el-row>
          <el-col :span="12">
            <span>面&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;积</span>&nbsp;&nbsp;&nbsp;&nbsp;
            使用面积<el-input size="mini" v-model="userArea"></el-input>            
            建筑面积<el-input size="mini" v-model="buildArea"></el-input>
          </el-col>
          <el-col :span="12">
            <span>区&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;域</span>
            <el-select v-model="location" placeholder="请选择">
              <el-option
                v-for="item in locationOptions"
                :key="item.value"
                :label="item.label"
                :value="item.value">
              </el-option>
            </el-select>
          </el-col>
        </el-row>
        <el-row>
          <el-col :span="12">
            <el-col :span="8">
              <span>价&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;钱</span>
              <el-input size="mini" v-model="price"></el-input>/日
            </el-col>
            <el-col :span="2">
              <el-checkbox v-model="saleType">可售</el-checkbox>
            </el-col>
            <el-col :span="2">
              <el-checkbox v-model="recommend">推荐</el-checkbox>
            </el-col>
          </el-col>
          <el-col :span="12">
            <span>经&nbsp;&nbsp;纬&nbsp;&nbsp;度</span>
            <el-input size="medium" v-model="position"></el-input>
          </el-col>
        </el-row>
        <el-row>
          <el-col :span="12">
            <span class="house-title">地&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;址</span>
            <el-input type="textarea" v-model="address"></el-input>
          </el-col>
        </el-row>
        <el-row>
          <el-col :span="16">
            <span class="house-title">交通情况</span>
            <el-input type="textarea" v-model="traffic"></el-input>
          </el-col>
        </el-row>
        <el-row>
          <el-col :span="16">
            <span class="house-title">房源详情</span>
            <el-input type="textarea" v-model="detail"></el-input>
          </el-col>
        </el-row>
        <el-row>
          <el-col :span="16">
            <span class="house-title">入住须知</span>
            <el-input type="textarea" v-model="note"></el-input>
          </el-col>
        </el-row>
        <el-row>
          <el-col :span="4">
            <div class="upload-continer">
              <span class="upload-title">房源图片</span>
              <div class="do-upload">
                <img v-on:click="triggerUpload" src="assets/img/photo-upload.jpg" alt="">
                <input accept="image/gif, image/jpeg,image/png,image/jpg" 
                       ref="file" type="file"
                       v-on:change="doUpload">
              </div>
            </div>
          </el-col>
          <el-col :span="20">
            <div class="img-container">
              <div class="img-list" v-for="(item, index) in houseImgList">
                <img :src="item" alt="">
                <span v-on:click="deleteImg(index)" class="delete-img"></span>
              </div>
              
            </div>
          </el-col>
        </el-row>
        <el-row>
          <p class="submit">
            <buuton class="submit-house" type="primary" v-on:click="submitInfo">{{houseId ? '修改' : '添加'}}房源</buuton>          
          </p>
        </el-row>
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
        villageOptions: [
          {
          value: 1,
          label: '悦居公寓 康泰嘉园'
          }, 
          {
            value: 2,
            label: '悦居公寓•熙俊印象'
          }, 
          {
            value: 3,
            label: '悦居公寓•群力家园'
          }, 
          {
            value: 4,
            label: '悦居公寓•雨阳名居'
          }, 
          {
            value: 5,
            label: '悦居公寓•玫瑰湾'
          },
          {
            value: 6,
            label: '悦居公寓•新怡园'
          }
        ],
        houseSizeOptions: [
          {
            value: 1,
            label: '一居室'
          }, 
          {
            value: 2,
            label: '二居室'
          }, 
          {
            value: 3,
            label: '三居室'
          }, 
          {
            value: 4,
            label: '四居室及以上'
          },
        ],
        locationOptions: [
          {
            value: 1,
            label: '香坊区'
          }, 
          {
            value: 2,
            label: '南岗区'
          }, 
          {
            value: 3,
            label: '动力区'
          }, 
          {
            value: 4,
            label: '道里区'
          },
          {
            value: 5,
            label: '道外区'
          },
          {
            value: 6,
            label: '江北区'
          }
        ],
        houseSize: 1,
        village: 1,
        room: 1,
        hall: 1,
        toilet: 1,
        buildArea: '',
        userArea: '',
        location: 1,
        price: '',
        position: '',
        address: '',
        traffic: '',
        detail: '',
        note: '',
        saleType: false,
        recommend: false,
        houseImgList: [],
      },
      methods: {
        checkNum(value){
          if(!/^\d+$/.test(value)){
            this.$message({
              type: 'warning',
              showClose: true,
              message: '请输入数字',
              duration: 1000
            });
          }
        },
        triggerUpload(){
          this.$refs.file.click();
        },
        doUpload(){
          var oFormData = new FormData();
          oFormData.append('img', this.$refs.file.files[0]);
          var config = {
            headers:{'Content-Type':'multipart/form-data'}
          }; 
          axios.post('welcome/upload_img',oFormData,config).then(res => {
            this.houseImgList.push(res.data);
          });
        },
        deleteImg(index){
          var imgSrc = this.houseImgList[index];
          axios.get('welcome/delete_img', {
            params: { imgSrc }
          }).then(res => {
            if(res.data == 'success'){
              this.houseImgList.splice(index, 1);                        
            }
          });
        },
        submitInfo(){
          const { village,houseName,houseSize,room,hall,toilet,buildArea,userArea,
                  location,price,position,address,traffic,detail,note,houseImgList,
                  saleType,villageOptions,houseSizeOptions,locationOptions,houseId,recommend} = this;
          const villageName = villageOptions[village-1].label;
          const houseSizeName = houseSizeOptions[houseSize-1].label;          
          const locationName = locationOptions[location-1].label;
          console.log('houseImgList===',houseImgList);
          if(!/^\d+$/.test(buildArea) || !/^\d+$/.test(userArea)){
            this.$message({
              type: 'warning',
              showClose: true,
              message: '面积请输入数字',
              duration: 1000
            });
            return;
          }
          if(!/^\d+$/.test(room) || !/^\d+$/.test(hall) || !/^\d+$/.test(toilet)){
            this.$message({
              type: 'warning',
              showClose: true,
              message: '房屋类型请输入数字',
              duration: 1000
            });
            return;
          }
          if(!/^\d+$/.test(price)){
            this.$message({
              type: 'warning',
              showClose: true,
              message: '价钱请输入数字',
              duration: 1000
            });
            return;
          }
          const houseType = room +'室'+ hall +'厅'+ toilet +'卫';
          let recommendVal = recommend ? 1 : 0;
          let saleTypeVal = saleType ? 2 : 1;
          axios.get('house/commit_house_info', {
            params: { village,houseName,houseSize,buildArea,userArea,location,
                      price,position,address,traffic,detail,note,recommendVal,
                      saleTypeVal,villageName,houseSizeName,locationName,houseId,houseType,
                      houseImgList: JSON.stringify(houseImgList)}
          }).then(res => {               
            if(res.data == 'success'){
              this.$message({
                type: 'success',
                showClose: true,
                message: '添加房源成功',
                duration: 1000
              }); 
              setTimeout(() => {
                window.location.href = "welcome/index";                                                      
              }, 1000);
            }else if(res.data == 'update'){
              this.$message({
                type: 'success',
                showClose: true,
                message: '修改房源成功',
                duration: 1000
              }); 
              setTimeout(() => {
                window.location.href = "welcome/index";                                                      
              }, 1000);
            }else if(res.data == 'no_update'){
              this.$message({
                type: 'error',
                showClose: true,
                message: '修改房源失败',
                duration: 1000
              });
            }else{
              this.$message({
                type: 'error',
                showClose: true,
                message: '添加房源失败',
                duration: 1000
              });
            }
          });
        },
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
            this.village = Number(houseData.village_type);
            this.houseName = houseData.house_name;
            this.houseSize = Number(houseData.house_size_val);
            this.room = houseData.house_type.charAt(0);
            this.hall = houseData.house_type.charAt(2);
            this.toilet = houseData.house_type.charAt(4);
            this.userArea = houseData.house_user_area;
            this.buildArea = houseData.house_build_area;
            const locationObj = {
              '香坊区': 1,
              '南岗区': 2,
              '动力区': 3,
              '道里区': 4,
              '道外区': 5,
              '江北区': 6,
            };
            this.location = locationObj[houseData.house_location];
            this.price = houseData.house_price;
            this.position = houseData.house_lng_lat;
            this.address = houseData.house_address;
            this.traffic = houseData.house_traffic;
            this.detail = houseData.house_details;
            this.note = houseData.house_note;
            this.saleType = Number(houseData.sale_type) == 2 ? true : false;
            this.recommend = Number(houseData.house_recommened) == 1 ? true : false;
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