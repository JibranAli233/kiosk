<?php
namespace App\Http\Controllers;
use DB;
use Auth;
use Gate;
use DataTables;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TypeRequest;
use Symfony\Component\HttpFoundation\Response;

class TypeController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:type-list', ['only' => ['index','show']]);
         $this->middleware('permission:type-create', ['only' => ['create','store']]);
         $this->middleware('permission:type-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:type-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $company_id = hp_company_id();
            $query      = Type::where('company_id',$company_id)->orderBy('types.name','ASC')->get();
            $table      = DataTables::of($query);

            $table->addColumn('srno', '');
            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            // $table->editColumn('parent_id', function ($row) {
            //     if(isset($row->parent_id)){
            //         if(isset($row->parent->name)){
            //             return $row->parent->name;
            //         }
            //     }
            //     return "";
            // });


            $table->editColumn('parent_id', function ($row) {
                if(isset($row->parent_id)){
                    return $row->getAllParenttypes();
                }
                return "";
            });

            $table->editColumn('actions', function ($row) {
                $viewGate       = 'type-list';
                $editGate       = 'type-edit';
                $deleteGate     = 'type-delete';
                $crudRoutePart  = 'types';

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
        return view('types.index');
    }

    public function create()
    {
        $company_id     = hp_company_id();
        $types         = Type::where('company_id',$company_id)->pluck('name','id')->all();
        return view('types.create',compact('types'));
    }

    public function store(TypeRequest $request)
    {
        // Retrieve the validated input data...
        $validated      = $request->validated();
        $data           = Type::create($request->all());

        if ($request->ajax()) {
            return response()->json([
                'data'      => $data,
                'success'   => 'Record added successfully.',
            ]);
        }
      
        return redirect()
                ->route('types.index')
                ->with('success','Record added successfully.');
    }

     public function show($id)
    {
        $company_id     = hp_company_id();
        $data           = Type::where('company_id',$company_id)->findOrFail($id);
        return view('types.show',compact('data'));
    }

    public function edit($id)
    {
        $company_id  = hp_company_id();
        $types       = Type::where('company_id',$company_id)->where('id','!=',$id)->pluck('name','id')->all();
        $data        = Type::where('company_id',$company_id)->findOrFail($id);
        return view('types.edit',compact('data','types'));
    }

    public function update(TypeRequest $request, $id)
    {
        // validated input data...
        $validated  = $request->validated();
        $company_id = hp_company_id();
        $data       = Type::where('company_id',$company_id)->findOrFail($id);
        $input      = $request->all();

        // if active is not set, make it in-active
        if(!(isset($input['active']))){
            $input['active'] = 0;
        }

        $upd        = $data->update($input);
        return redirect()
                ->route('types.index')
                ->with('success','Record updated successfully.');
    }

    public function destroy(Category $category)
    {
        $data       = Type::where('parent_id',$type->id)->first();
        if(isset($data->id)){
            return back()->with('permission','Delete Failed! Parent Id of other category.');
        }else{
            abort_if(Gate::denies('type-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $type->delete();
            return back()->with('success','Record deleted successfully.');
        }
    }
}
