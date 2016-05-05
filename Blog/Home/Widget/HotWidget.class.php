<?php

namespace Home\Widget;
use Think\Controller;

Class HotWidget extends Controller{

	public function hot_blog(){
		// echo 'hot';
		$this->blog = M('blog')->select();
	}
}