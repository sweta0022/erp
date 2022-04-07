<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemMaster;
use App\Models\Category;
use App\Models\UnitMeasurement;
use App\Models\ItemClass;


class itemController extends Controller
{
    public function __construct (){
        // $this->city = new City;
        // $this->zone = new Zone;
    }

    public function index(Request $request)
    {
       
        $search = $request->search;
        $items = ItemMaster::join('categories','categories.id','item_masters.category_id')
                    ->join('unit_measurements','unit_measurements.id','item_masters.unit_measurement')
                    ->join('item_classes','item_classes.id','item_masters.item_class')
                    ->select('item_masters.*','categories.name as category_name','unit_measurements.name as measurement_name','item_classes.name as item_class_name');
        if($search !== "")
        {
            
            $items = $items->where( function($q) use ($search){
                $q->where('item_masters.item_code','like','%'.$search.'%')->orWhere('item_masters.name','like','%'.$search.'%');
            } );
            
        }

        $items = $items->get();

        // dd($items);
      
        return view('admin.items.index',compact('items'));
    }

    public function create()
    {
        $category = Category::where('status',1)->get();
        $unitMeasurement = UnitMeasurement::where('status',1)->get();
        $itemclass = ItemClass::where('status',1)->get();
        
       
       
        return view('admin.items.create',compact('category','unitMeasurement','itemclass'));
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
        ], [
            'name.required' => 'Name is required',
            // 'password.required' => 'Password is required'
        ]);

        $item_code = $request->item_code;
        $name = $request->name;
        $unit_measurement = $request->unit_measurement;
        $category = $request->category;
        $item_class = $request->item_class;
        $pcs_in_box = $request->pcs_in_box;

        $sqlCreate = ItemMaster::create([
            'item_code' => $item_code,
            'name' => $name,
            'unit_measurement' => $unit_measurement,
            'category_id' => $category,
            'item_class' => $item_class,
            'pcs_in_box' => $pcs_in_box
        ]);

        return redirect('/item/list');
        
    }

    public function edit($id)
    {
        $category = Category::where('status',1)->get();
        $unitMeasurement = UnitMeasurement::where('status',1)->get();
        $itemclass = ItemClass::where('status',1)->get();

        $data = ItemMaster::join('categories','categories.id','item_masters.category_id')->join('unit_measurements','unit_measurements.id','item_masters.unit_measurement')->join('item_classes','item_classes.id','item_masters.item_class')->select('item_masters.*','categories.id as category_id','unit_measurements.id as measurement_id','item_classes.id as item_class_id')->where('item_masters.id',$id)->get();
        return view('admin.items.edit',compact('data','category','unitMeasurement','itemclass'));
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
        ], [
            'name.required' => 'Name is required',
            // 'email.required' => 'E-mail is required'
            // 'password.required' => 'Password is required'
        ]); 

        $update_id = $request->update_id;

        if( !isset($update_id) || $update_id == '' || $update_id == 0 )
        {
            redirect()->back();
        }

        $item_code = $request->item_code;
        $name = $request->name;
        $unit_measurement = $request->unit_measurement;
        $category = $request->category;
        $item_class = $request->item_class;
        $pcs_in_box = $request->pcs_in_box;

     

        try{
            $sqlUpdate = ItemMaster::where('id',$update_id)->update([
                'item_code' => $item_code,
                'name' => $name,
                'unit_measurement' => $unit_measurement,
                'category_id' => $category,
                'item_class' => $item_class,
                'pcs_in_box' => $pcs_in_box
            ]);
           
            return redirect('/item/list');
           
        }
        catch(Exception $e)
        {
            redirect()->back();
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

}
