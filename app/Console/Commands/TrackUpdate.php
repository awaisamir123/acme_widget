<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use Illuminate\Support\Facades\Http;
use DB;
use App\Models\tracking_data;
use Illuminate\Http\Request;
class TrackUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'track:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $getlocalttrackuser=tracking_data::all();
        //   dd($getlocalttrackuser);
          $response = Http::get('https://ffm.ismart.link/api/location_teamview.html', [
            'username' => '03041228820',
            'password' => 'uil@123',
            'is_json_true' => 'y'
        ]);

        // return json_decode($response);
        // return $response['Users']['User'];

        if(count($getlocalttrackuser) > 0){

                foreach($response['Users']['User'] as  $usersjazz){
                        $jazz_lng = number_format($usersjazz['Location']['Longitude'] , 6);
                        $jazz_lat = number_format($usersjazz['Location']['Latitude'] , 6);
                         $old = DB::table('tracking_data')
                                  ->where('msisdn',$usersjazz['MSISDN'])
                                  ->where('latitude',$jazz_lat)
                                  ->where('longitude',$jazz_lng)
                                  ->first();
                        if(!$old){
                            DB::table('tracking_data')->insert([
                                'msisdn' => $usersjazz['MSISDN'],
                                'username' => $usersjazz['UserName'],
                                'date' => $usersjazz['Location']['Date'],
                                'time' => $usersjazz['Location']['Time'],
                                'longitude' => $jazz_lng,
                                'latitude' => $jazz_lat,
                                'timeatlocation' => $usersjazz['Location']['TimeAtLocation'],
                                'address' =>$usersjazz['Location']['Address']
                                ]);
                        }
                        // $except = 1;
                        // DB::table('tracking_data')->where('msisdn',$usersjazz['MSISDN'])
                        //     ->where('latitude',$jazz_lat)
                        //     ->where('longitude',$jazz_lng)
                        //     ->latest()
                        //     ->skip($except)
                        //     ->get()
                        //     ->each(function($row){ $row->delete(); });
                        // var_dump($usersjazz['MSISDN'], $jazz_lng  , $jazz_lat);
                       }
                }
        else{
            foreach($response['Users']['User'] as  $usersjazz){
                $jazz_lng = number_format($usersjazz['Location']['Longitude'] , 6);
                $jazz_lat = number_format($usersjazz['Location']['Latitude'] , 6);

                 DB::table('tracking_data')->insert([
                     'msisdn' => $usersjazz['MSISDN'],
                     'username' => $usersjazz['UserName'],
                     'date' => $usersjazz['Location']['Date'],
                     'time' => $usersjazz['Location']['Time'],
                     'longitude' => $jazz_lng,
                     'latitude' => $jazz_lat,
                     'timeatlocation' => $usersjazz['Location']['TimeAtLocation'],
                     'address' =>$usersjazz['Location']['Address']
                     ]);
                 }

        }
        // $to_name="D GROUND";
        //     $to_email='ali.nasir2444@gmail.com';
        //     // $from_email='us@example.com';
        //       $code="Work Force User Account";
        //       $data=array('name'=> $code, 'body' => 'Work Force User Account Create Successfully');
        //       \Mail::send('emails',$data,function($message) use ($to_name,$to_email){
        //         $message->from('crmuk85@gmail.com', 'D GROUND');
        //         $message->to($to_email)
        //         ->subject('Mail from D GROUND');
        //       });
    }
}
