<?php

namespace Furbook\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;

class UploadController extends Controller
{
    public function index()
    {
        return view('upload');
    }

    /*
     * Do lưu file trong thư mục storage
     * DB: sẽ lưu path name (root)
     * Hiển thị file: sửa file web.php thêm Route lấy file
     */
    public function uploadAvatar(Request $request)
    {
        if ($request->hasFile('user_avatar')) {
            $pathName = $request->user_avatar->store('avatars', 'public');
            echo 'Path lưu vào DB: "' . $pathName . '"<br>';
            echo '<img src=" ' . asset($pathName) . '"><br>';
            echo '<a href="' . route('upload.index'). '">Quay lại</a>';
        } else {
            echo 'Không có file nào được tải lên!';
        }

    }

    /*
     * Sửa File .env và restart lại server
     * APP_URL=http://localhost:8000
     *
     * Sửa file config\filesystems.php
     * Thêm disks.upload với
     * root: nơi chứa file ($pathName)
     * url: trả về đường dẫn trỏ tới file ($productImage)
     */
    public function uploadProduct(Request $request)
    {
        if ($request->hasFile('product_image')) {
            $pathName = $request->product_image->store('products', 'upload');
            $productImage = Storage::disk('upload')->url($pathName);
            echo 'Path Name: "' . $pathName . '"<br>';
            echo 'URL lưu vào DB: "' . $productImage . '"<br>';
            echo '<img src=" ' . asset($productImage) . '"><br>';
            echo '<a href="' . route('upload.index'). '">Quay lại</a>';
        } else {
            echo 'Không có file nào được tải lên!';
        }
    }

    /*
     * Đối với file nằm trong thư mục storage
     * Xóa file sử dụng Storage::disk('public')->delete($pathName)
     */
    public function deleteUserAvatar()
    {
        $pathName = 'avatars/3mBNjpUqBzpe9g1UKZ9Hql4GUK9kF5SLVNafalHQ.jpeg';
        if (Storage::disk('public')->exists($pathName)) {
            $result = Storage::disk('public')->delete($pathName);
            echo 'Xóa file ' . ($result ? 'thành công.' : 'thất bại');
        } else {
            echo 'File không tồn tại!';
        }
    }

    /*
     * Đối với file nằm trong thư mục public
     * Xóa file sử dụng File::delete($pathName)
     */
    public function deleteProductImage()
    {
        $pathName = 'products/flmLlKKhkwBhlFFx04D84y4ESgjTn4UAvy06FoE3.jpeg';
        if (File::exists($pathName)) {
            $result = File::delete($pathName);
            echo 'Xóa file ' . ($result ? 'thành công.' : 'thất bại');
        } else {
            echo 'File không tồn tại!';
        }
    }
}
