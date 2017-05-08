<?php
namespace App\Http\Controllers;

use App\AverageLists;
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


}
