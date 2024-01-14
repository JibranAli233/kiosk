<?php


namespace App\Http\Controllers;

use DB;
use DataTables;
use App\Models\Sell;
use App\Models\Sell_has_item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer_has_transaction;


class SellController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:sell-list', ['only' => ['index','show']]);
         $this->middleware('permission:sell-create', ['only' => ['create','store']]);
         $this->middleware('permission:sell-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:sell-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        return view('sells.index');
    }

    public function list()
    {
        $data = DB::table('sells')
                ->orderBy('sells.created_at','DESC')
                ->leftjoin('users', 'users.id', '=', 'sells.customer_id')
                ->select('sells.*',
                        'users.name as customer_name'
                        )
                ->get();

        return 
            DataTables::of($data)
                ->addColumn('action',function($data){
                    return '
                    <div class="btn-group btn-group">
                        <a class="btn btn-info btn-sm" href="sells/'.$data->id.'">
                            <i class="fa fa-eye"></i>
                        </a>
                   
                     
                        <button
                            class="btn btn-danger btn-sm delete_all"
                            data-url="'. url('sellDelete') .'" data-id="'.$data->id.'">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>';
                })
                ->addColumn('srno','')
                ->rawColumns(['srno','','action'])
                ->make(true);

            //     <a class="btn btn-info btn-sm" href="sells/'.$data->id.'/edit" id="'.$data->id.'">
            //     <i class="fas fa-pencil-alt"></i>
            // </a>
    }

    public function fetch_item_unit_detail(Request $request)
    {
        if($request->ajax()){

            $item_id        = $request->item;

           
            $item           = DB::table('items')
                                ->select('items.*')
                                ->where('items.id',$item_id)
                                // ->pluck("name","id")
                                ->first();
                                
            return response()->json(['data'=>$item]);
        }

    }

    public function create()
    {

        $items       = DB::table('items')
                                ->leftjoin('companies', 'companies.id', '=', 'items.company_id')
                                ->select(
                                         'items.id',
                                          DB::raw('CONCAT(items.name, "  -  ", companies.name) as name')
                                         )
                                ->pluck('name','id')
                                ->all();


        $users          = DB::table('users')
                                ->orderBy('users.id')
                                ->select('users.id','name')
                                ->pluck('name','id')
                                ->all();


        return view('sells.create',
                        compact(
                            'items',
                            'users'
                        )
                    );
    }

    public function store(Request $request)
    {

        // dd($request->request);
        $this->validate($request,
            [
                'item_id'               => 'required',
                'customer_id'           => 'required',
                'total_amount'          => 'required',
            ],
            [
                'total_amount.required' => 'Please press calculate button befor submit!',
            ]
        );


        $inputs                     = $request->all();
        $item                       = $inputs['item_id'];
        $sell_qty                   = $inputs['sell_qty'];
        $sell_price                 = $inputs['sell_price'];
        $data                       = Sell::create($inputs);
        $sell_id                    = $data['id'];

        $tot_price                  = 0; 
      
        if($data){
            if($item){
                foreach($item as $item_key => $item_value){

                $tot_price          += (($sell_qty[$item_key]) * ($sell_price[$item_key]));
                $var                 = new Sell_has_item();
                $var->sell_id        = $sell_id;
                $var->item_id        = $item_value;
                $var->sell_qty       = $sell_qty[$item_key];
                $var->sell_price     = $sell_price[$item_key]; // sell price of that particular unit
                $var->tot_price      = (($sell_qty[$item_key]) * ($sell_price[$item_key]));
                $var->save();
                }
            }

            $val                    = new Customer_has_transaction();
            $val->sell_id           = $data['id'];
            $val->customer_id       = $inputs['customer_id'];
            // $val->credit            = $inputs['pay_amount'];
            $val->credit            = $tot_price;
            $val->debit             = $tot_price;


            $data->update([
                'total_amount'  => $tot_price,
                'pay_amount'    => $tot_price,
                'net_amount'    => ($tot_price - $tot_price),
            ]); 

            $val->save();

        }
        if($request['direction']==1){
            return redirect("sells/$sell_id")
                    ->with('success','Sell added successfully.');
              
        }else{
            return redirect()
                    ->route('sells.index')
                    ->with('success','Order added successfully.');
        }
    }

     public function show($id)
    {
        $data               = DB::table('sells')
                                ->orderBy('sells.created_at','DESC')
                                ->leftjoin('users', 'users.id', '=', 'sells.customer_id')
                                ->leftjoin('customer_has_transactions', 'customer_has_transactions.sell_id', '=', 'sells.id')
                                ->select('sells.*',
                                        'users.name as customer_name',
                                        // 'users.address',
                                        'customer_has_transactions.debit',
                                        'customer_has_transactions.credit',
                                        )
                                ->where('sells.id', $id)
                                ->first();

        // dd($data);
        $selected_items     = DB::table('sell_has_items')
                                ->leftjoin('items', 'items.id', '=', 'sell_has_items.item_id')
                                ->select('sell_has_items.*',
                                         'items.name as item_name')
                                ->where('sell_has_items.sell_id', $id)
                                ->get()
                                ->all();

        // dd($selected_items);

        return view('sells.show',compact('data','selected_items'));
    }


    public function edit($id)
    {

        return redirect()->back();
        $data               = DB::table('sells')
                                ->orderBy('sells.created_at','DESC')
                                ->leftjoin('users', 'users.id', '=', 'sells.customer_id')
                                ->leftjoin('customer_has_transactions', 'customer_has_transactions.sell_id', '=', 'sells.id')
                                ->select('sells.*',
                                        'users.name as customer_name',
                                        'customer_has_transactions.debit',
                                        'customer_has_transactions.credit'
                                        )
                                ->where('sells.id', $id)
                                ->first();

        $selected_items     = DB::table('sell_has_items')
                                ->leftjoin('items', 'items.id', '=', 'sell_has_items.item_id')
                                ->select('sell_has_items.*',
                                         'items.name as item_name')
                                ->where('sell_has_items.sell_id', $id)
                                ->get()
                                ->all();


        $items       = DB::table('items')
                        ->leftjoin('companies', 'companies.id', '=', 'items.company_id')
                        ->select(
                                'items.id',
                                DB::raw('CONCAT(items.name, "  -  ", companies.name) as name')
                                )
                        ->pluck('name','id')
                        ->all();

        $users          = DB::table('users')
                                ->orderBy('users.id')
                                ->select('users.id','name')
                                ->pluck('name','id')
                                ->all();



        return view('sells.edit',
                    compact(
                        'data',
                        'items',
                        'users',
                        'selected_items',
                        )
                    );
    }


    public function update(Request $request, $id)
    {
        $this->validate($request,
            [
                'item_id'               => 'required',
                // 'order_no'           => 'required',
                'customer_id'           => 'required',
                'total_amount'          => 'required',
            ],
            [
                'total_amount.required' => 'Please press calculate button befor submit!',
            ]
        );
        $data                       = sell::findOrFail($id);

        $inputs                     = $request->all();
        $item                       = $inputs['item_id'];
        $sell_qty                   = $inputs['sell_qty'];
        $sell_price                 = $inputs['sell_price'];

        $upd                        = $data->update($inputs);
        $sell_id                    =  $id;
        DB::table("customer_has_transactions")->where('sell_id', '=', $sell_id)->delete();
        DB::table("sell_has_items")->where('sell_id', '=', $sell_id)->delete();

        if($upd){
            if($item){
                foreach($item as $item_key => $item_value){
                $var                 = new Sell_has_item();
                $var->sell_id        = $sell_id;
                $var->item_id        = $item_value;
                $var->sell_qty       = $sell_qty[$item_key];
                $var->sell_price     = $sell_price[$item_key]; // sell price of that particular unit
                $var->tot_price      = (($sell_qty[$item_key]) * ($sell_price[$item_key]));
                $var->save();
                }
            }

            $val                    = new Customer_has_transaction();
            $val->sell_id           = $data['id'];
            $val->customer_id       = $inputs['customer_id'];
            $val->credit            = $inputs['pay_amount'];
            $val->debit             = $inputs['total_amount'];
            $val->save();

        }


        if($request['direction']==1){
            return redirect("sells/$sell_id")
                    ->with('success','Sell updated successfully.');
              
        }else{
            return redirect()
                    ->route('sells.index')
                    ->with('success','Sell updated successfully.');
        }
    }

    public function destroy(Request $request)
    {
        $ids = $request->ids;
        DB::table("company_has_transactions")->whereIn('sell_id',explode(",",$ids))->delete();
        DB::table("sell_has_items")->whereIn('sell_id',explode(",",$ids))->delete();
        DB::table("sells")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"deleted successfully."]);
    }
}
