<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessData;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
     public function index()
    {
        return view('admin.businesses.index');
    }

    public function create()
    {
        return view('admin.businesses.create');
    }

    public function edit(BusinessData $business)
    {
        $businessData = $business;

        return view('admin.businesses.edit', compact('businessData'));
    }

}
