<?php

namespace App\Lib\Repositories;

use App\Models\News;
use App\Models\NewsTranslation;

class NewsRepository
{

    public function selectAllActive()
    {
        return News::active()->with(['translation'])->get();
    }

    public function firstActiveById($id, $isActive = true)
    {
        $query = News::where('id', $id)->with(['translation']);
        if ($isActive) {
            $query->active();
        }
        return $query->firstOrFail();
    }

    public function save($data)
    {
        try {
            $news = News::create([
                'status'    => $data['status'],
            ]);
            NewsTranslation::create([
                'fk_id_news'        => $news->id,
                'title'             => $data['title'],
                'description'       => $data['description'],
                'language_code'     => $data['language_code'],
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }

        return $news;
    }

    public function update($news, $data)
    {
        try {
            $news->update([
                'status'            => $data['status']
            ]);
            NewsTranslation::where('fk_id_news', $news->id)->where('language_code', $data['language_code'])->update([
                'title'             => $data['title'],
                'description'       => $data['description'],
                'language_code'     => $data['language_code'],
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function delete($news)
    {
        try {
            $news->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
