<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::orderBy('branch_name', 'ASC')->paginate(10);
        return view('backend.branches.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.branches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'branch_name' => 'required|unique:branches|string|min:1|max:255',
            'mobile' => 'required|unique:branches|numeric|digits:11',
            'address' => 'nullable|string|min:1|max:255',
        ]);

        try {
            Branch::create([
                'branch_name' => $request->branch_name,
                'mobile' => $request->mobile,
                'address' => $request->address,
            ]);

            // sweet alert
            toast('Branch added!', 'success');

            return redirect()->back();
        } catch (Exception $e) {
            // dd($e->getMessage());
            toast('Something went wrong', 'error');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $editBranch = Branch::findOrFail($id);
            return view('backend.branches.edit', compact('editBranch'));
        } catch (Exception $e) {
            // dd($e->getMessage());
            toast('Something went wrong', 'error');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'branch_name' => ['required', 'string', 'min:1', 'max:255', Rule::unique('branches', 'branch_name')->ignore($id)],
            'mobile' => ['required', 'numeric', 'digits:11', Rule::unique('branches', 'branch_name')->ignore($id)],
            'address' => 'required|string|min:1|max:255',
            'default' => 'required|string|in:0,1',
        ]);

        try {
            Branch::where('id', $id)->first()->update([
                'branch_name' => $request->branch_name,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'default' => $request->default,
            ]);

            // sweet alert
            toast('Data Updated!', 'success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            toast('Something went wrong', 'error');
        }

        return redirect()->route('branches.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Branch::findOrFail($id)->delete();

            // sweet alert
            toast('Category Deleted!', 'info');
        } catch (Exception $e) {
            // dd($e->getMessage());
            toast('Something went wrong', 'error');
        }

        return redirect()->back();
    }
}
