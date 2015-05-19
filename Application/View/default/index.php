<html>
    <head>
        <title>登录</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="<?php echo Pub('js/jquery-1.7.2.min.js') ?>"></script>
    </head>
    <body>
        <div>
            <form method="post" action="<?php echo U('index/submit') ?>">
            <li>账号：<input type="text" name="username" value="爬虫12号"></li>
            <li>密码：<input type="text" name="pass" value="daijinjiang"></li>
            <li>验证码：<input type="text" name="yzm"><img src="<?php echo U('Index/getImg'); ?>" id="yzm"> </li>
            <li><input type="submit" name='tj' value='login'> </li>
            </form>
        </div>
    <script>
        $(function(){
            var url = "<?php echo U('Index/getImg'); ?>";
        })
    </script>
    </body>
</html>