<?php

namespace App\Http\Controllers\Backend;
use DB;
use Session;
use App\User;
use App\Models\Role;
use App\Models\track_data;
use Illuminate\Support\Arr;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use App\Models\tracking_data;
use App\Models\track_data_location;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('UserMiddleware');
    }
    public function companyList(){
        // $users  = User::Companies()->get();
        $users  = User::all();
        // $users=User::with('companyDetail')->get();
        // dd($users);
        // return $users->toJson();
        return view('backend.user.list',['user' => $users]);
    }

    public function employeeList(){
        // $users = User::all();
        // dd($users);
        $users  = User::with('employeesDetail','RoleUser')->where('role_id','=', 3)->get();
        // dd($users);
        return view('backend.employee.list',['user' => $users]);
    }

    public function userAdd(){
        $role = Role::whereStatus(1)->get();
        $users  = User::with('role')->whereHas('role', function($qurey){
            $qurey->where('id',2);
        })->get();
        return view('backend.user.add',compact('users','role'));

    }

    public function userStore(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'required|min:6|same:c_password',
            'role_id' => 'required',
        ]);
            $data = $request->all();
            $data['parent_id'] = Auth::user()->id;
            $data['password'] = Hash::make($request->password);
        if(User::create($data)){
            return redirect()->route('user.list')->with('success','User has been added Successfully');
        }
        else{
            return redirect()->back()->with('error','Something problem in internal system');
        }
    }

    public function userEdit($request){
        $users = User::find($request);
        $role = Role::whereStatus(1)->get();
        return view('backend.user.edit',compact('users','role'));
    }

    public function userUpdate(Request $request){
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'role_id' => 'required',
        ]);
        $data = $request->all();
        $user  = User::find($request->id);
        if($user->update($data)){
            return redirect()->back()->with('success','User has been Updated Successfully');
        }
        else{
            return redirect()->back()->with('error','Something problem internal system');
        }


    }

    public function userDelete($id){
        $user = User::find($id);
        if($user->delete()){
            return redirect()->back()->with('success','User deleted Successfully');
        }
        else{
            return redirect()->back()->with('error','Something problem internal system');
        }
    }
    public function userProfile(){
        return view('backend.user.user_profile');
    }
    public function userProfileUpdate(Request $request){
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required'
        ];
        $this->validate($request,$rules);

        $data = $request->all();
        if($request->hasFile('avatar')){
            $image = $request->file('avatar');
            $name = time().'_'.$image->getClientOriginalName();
            $path = storage_path("app/public/user_image/");
            $image->move($path,$name);

            $data['avatar'] = $name;
        }

        $user = User::find(auth()->user()->id);
        if($user->update($data)){
            session()->flash('success','Profile updated successfully');
            return redirect()->back();
        }else{
            session()->flash('error','Something error in internal system');
            return redirect()->back();
        }
    }

    public function passwordChange(Request $request){

        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {

            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again");

        }else{

            $rules = [
                'password' => 'required_with:confirm_password|same:confirm_password'
            ];
            $this->validate($request,$rules);

            $password = bcrypt($request->password);
            $data = [
                'password' => $password
            ];

            $user = User::find(auth()->user()->id);
            if($user->update($data)){
                session()->flash('success','Password updated successfully');
                return redirect()->back();
            }else{
                session()->flash('error','Something error in internal system');
                return redirect()->back();
            }
        }
    }


    public function trackuserbynum(Request $request){
       $to = $request->todate;
       $from = $request->fromdate;
       $num=$request->phone;
       $to=date_create($request->todate);
       $from=date_create($request->fromdate);
       $y = date_format($to,"d-m-Y");
       $z = date_format($from,"d-m-Y");
       // dd($y, $z);
       $map_pins = DB::table('tracking_data')->where('msisdn',$num)->whereBetween('date', [$y, $z])->get();
       //dd($map_pins);
       Session::put('trackdata', $map_pins);
       $getname=DB::table('tracking_data')->where('msisdn',$num)->first();
       return view ('backend.user.trackuser')->with('map_pins',$map_pins)->with('trackUsername',$getname);
    }

    public function trackuser(){

        return view ('backend.user.trackuser');
    //   $getlocalttrackuser=tracking_data::all();
    // //   dd($getlocalttrackuser);
    //   $response = Http::get('https://ffm.ismart.link/api/location_teamview.html', [
    //     'username' => '03041228820',
    //     'password' => 'uil@123',
    //     'is_json_true' => 'y'
    // ]);

    // // return json_decode($response);
    // // return $response['Users']['User'];

    // if(count($getlocalttrackuser) > 0){
    //         foreach($response['Users']['User'] as  $usersjazz){
    //                 $jazz_lng = number_format($usersjazz['Location']['Longitude'] , 6);
    //                 $jazz_lat = number_format($usersjazz['Location']['Latitude'] , 6);
    //                  $old = DB::table('tracking_data')
    //                           ->where('msisdn',$usersjazz['MSISDN'])
    //                           ->where('latitude',$jazz_lat)
    //                           ->where('longitude',$jazz_lng)
    //                           ->first();
    //                 if(!$old){
    //                     DB::table('tracking_data')->insert([
    //                         'msisdn' => $usersjazz['MSISDN'],
    //                         'username' => $usersjazz['UserName'],
    //                         'date' => $usersjazz['Location']['Date'],
    //                         'time' => $usersjazz['Location']['Time'],
    //                         'longitude' => $jazz_lng,
    //                         'latitude' => $jazz_lat,
    //                         'timeatlocation' => $usersjazz['Location']['TimeAtLocation'],
    //                         'address' =>$usersjazz['Location']['Address']
    //                         ]);
    //                 }

    //                 // var_dump($usersjazz['MSISDN'], $jazz_lng  , $jazz_lat);
    //                }
    //         }
    // else{
    //     foreach($response['Users']['User'] as  $usersjazz){
    //         $jazz_lng = number_format($usersjazz['Location']['Longitude'] , 6);
    //         $jazz_lat = number_format($usersjazz['Location']['Latitude'] , 6);

    //          DB::table('tracking_data')->insert([
    //              'msisdn' => $usersjazz['MSISDN'],
    //              'username' => $usersjazz['UserName'],
    //              'date' => $usersjazz['Location']['Date'],
    //              'time' => $usersjazz['Location']['Time'],
    //              'longitude' => $jazz_lng,
    //              'latitude' => $jazz_lat,
    //              'timeatlocation' => $usersjazz['Location']['TimeAtLocation'],
    //              'address' =>$usersjazz['Location']['Address']
    //              ]);
    //          }

    // }
    //   return view ('backend.user.trackuser');
    }


    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
