<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use DataTables ,DB;

class PortfolioController extends Controller
{
    public function index(Request $request){
        $path = URL('/uploads/portfolio').'/';
        if($request->ajax()){
            $data = Portfolio::select('portfolio.id', 'portfolio.thumbnail_image', 
                    DB::Raw("CASE
                        WHEN ".'pi.images'." != '' THEN CONCAT("."'".$path."'".", ".'pi.images'.")
                        ELSE CONCAT("."'".$path."'".", 'default.png')
                        END as images"))
                    ->leftjoin('portfolio_images AS pi' ,'portfolio.id' ,'pi.portfolio_id')
                    ->orderBy('portfolio.id','desc')
                    ->get();

            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                $return = '<div class="btn-group btn-sm">
                            <a href="'.route('portfolio.view', ['id' => base64_encode($data->id)]).'" class="btn btn-default btn-xs">
                                <i class="fa fa-eye"></i>
                            </a>';
                
                
                $return .= '<a href="'.route('portfolio.edit', ['id' => base64_encode($data->id)]).'" class="btn btn-default btn-xs">
                                    <i class="fa fa-edit"></i>
                                </a>';

                $return .= '<a class="btn btn-default btn-xs" href="javascript:;" onclick="change_status(this);" data-id="'.base64_encode($data->id).'"><i class="fa fa-trash"></i></a>
                    </div>';

                return $return;
            })

            ->editColumn('status', function($data) {
                if($data->status == 'active')
                    return '<span class="badge badge-pill badge-info">Active</span>';
                else if($data->status == 'inactive')
                    return '<span class="badge badge-pill badge-warning">Inactive</span>';
                else if($data->status == 'deleted')
                    return '<span class="badge badge-pill badge-danger">Deleted</span>';
                else
                    return '-';
            })

            ->rawColumns(['action', 'status'])
            ->make(true);
        }
        return view('admin.portfolio');
    }
}
