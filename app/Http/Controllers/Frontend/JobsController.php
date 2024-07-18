<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyJobRequest;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Models\Budget;
use App\Models\Category;
use App\Models\Job;
use App\Models\TaskStatus;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class JobsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('job_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobs = Job::with(['category', 'budget', 'status', 'user', 'media'])->get();

        return view('frontend.jobs.index', compact('jobs'));
    }

    public function create()
    {
        abort_if(Gate::denies('job_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $budgets = Budget::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = TaskStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.jobs.create', compact('budgets', 'categories', 'statuses', 'users'));
    }

    public function store(StoreJobRequest $request)
    {
        $job = Job::create($request->all());

        foreach ($request->input('attachments', []) as $file) {
            $job->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('attachments');
        }

        foreach ($request->input('completed_files', []) as $file) {
            $job->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('completed_files');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $job->id]);
        }

        return redirect()->route('frontend.jobs.index');
    }

    public function edit(Job $job)
    {
        abort_if(Gate::denies('job_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $budgets = Budget::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = TaskStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $job->load('category', 'budget', 'status', 'user');

        return view('frontend.jobs.edit', compact('budgets', 'categories', 'job', 'statuses', 'users'));
    }

    public function update(UpdateJobRequest $request, Job $job)
    {
        $job->update($request->all());

        if (count($job->attachments) > 0) {
            foreach ($job->attachments as $media) {
                if (! in_array($media->file_name, $request->input('attachments', []))) {
                    $media->delete();
                }
            }
        }
        $media = $job->attachments->pluck('file_name')->toArray();
        foreach ($request->input('attachments', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $job->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('attachments');
            }
        }

        if (count($job->completed_files) > 0) {
            foreach ($job->completed_files as $media) {
                if (! in_array($media->file_name, $request->input('completed_files', []))) {
                    $media->delete();
                }
            }
        }
        $media = $job->completed_files->pluck('file_name')->toArray();
        foreach ($request->input('completed_files', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $job->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('completed_files');
            }
        }

        return redirect()->route('frontend.jobs.index');
    }

    public function show(Job $job)
    {
        abort_if(Gate::denies('job_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $job->load('category', 'budget', 'status', 'user');

        return view('frontend.jobs.show', compact('job'));
    }

    public function destroy(Job $job)
    {
        abort_if(Gate::denies('job_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $job->delete();

        return back();
    }

    public function massDestroy(MassDestroyJobRequest $request)
    {
        $jobs = Job::find(request('ids'));

        foreach ($jobs as $job) {
            $job->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('job_create') && Gate::denies('job_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Job();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
