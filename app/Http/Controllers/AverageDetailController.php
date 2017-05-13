<?php
namespace App\Http\Controllers;

use App\AverageDetails;
use Illuminate\Http\Request;



class AverageDetailController extends Controller
{
    public function createAverageDetail(Request $request)
    {
        $list = AverageDetails::create($request->all());
        return response()->json($list);
    }

    public function updateAverageDetail(Request $request, $id)
    {
        $list = AverageDetails::find($id);
        $list->title = $request->input('title');
        $list->tips = $request->input('tips');
        //是否免费
        $list->state = $request->input('state');
        $list->save();

        return response()->json($list);
    }

    public function deleteAverageDetail($id)
    {
        $list = AverageDetails::find($id);
        $list->delete();

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
        $list = AverageDetails::where([
          'averagelist_id'=>$id])->get();
        return response()->json($list);
    }


}
