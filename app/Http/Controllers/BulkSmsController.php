<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Reminder;
use App\Models\Vehicle;
use App\Models\User;
use App\Models\ReminderHistory;
use App\Models\SmsHistory;

use App\Http\Requests\SmsPubRequest;
use App\Http\Requests\SmsManualRequest;

use Twilio\Rest\Client;
use Twilio\Exceptions\RestException;
use Validator;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BulkSmsController extends Controller
{
    public function __construct()
    {
        
    }

    public function tax(){
        echo "tax";
        $reminder = Reminder::get();
        $vehicle = Vehicle::get();
        
        $today = Carbon::today();
        foreach($vehicle as $keyVehicle=>$valueVehicle){
            $deadlineTax = Carbon::parse($valueVehicle->tax_validity_period);

            if($today <= $deadlineTax){
                $diff = $today->diffInDays($deadlineTax);
                foreach($reminder as $keyReminder=>$valueReminder){
                    if($diff==$valueReminder->before_deadline){


                        $message = "Your tax vehicle (".$valueVehicle->area_code." ".$valueVehicle->number." ".$valueVehicle->code.") payment deadline has ".$diff." days left, on the date ".$valueVehicle->tax_validity_period;
                        // $reminderReceiver = ReminderReceiverRole::where('reminder', $valueReminder->id)->get();
                        
                        // $receiverRole = array();
                        // foreach($reminderReceiver as $keyReminderReceiver => $valueReminderReceiver){
                        //     array_push($receiverRole,$valueReminderReceiver->role);
                        // }
                        // $receiverRole = array_unique($receiverRole);

                        // foreach($receiverRole as $keyReceiverRole => $valueReceiverRole){
                            $reminderUser = User::get();
                            $receiverUser = array();
                            foreach($reminderUser as $keyReminderUser => $valueReminderUser){
                                $idUser = $valueReminderUser->id;
                                $to = $valueReminderUser->phone;

                                if($to[0]=="0"){

                                    $to="+62".substr($to, 1);
                                }
                                array_push($receiverUser,['idUser'=> $idUser, 'phone'=>$to]);
                            }

                            $receiverUser = array_map("unserialize", array_unique(array_map("serialize", $receiverUser)));

                            // $receiverUser = array_unique($receiverUser);
                            $this->sendSms($receiverUser, $message, $valueVehicle->id, "tax");
                            
                        // }
                    }
                }
            }
        }
    }

    public function stnk(){
        $reminder = Reminder::get();
        $vehicle = Vehicle::get();
        
        $today = Carbon::today();
        foreach($vehicle as $keyVehicle=>$valueVehicle){
            $deadlineTax = Carbon::parse($valueVehicle->stnk_validity_period);

            if($today <= $deadlineTax){
                $diff = $today->diffInDays($deadlineTax);
                foreach($reminder as $keyReminder=>$valueReminder){
                    if($diff==$valueReminder->before_deadline){
                        $message = "Your STNK vehicle (".$valueVehicle->area_code." ".$valueVehicle->number." ".$valueVehicle->code.") payment deadline has ".$diff." days left, on the date ".$valueVehicle->stnk_validity_period;


                        // $reminderReceiver = ReminderReceiverRole::where('reminder', $valueReminder->id)->get();
                        
                        // $receiverRole = array();
                        // foreach($reminderReceiver as $keyReminderReceiver => $valueReminderReceiver){
                        //     array_push($receiverRole,$valueReminderReceiver->role);
                        // }
                        // $receiverRole = array_unique($receiverRole);

                        // foreach($receiverRole as $keyReceiverRole => $valueReceiverRole){

                            $reminderUser = User::get();
                            $receiverUser = array();
                            foreach($reminderUser as $keyReminderUser => $valueReminderUser){
                                $idUser = $valueReminderUser->id;
                                $to = $valueReminderUser->phone;

                                if($to[0]=="0"){

                                    $to="+62".substr($to, 1);
                                }
                                array_push($receiverUser,['idUser'=> $idUser, 'phone'=>$to]);
                            }

                            $receiverUser = array_map("unserialize", array_unique(array_map("serialize", $receiverUser)));

                            // $receiverUser = array_unique($receiverUser);
                            
                            $this->sendSms($receiverUser, $message, $valueVehicle->id, "stnk");
                        // }
                    }
                }
            }
        }
    }

    private function sendSms( $receiver , $message, $vehicle, $type){
        
        
        // Your Account SID and Auth Token from twilio.com/console
 
        $sid    = env( 'TWILIO_SID' );
        $token  = env( 'TWILIO_TOKEN' );
        $client = new Client( $sid, $token );
 
        $numbers_in_arrays = $receiver;
        $count = 0;

        foreach( $numbers_in_arrays as $key => $value )
        {
            $status = null;
            $count++;
            try{
                    $client->messages->create(
                        $value['phone'],
                        [
                            'from' => env( 'TWILIO_FROM' ),
                            'body' => $message,
                        ]
                    );

                    $status = true;
            }catch(\Exception $e){
                    $status = false;
            }

            if($status){
                echo "========SUCCESS========<br>".PHP_EOL;
                echo $message." - ".$value['phone']."<br>".PHP_EOL;
                ReminderHistory::insert(
                    ['user' => $value['idUser'], 'phone' => $value['phone'], 'vehicle'=>$vehicle, 'message'=>$message, 'type'=>$type]
                );
            }else{
                echo "=========FAILED=========<br>".PHP_EOL;
                echo $message." - ".$value['phone']."<br>".PHP_EOL;
                echo $e->getCode() . ' : ' . $e->getMessage()."<br><br>".PHP_EOL,PHP_EOL;
            }
            
        }              
    }

    public function smsManual(SmsManualRequest $request){
        // $this->middleware('auth');
        $sid    = env( 'TWILIO_SID' );
        $token  = env( 'TWILIO_TOKEN' );
        $client = new Client( $sid, $token );

        $data = $request->validated();
        $receiver = str_replace(" ", "", $data['receiver']);
        $receiver = explode(",", $receiver);
        $message = $data['message'];

        foreach( $receiver as $key => $phone )
        {
            if($phone[0]=="0"){
                $phone="+62".substr($phone, 1);
            }

            $client->messages->create(
                $phone,
                [
                    'from' => env( 'TWILIO_FROM' ),
                    'body' => $message,
                ]
            );

            SmsHistory::insert(
                ['phone' => $phone, 'message'=>$message]
            );
        }
        return redirect('sms');
    }
    
    public function index(){
        // $this->middleware('auth');
        return view('sms', ['page'=>'SMS']);
    }

}