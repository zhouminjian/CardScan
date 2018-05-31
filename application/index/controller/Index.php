<?php
namespace application\index\controller;
use think\Controller;
class Index extends controller
{
    public function index(){
        return $this->fetch("../application/index/view/index/index.php"); 
        // return $this->fetch(); 
    } 
}
?>