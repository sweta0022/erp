<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\ItemMaster;

class StockController extends Controller
{
    public function index()
    {       
        $stock = Stock::get();
        return view('admin.stock.index',compact('stock'));
    }

    public function create()
    {
        $itemMaster = ItemMaster::where('status',1)->get();
        
        return view('admin.stock.create',compact('itemMaster'));
    }
}
