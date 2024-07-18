<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBidRequest;
use App\Http\Requests\StoreBidRequest;
use App\Http\Requests\UpdateBidRequest;
use App\Models\Bid;
use App\Models\Job;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BidsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bid_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bids = Bid::with(['job', 'user'])->get();

        return view('frontend.bids.index', compact('bids'));
    }

    public function create()
    {
        abort_if(Gate::denies('bid_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobs = Job::pluck('job_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.bids.create', compact('jobs', 'users'));
    }

    public function store(StoreBidRequest $request)
    {
        $bid = Bid::create($request->all());

        return redirect()->route('frontend.bids.index');
    }

    public function edit(Bid $bid)
    {
        abort_if(Gate::denies('bid_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobs = Job::pluck('job_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bid->load('job', 'user');

        return view('frontend.bids.edit', compact('bid', 'jobs', 'users'));
    }

    public function update(UpdateBidRequest $request, Bid $bid)
    {
        $bid->update($request->all());

        return redirect()->route('frontend.bids.index');
    }

    public function show(Bid $bid)
    {
        abort_if(Gate::denies('bid_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bid->load('job', 'user');

        return view('frontend.bids.show', compact('bid'));
    }

    public function destroy(Bid $bid)
    {
        abort_if(Gate::denies('bid_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bid->delete();

        return back();
    }

    public function massDestroy(MassDestroyBidRequest $request)
    {
        $bids = Bid::find(request('ids'));

        foreach ($bids as $bid) {
            $bid->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
