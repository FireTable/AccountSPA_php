<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function createUser(Request $request)
    {
        $user = User::create($request->all());
        //return $request->all();
        return response()->json($user);
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
        $user->alipay = $request->input('alipay');
        $user->alipay_tips = $request->input('alipay_tips');
        $user->wechat = $request->input('wechat');
        $user->wechat_tips = $request->input('wechat_tips');
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
}
