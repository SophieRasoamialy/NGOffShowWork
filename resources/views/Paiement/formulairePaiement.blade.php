@extends('layouts.participant_layout')
@section('content')
    
<div class="min-w-screen min-h-screen  flex items-center justify-center px-5   pb-10 ">
    <div class="w-full mx-auto rounded-lg bg-gray-200  p-5 text-gray-700" style="max-width: 600px">
        <div class="w-full pt-1 pb-5">
            <div class="bg-indigo-500 text-white overflow-hidden rounded-full w-20 h-20 -mt-16 mx-auto shadow-lg flex justify-center items-center">
                <i class='bx bxs-credit-card text-3xl'></i>
            </div>
        </div>
        <div class="mb-8">
            <h1 class="text-center font-bold text-xl uppercase">Abonnement de {{$montant}} Ar</h1>
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
 
    @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif
        <!-- Used to display Element errors. -->
        <div id="card-errors" role="alert"></div>

        <form  action="{{url('payment')}}"  data-cc-on-file="false" data-stripe-publishable-key="{{ config('stripe.publishable_key') }}"  id="form-stripe" method="post">
            {{ csrf_field() }}
            <div class="mb-3">
                <label class="font-bold text-sm mb-2 ml-1">Nom de la carte</label>
                <div>
                    <input name="card_name" class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors"  type="text"/>
                </div>
            </div>
            <input type="hidden" name="montant" value="{{$montant}}">
            <input id="payment_method" name="payment_method" type="hidden">
            <div class="mb-3">
                <label class="font-bold text-sm mb-2 ml-1">Numéro de la carte</label>
                <div id="card-element"></div>
            </div>

            <div>
                <button id = "bouton_payer"   class=" flex items-center justify-center p-0.5 mb-2 block  mx-auto overflow-hidden text-sm font-medium  rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white text-white focus:ring-4 focus:outline-none focus:ring-blue-800" >
                    <span class=" px-5 py-2.5 transition-all ease-in duration-75  bg-gray-900 rounded-md group-hover:bg-opacity-0">
                        <i class='bx bx-lock-alt'></i> S'ABONNER
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>
<script src="https://js.stripe.com/v3/"></script>

<script>
    
    
    const stripe = Stripe(" pk_test_51M1jzYIi0lAgxCcgEORj5dR2ztoDArGgLmdEmd0kgwgYTKkcVTLKFfeaT0cqRAlmLq5baSTF8XPVzSSh6CbNFJIQ00nzqUcRFi");
 
    const elements = stripe.elements();

    const cardElement = elements.create('card',{
        classes: {
            base:'StripeElement bg-white rounded-md p-3 my-2'
        }
    });
    cardElement.mount('#card-element');

    var form =   document.getElementById('form-stripe');
    const bouton_payer  = document.getElementById('bouton_payer');

    form.addEventListener('submit',async(e) => {
        e.preventDefault();
        const {token, error} = await stripe.createToken(cardElement);
        //const {paymentMethod, error } = await stripe.createPayementMethod('card',cardElement);
        if(error)
        {
            const errorElement = document.getElementById('card-errors');
            errorElement.textContent = error.message;

        }
        else
        {
            stripeTokenHandler(token);

            //document.getElementByid('payment_method').value = paymentMethod.id;
        }

       // document.getElementByid('form-stripe').submit();
    });

    const stripeTokenHandler = (token) => {
  // Insert the token ID into the form so it gets submitted to the server
  const hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);
  // Submit the form
  form.submit();
}

 
</script>


<script>
/*    var card = document.getElementById('card_no');
    card.maxLength = 16;

    var cvv = document.getElementById('cvv');


    var annee = document.getElementById('expiry_year');
    annee.maxLength = 4;

    function verifierCard(event)
    {
       var keyCode = event.which ? event.which : event.keyCode;
        var touche = String.fromCharCode(keyCode);
                
                
        var caracteres = '0123456789';
                
        if(caracteres.indexOf(touche) >= 0) {
            card.value += touche;
        }
    }

    function verifierCvv(event)
    {
        var keyCode = event.which ? event.which : event.keyCode;
        var touche = String.fromCharCode(keyCode);
                
                    cvv.maxLength = 3;
        var caracteres = '0123456789';
                
        if(caracteres.indexOf(touche) >= 0) {
            cvv.value += touche;
        }
    }

    function verifierAnnee(event) 
    {
        var keyCode = event.which ? event.which : event.keyCode;
        var touche = String.fromCharCode(keyCode);
                
                
        var caracteres = '0123456789';
                
        if(caracteres.indexOf(touche) >= 0) {
            annee.value += touche;
        }
    }


    var date_now=new Date();
    var annee_now = date_now.getFullYear();
    var entier_annee = annee.parseInt();
    entier_annee.maxValue = annee_now;
    
  
*/

</script>
@endsection 
