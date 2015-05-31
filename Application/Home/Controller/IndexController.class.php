<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
  public function index(){
    $User = M('User');
    $this->display();
  }
  public function user() {
    $username = session("username");
    $this->assign('username', $username);
    $this->display();
  }
  public function admin() {
    $Express = M('Express');
    $map['status'] = 0;
    $username = session("username");
    $expressList = $Express->where($map)->select();
    $this->assign('expressList', $expressList);
    $this->assign('username', $username);
    $this->display();
  }
  public function userfind() {
    $Express = M('Express');
    $map['status'] = 0;
    $map['isRelease'] = 1;
    $expressList = $Express->where($map)->select();
    $username = session("username");
    $this->assign('username', $username);
    $this->assign('expressList', $expressList);
    $this->display();
  }
  public function login() {
    $User = M('User');
    $condition['username'] = I('post.username');
    $condition['password'] = I('post.password');
    $user = $User->where($condition)->find();
    if ($user) {
      session('userid', $user["userid"]);
      session('username', $user["username"]);
      if ($user['mark'] == 1) {
        //$this->display('admin');
        // $this->success('登陆成功', 'admin', 0);
        $this->redirect('admin', array(), 0, '页面跳转中...');
      } else {
        // $this->success('登陆成功', 'user', 0);
        $this->redirect('user', array(), 0, '页面跳转中...');
      }
    } else {
      $this->display('index');
    } 
  }
  public function regist() {
    $User = M('User');
    $data['username'] = I('post.registName');
    $data['password'] = I('post.registPassword');
    $result = $User->add($data);
    if($result) {
      $this->display('index');
    }
  }
  public function expressForm() {
    $Express = M('Express');
    $data['name'] = I('get.name');
    $data['phone'] = I('get.phone');
    $data['company'] = I('get.company');
    $data['expressNumber'] = I('get.expressNumber');
    $data['startAddress'] = I('get.startAddress');
    $data['endAddress'] = I('get.endAddress');
    $userid = session('userid');
    $data["userId"] = $userid;
    $data['status'] = 0;
    $result = $Express->add($data);
    if ($result) {
      $returnData["status"] = true;
    } else {
      $returnData["status"] = false;
    }
    $this->ajaxReturn($returnData);
  }

  public function searchAjax() {
    $name = I('get.name');
    $Express = M('Express');
    $map['name'] = $name;
    $map['status'] = 0;
    $returnData = $Express->where($map)->select();
    // var_dump($returnData);
    $this->ajaxReturn($returnData);
  }
  public function finishExpressAjax() {
    $Express =  M('Express');
    $isFinish = intval(I('get.isfinish'));
    $expressid = I('get.expressid');
    if ($isFinish) {
      $data['expressId'] = $expressid;
      $data['status'] = 1;
      if ($Express->save($data)) {
        $returnData["status"] = true;
      } else {
        $returnData["status"] = false; 
      }
    }
    $this->ajaxReturn($returnData);
  }
  public function releaseAjax() {
    $isRelease = intval(I('get.isRelease'));
    $expressid = intval(I('get.expressid'));
    $Express = M('Express');
    if ($isRelease == 1) {
      $data['expressId'] = $expressid;
      $data['isRelease'] = 1;
      $result = $Express->save($data);
      echo $result;
      if ($result !== false) {
        $returnData['status'] = true;
      } else {
        $returnData['status'] = false;
      }
    }
    $this->ajaxReturn($returnData);
  }
}