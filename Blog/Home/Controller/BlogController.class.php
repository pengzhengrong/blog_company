<?php

namespace Home\Controller;
use Think\Controller;

Class BlogController extends CommonController {

	public function index() {
		$where = array('status'=>0);
		if( I('cat_type',0,'intval') != 0 ){
			$where['id'] = I('cat_type');
		}
		$this->getBlog($where);
		$this->display();
	}

	public function add() {
		if( IS_POST ){
			// $data = I('post.');
			$data = $_POST;
			$data['created'] = time();
			$rest = M('blog')->add( $data );
			// my_log( 'id' , $rest );
			$rest || $this->error( 'INSERT ERROR' );
			$cate_blog = array(
				'cat_id' => I('cat_id'),
				'blog_id' => $rest
				);
			$result = M('cate_blog')->add( $cate_blog );
			$result || $this->error( 'BLOG RELATION CATEGORY FAILED' );
			$attr_ids = I('attr_id');
			$this->insert_blog_attr( $attr_ids , $rest );
			$this->redirect( 'index');
			return;
		}
		// $rest = M('category')->field(array('id','title','pid'))->order('sort')->select();
		// $this->rest = node_merge( $rest );
		$this->rest = $this->getCateList();
		$this->attr = M('attr')->order('sort')->select();
		$this->display();
	}

	public function _after_add() {
		
	}

	public function edit() {
		if( IS_POST ){
			// $data = I('post.');
			$data = $_POST;
			$data['update_time'] = time();
			// p( $data );die;
			$rest = M('blog')->save($data);
			$rest || $this->error( 'UPDATE FAILED' );
			$delete = M('blog_attr')->where(array('blog_id'=>I('id')))->delete();
			// $delete || $this->error('DELETE BLOG ATTR '.I('id').' FAILED');
			$this->insert_blog_attr(I('attr_id') , I('id'));
			$this->redirect('index');
			return;
		}
		// $this->rest = M('blog')->find(I('id'));
		// $this->rest = D('BlogRelation')->relation(true)->where(array('status'=>0))->find(I('id'));
		$this->rest = D('BlogRelation')->relation(true)->find(I('id'));
		// p( $this->rest ); die;
		$this->category = $this->getCateList();
		$this->attr = M('attr')->select();
		$this->display();
	}

	public function delete() {
		if( I('delete') != null ){
			$rest = M('blog')->delete(I('id'));
			$rest || $this->error('DELETE FAILED');
			$this->_after_delete( I('id') );
			$this->redirect('gc');
			return;
		}
		if( I('reback') != null ){
			$rest = M('blog')->save( array('id'=>I('id'),'status'=>0) );
			$rest || $this->error( 'REBACK FAILED',1 );
			$this->redirect('gc');
		}
		$rest = M('blog')->save( array('id'=>I('id'),'status'=>1) );
		$rest || $this->error( 'GC FAILED',1 );
		$this->redirect('index');
	}

	public function  _after_delete( $blog_id ) {
		$rest = M('blog_comment')->where( array('blog_id'=>I('id')) )->delete();
		$rest || $this->error('BLOG COMMENT DELETE FAILED');
	}

	private function getCateList() {
		$databack = array();
		// if( S('category') ) return S('category');
		$rest = M('category')->field(array('id','title','pid','level'))->order('sort')->select();
		$databack = node_merge( $rest );
		// S('category',$databack,60*60*24);
		return $databack;
	}

	public function gc() {
		$this->getBlog( array('status'=>1));
		$this->gc = true;
		$this->display('Blog_index');
	}

	private function getBlog( $where ) {
		$field = array('id','cat_id','title','click','created','sort');
		// $this->rest = M('blog')->field($field)->order('sort')->select();
		// $this->rest = D('BlogRelation')->relation(true)->field($field)->where(array('status'=>$status))->select();
		$this->category = M('category')->field(array('id','pid','title'))->select();
		$this->attr = M('attr')->select();

		$totalRows = D('BlogRelation')->relation(true)->where( $where )->count();
		$page = new \Think\Page( $totalRows , C('PAGE_SIZE') , $url);
		$limit = $page->firstRow.','.$page->listRows;
		$this->rest = D('BlogRelation')->relation(true)->field($field)->where($where)->limit($limit)->select();

		$this->page = $page->show();

		// p($this->rest ); die;
	}

	private function insert_blog_attr( $attr_ids , $blog_id) {
		$values = array();
			foreach ($attr_ids as $key => $value) {
				$values[] = "({$blog_id},{$value})";
			}
			$insert_sql = 'insert into '.C('DB_NAME').'.'.C('DB_PREFIX').'blog_attr(`blog_id`,`attr_id`) values'.implode(',',$values);
			// p($insert_sql); die;
			$blog_attr = M('blog_attr')->query($insert_sql);
			// $blog_attr || $this->error('INSERT BLOG ATTR FAILED');
	}

}