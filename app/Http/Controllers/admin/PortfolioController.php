<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PortfolioRequest;
use App\Models\Portfolio;
use App\Models\PortfolioImages;
use Illuminate\Http\Request;
use DataTables, DB;

class PortfolioController extends Controller
{
    public function index(Request $request){

        $path = URL('/uploads/portfolio') . '/';
        if ($request->ajax()) {
            $data = Portfolio::select(
                'portfolio.id',
                'portfolio.name',
                DB::Raw("SUBSTRING(" . 'portfolio.description' . ", 1, 50) as description"),
                'portfolio.thumbnail_image',
                'portfolio.status',
                DB::Raw("CASE
                        WHEN " . 'portfolio.thumbnail_image' . " != '' THEN CONCAT(" . "'" . $path . "'" . ", " . 'portfolio.thumbnail_image' . ")
                        ELSE CONCAT(" . "'" . $path . "'" . ", 'default.png')
                        END as image")
            )
                ->orderBy('portfolio.id', 'desc')
                ->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $return = '<div class="btn-group btn-sm">
                            <a href="' . route('portfolio.view', ['id' => base64_encode($data->id)]) . '" class="btn btn-default btn-xs">
                                <i class="fa fa-eye"></i>
                            </a>';


                    $return .= '<a href="' . route('portfolio.edit', ['id' => base64_encode($data->id)]) . '" class="btn btn-default btn-xs">
                                    <i class="fa fa-edit"></i>
                                </a>';

                    $return .= '<a href="javascript:;" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bars"></i>
                            </a> &nbsp;
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:;" onclick="change_status(this);" data-status="active" data-id="' . base64_encode($data->id) . '">Active</a></li>
                                <li><a class="dropdown-item" href="javascript:;" onclick="change_status(this);" data-status="inactive" data-id="' . base64_encode($data->id) . '">Inactive</a></li>
                                <li><a class="dropdown-item" href="javascript:;" onclick="change_status(this);" data-status="deleted" data-id="' . base64_encode($data->id) . '">Delete</a></li>
                            </ul>';

                    return $return;
                })

                ->editColumn('image', function ($data) {
                    $url = $data->image;
                    return '<img src="' . $url . '" border="0" width="40" class="img-rounded" align="center" />';
                })

                ->editColumn('status', function ($data) {
                    if ($data->status == 'active')
                        return '<span class="badge badge-pill badge-success">Active</span>';
                    else if ($data->status == 'inactive')
                        return '<span class="badge badge-pill badge-warning">Inactive</span>';
                    else if ($data->status == 'deleted')
                        return '<span class="badge badge-pill badge-danger">Deleted</span>';
                    else
                        return '-';
                })

                ->rawColumns(['action', 'status', 'image'])
                ->make(true);
        }
        return view('admin.portfolio.index');
    }

    public function create(Request $request){
        return view('admin.portfolio.create');
    }

    public function insert(PortfolioRequest $request){
        if ($request->ajax()) {
            return true;
        }

        $crud = [
            'name' => $request->name,
            'description' => $request->description,
            'status' => 'active',
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => auth()->user()->id,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => auth()->user()->id
        ];

        // Thumbnail Image
        if (!empty($request->file('thumbnail'))) {
            $file = $request->file('thumbnail');
            $filenameWithExtension = $request->file('thumbnail')->getClientOriginalName();
            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
            $extension = $request->file('thumbnail')->getClientOriginalExtension();
            $filenameToStore = "thumb_" . time() . "_" . $filename . '.' . $extension;

            $folder_to_upload = public_path() . '/uploads/portfolio/';

            if (!\File::exists($folder_to_upload))
                \File::makeDirectory($folder_to_upload, 0777, true, true);

            $crud['thumbnail_image'] = $filenameToStore;
        } else {
            $crud['thumbnail_image'] = 'default.jpg';
        }
        // Thumbnail Image

        // Images
        DB::beginTransaction();
        try {
            $last_id = Portfolio::insertGetId($crud);
            if ($last_id) {
                // Move Files to Folder
                if (!empty($request->file('thumbnail'))) {
                    $file->move($folder_to_upload, $filenameToStore);
                }

                if (!empty($request->file('images'))) {
                    $file = $request->file('images');
                    foreach ($file as $files) {
                        $filenameWithExtension = $files->getClientOriginalName();
                        $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
                        $extension = $files->getClientOriginalExtension();
                        $filenameToStore1 = time() . "_" . $filename . '.' . $extension;

                        $folder_to_upload = public_path() . '/uploads/portfolio/';

                        if (!\File::exists($folder_to_upload)) {
                            \File::makeDirectory($folder_to_upload, 0777, true, true);
                        }

                        $files->move($folder_to_upload, $filenameToStore1);
                        $crud2 = [
                            'portfolio_id' => $last_id,
                            'images' => $filenameToStore1,
                            'status' => 'active',
                            'created_by' => auth()->user()->id,
                            'updated_by' => auth()->user()->id,
                            'created_at' => Date('Y-m-d H:i:s'),
                            'updated_at' => Date('Y-m-d H:i:s')
                        ];
                        $portfolio_image = DB::table('portfolio_images')->insertGetId($crud2);
                        // dd('in');
                    }
                }
                DB::commit();
                return redirect()->route('portfolio')->with('success', 'Record inserted successfully');
            } else {
                DB::rollback();
                return redirect()->back()->with('error', 'Failed to insert record')->withInput();
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong, please try again later')->withInput();
        }
    }

    public function edit(Request $request){
        $id = base64_decode($request->id);
        $portfolio = Portfolio::where('portfolio.id' ,$id)->first();
        $portfolio_images = DB::table('portfolio_images')->where('portfolio_id' ,$id)->get()->toArray();
        return view('admin.portfolio.edit')->with(['portfolio' => $portfolio , 'portfolio_images' => $portfolio_images]);   
    }

    public function update(PortfolioRequest $request){
        if ($request->ajax()) {
            return true;
        }
        $id = $request->id;

        $crud = [
            'name' => $request->name,
            'description' => $request->description,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => auth()->user()->id
        ];

        // Thumbnail Image
        if (!empty($request->file('thumbnail'))) {
            $file = $request->file('thumbnail');
            $filenameWithExtension = $request->file('thumbnail')->getClientOriginalName();
            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
            $extension = $request->file('thumbnail')->getClientOriginalExtension();
            $filenameToStore = "thumb_" . time() . "_" . $filename . '.' . $extension;

            $folder_to_upload = public_path() . '/uploads/portfolio/';

            if (!\File::exists($folder_to_upload))
                \File::makeDirectory($folder_to_upload, 0777, true, true);

            $crud['thumbnail_image'] = $filenameToStore;
        }
        // Thumbnail Image

        // Images
     
            $update_portfolio = Portfolio::where(['id' => $id])->update($crud);
            if ($update_portfolio) {
                // Move Files to Folder
                if (!empty($request->file('thumbnail'))) {
                    $file->move($folder_to_upload, $filenameToStore);
                }

                if (!empty($request->file('images'))) {
                    $ext_rec = DB::table('portfolio_images')->where('portfolio_id' ,$id)->delete();
                    $file = $request->file('images');
                    foreach ($file as $files) {
                        $filenameWithExtension = $files->getClientOriginalName();
                        $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
                        $extension = $files->getClientOriginalExtension();
                        $filenameToStore1 = "port_" . time() . "_" . $filename . '.' . $extension;

                        $folder_to_upload = public_path() . '/uploads/portfolio/';

                        if (!\File::exists($folder_to_upload)) {
                            \File::makeDirectory($folder_to_upload, 0777, true, true);
                        }

                        $files->move($folder_to_upload, $filenameToStore1);
                        $crud2 = [
                            'portfolio_id' => $id,
                            'images' => $filenameToStore1,
                            'status' => 'active',
                            'created_by' => auth()->user()->id,
                            'updated_by' => auth()->user()->id,
                            'created_at' => Date('Y-m-d H:i:s'),
                            'updated_at' => Date('Y-m-d H:i:s')
                        ];
                        $portfolio_image = DB::table('portfolio_images')->insertGetId($crud2);
                    }
                    return redirect()->route('portfolio')->with('success', 'Record updated successfully');
                }else{
                    
                    return redirect()->route('portfolio')->with('success', 'Record updated successfully.');
                }
            } else {
            
                return redirect()->back()->with('error', 'Failed to insert record')->withInput();
            }
        
    }

    public function view(Request $request){
        $id = base64_decode($request->id);
        $portfolio = Portfolio::where('portfolio.id' ,$id)->first();
        $portfolio_images = DB::table('portfolio_images')->where('portfolio_id' ,$id)->get()->toArray();
        return view('admin.portfolio.view')->with(['portfolio' => $portfolio , 'portfolio_images' => $portfolio_images]);   
    }

    public function change_status(Request $request){
        if (!$request->ajax()) { exit('No direct script access allowed'); }

        $id = base64_decode($request->id);
        $data = Portfolio::where(['id' => $id])->first();

        if (!empty($data)) {
            $update = Portfolio::where(['id' => $id])->update(['status' => $request->status, 'updated_at' => date('Y-m-d H:i:s'), 'updated_by' => auth()->user()->id]);
            if ($update) {
                $update_image = PortfolioImages::where(['portfolio_id' => $id])->update(['status' => $request->status, 'updated_at' => date('Y-m-d H:i:s'), 'updated_by' => auth()->user()->id]);
                if($update_image){
                    return response()->json(['code' => 200]);
                }else{
                    return response()->json(['code' => 201]);
                }
            } else {
                return response()->json(['code' => 201]);
            }
        } else {
            return response()->json(['code' => 201]);
        }
        
    }
}
