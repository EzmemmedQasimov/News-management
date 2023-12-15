<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsStoreRequest;
use App\Http\Resources\NewsResource;
use App\Lib\Repositories\NewsRepository;

use Illuminate\Http\Response;

class NewsController extends Controller
{
    public function __construct(private NewsRepository $newsRepository)
    {
    }

    public function index()
    {
        $news = $this->newsRepository->selectAllActive();
        return success(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK], NewsResource::collection($news));
    }

    public function show($id)
    {
        $news = $this->newsRepository->firstActiveById($id);
        return success(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK], new NewsResource($news));
    }

    public function store(NewsStoreRequest $request)
    {
        $data = $request->validated();
        $news = $this->newsRepository->save($data);
        return success(Response::HTTP_CREATED, Response::$statusTexts[Response::HTTP_CREATED], new NewsResource($news));
    }

    public function update($id, NewsStoreRequest $request)
    {
        $data = $request->validated();
        $news = $this->newsRepository->firstActiveById($id, false);
        $this->newsRepository->update($news, $data);
        return success(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK], []);
    }

    public function delete($id)
    {
        $news = $this->newsRepository->firstActiveById($id, false);
        $this->newsRepository->delete($news);
        return success(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK], []);
    }
}
