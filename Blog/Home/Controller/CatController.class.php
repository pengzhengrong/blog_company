<?php

namespace  Home\Controller;
use Think\Controller;
Class CatController extends CommonController {

	public function index() {
		$rest = M('category')->order('sort')->select();
		$this->rest = node_merge( $rest );
		// p( $this->rest );die;
		$this->display();
	}

	public function add() {
		if( IS_POST ){
			// p(I('post.') ); die;
			$rest = M('category')->add( I('post.'));
			$rest || $this->error('INSERT ERROR');
			$this->redirect('index');
			return;
		}
		$this->pid = I('pid');
		$this->level = I('level');
		$this->display();
	}

	public function edit() {
		if( IS_POST){
			$rest = M('category')->save( I('post.'));
			$rest || $this->error('INSERT ERROR');
			$this->redirect('index');
			return;
		}
		$this->rest = M('category')->find(I('id'));
		// p($this->rest); die;
		$this->display();
	}

	public function delete() {
		$rest = M('category')->delete( I('id'));
		$rest || $this->error( 'DELETE FAILED' );
		$this->redirect('index');
	}


}