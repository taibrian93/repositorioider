<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Node;
use App\Models\TypeDocument;
use App\Models\User;
use App\Models\File;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(){

        $users = User::count();
        $nodes = Node::count();
        $languages = Language::count();
        $typeDocuments = TypeDocument::count();

        $file = File::class;

        return view('admin.index', compact('users','nodes','languages','typeDocuments','file'));
    }
}
