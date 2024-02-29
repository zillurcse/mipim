<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['items'] = Banner::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Banner has been updated',
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all);

        $path = $request->file('file')->storePublicly('public/banner');
        $data['title'] = 'Banner';
        $data['banner_image'] = 'https://mipim-file.s3.amazonaws.com/' . $path;
        $banner = Banner::create($data);


        //        $this->fileUpload([
        //            'model' => $banner,
        //            'file' => $request['banner_image'],
        //            'multi_upload' => false,
        //            'request_type' => 'base64',
        //            'collection_name' => 'gallery',
        //        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Banner has been updated',
            'data' => $banner
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    function fileUpload($options = [])
    {

        try {
            if (!key_exists('model', $options)) {
                throw new ('please model provide ');
            }
            if (!key_exists('file', $options)) {
                throw new ('file key needed');
            }
            if (key_exists('request_type', $options) && !is_string($options['request_type'])) {
                throw new ('request_type must be string ');
            }
            if (key_exists('collection_name', $options) && !is_string($options['collection_name'])) {
                throw new ('collection_name must be string ');
            }
            if (key_exists('mime_type', $options) && !is_array($options['mime_type'])) {
                throw new ('mime_type must be array ');
            }
            if (key_exists('multi_upload', $options) && !is_bool($options['multi_upload'])) {
                throw new ('multi_upload type must be boolean ');
            }
            if (!key_exists('request_type', $options)) {
                $options['request_type'] = 'file_upload';
            }
            if (!key_exists('multi_upload', $options)) {
                $options['multi_upload'] = false;
            }
            if (!key_exists('collection_name', $options)) {
                $options['collection_name'] = false;
            }

            if (!key_exists('mime_type', $options)) {
                $options['mime_type'] = null;
            }

            $options = (object)$options;

            if ($options->multi_upload) {
                if (is_array($options->file)) {
                    foreach ($options->file as $file) {
                        $this->conditionWiseMedeaUpload($options, $file);
                    }
                }
            } else if (!is_array($options->file)) {
                $this->conditionWiseMedeaUpload($options, $options->file);
            } else if (is_array($options->file)) {
                foreach ($options->file as $file) {
                    $this->conditionWiseMedeaUpload($options, $file);
                }
            }
            return true;
        } catch (\Exception $exception) {
            return [
                'status' => false,
                'message' => $exception->getMessage()
            ];
        }
    }

    function conditionWiseMedeaUpload($options, $file)
    {
        if ($options->request_type == 'file_upload') {
            if (!$options->mime_type) {
                $upload = $options->model->addMedia($file);
            } else {
                $upload = $options->model->addMedia($file, $options->mime_type);
            }
            $upload->toMediaCollection($options->collection_name);
        } else if ($options->request_type == 'base64') {
            $file = trim($file);
            if (!$options->mime_type) {
                $upload = $options->model->addMediaFromBase64($file);
            } else {

                $upload = $options->model->addMediaFromBase64($file, $options->mime_type);
            }
            $upload->toMediaCollection($options->collection_name);
        } else if ($options->request_type == 'url') {
            if (!$options->mime_type) {
                $upload = $options->model->addMediaFromUrl($file);
            } else {
                $upload = $options->model->addMediaFromUrl($file, $options->mime_type);
            }
            $upload->toMediaCollection($options->collection_name);
        }
    }

    function deleteMedia($model, $files, $delete_type = "original_url")
    {
        try {
            $files_data = [];
            if (is_string($files)) {
                $files_data[] = $files;
            } else if (is_array($files)) {
                $files_data = $files;
            }
            $model->getMedia('*')->whereIn($delete_type, $files_data)->each(function ($item) {
                $item->delete();
            });
            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }

    function deleteCollections($collections, $model)
    {
        $collections->each(function ($collection) use ($model) {
            $model->clearMediaCollection($collection);
        });
    }
    function
    deleteAllMedia($model, $collection_name = false)
    {
        try {
            if ($collection_name) {
                if (is_string($collection_name)) {
                    $model->clearMediaCollection($collection_name);
                }
                if (is_array($collection_name)) {
                    $collections = collect($collection_name);
                    $this->deleteCollections($collections, $model);
                }
            } else {
                $collections = $model->getMedia('*')->pluck('collection_name')->unique();
                $this->deleteCollections($collections, $model);
            }
            return true;
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    function mediaGallery($model, $column = false, $value = false)
    {
        try {
            if (!$column || !$value) {
                $query = Media::query();
            } else {
                $ids = $model::where($column, $value)->pluck('id');
                $query = Media::where('model_type', $model)->whereIn('model_id', $ids);
            }
            return $query->get()->map(function ($media) {
                return [
                    'file_name' => $media->file_name,
                    'uuid' => $media->uuid,
                    'url' => $media->getUrl()
                ];
            });
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }


    function changeMedia($model, $files, $move_to, $exit_move_to = false, $condition = 'original_url')
    {
        try {
            $files_data = [];
            if (is_string($files)) {
                $files_data[] = $files;
            } else if (is_array($files)) {
                $files_data = $files;
            }

            if ($exit_move_to) {
                $model->getMedia($move_to)->each(function ($item) use ($exit_move_to) {
                    $item->update(['collection_name' => $exit_move_to]);
                });
            }

            $model->getMedia('*')->whereIn($condition, $files_data)->each(function ($item) use ($move_to) {
                $item->update([
                    'collection_name' => $move_to
                ]);
            });
            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }
}
