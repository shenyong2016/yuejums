<?php $loginedUser = $this -> session -> userdata('loginedUser');?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>悦居后台管理系统-首页</title>
  <base href="<?php echo site_url();?>">
  <link rel="stylesheet" href="assets/css/elementUI.css">
  <link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/houseManage.css">
</head>
<body>
  <div class="container" data-user="<?php echo $loginedUser ? $loginedUser->username : '';?>">
    <!-- 左侧菜单 -->
    <?php include 'main_menu.php';?>
    <!-- 左侧菜单 --> 
    <!-- 右侧内容 -->
    <div class="right-content">
      <!-- 用户 -->
      <?php include 'user.php';?>
      <!-- 用户 -->
      
      <div class="manage-content">
        <h4>房源管理</h4>
        <div class="mange-house" id="mange-house">
          <div class="btn-group">
            <el-button v-on:click="addHouse" type="info" icon="el-icon-plus" size="mini">添加</el-button>
            <el-button type="info" icon="el-icon-minus" size="mini"
                      v-on:click="deleteHouseList">删除</el-button>
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
                <tr v-for="house in houseList">
                  <td><input type="checkbox" v-model="houseIdList" :value="house.house_id"></td>
                  <td>{{house.house_id}}</td>
                  <td>{{house.village_name}}</td>
                  <td>{{house.house_name}}</td>
                  <td>{{house.house_price}}.00</td>
                  <td>{{house.house_size}}</td>
                  <td>{{house.house_address}}</td>
                  <td>
                    <a :href="`house/house_detail/${house.house_id}`">详情</a>
                    <a :href="`house/edit_house/${house.house_id}`">编辑</a>
                    <a href="javascript:;" v-on:click="deleteHouse(house.house_id)">删除</a>                  
                  </td>
                </tr>
              </tbody>
            </table>  
          </div>
          <!-- 分页 -->
          <div class="pagination">
            <el-pagination
              background
              :total="houseCount"
              :pager-count="4"
              :page-size="pageSize"
              :page-sizes="[4, 8, 12, 16]"
              layout="sizes, prev, pager, next"
              v-on:current-change="handleCurrentChange"
              v-on:size-change="handleSizeChange">
            </el-pagination>
          </div>
          <!-- 分页 -->        
        </div>
      
    </div>
    <!-- 右侧内容 -->    
  </div>
  <input type="hidden" id="menu-index" value="0">
  <script src="assets/js/jquery-1.12.4.min.js"></script>
  <script src="assets/js/vue.min.js"></script>
  <script src="assets/js/axios.min.js"></script>  
  <script src="assets/js/elementUI.js"></script>
  <script src="assets/js/pagination.js"></script>
  <script src="assets/js/menu.js"></script>
  <script>
    $(function(){
      var user = $('.container').data('user');
      console.log(user);
      if(!user){
        window.location.href = 'welcome/login';
      }
    });
    new Vue({
      el: '#mange-house',
      data: {
        houseList: [],
        houseCount: 0,
        page: 1,
        pageSize: 4,
        houseIdList: []
      },
      methods: {
        goHouseDetail(houseId){
          console.log(houseId);
        },
        deleteHouseList(){
          if(this.houseIdList.length == 0){
            this.$message({
              type: 'warning',
              showClose: true,
              message: '请选择要删除的房源',
              duration: 1000
            });
            return;
          }
          var houseId = this.houseIdList.join(',');                    
          this.deleteHouse(houseId);
          this.loadHouseList(this.page, this.pageSize);                  
        },
        addHouse(){
          window.location.href = "house/edit_house";
        },
        deleteHouse(houseId){
          this.$confirm('确认删除该房源，是否继续?', '提示', {
            confirmButtonText: '确定',
            cancelButtonText: '取消',
            type: 'warning'
          }).then(() => {
            axios.get('house/delete_house', {
              params: {houseId}
            }).then(res => {
              if(res.data == 'success'){
                this.$message({
                  type: 'success',
                  showClose: true,
                  message: '删除成功',
                  duration: 1000
                });
                this.loadHouseList(this.page, this.pageSize);        
              }else{
                this.$message({
                  type: 'error',
                  showClose: true,
                  message: '删除失败',
                  duration: 1000
                });
              }            
            });
          }).catch(() => {
            this.$message({
              type: 'info',
              message: '已取消删除',
              duration: 1000              
            });   
          });
        },
        handleCurrentChange(page){
          this.loadHouseList(page, this.pageSize);
        },
        handleSizeChange(pageSize){
          this.pageSize = pageSize;
          this.loadHouseList(this.page, pageSize);          
        },
        loadHouseList(page, pageSize){
          axios.get('house/get_all_house', {
            params: {page, pageSize}
          }).then(res => {
            this.houseList = res.data.house;
            this.houseCount = res.data.house_count;
          });
        }
      },
      created(){
        this.loadHouseList(this.page, this.pageSize);
      }
      
    });
  
  
  
  
  </script>

</body>
</html>