<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemMaster;
use App\Models\Category;
use App\Models\UnitMeasurement;
use App\Models\ItemClass;
use App\Models\ItemPrice;
use App\Models\GstMaster;




class ItemController extends Controller
{
    public function __construct (){
        // $this->city = new City;
        // $this->zone = new Zone;
    }

    public function index(Request $request)
    {
       
        $search = $request->search;
        $items = ItemMaster::
                    LeftJoin('categories','categories.id','item_masters.category_id')
                    ->LeftJoin('unit_measurements','unit_measurements.id','item_masters.unit_measurement')
                    ->LeftJoin('item_classes','item_classes.id','item_masters.item_class')
                    ->LeftJoin('item_prices','item_prices.item_id','item_masters.id')
                    ->LeftJoin('gst_masters','item_masters.gst','gst_masters.id')
                    ->select('item_masters.*','item_prices.mrp','item_prices.cost_price','item_prices.ss_price','item_prices.distributor_price','categories.name as category_name','unit_measurements.name as measurement_name','item_classes.name as item_class_name','gst_masters.value as gst');
        if($search != "")
        {
            
            $items = $items->where( function($q) use ($search){
                $q->where('item_masters.item_code','like','%'.$search.'%')->orWhere('item_masters.name','like','%'.$search.'%');
            } );
            
        }

        $items = $items->groupBy('item_prices.item_id')->orderBy('item_masters.id','desc')->get();

        // dd($items);
      
        return view('admin.items.index',compact('items'));
    }

    public function create()
    {
        $category = Category::where('status',1)->get();
        $unitMeasurement = UnitMeasurement::where('status',1)->get();
        $itemclass = ItemClass::where('status',1)->get();
        $gst = GstMaster::all();
       
       
        return view('admin.items.create',compact('category','unitMeasurement','itemclass','gst'));
    }

    public function store(Request $request  )
    {
        //  dd($request->item_code);
         $validatedData = $request->validate([
            'item_code' => 'required',
            'name' => 'required',
            'unit_measurement' => 'required',
            'category' => 'required',
            'item_class' => 'required',
            'pcs_in_box' => 'required|numeric',
            'mrp' => 'required|numeric',
            'cost_price' => 'required|numeric',
            'ss_price' => 'required|numeric',
            'distributor_price' => 'required|numeric',
        ], [
            'name.required' => 'Name is required',
            // 'password.required' => 'Password is required'
        ]);

        

        $item_code = $request->item_code;
        $name = $request->name;
        $unit_measurement = $request->unit_measurement;
        $category = $request->category;
        $item_class = $request->item_class;
        $gst = $request->gst;
        $hsn_code = $request->hsn_code;
        $pcs_in_box = $request->pcs_in_box;
        // dd($gst);
        $sqlCreate = ItemMaster::create([
            'item_code' => $item_code,
            'name' => $name,
            'unit_measurement' => $unit_measurement,
            'category_id' => $category,
            'item_class' => $item_class,
            'hsn_code' => $hsn_code,
            'gst' => $gst,
            'pcs_in_box' => $pcs_in_box
        ]);

        if($sqlCreate)
        {
            $mrp = $request->mrp;
            $cost_price = $request->cost_price;
            $ss_price = $request->ss_price;
            $distributor_price = $request->distributor_price;

            ItemPrice::create([
                'item_id' => $sqlCreate->id,
                'mrp' => $mrp,
                'cost_price' => $cost_price,
                'ss_price' => $ss_price,
                'distributor_price' => $distributor_price,
            ]);
        }

        return redirect('/item/list');
        
    }

    public function edit($id)
    {
        $category = Category::where('status',1)->get();
        $unitMeasurement = UnitMeasurement::where('status',1)->get();
        $itemclass = ItemClass::where('status',1)->get();
        $gst = GstMaster::all();

        $data = ItemMaster::join('categories','categories.id','item_masters.category_id')
                    ->LeftJoin('unit_measurements','unit_measurements.id','item_masters.unit_measurement')
                    ->LeftJoin('item_classes','item_classes.id','item_masters.item_class')
                    ->LeftJoin('item_prices','item_prices.item_id','item_masters.id')
                    ->LeftJoin('gst_masters','gst_masters.id','item_masters.gst')
                    ->select('item_masters.*','item_prices.mrp','item_prices.cost_price','item_prices.ss_price','item_prices.distributor_price','categories.id as category_id','unit_measurements.id as measurement_id','item_classes.id as item_class_id','gst_masters.id as gst')->where('item_masters.id',$id)->get();

        return view('admin.items.edit',compact('data','category','unitMeasurement','itemclass','gst'));
    }

