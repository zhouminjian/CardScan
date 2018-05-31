<?php
namespace application\admin\controller;
use think\Controller;
	
class Index extends Controller
{
    public function index(){
        return  $this->fetch("../application/admin/view/index/index.php");
    }
    
    public function _empty($name)
    {
        echo '<h1 align=center>404</h1>';
    }
    
}
?>