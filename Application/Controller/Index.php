<?php
namespace Application\Controller;

class Index extends \Ji\Core\Controller
{
    public function index()
    {
        $this->show('index');
    }
    public function getImg()
    {
        //匹配需要的参数
        $url = 'http://passport.uc108.com/getvalidatecode.aspx?rt=1&r='.rand();
        $content = file_get_contents($url);
        $pattern = "/\"(.*?)\"/";
        preg_match($pattern, $content, $match);
        $key = $match[1];
        $_SESSION['code'] = $key;

        //请求验证码 并保存cookie
        $url = "http://passport.uc108.com/ValidateCode.aspx?CodeID=".$key;
        $cookie_file = tempnam('./temp','cookie');
        $_SESSION['file'] = $cookie_file;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; zh-CN; rv:1.9.1.5) Gecko/20091102 Firefox/3.5.5');
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
        $content = curl_exec($ch);
        curl_close($ch);

        //输出验证码
        header('Content-Type:image/png');
        echo $content;
    }
    /*
     * 提交
     */
    public function submit()
    {
        $url = "http://passport.uc108.com/login.aspx?mode=1";
        $data = array(
            'username'      => $_POST['username'],
            'password'      => $_POST['pass'],
            'verifyCode'    => $_POST['yzm'],
            'verifycodeid'  => $_SESSION['code'],
        );
        $ch = curl_init($url);
        $array = Array(
            "Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
            "Accept-Encoding:gzip, deflate",
            "Accept-Language:zh-CN,zh;q=0.8",
            "Cache-Control:max-age=0",
            "Connection:keep-alive",
            "Content-Length:180",
            "Content-Type:application/x-www-form-urlencoded",
            "DNT:1",
            "Host:passport.uc108.com",
            "Origin:http://shangyu.108sq.com",
            "Referer:http://shangyu.108sq.com/User/Login?url=http%3A%2F%2Fshangyu.108sq.com%2F",
            "User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36",
        );
        //curl_setopt($ch, CURLOPT_HTTPHEADER, $array);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $_SESSION['file']);

        $cookie_file = tempnam('./temp','cookie');
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
        $_SESSION['login_cookie'] = $cookie_file;
        $contents = curl_exec($ch);
        curl_close($ch);
        p($contents);
    }
    public function test()
    {
        $url = "http://passport.uc108.com/login.aspx?mode=1";
        $ch = curl_init($url);
        $array = Array(
            "Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
            "Accept-Encoding:gzip, deflate",
            "Accept-Language:zh-CN,zh;q=0.8",
            "Cache-Control:max-age=0",
            "Connection:keep-alive",
            "Content-Length:180",
            "Content-Type:application/x-www-form-urlencoded",
            "DNT:1",
            "Host:passport.uc108.com",
            "Origin:http://shangyu.108sq.com",
            "Referer:http://shangyu.108sq.com/User/Login?url=http%3A%2F%2Fshangyu.108sq.com%2F",
            "User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36",
        );
        p($array, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array(
            "Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
            "Accept-Encoding:gzip, deflate",
            "Accept-Language:zh-CN,zh;q=0.8",
            "Cache-Control:max-age=0",
            "Connection:keep-alive",
            "Content-Length:180",
            "Content-Type:application/x-www-form-urlencoded",
            "DNT:1",
            "Host:passport.uc108.com",
            "Origin:http://shangyu.108sq.com",
            "Referer:http://shangyu.108sq.com/User/Login?url=http%3A%2F%2Fshangyu.108sq.com%2F",
            "User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36",
        ));
        p('ok', 1);
        $data = array();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $_SESSION['file']);

        $cookie_file = tempnam('./temp','cookie');
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
        $_SESSION['login_cookie'] = $cookie_file;
        $contents = curl_exec($ch);
        curl_close($ch);
        p($contents);
    }
}