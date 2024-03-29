<?php

namespace Admin\Widget;
use Think\Controller;

Class CatWidget extends Controller {

	public function unlimitLayer( $cate ) {
		foreach ($cate as $v) {
			switch ($v['level']) {
				case '1':
					echo '<dl class="showDl">';
					$type = 'dt';
					break;
				default:
					$padding_left = ($v['level']*$v['level']*2).'px';
					$type = 'dd';
				break;
			}
			$url = C('URL_ROUTER_ON')?'content_'.$v['id']:U(MODULE_NAME.'/Index/content',array('id'=>$v['id']));
			echo "<$type><a href='$url' style='padding-left:$padding_left'>{$v['title']}</a></$type>";
			
			if( $v['child'] ){
				$this->unlimitLayer( $v['child'] );
			}
		if( $v['level']==1 ) echo '</dl>';
		}
		

	}

}
