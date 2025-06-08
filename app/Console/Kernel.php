<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Models\Reminder;
use App\Models\Vehicle;
use App\Models\VehicleAreaCode;
use App\Models\ReminderReceiverRole;
use App\Models\User;
use App\Models\ReminderHistory;
use App\Models\SmsHistory;

use Twilio\Rest\Client;
use Validator;

use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->everyMinute();

        $schedule->call(function () {
            $this->tax();
            $this->stnk();
        })->daily()
        ->runInBackground()
        ->appendOutputTo(storage_path('logs/reminder.log'));
    }

    private function stnk(){
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

    private function tax(){
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
                echo "========SUCCESS========".PHP_EOL;
                echo $message." - ".$value['phone'],PHP_EOL,PHP_EOL;
                ReminderHistory::insert(
                    ['user' => $value['idUser'], 'phone' => $value['phone'], 'vehicle'=>$vehicle, 'message'=>$message, 'type'=>$type]
                );
            }else{
                echo "=========FAILED=========".PHP_EOL;
                echo $message." - ".$value['phone'],PHP_EOL;
                echo $e->getCode() . ' : ' . $e->getMessage(),PHP_EOL,PHP_EOL;
            }
            
        }              
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}