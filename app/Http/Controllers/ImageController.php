<?php

namespace App\Http\Controllers;

use App\Models\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers;
use Auth;

use Illuminate\Support\Facades\Response;
use Image;
use View;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class ImageController extends Controller
{
    public function getImage(Request $request, $fileName)
    {

        $path = storage_path('app/image/') . $fileName;

        if (!File::exists($path)) {
            $path = storage_path('app/image/') . 'default.jpg';
        } else if (isset($request->height) && isset($request->width)) {
            $second_path = strrev($path);
            $image_name = strstr($second_path, '/', true);
            $full_path = strstr(strrev($second_path), strrev($image_name), true);
            $image_name = strrev($image_name);
            $image_name_resize = $request->height . 'x' . $request->width . '_' . $image_name;
            $path_resize = $full_path . $image_name_resize;

            if (!File::exists($path_resize)) {
                $image = Image::make($path);

                $image_width = $image->width();
                $image_height = $image->height();

                $v = min($image_width / $request->width, $image_height / $request->height);

                $needle_width = floor($v * $request->width);
                $needle_height = floor($v * $request->height);

                $image->crop($needle_width, $needle_height)
                    ->resize($request->width, $request->height)
                    ->save($path_resize);
            }
            $path = $path_resize;
        }
        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);

        $lifetime = 10000000;

        $filetime = filemtime($path);
        $etag = md5($filetime . $path);
        $time = gmdate('r', $filetime);
        $expires = gmdate('r', $filetime + $lifetime);

        $headers['Content-Type'] = $type;
        $headers['Content-Disposition'] = 'inline; filename="' . $fileName . '"';
        $headers['Last-Modified'] = $time;
        $headers['Cache-Control'] = 'must-revalidate';
        $headers['Expires'] = $expires;
        $headers['Pragma'] = 'public';
        $headers['Etag'] = $etag;

        return $response->withHeaders($headers);
    }

    public function uploadImage(Request $request)
    {
        $file = $request->image;
        $file_name = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();

        if (substr($file->getClientMimeType(), 0, 5) != 'image') {
            $result['error'] = 'Загружайте только файлы форматов JPEG, PNG';
            $result['success'] = false;
            return $result;
        } else if ($file->getClientSize() > 2097152) {
            $result['error'] = 'Максимальный размер загружаемого файла ~ 2 МБ';
            $result['success'] = false;
            return $result;
        }
        $destinationPath = $request->disk . '/' . date('Y') . '/' . date('m') . '/' . date('d');

        $file_name = $destinationPath . '/' . $file_name;

        if (Storage::disk('image')->exists($file_name)) {
            $now = \DateTime::createFromFormat('U.u', microtime(true));
            $file_name = $destinationPath . '/' . $now->format("Hisu") . '.' . $extension;
        }

        Storage::disk('image')->put($file_name, File::get($file));
        $result['success'] = true;
        $result['file_name'] = '/media' . $file_name;
        return $result;
    }


    public function uploadMultipleImages(Request $request)
    {
        if ($request->hasFile('images')) {
            $fileNames = [];
            $error = false;
            $files = $request->images;
            foreach ($files as $file) {
                $fileName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();

                if (substr($file->getClientMimeType(), 0, 5) != 'image') {
                    $result['error'] = 'Загружайте только файлы форматов JPEG, PNG';
                    $result['success'] = false;
                    return $result;
                } else if ($file->getClientSize() > 2097152) {
                    $result['error'] = 'Максимальный размер загружаемого файла ~ 2 МБ';
                    $result['success'] = false;
                    return $result;
                }
                $destinationPath = $request->disk . '/' . date('Y') . '/' . date('m') . '/' . date('d');

                $fileName = $destinationPath . '/' . $fileName;

                if (Storage::disk('image')->exists($fileName)) {
                    $now = \DateTime::createFromFormat('U.u', microtime(true));
                    $fileName = $destinationPath . '/' . $now->format("Hisu") . '.' . $extension;
                }

                if (!Storage::disk('image')->put($fileName, File::get($file))) {
                    $error = true;
                }

                $fileName = '/media' . $fileName;
                array_push($fileNames, $fileName);

            }
            if ($error) {
                $result['success'] = false;
                $result['file_name'] = $fileNames;
                return $result;
            }
            $result['success'] = true;
            $result['file_name'] = $fileNames;
            return $result;
        }
    }

    public function uploadDocument(Request $request)
    {
        if (!isset($request->image_id)) $file = $request->image;
        else $file = $request['image_' . $request->image_id];
        $file_name = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();

        if ($file->getClientSize() > 10097152) {
            $result['error'] = 'Максимальный размер загружаемого файла ~ 10 МБ';
            $result['success'] = false;
            return $result;
        }

        $destinationPath = '/document/' . date('Y') . '/' . date('m') . '/' . date('d');

        $file_name = $destinationPath . '/' . $file_name;

        if (Storage::disk('image')->exists($file_name)) {
            $now = \DateTime::createFromFormat('U.u', microtime(true));
            $file_name = $destinationPath . '/' . $now->format("Hisu") . '.' . $extension;
        }

        Storage::disk('image')->put($file_name, File::get($file));
        $result['status'] = true;
        $result['format'] = $extension;
        $result['file_name'] = '/media' . $file_name;
        return $result;
    }

    public function deleteImage($imagePath)
    {
        if (Storage::delete($imagePath)) {
            $result['status'] = true;
            $result['file_name'] = $imagePath;
            $result['message'] = 'Вы успешно удалили';
            return $result;
        }
        $result['status'] = false;
        $result['file_name'] = $imagePath;
        $result['message'] = 'Произошла ошибка';
        return $result;
    }
}
