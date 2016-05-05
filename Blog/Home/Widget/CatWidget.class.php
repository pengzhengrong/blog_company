<?php

namespace Home\Widget;
use Think\Controller;

Class CatWidget extends Controller {

	public  function unlimitLayer( $cate ){
		foreach ($cate as  $v) {
			$class = '';
			switch ($v['level']) {
				case '0':
					$class = 'modules';
					break;
				case '1':
					$class = 'action';
					break;
				default:
					$class = 'method';
					break;
			}
			echo '<div class='.$class.'>';
			echo $v['title'];
			if( $v['multi'] ){
				echo '<a href="'.U(MODULE_NAME.'/Cat/add',array('pid'=>$v['id'],'level'=>$v['level']+1)).'">[ADD]</a>';
			}
			echo '<a href="'.U(MODULE_NAME.'/Cat/edit',array('id'=>$v['id'])).'">[EDIT]</a>
			<a href="'.U(MODULE_NAME.'/Cat/delete',array('id'=>$v['id'])).'">[DELETE]</a>';
			if(  $v['child'] ){
				$this->unlimitLayer( $v['child'] );
			}
			echo '</div>';
		}
		
		
	}

	public function select( $cate , $cat_id ){
		 // echo '<select name="cat_id" >';
		foreach ($cate as  $v) {
			$space = str_repeat( '&nbsp;', $v['level']*2);
			// my_log( 'select',$cat_id);
			if( $v['id'] == $cat_id  ){ $selected = 'selected';}
			echo "<option $selected value='".$v['id']."'>".$space.$v['title']."</option>";
			$selected = '';
			if( $v['child'] ){
				$this->select( $v['child'] ,$cat_id);
			}
		}
		 // echo '</select>';
	}

}
