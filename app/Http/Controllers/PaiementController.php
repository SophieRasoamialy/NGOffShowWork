<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DemandePartenariat;
use App\Http\Livewire\Parametre\Parametre;
use App\Models\parametre as ModelsParametre;
use App\Notifications\demandePartenariat as NotificationsDemandePartenariat;
use App\Models\User;
class PaiementController extends Controller
{
    
    function formulaire() {

        $montant = $_GET['montant'];
        $ispremium = $_GET['val'];
        $type = $_GET['type'];
        

           //alert
            return back();
        
        return view ('PaiementPartenaire.formulairePaiement')->with('montant',$montant);
      }

      public function payStripe(Request $request)
      {
        $montant = $request->input('montant');
        $dollar = 4360.49 ;
        $amount = ((int)$montant / $dollar) * 100;
        // Set your secret key. Remember to switch to your live secret key in production.
        // See your keys here: https://dashboard.stripe.com/apikeys
         \Stripe\Stripe::setApiKey("sk_test_51M1jzYIi0lAgxCcgTLmpJurrF5KECTytbbidiueeFMx93Kz2ZOwJr3ZI3NgE4hbjzgagSiL8JgWX1yhuOziBLAbR00PFvaxVHj");
        // Token is created using Stripe Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $request->input('stripeToken');

        $charge = \Stripe\Charge::create([
        'amount' => round($amount),
        'currency' => 'usd',
        'description' => 'frais de demande de partenariat',
        'source' => $token,
        ]);
          /*$this->validate($request, [
              'card_no' => 'required',
              'expiry_month' => 'required',
              'expiry_year' => 'required',
              'cvv' => 'required',
          ]);
   
          $stripe = \Stripe\Stripe::setApiKey(config('stripe.secret_key'));
          try {
              $response = \Stripe\Token::create(array(
                  "card" => array(
                      "number"    => $request->input('card_no'),
                      "exp_month" => $request->input('expiry_month'),
                      "exp_year"  => $request->input('expiry_year'),
                      "cvc"       => $request->input('cvv')
                  )));
              if (!isset($response['id'])) {
                  return redirect()->route('addmoney.paymentstripe');
              }
              $charge = \Stripe\Charge::create([
                  'card' => $request->input('payment_method'),//$response['id'], 
                  'currency' => 'usd',
                  'amount' =>  $this->amount,
                  'description' => 'wallet',
              ]);*/
   
              if($charge['status'] == 'succeeded') {

                DemandePartenariat::create([
                    'user_id'=>Auth::user()->id
                ]);

                //notification de l'admin
                $user_name = Auth::user()->name;

                $user_destination = User::join('role_users','role_users.user_id','=','users.id')->where('role_users.role_id',1)->get();
                foreach($user_destination as $row)
                {
                    User::find($row->id)->notify(new NotificationsDemandePartenariat($user_name));
                }
                return redirect('/paimentSucces');
            
   
              } else {
                  return redirect('PaiementPartenaire.formulairePaiement')->with('error', 'something went to wrong.');
              }
   
          /*}
          catch (Exception $e) {
              return $e->getMessage();
          }*/
   
      }

    
}

