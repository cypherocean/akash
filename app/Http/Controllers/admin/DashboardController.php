<?php    

    namespace App\Http\Controllers\admin;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Auth, DB;

    class DashboardController extends Controller{

        /** index */
            public function index(Request $request){
                return view('admin.dashboard');
            }
        /** index */
    }