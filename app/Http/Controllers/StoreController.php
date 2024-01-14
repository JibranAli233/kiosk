<?php
namespace App\Http\Controllers;
use DB;
use Auth;
use Gate;
use DataTables;
use App\Models\Company;
use App\Models\Branch;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class StoreController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:store-list', ['only' => ['index','show']]);
         $this->middleware('permission:store-create', ['only' => ['create','store']]);
         $this->middleware('permission:store-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:store-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $company_id     = hp_company_id();
            $query          = Store::where('company_id',$company_id)->orderBy('stores.name','ASC')->get();
            $table          = DataTables::of($query);

            $table->addColumn('srno', '');
            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate       = 'store-list';
                $editGate       = 'store-edit';
                $deleteGate     = 'store-delete';
                $crudRoutePart  = 'stores';

                return view('partials.datatableActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->rawColumns(['actions', 'placeholder']);
            return $table->make(true);
        }
        return view('stores.index');
    }

    public function create()
    {
        $company_id     = hp_company_id();
        $branches       = Branch::where('company_id',$company_id)->pluck('name','id')->all();
        return view('stores.create',compact('branches'));
    }

    public function store(StoreRequest $request)
    {
        // Retrieve the validated input data...
        $validated      = $request->validated();
        $data           = Store::create($request->all());
      
        return redirect()
                ->route('stores.index')
                ->with('success','Record added successfully.');
    }

     public function show($id)
    {
        $company_id = hp_company_id();
        $data       = Store::where('company_id',$company_id)->findOrFail($id);
        return view('stores.show',compact('data'));
    }


    public function edit($id)
    {
        $company_id     = hp_company_id();
        $data           = Store::where('company_id',$company_id)->findOrFail($id);
        $branches       = Branch::where('company_id',$company_id)->pluck('name','id')->all();
        return view('stores.edit',compact('data','branches'));

    }


    public function update(StoreRequest $request, $id)
    {
        dd($request->request);
        // validated input data...
        $validated  = $request->validated();
        $company_id = hp_company_id();
        $data       = Store::where('company_id',$company_id)->findOrFail($id);
        $input      = $request->all();

        // if active is not set, make it in-active
        if(!(isset($input['active']))){
            $input['active'] = 0;
        }

        $upd        = $data->update($input);

        return response()->json(['status' => 200,'success'=>'Branch added successfully.']);

        
        return redirect()
                ->route('stores.index')
                ->with('success','Record updated successfully.');
    }

    public function destroy(Item $item)
    {
        abort_if(Gate::denies('item-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $item->delete();
        return back()->with('success','Record deleted successfully.');
    }

}
