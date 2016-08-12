<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CreateNewsRequest;
use App\Http\Requests\Backend\UpdateNewsRequest;
use App\Repositories\Backend\NewsRepository;
use App\Repositories\Backend\AttachmentRepository;
use App\Models\Attachment;
use App\Models\Department;
use App\Http\Controllers\Backend\AppBaseController as BaseController;

class NewsController extends BaseController
{
    /** @var  NewsRepository */
    private $newsRepo;
    /** @var  AttachmentRepository */
    private $attachmentRepo;

    public function __construct(NewsRepository $newsRepo, AttachmentRepository $attachmentRepo)
    {
        $this->newsRepo = $newsRepo;
        $this->attachmentRepo = $attachmentRepo;
    }

    /**
     * Display a listing of the News.
     *
     * @param Request $request
     * @return Response
     */
    public function index(\Request $request)
    {
        if (request('search') || request('department_id')) {
            $news = $this->newsRepo->search(request('search'), request('department_id'));
        } else {
            $news = $this->newsRepo->paginate();
        }
        $departments = Department::getList(true);

        return view('backend.news.index', compact('news', 'departments'));
    }

    /**
     * Show the form for creating a new News.
     *
     * @return Response
     */
    public function create()
    {
        $departments = Department::getList();

        return view('backend.news.create')
            ->with('departments', $departments);
    }

    /**
     * Store a newly created News in storage.
     *
     * @param CreateNewsRequest $request
     *
     * @return Response
     */
    public function store(CreateNewsRequest $request)
    {
        $news = $this->newsRepo->createByRequest($request);

        \Flash::success('已成功新增一筆公告');

        return redirect(route('backend.news.index'));
    }

    /**
     * Show the form for editing the specified News.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $news = $this->newsRepo->findWithoutFail($id);
        $departments = Department::getList();

        if (empty($news)) {
            \Flash::error('找不到該筆公告');

            return redirect(route('backend.news.index'));
        }

        return view('backend.news.edit', compact('news', 'departments'));
    }

    /**
     * Update the specified News in storage.
     *
     * @param  int $id
     * @param UpdateNewsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNewsRequest $request)
    {
        $news = $this->newsRepo->findWithoutFail($id);

        if (empty($news)) {
            \Flash::error('找不到該筆公告');

            return redirect(route('backend.news.index'));
        }

        $news = $this->newsRepo->updateByRequest($request, $id);

        \Flash::success('已成功更新一筆公告');

        return redirect(route('backend.news.edit', $id));
    }

    /**
     * Remove the specified News from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $news = $this->newsRepo->findWithoutFail($id);

        if (empty($news)) {
            \Flash::error('找不到該筆公告');

            return redirect(route('backend.news.index'));
        }

        $this->newsRepo->delete($id);

        \Flash::success('已成功刪除一筆公告');

        return redirect(route('backend.news.index'));
    }

    public function destroyAttachment($id, $attachment_id)
    {
        $attachment = $this->attachmentRepo->findWithoutFail($attachment_id);

        if (empty($attachment)) {
            \Flash::error('找不到該筆附件');

            return redirect(route('backend.news.index'));
        }

        $this->newsRepo->destroyAttachment($attachment);

        \Flash::success('已成功刪除一筆附件');

        return redirect(route('backend.news.edit', $id));
    }
}
