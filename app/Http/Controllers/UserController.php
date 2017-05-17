<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;



class UserController extends Controller
{
    //获取七牛token
    public function getToken()
    {
        $qiniuToken = '3QSNrejV93v8qgNKrrBvxPIEi_zxIqde4xx1Rqj0:H1WJRDM4-tIPKhS9YzQppfsB5DE=:eyJzY29wZSI6InVzZXJpY29uIiwiZGVhZGxpbmUiOjU0MzM0MjUyMzQ1MjM0NTEwMDB9';
        $token = array("uptoken" => $qiniuToken);
        return response()->json($token);
    }

    public function createUser(Request $request)
    {
        $check = $request->input('username');
        $checkUser = User::where('username','=',$check)->first();
        if($checkUser == null){
          $user = User::create($request->all());
          $user['check'] = '不存在';
          return response()->json($user);
        }else{
          return response()->json(array('check'=>'已经存在'));
        }

    }

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        $user->nickname = $request->input('nickname');
        $user->password = $request->input('password');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->location = $request->input('location');
        $user->age = $request->input('age');
        $user->sex = $request->input('sex');
        $user->icon = $request->input('icon');
        $user->alipay = $request->input('alipay');
        $user->alipay_tips = $request->input('alipay_tips');
        $user->wechat = $request->input('wechat');
        $user->wechat_tips = $request->input('wechat_tips');
        //在前端拼接
        $user->averagelists_id = $request->input('averagelists_id');
        $user->save();

        return response()->json($user);
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json('删除成功');
    }

    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function queryActor(Request $request,$actor_id)
    {
      $idList = preg_split('/[-]/', $actor_id);
      $actorLists = array();
      //因为是 1-2-3-这种形式,最后一个会空缺,
      for($index = 0;$index < count($idList) -1;$index++) {
        //往数组元素添加新的查到的数据
        array_push($actorLists,User::find($idList[$index]));
      }

        return response()->json($actorLists);
    }



    public function login(Request $request,$username,$password)
    {
        //where多条件查询
        $user = User::where([
          'username'=>$username,
          'password' =>$password
        ])->first();
        return response()->json($user);
    }
}
