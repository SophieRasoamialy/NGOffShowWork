
    
<div>
    <style>
        /**
 * 1. The `reverse` animation direction plays the animation backwards
 *    which makes it start at the stroke offset 100 which means displaying
 *    no stroke at all and animating it to the value defined in the SVG
 *    via the inline `stroke-dashoffset` attribute.
 * 2. Rotate by -90 degree to make the starting point of the
 *    stroke the top of the circle.
 * 3. Using CSS transforms on SVG elements is not supported by Internet Explorer
 *    and Edge, use the transform attribute directly on the SVG element as a
 * .  workaround (https://markus.oberlehner.net/blog/pure-css-animated-svg-circle-chart/#part-4-internet-explorer-strikes-back).
 */
.circle-chart__circle {
  animation: circle-chart-fill 2s reverse; /* 1 */ 
  transform: rotate(-90deg); /* 2, 3 */
  transform-origin: center; /* 4 */
}

/**
 * 1. Rotate by -90 degree to make the starting point of the
 *    stroke the top of the circle.
 * 2. Scaling mirrors the circle to make the stroke move right
 *    to mark a positive chart value.
 * 3. Using CSS transforms on SVG elements is not supported by Internet Explorer
 *    and Edge, use the transform attribute directly on the SVG element as a
 * .  workaround (https://markus.oberlehner.net/blog/pure-css-animated-svg-circle-chart/#part-4-internet-explorer-strikes-back).
 */
.circle-chart__circle--negative {
  transform: rotate(-90deg) scale(1,-1); /* 1, 2, 3 */
}

.circle-chart__info {
  animation: circle-chart-appear 2s forwards;
  opacity: 0;
  transform: translateY(0.3em);
}

@keyframes circle-chart-fill {
  to { stroke-dasharray: 0 100; }
}

