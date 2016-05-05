<?php

namespace Home\Widget;
use Think\Controller;

Class CatTypeWidget extends Controller {

	public function getTypes( $selectid=0 ) {
		$cate = M('category')->where(array('level'=>1))->getField('id,title');
		// $cate = node_merge( $cate );
		// p($cate);die;
		echo "<select  name='cat_type'>";
			echo '<option value=0>SELECT</option>';
			foreach ($cate as $k=>$v) {
				echo "<option value='{$k}'>{$v}</option>";
			}
		echo "</select>";
		
		// $this->cate = $cate;
		// $this->display('CatType:getTypes');

	}


}