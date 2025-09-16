<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileManagementController extends Controller
{
    public function fileManagement()
    {
        return view('admin.file.file-management');
    }
}
