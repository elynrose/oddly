<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyReviewRequest;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Category;
use App\Models\Job;
use App\Models\Review;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ReviewsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('review_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reviews = Review::with(['job', 'user', 'category'])->get();

        return view('admin.reviews.index', compact('reviews'));
    }

    public function create()
    {
        abort_if(Gate::denies('review_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobs = Job::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = Category::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.reviews.create', compact('categories', 'jobs', 'users'));
    }

    public function store(StoreReviewRequest $request)
    {
        $review = Review::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $review->id]);
        }

        return redirect()->route('admin.reviews.index');
    }

    public function edit(Review $review)
    {
        abort_if(Gate::denies('review_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobs = Job::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = Category::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $review->load('job', 'user', 'category');

        return view('admin.reviews.edit', compact('categories', 'jobs', 'review', 'users'));
    }

    public function update(UpdateReviewRequest $request, Review $review)
    {
        $review->update($request->all());

        return redirect()->route('admin.reviews.index');
    }

    public function show(Review $review)
    {
        abort_if(Gate::denies('review_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $review->load('job', 'user', 'category');

        return view('admin.reviews.show', compact('review'));
    }

    public function destroy(Review $review)
    {
        abort_if(Gate::denies('review_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $review->delete();

        return back();
    }

    public function massDestroy(MassDestroyReviewRequest $request)
    {
        $reviews = Review::find(request('ids'));

        foreach ($reviews as $review) {
            $review->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('review_create') && Gate::denies('review_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Review();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
