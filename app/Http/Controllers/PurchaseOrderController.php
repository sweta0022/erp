<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $items = [];
        return view('admin.purchase.index',compact('items'));
    }
}
