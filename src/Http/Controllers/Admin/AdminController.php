<?php

namespace DesignByCode\Realtor\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        return view('realtor::admin.index');
    }



}
