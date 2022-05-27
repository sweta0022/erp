<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\ItemMaster;
use Auth;

class StockController extends Controller
{
    public function index()
    {       
        $stock = Stock::join('item_masters','item_masters.id','stocks.item_id')->join('item_prices','stocks.item_price_id','item_prices.id')
                ->select('item_masters.name','stocks.batch_number','stocks.stock_in_quantity','item_prices.mrp')->get();
        return view('admin.stock.index',compact('stock'));
    }

    public function create()
    {
        $itemMaster = ItemMaster::where('status',1)->get();
        
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
                $batchExistSql = Stock::where('batch_number','like',$batchNum)->count();
                if($batchExistSql)
                {
                    Stock::where('batch_number','like','')->update([
                        'user_id' => $loggedInUserId,
                        'item_id' => $idsV,
                        'batch_number' => $batchNum,
                        'item_price_id' => $mrp,
                        'stock_in_quantity' => $stock
                    ]);
                }
                else
                {   
                    Stock::create([
                        'user_id' => $loggedInUserId,
                        'item_id' => $idsV,
                        'batch_number' => $batchNum,
                        'item_price_id' => $mrp,
                        'stock_in_quantity' => $stock
                    ]);
                }
            }
        }
        return redirect('/stock/list');
    }
}
