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
        //请求到登陆地址
        $urls = $this->login();
        p($urls, 1);
        //跳转链接
        $url = U('Index/test');
        $this->dumpUrl($urls);

    }
    private function dumpUrl($urls)
    {
        //请求第一个地址
        $array = Array(
            "Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
            "Accept-Encoding:gzip, deflate",
            "Accept-Language:zh-CN,zh;q=0.8",
            "Cache-Control:max-age=0",
            "Connection:keep-alive",
            "Host:login.108sq.com",
            "Referer:http://passport.uc108.com/login.aspx?mode=1",
            "User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36",
            "DNT:1",
        );
        $url = $urls[0];
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $array);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $_SESSION['file']);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $_SESSION['file']);
        $result = curl_exec($ch);
        curl_close($ch);
        //请求第二个地址
        $array = Array(
            "Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
            "Accept-Encoding:gzip, deflate",
            "Accept-Language:zh-CN,zh;q=0.8",
            "Cache-Control:max-age=0",
            "Connection:keep-alive",
            "Host:passport.ct108.com",
            "Referer:http://passport.uc108.com/login.aspx?mode=1",
            "User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36",
            "DNT:1",
        );
        $url = $urls[1];
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $array);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $_SESSION['file']);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $_SESSION['file']);
        $result = curl_exec($ch);
        curl_close($ch);
        p('two');
        p($result);
    }
    private function login()
    {
        //请求登陆地址
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
            "Host:passport.uc108.com",
            "Origin:http://shangyu.108sq.com",
            "Referer:http://shangyu.108sq.com/User/Login?url=http%3A%2F%2Fshangyu.108sq.com%2F",
            "User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36",
            "DNT:1",
        );
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $array);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $_SESSION['file']);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $_SESSION['file']);
        $result = curl_exec($ch);
        curl_close($ch);
        //p($result, 1);
        $pattern = "/apps.*?\"(.*?)\"/m";
        preg_match_all($pattern, $result, $match);
        if(!empty($match[1])) {
            return $match[1];
        } else {
            p('输入有误', 1);
        }
    }
    public function test()
    {
        $url = "http://shangyu.108sq.com/Users/Default.aspx";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $_SESSION['file']);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $_SESSION['file']);
        $content = curl_exec($ch);
        curl_close($ch);
        p($content);
    }
}