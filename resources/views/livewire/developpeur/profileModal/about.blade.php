{{--MODAL MODIFIER ABOUT--}}
  
  <!-- Main modal -->
  <div id="staticModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" wire:ignore.self class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
    <div class="relative w-full h-full max-w-2xl md:h-auto">
        <!-- Modal content -->
        <div class="relative  rounded-lg shadow bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-white">
                    About
                </h3>
                <button type="button"  wire:click= "annulerAbout" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="staticModal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                </button>
            </div>
            <!-- Modal body -->
          <form>

            <div class="p-6 space-y-6">
              
                  <div class="grid gap-6 mb-6 md:grid-cols-2">
                      <div>
                          <label for="firstname" class="block mb-2 text-sm font-medium text-white">First name</label>
                          <input type="text" id="firstname" wire:model = 'firstname' class=" border  text-sm rounded-lg   block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" required>
                          @error('firstname') <span class="text-red-500">{{$message}}</span>@enderror
                      </div>
                      <div>
                          <label for="lastname" class="block mb-2 text-sm font-medium text-white">Last name</label>
                          <input type="text" id="lastname" wire:model = "lastname" class="border  text-sm rounded-lg   block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" required>
                          @error('lastname') <span class="text-red-500">{{$message}}</span>@enderror
                      </div>
                      <div>
                          <label for="username" class="block mb-2 text-sm font-medium text-white">Nom d'utilisateur</label>
                          <input type="text" id="username" wire:model = "username" class="border  text-sm rounded-lg   block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"  required>
                          @error('username') <span class="text-red-500">{{$message}}</span>@enderror
                      </div>  
                      <div>
                          <label for="a_propos" class="bblock mb-2 text-sm font-medium text-white">A propos</label>
                          <input type="text" id="a_propos" wire:model="a_propos" class="border  text-sm rounded-lg   block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"   required>
                          @error('a_propos') <span class="text-red-500">{{$message}}</span>@enderror
                      </div>
                      <div>
                          <label for="contact" class="block mb-2 text-sm font-medium text-white">Numéro Téléphone</label>
                          <input type="tel" id="contact" wire:model="contact" class="border  text-sm rounded-lg   block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}-[0-9]{2}" required>
                          @error('contact') <span class="text-red-500">{{$message}}</span>@enderror
                      </div>
                      <div>
                          <label for="email" class="block mb-2 text-sm font-medium text-white">Email</label>
                          <input type="email" id="email" wire:model = "email" class="border  text-sm rounded-lg   block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" placeholder="" required>
                          @error('email') <span class="text-red-500">{{$message}}</span>@enderror
                      </div>
                  </div>
            </div>
          
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-toggle="staticModal" wire:click = "enregistrerAbout"  type="button" class="text-white  focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">
                  Mettre à jour
                  </button>
                <button data-modal-toggle="staticModal"  type="reset"  wire:click = "annulerAbout" class="  focus:ring-4 focus:outline-none  rounded-lg border  text-sm font-medium px-5 py-2.5  focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">
                  Annuler
              </button>
            </div>
          </form>
        </div>
    </div>
</div>