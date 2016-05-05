<?php

namespace Home\Controller;
use Think\Controller;
Class AttrController extends CommonController {

	public function index() {
		$this->rest = M('attr')->order('sort')->select();
		$this->display();
	}

	public function add() {
		if( IS_POST){
			$rest = M('attr')->add(I('post.'));
			$rest || $this->error('INSERT FAILED');
			$this->redirect('index');
		}
		$this->display();
	}

	public function edit() {
		if( IS_POST ){
			$rest = M('attr')->save(I('post.'));
			$rest || $this->error('UPDATE FAILED');
			$this->redirect('index');
		}
		$this->rest = M('attr')->find(I('id'));
		$this->display();
	}

	public function delete() {
		$rest = M('attr')->delete(I('id'));
		$rest || $this->error('DELETE FAILED');
		$this->redirect('index');
	}

}