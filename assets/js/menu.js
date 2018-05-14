$(function(){
  // 主菜单切换
  $tab = $('.menu-tab li');
  var iNow = Number($('#menu-index').val());
  changeTab(iNow);
  $tab.on('click', function(){
    var index = $(this).index();
    var url = '';
    changeTab(index);
    switch(+index){
      case 0:
        url = "welcome/index";
        break;
      case 1:
        url = "order/index";
        break;
      case 2:
        url = "javascript:;";
    }
    window.location.href = url;
  });
  function changeTab(index){
    $tab.eq(index).addClass('active').siblings().removeClass('active');
    $tab.eq(index).children('.menu-info').addClass('active').parent('li')
    .siblings().children('.menu-info').removeClass('active');
    $tab.eq(index).children('.menu-icon').addClass('active').parent('li')
    .siblings().children('.menu-icon').removeClass('active');
  }

  // 退出系统
  $('.logout').on('click', function(){
    console.log(123456);
    $.get('welcome/logout', function(res){
      if(res == 'success'){
        window.location.href = "welcome/login";
      }
    }, 'text');
  });
});