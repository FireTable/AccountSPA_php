<?php
namespace App\Http\Controllers;

use App\AverageDetails;
use App\AverageLists;
use Illuminate\Http\Request;



class AverageResultController extends Controller
{


    public function queryDetails(Request $request, $id,$userid)
    {
        $details = AverageDetails::where('averagelist_id','=',$id)->get();

        //paylist是本来应付他人多少钱,应该付款给谁多少钱,平均
        $payList =array();

        //freelist是免单的费用,表示谁给你平均免单了多少钱,平均
        $freeList = array();

        //costList是总花费,谁花了多少钱,
        $costList = array();

        //freelist_all是总免单费用,表示谁总共免单了多少钱,
        $freeList_all = array();

        //$allcost,总花费
        $allCost = 0;

        //遍历detail
        foreach($details as $detail){
          //直接拿到
          $actor_id = $detail->actor_id;
          //分割
          $idList = preg_split('/[-]/', $actor_id);
          $num = $detail->actor_num;
          $cost = $detail->cost;
          $creator_id = $detail->creator_id;
          $state = $detail->state;
          //因为是 1-2-3-这种形式,最后一个会空缺,所以-1
          if($num != 0){
          for($index = 0;$index < count($idList) -1;$index++) {
            //往数组元素添加新的查到的数据
            $realIndex = $idList[$index];
            //不处理参与人数为0的,不能被除
              //payList,需要不是自己条目,并且为参与者里面有自己的id
              if($creator_id != $userid && $userid == $realIndex){
                  if(array_key_exists($creator_id,$payList)){
                    $payList[$creator_id] = ($cost/$num) + $payList[$creator_id] ;
                  }else{
                    $payList[$creator_id] = $cost/$num;
                  }
                    //freeList,paylist的基础上加上免单
                  if(array_key_exists($creator_id,$freeList) && $state == '免单'){
                    $freeList[$creator_id] = ($cost/$num) + $freeList[$creator_id] ;
                  }elseif (!array_key_exists($creator_id,$freeList) && $state == '免单'){
                    $freeList[$creator_id] = $cost/$num;
                  }
              }

            }
            //$allcost,所有相加
            $allCost = $allCost + $cost;
          }

          //costlist,每人总花费,不能放在for里面,否则叠加
          if(array_key_exists($creator_id,$costList)){
            $costList[$creator_id] = $cost + $costList[$creator_id] ;
          }else{
            $costList[$creator_id] = $cost ;
          }

          //freelist_all,每人免单了多少钱
          if(array_key_exists($creator_id,$freeList_all) && $state == '免单'){
            $freeList_all[$creator_id] = $cost + $freeList_all[$creator_id] ;
          }elseif(!array_key_exists($creator_id,$freeList_all) && $state == '免单'){
            $freeList_all[$creator_id] = $cost ;
          }

        }

        $averageList = AverageLists::find($id);
        $averageList->cost = $allCost;
        $actor_num = count(preg_split('/[-]/', $averageList->actor_id))-1;
        $averageList->save();

        $List = array('payList'=>$payList,'freeList'=>$freeList,'costList'=>$costList,
                    'freeList_all'=> $freeList_all,'allCost'=>$allCost,'actor_num'=>$actor_num);



        return response()->json($List);
    }


}
