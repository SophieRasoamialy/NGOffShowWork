<div class=" mt-5 mx-3 p-4 bg-gray-100 shadow-md">

    <script src="https://cdn.tiny.cloud/1/pfj5wp555kxmoyt0yyzrbzpurbg1dhoal3nlf0itoy9at9k1/tinymce/6/tinymce.min.js" referrerpolicy="origin" ></script>
    <script>
         
       
        tinymce.init({
          selector: "#projet_description",
          plugins: " autoresize link lists emoticons table menubar",
          toolbar: " bold italic strikethrough link numlist bullist blockquote emoticons table",
          toolbar_location: "top",
          autoresize_bottom_margin: 0,
          max_height: 1000,
          placeholder: "Entrer le texte . . .",

          menubar:true,
          statusbar:false,
          forced_root_block: false,
            setup: function (editor) {
                editor.on('init change', function () {
                    editor.save();
                });
                editor.on('change', function (e) {
                    @this.set('projet_description', editor.getContent());
                });
            }
        });

       
      </script>
    <div >
        <h4 class="text-center font-bold text-xl uppercase m-3">Projet<br>
    </h4>
    </div> 
    <form >

    <div class="flex">
        <div class="flex-1 mr-4">
            <div class=" form-row mb-3">
                    <div class=" form-group  justify-content-center ">
                        <label class="text-blue-700 text-base" for="categorie_id "> Categorie</label>
                        <select  class="bg-gray-50 border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " id = "categorieId" wire:model = "categorieId">
                            <option selected value="">Choisir categorie</option>
                            @foreach($categorie as $categorie)
                                <option value= {{$categorie->categorie_id}} >{{$categorie->categorie_label}}</option>
                            @endforeach
                        </select>
                        @error('categorieId') <span class="text-danger">{{$message}}</span>@enderror
                    </div>
            </div> 
        
            <div class="form-row mb-3">
                    <label class="text-blue-700 text-base" for="projet_titre"> Titre</label>
                    <input type="text" class="bg-gray-50 border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " id  = "projet_titre" name = "projet_titre" wire:model.defer = "data.projet_titre" >
                    @error('projet_titre') <span class="text-danger">{{$message}}</span>@enderror
                    @if($cdo_premium == 1 || App\Models\Admin::where('user_id', Illuminate\Support\Facades\Auth::user()->id)->exists())
                    <div class="flex items-center my-2">
                        <input type="checkbox" wire:model = "projet_premium" class="  w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 focus:ring-2">
                        <label class="ml-2 text-sm font-medium  text-gray-700" style="color: #f59e0b">Premium</label>
                    </div>
                    @endif
                </div>
            
        </div>
        <div class="flex-1">
            <div class=" form-group mb-3">
                <label class="text-blue-700 text-base" for="projet_duree">Duree du projet  @if(!is_null($categorieId) || $categorieId != "" || !is_null($projet_premium))<span class="text-sm text-gray-500">(doit être supérieur à {{$duree_min}})</span>@endif</label>
                <input type="number" class=" bg-gray-50 border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " id  = "projet_duree" name = "projet_duree" wire:model.defer = "data.projet_duree"  >
                @error('projet_duree') <span class="text-danger">{{$message}}</span>@enderror
            </div>
            <div class=" form-group mb-3">
                <label class="text-blue-700 text-base" for="projet_budget">Budget pour le  projet @if(!is_null($categorieId) || $categorieId != "" || !is_null($projet_premium))<span class="text-sm text-gray-500"> (doit être supérieur à {{$budget_min}})@endif </label>
                <input type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " id  = "projet_budget" name = "projet_budget" wire:model.defer = "data.projet_budget"  >
                @error('projet_budget') <span class="text-danger">{{$message}}</span>@enderror
            </div>
            
        </div>

    </div>
    <div class="form-row">
        <label class="text-blue-700 text-base" for="projet_description"> Description (n'utiliser pas la couleur gris pour les titres, utiliser des couleurs clairs)</label>
        <div wire:ignore>
        <textarea  id="projet_description"    name = "projet_description" wire:model.defer = "projet_description" cols="30" rows="10" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 ">
        </textarea>
    </div>
        @error('projet_description') <span class="text-danger">{{$message}}</span>@enderror
    </div>
    <div class="my-3">
        <button type="reset" wire:click = "cancel" class="text-gray-900 hover:text-white border-2 border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2  " >
            Annuler</button>
        @if($updateMode)
            <button type="submit" wire:click.prevent="update" class="text-green-700 hover:text-white border-2 border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                Mettre à jour</button>
        @else
        <button type="submit"  wire:click.prevent = "store" class="text-green-700 hover:text-white border-2 border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 ">
            Enregistrer</button>
        @endif
    </div>
    </form>

    <script>

        window.addEventListener('hide_modal_form', event => {
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            });

        Toast.fire({
          icon: 'success',
          title: event.detail.title
          });

          setTimeout(() => {
            window.location.href = "/liste_projet";
          }, 3000);
      });

      
</script>

</div>
