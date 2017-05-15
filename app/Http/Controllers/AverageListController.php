<?php
namespace App\Http\Controllers;

use App\AverageLists as AverageLists ;
use App\User ;
use App\AverageDetails;
use Illuminate\Http\Request;



class AverageListController extends Controller
{
    public function createAverageList(Request $request)
    {
        $list = AverageLists::create($request->all());
        return response()->json($list);
    }

    public function updateAverageList(Request $request, $id)
    {
        $list = AverageLists::find($id);
        $list->title = $request->input('title');
        $list->tips = $request->input('tips');
        $list->state = $request->input('state');
        $list->save();

        return response()->json($list);
    }

    public function deleteAverageList($id)
    {
        $list = AverageLists::find($id);
        $list->delete();

        return response()->json('删除成功');
    }

    public function index()
    {
        $list = AverageLists::all();

        return response()->json($list);
    }

    public function queryAverageList(Request $request,$id)
    {
        //where多条件查询
        $idList = preg_split('/[-]/', $id);
        $averageLists = array();
        //因为是 1-2-3-这种形式,最后一个会空缺,所以-1
        for($index = 0;$index < count($idList) -1;$index++) {
          //往数组元素添加新的查到的数据
          array_push($averageLists,AverageLists::find($idList[$index]));
        }
        //将输出结果倒序
        $result = array_reverse($averageLists);

        return response()->json($result);

    }

    public function addAverageList(Request $request, $id){
        $list = AverageLists::where([
          'id'=>$request->input('id'),
          'password' =>$request->input('password')
        ])->first();
        $list->actor_id = ($list->actor_id).($request->input('userid').'-');
        $list->save();
        return response()->json($list);
    }

    public function outAverageList(Request $request,$id,$userid,$actorid,$averagelistsid)
    {
        $flag = 'true';

        $list = AverageLists::find($id);

        if($list->creator_id != $userid){
          $list->actor_id = $actorid;
          $list->save();

          $details = AverageDetails::where([
            'creator_id'=> $userid,
            'averagelist_id'=> $id
            ])->delete();

          $user = User::find($userid);
          $user->averagelists_id = $averagelistsid;
          $user->save();

        }else{
          $flag ='false';
        }

      if($flag == 'true'){
        return response()->json('success');
      }else{
        return response()->json('false');
      }
    }


}
