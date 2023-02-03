@extends('layouts.developpeur_layout')
@section('content')
<div>
<div class="max-w-sm  border  rounded-lg shadow-md bg-gray-800 border-gray-700">
    <a href="#">
        <img class="rounded-t-lg" src="/docs/images/blog/image-1.jpg" alt="" />
    </a>
    <div class="p-5">
        <p>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-white">Entrer votre établissement d'origine</h5>
        </p>
        <div class="mb-6">
            <input type="text" wire:model = "etablissement"  placeholder="ex. ENI"
            class=" border  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
        </div>
        
       <div class="text-center">
        <button wire:click = "participer2" type="button" 
        class="text-white bg-red-800 focus:ring-4 focus:outline-none ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
            Participer
        </button>
        <button  wire:click = "annulerParticipation" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
            Annuler
        </button>
    </div>
       </div>
    </div>
</div>
<script>
    window.addEventListener('nonpremium', event => {
            Swal.fire({
            title: '<strong>Ce projet est reservé aux developpeurs premiums</strong>',
            icon: 'info',
            html:
                'You can use <b>bold text</b> and other HTML tags',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText:
            '<a href = "/validation"> Devenir premium</a>'            
            });
        });
</script>
</div>
@endsection