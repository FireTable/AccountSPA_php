<?php
namespace App\Http\Controllers;

use App\AverageDetails;
use App\AverageLists;
use Illuminate\Http\Request;



class AverageDetailController extends Controller
{
    public function updateAverageListCost($id)
    {
        $list = AverageLists::find($id);
        $cost = 0;
        $details = AverageDetails::where('averagelist_id','=',$id)->get();
        foreach ($details as $detail ) {
          if($detail->actor_num != 0){
            $cost = $cost+$detail->cost;
          }
        }
        $list->cost = $cost;
        $list->save();
    }

    public function createAverageDetail(Request $request)
    {
        $list = AverageDetails::create($request->all());
        $this->updateAverageListCost($request->input('averagelist_id'));
        return response()->json($list);
    }

    public function updateAverageDetail(Request $request, $id)
    {
        $list = AverageDetails::find($id);
        $list->title = $request->input('title');
        $list->tips = $request->input('tips');
        $list->actor_id = $request->input('actor_id');
        $list->actor_num = $request->input('actor_num');
        //是否免费
        $list->state = $request->input('state');
        $list->save();

        $this->updateAverageListCost($list->averagelist_id);

        return response()->json($list);
    }

    public function deleteAverageDetail($id)
    {
        $list = AverageDetails::find($id);
        $averagelist_id = $list->averagelist_id;
        $list->delete();

        $this->updateAverageListCost($averagelist_id);

        return response()->json('删除成功');
    }

    public function index()
    {
        $list = AverageDetails::all();
        return response()->json($list);
    }


    public function queryDetails(Request $request, $id)
    {
      //->get()是所有,->first()是第一个
      $this->updateAverageListCost($id);
        $list = AverageDetails::where([
          'averagelist_id'=>$id])->get();

        return response()->json($list);
    }


}
