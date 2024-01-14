<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\BranchRequest;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BranchController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:company-list', ['only' => ['index','show']]);
        $this->middleware('permission:company-create', ['only' => ['create','store']]);
        $this->middleware('permission:company-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:company-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            
            $user_id    = hp_user_id();
            $company_id = hp_company_id();
            $branch_id  = hp_branch_id();

            $company    = Company::where('id',$company_id)->first();
            $query      = Branch::query()
                                ->where('company_id',$company_id)
                                ->where('id',$branch_id)
                                ->select('branches.*')
                                ->get();

            // Get all branches of this company if, it is created by logged In user
            if(isset($company->created_by) && ($company->created_by == $user_id) ){ 
                $query      = Branch::query()
                                ->where('company_id',$company_id)
                                ->select('branches.*')
                                ->get();
            }

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'company-list';
                $editGate = 'company-edit';
                $deleteGate = 'company-delete';
                $action = 'branch_update';
                $crudRoutePart = 'branches';

                return view('partials.datatableActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'action',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
        return view('branches.index');
    }

    public function create()
    {
        return view('branches.create');
    }

    public function store(BranchRequest $request)
    {
        $validated  = $request->validated();
        $data       = Branch::create($request->all());

        return response()->json(['status' => 200,'success'=>'Branch added successfully.']);


    }

    public function show($id)
    {
        $data = Branch::query()
            ->select('branches.*')
            ->where('branches.id', $id)
            ->first();

        return view('branches.show',compact('data'));
    }

    public function edit($id)
    {
        $data = Branch::query()
            ->select('branches.*')
            ->where('branches.id', $id)
            ->first();
        return response()->json(['status' => 200, 'data' => $data, 'msg' => "Branch added Successfully", 'alert' => "success"]);

//        return view('branches.edit',compact('data'));
    }

    public function update(BranchRequest $request, $id)
    {
        $validated  = $request->validated();
        $data       = Branch::findOrFail($id);
        $data->update($request->all());

        return response()->json(['status' => 200,'success'=>'Branch updated successfully.']);


        // return response()->json(['status' => 200, 'data' => $data, 'msg' => "Branch update Successfully", 'alert' => "success"]);
    }

    public function destroy(Branch $branch)
    {
//        abort_if(Gate::denies('company-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $branch->delete();
        return back();
    }

    public function massDestroy(MassDestroyMemberRequest $request)
    {
        Branch::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