@keyframes circle-chart-appear {
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Layout styles only, not needed for functionality */
html {
  font-family: sans-serif;
  padding-right: 1em;
  padding-left: 1em;
}

.grid {
  display: grid;
  grid-column-gap: 1em;
  grid-row-gap: 1em;
  grid-template-columns: repeat(1, 1fr);
}

@media (min-width: 31em) {
  .grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

    </style>
  <div class="flex">
    <div class="mb-2">
      @can('admin')
        <div class="bg-white shadow-lg shadow-gray-200 my-3   h-auto rounded-2xl p-4 ">
            <div class="flex items-center">
            <div class="inline-flex flex-shrink-0 justify-center items-center w-20 h-20 text-white bg-gradient-to-br from-pink-500 to-voilet-500 rounded-lg shadow-md shadow-gray-300">
              <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
              <lottie-player src="https://assets9.lottiefiles.com/packages/lf20_dfvvegpe.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"    autoplay></lottie-player>
              
            </div>
            <div class="flex-shrink-0 ml-3">
            <span class="text-2xl font-bold leading-none text-gray-900">{{$nombre_participant}}</span>
            <h3 class="text-base font-normal text-gray-500">Développeurs</h3>
            </div>
            <div class="flex flex-1 justify-end items-center ml-5 w-0 text-base font-bold text-green-500">
            + {{$participant_today}}
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
              </svg>
            </div>
            </div>
        </div>
        @endcan
        @can('admin')
        <div class="bg-white shadow-lg  shadow-gray-200  my-3 h-auto rounded-2xl p-4 ">
            <div class="flex items-center">
            <div class="inline-flex flex-shrink-0 justify-center items-center w-20 h-20 text-white bg-gradient-to-br from-pink-500 to-voilet-500 rounded-lg shadow-md shadow-gray-300">
              <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
              <lottie-player src="https://assets10.lottiefiles.com/private_files/lf30_o27y0rhb.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop  autoplay></lottie-player>
            </div>
            <div class="flex-shrink-0 ml-3">
            <span class="text-2xl font-bold leading-none text-gray-900">{{$nombre_partenaire}}</span>
            <h3 class="text-base font-normal text-gray-500">Clients</h3>
            </div>
            <div class="flex flex-1 justify-end items-center ml-5 w-0 text-base font-bold text-green-500">
            + {{$partenaire_today}}
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
              </svg>
            </div>
            </div>
        </div>
            
        @elsecan('cdo')

        <div class="bg-white shadow-lg my-3   shadow-gray-200 h-auto rounded-2xl p-4 ">
          <div class="flex items-center">
          <div class="inline-flex flex-shrink-0 justify-center items-center w-20 h-20 text-white bg-gradient-to-br from-pink-500 to-voilet-500 rounded-lg shadow-md shadow-gray-300">
            <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
            <lottie-player src="https://assets3.lottiefiles.com/private_files/lf30_xwaijjvp.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop  autoplay></lottie-player>
          </div>
          <div class="flex-shrink-0 ml-3">
          <span class="text-xl font-bold leading-none text-gray-900">{{$cout}} Ar</span>
          <h3 class="text-base font-normal text-gray-500">Coût</h3>
          </div>
          {{--<div class="flex flex-1 justify-end items-center ml-5 w-0 text-base font-bold text-green-500">
          + {{$projet_today}}
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
            </svg>
          </div>--}}
          </div>
      </div>
      @endcan

        <div class="bg-white shadow-lg shadow-gray-200  my-3 h-auto rounded-2xl p-4 ">
            <div class="flex items-center">
            <div class="inline-flex flex-shrink-0 justify-center items-center w-20 h-20 text-white bg-gradient-to-br from-pink-500 to-voilet-500 rounded-lg shadow-md shadow-gray-300">
              <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
              <lottie-player src="https://assets8.lottiefiles.com/private_files/lf30_zdkoi7jh.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"    autoplay></lottie-player>
            </div>
            <div class="flex-shrink-0 ml-3">
            <span class="text-xl font-bold leading-none text-gray-900">{{$nombre_projet}}</span>
            <h3 class="text-base font-normal text-sm text-gray-500">Projets uploadés </h3>
           
            <span class="text-xl font-bold leading-none text-gray-900">{{$projet_encours}}</span>
            <h3 class="text-base font-normal text-sm text-gray-500">Projets en cours </h3> 
            
          </div>
          @can('admin')
            <div class="flex flex-1 justify-end items-center ml-5 w-0 text-base font-bold text-green-500">
            + {{$projet_today}}
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
            </svg>
            </div>
          @endcan
            </div>
            
        </div>
    </div>
        <div>
        <div class="flex   mt-3">
          <div>
            <div class="rounded overflow-hidden shadow   bg-white mx-3 pt-2">
                <div class="px-3 py-2 border-b border-light-grey ">
                    <div class=" text-lg font-semibold text-gray-500 text-center">Taux de participation </div>
                </div>
                <div class="">
                    <div class=" bg-white mx-auto my-3 px-5">
                        <svg class="circle-chart" viewbox="0 0 33.83098862 33.83098862" width="200" height="200" xmlns="http://www.w3.org/2000/svg">
                            <circle class="circle-chart__background" stroke="#efefef" stroke-width="2" fill="none" cx="16.91549431" cy="16.91549431" r="15.91549431" />
                            <circle class="circle-chart__circle" stroke="#00acc1" stroke-width="2" stroke-dasharray="{{$taux_participation}},100" stroke-linecap="round" fill="none" cx="16.91549431" cy="16.91549431" r="15.91549431" />
                            <g class="circle-chart__info">
                              <text class="circle-chart__percent " x="16.91549431" y="15.5" alignment-baseline="central" text-anchor="middle" font-size="8">{{$taux_participation}}%</text>
                            </g>
                          </svg>
                        </div>
                    </div>
                </div>
              </div>
                <div>
                <div class="rounded  overflow-hidden h-auto shadow bg-white mx-3 pt-2 ">
                    <div class="px-3 py-2 border-b border-light-grey ">
                        <div class=" text-lg font-semibold text-gray-500 text-center">Taux de dépot de projet</div>
                    </div>
                    <div class="">
                        <div class=" mx-auto my-3 px-5">
                            <svg class="circle-chart" viewbox="0 0 33.83098862 33.83098862" width="200" height="200" xmlns="http://www.w3.org/2000/svg">
                                <circle class="circle-chart__background" stroke="#efefef" stroke-width="2" fill="none" cx="16.91549431" cy="16.91549431" r="15.91549431" />
                                <circle class="circle-chart__circle" stroke="#00acc1" stroke-width="2" stroke-dasharray="{{$taux_depot_projet}},100" stroke-linecap="round" fill="none" cx="16.91549431" cy="16.91549431" r="15.91549431" />
                                <g class="circle-chart__info">
                                  <text class="circle-chart__percent" x="16.91549431" y="15.5" alignment-baseline="central" text-anchor="middle" font-size="8">{{$taux_depot_projet}}%</text>
                                </g>
                              </svg>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
              @can('admin')
              <div class="m-3">
                <div class="mb-1 text-base font-medium text-blue-700 dark:text-blue-500">Client basique</div>
                <div class="w-full bg-gray-200 rounded-full   dark:bg-gray-700">
                  <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full" style="width: {{$taux_cdo_basic}}%">
                    {{$taux_cdo_basic}}%
                  </div>
                </div>

                <div class="mb-1 text-base font-medium text-green-700 dark:text-green-500">Client premium</div>
                <div class="w-full bg-gray-200 rounded-full   dark:bg-gray-700">
                  <div class="bg-green-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full" style="width: {{$taux_cdo_premium}}%"> {{$taux_cdo_premium}}%</div>
                </div>
              </div>
              <div class="m-3">
                <div class="mb-1 text-base font-medium text-blue-700 dark:text-blue-500">Développeur basique</div>
                <div class="w-full bg-gray-200 rounded-full   dark:bg-gray-700">
                  <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full" style="width: {{$taux_dev_basic}}%">
                    {{$taux_dev_basic}}%
                  </div>
                </div>

                <div class="mb-1 text-base font-medium text-green-700 dark:text-green-500">Développeur premium</div>
                <div class="w-full bg-gray-200 rounded-full   dark:bg-gray-700">
                  <div class="bg-green-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full" style="width: {{$taux_dev_premium}}%"> {{$taux_dev_premium}}%</div>
                </div>
              </div>
              @endcan
          </div>
      </div>
      <div class="row-span-2 col-span-2 p-3 mr-5 my-3 bg-gray-100 shadow-md ">

        <div class="overflow-x-auto relative">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs  uppercase bg-gray-50 text-gray-700">
                    <tr>
                        <th scope="col" class="py-3 px-6">
                            Categories
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Nombre de projet
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Nombre de participants
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categorie as $row)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$row->categorie_label}}
                        </th>
                        <td class="py-4 px-6">
                            {{$row->nbre_projet}}
                        </td>
                        <td class="py-4 px-6">
                          @php
                              $count_participation = App\Models\Categorie::join('projets','projets.categorie_id','=','categories.categorie_id')
                                                        ->join('participations','participations.projet_id','projets.projet_id')
                                                        ->groupBy('participations.projet_id')
                                                        ->count('participations.projet_id');
                          @endphp
                          @if (is_null($count_participation))
                              0
                          @else
                              {{$count_participation}}
                          @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
        
</div>
