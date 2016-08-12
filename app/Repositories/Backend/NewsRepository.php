<?php

namespace App\Repositories\Backend;

use App\Models\News;
use App\Models\Attachment;
use InfyOm\Generator\Common\BaseRepository;

class NewsRepository extends BaseRepository
{
    /**
     * Configure the Model
     **/
    public function model()
    {
        return News::class;
    }

    public function search($search = null, $department_id = null)
    {
        $news = News::orderBy('created_at');

        if ($search) {
            $news = $news->where('title', 'LIKE', '%' . $search . '%');
        }
        if ($department_id) {
            $news = $news->where('department_id', $department_id);
        }

        return $news->paginate();
    }

    public function createByRequest($request)
    {
        $news = $this->create($request->all());
        $this->uploadAttachments($news->id, $request);

        return $news;
    }

    public function updateByRequest($request, $id)
    {
        $news = $this->update($request->all(), $id);
        $this->uploadAttachments($news->id, $request);

        return $news;
    }

    public function destroyAttachment($attachment)
    {
        \Storage::delete($attachment->path);
        return $attachment->delete();
    }

    public function uploadAttachments($news_id, $request)
    {
        // 處理上傳檔案
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                // 略過空檔案
                if (!$file) {
                    continue;
                }
                $filename = $file->getClientOriginalName();

                // Storage
                $storage_name = uniqid() . '.' . pathinfo($filename, PATHINFO_EXTENSION);
                \Storage::put('attachments/' . $storage_name , $file);

                // 建立附件
                $attachment = new Attachment();
                $attachment->name = pathinfo($filename, PATHINFO_FILENAME);
                $attachment->extension = pathinfo($filename, PATHINFO_EXTENSION);
                $attachment->size = $file->getSize();
                $attachment->path = 'attachments/' . $storage_name;
                $attachment->news_id = $news_id;
                $attachment->save();
            }
        }
    }
}
