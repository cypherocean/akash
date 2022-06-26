<?php    

    namespace App\Http\Controllers\Front;

    use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;
    use DB;

    class RootController extends Controller{

        /** index */
            public function index(Request $request){
                return view('front.index');
            }
        /** index */

        /** Portfolio */
            public function portfolio(Request $request ,$id = ''){
                return view('front.portfolio');
            }
        /** Portfolio */
        
        
        /** Contact */
            public function contact(Request $request){
                if(!$request->ajax()){ exit('No direct script access allowed'); }

                $crud = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'subject' => $request->subject,
                    'message' => $request->message,
                    'is_read' => 'n'
                ];
    
                $contact = ContactUs::create($crud);
    
                if($contact){
                    $mailData = [   
                                    'email_from_address' => _settings('MAIL_FROM_ADDRESS'), 
                                    'name' => $request->name, 
                                    'email' => $request->email, 
                                    'phone' => $request->phone, 
                                    'subject' => $request->subject, 
                                    'message' => $request->message
                                ];
    
                    try{
                        Mail::to(_settings('MAIL_FROM_ADDRESS'))->send(new ContactUsMail($mailData));
                    }catch(\Exception $e){
                    
                    }
    
                    return response()->json(['code' => 200, 'message' => 'Thanks for contact us, we will take actions sortly.']);
                }
                else
                    return response()->json(['code' => 201, 'message' => 'Something went wrong, please try again later.']);
            }
        /** Contact */
    }