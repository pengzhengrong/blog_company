<?php

namespace Admin\Widget;
use Think\Controller;

Class CommentWidget  extends Controller {

	public  function unlimitComments( $comment ) {
		foreach ($comment as  $k=>$v) {
			$id = $v['id'];
			$pid = $v['pid'];
			$padding_left = 'padding-left:'.($k+1)*15 .'px';
			if( $pid==0 ){
				$floor =  'Floor';
				echo " <font  color='".fontColor()."'>";
			}else{
				$floor = 'Layer';
				echo "<div style='display:none;$padding_left;'  class='comment_{$pid}'>";
				echo '<hr style="height:1px;border:none;border-top:1px dashed #0066CC;" />';
			}
			echo "<li>";
			echo ($k+1).$floor.'    '.$v['username'].'    '.date('Y-m-d H:i',$v['created']);
			echo '<p>'.$v['content'].'</p>';
			// if( $v['child'] ){
				echo "<span onclick='showComment({$id})'  class='fa'>查看评论(".count($v['child']).")</span> ";
			// }
			echo '<span onclick="vote_comment('.$id.',1)">[顶('.$v['top_num'].')]</span>  ';
			echo '<span onclick="vote_comment('.$id.',-1)">[踩('.$v['base_num'].')]</span>    ';
			echo '<span id="'.$id.'" title="'.$v['username'].'"  class="reply">回复</span>';
			echo "</li>";
			if( $v['child'] ){
				$this->unlimitComments( $v['child'] );
			}
			if( $pid==0 )
				{echo "</font>";echo '<hr style="">';}
			else
				{echo "</div>";}
		}
		
	}
}