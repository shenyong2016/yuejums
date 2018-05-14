
<?php $loginedUser = $this -> session -> userdata('loginedUser');?>

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
          <div class="btn-group" style="height: 30px; line-height: 30px">
            <el-radio v-model="isFinished" label="1" v-on:change="searchOrder">未完成</el-radio>
            <el-radio v-model="isFinished" label="2" v-on:change="searchOrder">已完成</el-radio>
          </div>
          <div class="house-table">
            <table>
              <thead>
                <tr>
                  <th>订单号</th>
                  <th>公寓名</th>
                  <th>入住时间</th>
                  <th>退房时间</th>
                  <th>预定人</th>
                  <th>联系电话</th>
                  <th>订单总价</th>
                  <th>操作</th>                  
                </tr>
              </thead>
              <tbody>
                <tr v-for="order in orderList">
                  <td>{{order.order_num}}</td>         
                  <td>{{order.house_name}}</td>
                  <td>{{order.start_time}}</td>
                  <td>{{order.end_time}}</td>
                  <td>{{order.real_name}}</td>
                  <td>{{order.phone_num}}</td>  
                  <td>{{order.total_price}}.00</td>
                  <td>
                    <a :href="`order/order_detail?orderId=${order.order_num}`">详情</a>                  
                  </td>
                </tr>
              </tbody>
            </table>  
          </div>
          <!-- 分页 -->
          <div class="pagination">
            <el-pagination
              background
              :total="orderCount"
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
  

  <input type="hidden" id="menu-index" value="1">
  <script src="assets/js/jquery-1.12.4.min.js"></script>
  <script src="assets/js/vue.min.js"></script>
  <script src="assets/js/axios.min.js"></script>  
  <script src="assets/js/elementUI.js"></script>
  <script src="assets/js/menu.js"></script>
  <script>
    new Vue({
      el: '#manage-order',
      data: {
        orderList: [],
        orderCount: 0,
        pageSize: 4,
        page: 1,
        isFinished: 0,//初始化加载所有订单
      },
      methods: {
        handleCurrentChange(page){
          this.loadOrderList(page, this.pageSize, this.isFinished);
        },
        handleSizeChange(pageSize){
          this.pageSize = pageSize;
          this.loadOrderList(this.page, pageSize, this.isFinished);          
        },
        searchOrder(){
          this.loadOrderList(this.page, this.pageSize, this.isFinished);          
        },
        loadOrderList(page, pageSize, isFinished){
          axios.get('order/get_all_order', {
            params: {page, pageSize, isFinished}
          }).then(res => {
            this.orderList = res.data.order;
            this.orderCount = res.data.order_count;
          });
        }
      },
      created(){
        this.loadOrderList(this.page, this.pageSize, this.isFinished);
      }
    });
  
  
  </script>
</body>
</html>