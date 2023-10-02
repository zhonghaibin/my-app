<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UploadController extends Controller
{
    public function image(Request $request): \Illuminate\Http\JsonResponse|array
    {
        if (!$request->hasFile('editormd-image-file')) {
            return ['success' => 0, 'message' => '上传文件不存在'];
        }
        $file = $request->file('editormd-image-file');
        $rules = [
            'editormd-image-file' => 'max:10240',
        ];
        $messages = [
            'editormd-image-file.max' => '上传图片最大不超过10M',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if (!$validator->passes()) {
            return ['success' => 0, 'message' => '上传图片最大不超过10M'];
        }
        $filePath = config("editormd.upload_path") . date('Ymd', time()) . '/';
        $savepath = public_path($filePath);
        if (!is_dir($savepath)) {
            mkdir($savepath, 0777, true);
        }
        $ext = $file->getClientOriginalExtension();
        if (!in_array($ext, ['png', 'jpg', 'jpeg', 'gif'])) {
            return response()->json(['success' => 0, 'message' => '文件类型不符合要求']);
        }
        $fileName = uniqid() . '_' . date('s') . '.' . $ext;
        if (!$file->isValid()) {
            return ['success' => 0, 'message' => '文件校验失败'];
        }
        $file->move($savepath, $fileName);
        return ['success' => 1, 'url' => $filePath . $fileName];
    }
}