    public function update(Request $request  )
    {
        
         $validatedData = $request->validate([
            'item_code' => 'required',
            'name' => 'required',
            'unit_measurement' => 'required',
            'category' => 'required',
            'item_class' => 'required',
            'pcs_in_box' => 'required|numeric',
            'mrp' => 'required|numeric',
            'cost_price' => 'required|numeric',
            'ss_price' => 'required|numeric',
            'distributor_price' => 'required|numeric',
        ], [
            'name.required' => 'Name is required',
            // 'email.required' => 'E-mail is required'
            // 'password.required' => 'Password is required'
        ]); 

        $update_id = $request->update_id;

        if( !isset($update_id) || $update_id == '' || $update_id == 0 )
        {
           return redirect()->back();
        }

        $item_code = $request->item_code;
        $name = $request->name;
        $unit_measurement = $request->unit_measurement;
        $category = $request->category;
        $item_class = $request->item_class;
        $pcs_in_box = $request->pcs_in_box;     
        $hsn_code = $request->hsn_code;     
        $gst = $request->gst;     

        try
        {
            $sqlUpdate = ItemMaster::where('id',$update_id)->update([
                'item_code' => $item_code,
                'name' => $name,
                'unit_measurement' => $unit_measurement,
                'category_id' => $category,
                'item_class' => $item_class,
                'pcs_in_box' => $pcs_in_box,
                'hsn_code' => $hsn_code,
                'gst' => $gst
            ]);

            $mrp = $request->mrp;
            $cost_price = $request->cost_price;
            $ss_price = $request->ss_price;
            $distributor_price = $request->distributor_price;
            
            ItemPrice::where('item_id',$update_id)->delete();

            ItemPrice::create([
                'item_id' => $update_id,
                'mrp' => $mrp,
                'cost_price' => $cost_price,
                'ss_price' => $ss_price,
                'distributor_price' => $distributor_price,
            ]);

            // $sqlUpdate = ItemPrice::where('item_id',$update_id)->update([
            //     'mrp' => $mrp,
            //     'cost_price' => $cost_price,
            //     'ss_price' => $ss_price,
            //     'distributor_price' => $distributor_price
            // ]);

            return redirect('/item/list');
           
        }
        catch(Exception $e)
        {
           return redirect()->back();
        }
        
    }


    public function statusChange($id)
    {  
       $item = ItemMaster::find($id);       
       if( $item )  
       {
          $item->where('id',$id)->update([
              'status' => ($item->status-1)*-1
          ]);
          return redirect('/item/list');
       }
       else
       {
         return redirect('/item/list');
       }
    }

    public function item_price($id)
    {       
        $itemPrice = ItemPrice::where('item_id',$id)->get();   
       
      
        return view('admin.items.view_item_price',compact('itemPrice'));
    }

    public function save_item_price(Request $request)
    {  
            
        $validatedData = $request->validate([
            'mrp' => 'required|numeric',
            'cost_price' => 'required|numeric',
            'ss_price' => 'required|numeric',
            'distributor_price' => 'required|numeric',
        ], [
            // 'name.required' => 'Name is required',
            // 'password.required' => 'Password is required'
        ]);

        $mrp = $request->mrp;
        $cost_price = $request->cost_price;
        $ss_price = $request->ss_price;
        $distributor_price = $request->distributor_price;
        $item_id = $request->update_id;

        ItemPrice::create([
            'item_id' => $item_id,
            'mrp' => $mrp,
            'cost_price' => $cost_price,
            'ss_price' => $ss_price,
            'distributor_price' => $distributor_price
        ]);
        return redirect()->back();
          
    }

    public function statusChangeItemPrice($id)
    {  
        $price = ItemPrice::find($id);       
        if( $price )  
        {
           $price->where('id',$id)->update([
               'status' => ($price->status-1)*-1
           ]);
           return redirect()->back();
        }
        else
        {
          return redirect()->back();
        }
     }

     public function update_item_price(Request $request)
     {  
             
         $validatedData = $request->validate([
             'mrp' => 'required|numeric',
             'cost_price' => 'required|numeric',
             'ss_price' => 'required|numeric',
             'distributor_price' => 'required|numeric',
         ], [
             // 'name.required' => 'Name is required',
             // 'password.required' => 'Password is required'
         ]);
 
         $mrp = $request->mrp;
         $cost_price = $request->cost_price;
         $ss_price = $request->ss_price;
         $distributor_price = $request->distributor_price;
         $item_id = $request->item_id;
 
         ItemPrice::where('id',$item_id)->update([             
             'mrp' => $mrp,
             'cost_price' => $cost_price,
             'ss_price' => $ss_price,
             'distributor_price' => $distributor_price
         ]);

         return redirect()->back();
           
     }

}
