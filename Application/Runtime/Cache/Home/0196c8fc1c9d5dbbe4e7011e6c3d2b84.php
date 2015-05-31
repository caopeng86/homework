<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>社区快递管理系统</title>

    <!-- Bootstrap -->
    <link href="/homework/Public/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/homework/Public/css/index.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <nav class="navbar navbar-default navbar-fixed-top" id="exNavbar">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">社区快递管理系统</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-left">
          <li><a href="/homework/index.php/Home/Index/user">提交快递</a></li>
          <li class="active"><a href="#">代领快递<span class="sr-only">(current)</span></a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#"><?php echo ($username); ?></a></li>
          <li><a href="/homework/index.php/Home/Index/index">注销</a></li>         
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
  <section id="main-content">
    <div class="table-content">
        <table class="table table-bordered table-striped">
         <thead>
          <tr>
           <th>姓名</th>
           <th>电话</th>
           <th>快递公司</th>
           <th>运单号</th>
           <th>寄件地址</th>
           <th>收件地址</th>
           <th>操作</th>
         </tr>
       </thead>
       <tbody>
        <?php if(is_array($expressList)): $i = 0; $__LIST__ = $expressList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$express): $mod = ($i % 2 );++$i;?><tr>
           <td><?php echo ($express["name"]); ?></td>
           <td><?php echo ($express["phone"]); ?></td>
           <td><?php echo ($express["company"]); ?></td>
           <td><?php echo ($express["expressnumber"]); ?></td>
           <td><?php echo ($express["startaddress"]); ?></td>
           <td><?php echo ($express["endaddress"]); ?></td>
           <td data-expressid=<?php echo ($express["expressid"]); ?>><a href="" class="getExpress" data-isget="false">代领</a></td>
         </tr><?php endforeach; endif; else: echo "" ;endif; ?>
       </tbody>
     </table>
   </div>
  </section>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/homework/Public/js/jquery-1.11.2.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/homework/Public/js/bootstrap.min.js"></script>
    <script type="text/javascript">
      $(function(){
        $('.table-content tbody').on('click', '.getExpress', function(event) {
          event.preventDefault();
          /* Act on the event */
          console.log($(this));
          $isGet = $(this).data('isget');
          // console.log($isGet);
          if($isGet == false) {
            // alert('带领成功！');
            $(this).text('取消代领');
            $(this).data('isget', true);
          } else {
            $(this).text('代领');
            $(this).data('isget', false);
          }
        });
      });
    </script>
  </body>
</html>