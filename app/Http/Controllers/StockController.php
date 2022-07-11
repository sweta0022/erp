<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\ItemMaster;
use App\Models\ItemPrice;
use Auth;
use DB;

class StockController extends Controller
{
    public function index()
    {    
        $loggedInUserId = Auth::user()->id;

        $stock = Stock::join('item_masters','item_masters.id','stocks.item_id')->join('item_prices','stocks.item_price_id','item_prices.id')->select('item_masters.name','stocks.batch_number','stocks.stock_in_quantity','item_prices.mrp')->where('user_id',$loggedInUserId)->get();

        return view('admin.stock.index',compact('stock'));
    }

    public function create()
    {
        $itemMaster = ItemMaster::leftJoin('stocks','stocks.item_id','item_masters.id')->select('item_masters.*',DB::Raw("sum(stocks.stock_in_quantity) as totalStock"))->where('status',1)->groupBy('stocks.item_id')->get();
       
        return view('admin.stock.create',compact('itemMaster'));
    }

    public function store(Request $request)
    {   
        $loggedInUserRoleId = Auth::user()->role_id;

        if($loggedInUserRoleId == 1)
        {
            return redirect()->back();
        }
        $loggedInUserId = Auth::user()->id;
        $ids = [];
        $batch_num = [];
        $mrps = [];
        $stocks = [];
        $ids = $request->id;
        $batch_num = $request->batch_num;
        $mrps = $request->mrp;
        $stocks = $request->stock;
       

        foreach( $ids as $key => $idsV )
        {
            $batchNum = $batch_num[$key];
            $mrp = $mrps[$key];
            $stock = ($stocks[$key])?$stocks[$key]:0;
            if( $batchNum != '' && $mrp != 0 && $mrp != '' && $stock != 0 && $stock != ''  )
            {
                $batchExistSql = Stock::where('batch_number','like',$batchNum)->where('item_price_id',$mrp)->where('user_id',$loggedInUserId)->first();
                if($batchExistSql)
                {
                    Stock::where('batch_number','like',$batchNum)->where('item_price_id',$mrp)->where('user_id',$loggedInUserId)->update([
                        'stock_in_quantity' => $batchExistSql->stock_in_quantity + $stock
                    ]);
                }
                else
                {   
                    $mrpSql = ItemPrice::where('id',$mrp)->first();
                    Stock::create([
                        'user_id' => $loggedInUserId,
                        'item_id' => $idsV,
                        'batch_number' => $batchNum,
                        'item_price_id' => $mrp,
                        'mrp' => $mrpSql->mrp,
                        'stock_in_quantity' => $stock
                    ]);
                }
            }
        }
        return redirect('/stock/list');
    }

    public function mrpWiseDetail(Request $request)
    {
        $item_id = $request->item_id;
        $loggedInUserId = Auth::user()->id;
        // $data = Stock::join('item_masters','item_masters.id','stocks.item_id')->where('item_id',$item_id)->where('user_id',$loggedInUserId)->get();
       
        $data = Stock::join('item_masters','item_masters.id','stocks.item_id')->where('item_id',$item_id)->where('user_id',$loggedInUserId)->select('item_masters.name as item_name','stocks.*')->get();

        return response()->json([
            "status" => 200,
            "message" => "Data fetched successfully.",
            "result"=>$data            
        ]);
    }
}
