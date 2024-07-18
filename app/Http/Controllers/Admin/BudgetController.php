<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBudgetRequest;
use App\Http\Requests\StoreBudgetRequest;
use App\Http\Requests\UpdateBudgetRequest;
use App\Models\Budget;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BudgetController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('budget_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $budgets = Budget::all();

        return view('admin.budgets.index', compact('budgets'));
    }

    public function create()
    {
        abort_if(Gate::denies('budget_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.budgets.create');
    }

    public function store(StoreBudgetRequest $request)
    {
        $budget = Budget::create($request->all());

        return redirect()->route('admin.budgets.index');
    }

    public function edit(Budget $budget)
    {
        abort_if(Gate::denies('budget_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.budgets.edit', compact('budget'));
    }

    public function update(UpdateBudgetRequest $request, Budget $budget)
    {
        $budget->update($request->all());

        return redirect()->route('admin.budgets.index');
    }

    public function show(Budget $budget)
    {
        abort_if(Gate::denies('budget_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.budgets.show', compact('budget'));
    }

    public function destroy(Budget $budget)
    {
        abort_if(Gate::denies('budget_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $budget->delete();

        return back();
    }

    public function massDestroy(MassDestroyBudgetRequest $request)
    {
        $budgets = Budget::find(request('ids'));

        foreach ($budgets as $budget) {
            $budget->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
