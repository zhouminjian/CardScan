<?php
namespace application\index\controller;
use think\Controller;

class Shibie extends controller
{
	public function index()
	{
         echo "<meta name='viewport' content='width=device-width,initial-scale=1'>";
         echo "<link rel=\"shortcut icon\" type=\"image/x-icon\" href=\"/web/mingpian/public/images/Logo.ico\" media=\"screen\" /><link rel=\"stylesheet\" href=\"http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css\">";
         header("Content-Type: text/html;charset=utf-8"); 
         if(isset($_FILES['imgfile'])&&is_uploaded_file($_FILES['imgfile']['tmp_name'])){
            $imgFile = $_FILES['imgfile'];
            //文件后缀
            $imgext = $imgFile['type'];
            //获取请求的文件
            $file = request()->file('imgfile');
            //移动文件至uploads目录
            $info = $file->move(ROOT_PATH.'public'.DS.'uploads');
            // var_dump($info);
            //获取图片路径
            $imgsrc = $info->getFileNewPath();
            session_start();
            //保存部分路径
            $pathstr = strstr($imgsrc,"uploads");
            $inputTime = explode("\\", $pathstr)[1];
            $fileRealName = explode("\\", $pathstr)[2];
            $_SESSION['uri'] = $inputTime."/".$fileRealName;
            // var_dump($imgsrc);
            //定义请求的url地址
            //修改地址中的key，key从汉王云官网获取
            $url1 = "http://api.hanvon.com/rt/ws/v1/ocr/bcard/recg?key=你的key&code=91f6a58d-e418-4e58-8ec2-61b583c55ba2";
            $url2 = "http://api.hanvon.com/rt/ws/v1/ocr/bcard/recg?key=你的key&code=cf22e3bb-d41c-47e0-aa44-a92984f5829d";
            $url3 = "http://api.hanvon.com/rt/ws/v1/ocr/bcard/recg?key=你的key&code=e6a41101-e7aa-4f7a-a8c7-719bad73a564";
            $urls = array($url1,$url2,$url3);
            //控制是否启用识别功能 true:启用 false:不启用
            $validType = true;
            if ($validType){
                foreach ($urls as $url) {
                    //模拟发送POST请求（CURL四步走）
                    //第一步：初始化curl
                    $ch = curl_init();
                    //第二步：设置相关参数
                    //设置请求的url地址
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    //禁止SSL证书的校检功能
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                    //模拟发送POST请求
                    curl_setopt($ch, CURLOPT_POST, 1);
                    //修改图片尺寸
                    list($width,$height,$type) = getimagesize($imgsrc);
                    $new_width = $width;
                    $new_height = $height;
                    if($width>900||$height>900){
                        if($width>=$height){
                            $Multiple = $width/1500>1?($width/1500):1;
                        }
                        else{
                            $Multiple = $height/1500>1?($height/1500):1;
                        }
                        $new_width = $width*0.8/$Multiple;
                        $new_height = $height*0.8/$Multiple;
                    }
                    header('Content-Type:'.$imgext);
                    $image_wp=imagecreatetruecolor($new_width,$new_height); 
                    if(strcmp($imgext,'image/jpeg')===0){  
                        $image = imagecreatefromjpeg($imgsrc);
                    }
                    else{
                        $image = imagecreatefrompng($imgsrc);
                    }
                    imagecopyresampled($image_wp, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height); 
                    $imgdst = $imgsrc;
                    imagejpeg($image_wp, $imgdst,75);
                    imagedestroy($image_wp);
                    //解析图片
                    $image=base64_encode(file_get_contents($imgsrc));
                    //var_dump($image);
                    $arr = array ('uid'=>'','lang'=>'auto','color'=>'color','image'=>$image);
                    $data = json_encode($arr);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    //第三步：执行curl
                    $output = curl_exec($ch);
                    // var_dump($output);
                    //判断输出结果是否异常
                    if($output===false) {
                            echo curl_error($ch);
                    } else {
                        //json数据转换成数组
                        $arr = json_decode($output,true);
                        //对比错误参照码，为0则无错误
                        $errorCode = intval($arr['code']);
                        if($errorCode===0){
                            echo "<body class='container'>
                                <p style='text-align:center;font-size:18px;font-weight:bold;margin:20px auto;'>请确认您的信息</p>";
                            echo "<form action='operation' class='form-horizontal' method='post' enctype='multipart/form-data'>";
                            //输出名片信息
                            echo "<div class='form-group'><label class='col-sm-2 control-label'>姓名</label>
                                    <div class='col-sm-2'><input class='form-control' type='text' name='username' value=".judgeEmpty($arr['name'])."></div></div>";
                            echo "<div class='form-group'><label class='col-sm-2 control-label'>电话</label>
                                    <div class='col-sm-2'><input class='form-control' type='text' name='telephone' value=".judgeEmpty($arr['tel'])."></div></div>";
                            echo "<div class='form-group'><label class='col-sm-2 control-label'>手机</label>
                                    <div class='col-sm-2'><input class='form-control' type='text' name='mobile' value=".judgeEmpty($arr['mobile'])."></div></div>";
                            echo "<div class='form-group'><label class='col-sm-2 control-label'>传真</label>
                                    <div class='col-sm-2'><input class='form-control' type='text' name='fax' value=".judgeEmpty($arr['fax'])."></div></div>";
                            echo "<div class='form-group'><label class='col-sm-2 control-label'>邮箱</label>
                                    <div class='col-sm-2'><input class='form-control' type='text' name='email' value=".judgeEmpty($arr['email'])."></div></div>";
                            echo "<div class='form-group'><label class='col-sm-2 control-label'>公司</label>
                                    <div class='col-sm-2'><input class='form-control' type='text' name='comp' value=".judgeEmpty($arr['comp'])."></div></div>";
                            echo "<div class='form-group'><label class='col-sm-2 control-label'>地址</label>
                                    <div class='col-sm-2'><input class='form-control' type='text' name='addr' value=".judgeEmpty($arr['addr'])."></div></div>";
                            buttonInfo();
                            echo"</form></body>";
                        }else if($errorCode===434){
                            if(strcmp($url,$url3)!=0)  
                                continue;
                            else 
                                messageOutput("今日服务次数已达上限！");
                        }else{
                            messageOutput("图片无法识别，请确认图片清晰度以及大小不超过200KB！");
                        }
                    }
                    //第四步：关闭curl
                    curl_close($ch); 
                    break;
                }  
            }
        }
        else{
                //未上传图片点击提交后的提示并返回首页
                messageOutput("未选择任何图片！"); 
            } 
	}
    public function operation(){
        $con = connectMysql();
        if(!$con){
            die('Could not connect: ' . mysqli_error());
        }
        //设置数据库字符集
        mysqli_query($con,"set names 'utf8'");
        //获取提交的数据信息
        $username = $_POST['username'];
        $telephone = $_POST["telephone"];
        $mobile = $_POST['mobile'];
        $fax = $_POST['fax'];
        $email = $_POST['email'];
        $comp = $_POST['comp'];
        $addr = $_POST['addr'];
        $date = date('Y-m-d',time());
        session_start();
        $clerkid = $_SESSION['id'];
        $uri = $_SESSION['uri'];
        $sqlstr="insert into customerinfo(username,telephone,mobile,fax,email,comp,addr,date,clerkid,uri) values('$username','$telephone','$mobile','$fax','$email','$comp','$addr','$date',$clerkid,'$uri');";
        //执行sql语句
        if(!mysqli_query($con,$sqlstr)){
            messageOutput("信息提交失！请联系管理员");
        }
        mysqli_close($con);
        //关闭当前页并跳转到首页
        messageOutput("信息提交成功！");
    }
}
?>
