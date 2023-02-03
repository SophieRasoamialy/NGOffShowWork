<?php

namespace App\Jobs;

use App\Models\CDO;
use App\Models\DateAbonnement;
use App\Models\Developpeur;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class expirationAbonnement implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $date_abonnement = DateAbonnement::where('created_at',Carbon::now()->setTimezone('Turkey'))->get();
        foreach ($date_abonnement as $row)
        {
            if(Developpeur::where('user_id',$row->user_id)->exists())
            {
                Developpeur::where('user_id',$row->user_id)->update([
                    'premium' => 0,
                    'developpeurs_isvalide' => 0
                ]);

            }
            if(CDO::where('user_id',$row->user_id)->exists())
            {
                CDO::where('user_id',$row->user_id)->update([
                    'cdo_premium' => 0,
                    'cdo_isvalide' => 0
                ]);
                $user_destination = User::find($row->user_id);
                $message = "Votre abonnement est expiré.\n Veuillez reabonner pour pouvoir beneficier notre service.";
            }
        }
        
    }
}
