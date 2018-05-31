<?php
namespace application\admin\controller;

use think\Controller;
		
class Showpicture extends Controller
{
	public function index(){
		$uri = $_GET['uri'];
		?>
		<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
		<style>
			.max{width:100%;}
			/*.min{width:100px;}*/
		</style>
		<!-- <script>
			$(function(){
				$('#img').click(function(){
					$(this).toggleClass('min');
					$(this).toggleClass('max');
				});
			});
		</script> -->
		<img id="img" class="max" src="/web/mingpian/public/uploads/<?php echo $uri; ?>" >
		<?php
	}
}
?>
