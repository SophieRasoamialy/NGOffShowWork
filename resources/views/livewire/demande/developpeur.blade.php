<div>
	@php
		if(App\Models\Developpeur::where('user_id', Auth::user()->id)->exists())
        {
            return redirect()->to('/projets');
        }
		if(App\Models\CDO::where('user_id', Auth::user()->id)->exists() )
		{
			return redirect()->to('/liste_projet');
		}
	@endphp
<body class="antialiased sans-serif bg-gray-200 mx-20" >

    <h2 class="text-center uppercase font-bold mt-3">Compléter votre profile</h2>
	
		@if(!empty($successMessage))
		<div class="alert alert-success">
		{{ $successMessage }}
		</div>
		@endif
		<div class="stepwizard">
			<div class="stepwizard-row setup-panel">
					@php
								$step = ($currentStep/5)*100;
							@endphp
					<div class="mb-1 text-base mt-3 font-medium text-green-700 dark:text-green-500">{{$step}}%</div>
						<div class="w-full bg-gray-500 rounded-full h-2.5 mb-4 dark:bg-gray-700">
							
						<div class="bg-green-600 h-2.5 rounded-full dark:bg-green-500" style="width: {{$step}}%"></div>
					</div>

				
			</div>
		</div>
		<div >	

				<!-- Step Content -->
				<div class="py-10">	


					<!--PROFILE-->
					<div class=" setup-content {{ $currentStep != 1 ? 'displayNone' : '' }}" id="step-1">
						<div class="border-b-2 py-4">
						<div class="flex flex-col md:flex-row md:items-center md:justify-between">
							<div class="flex-1">
								<div class="text-lg font-bold text-gray-700 leading-tight">Votre Profile</div>
							</div>
						</div>
						</div>
						<div class="mb-5 text-center">
							<div class="mx-auto w-32 h-32 mb-2 border rounded-full relative bg-gray-100 mb-4 shadow-inset">
								@if ($profile_photo)
								<img src="{{ $profile_photo->temporaryUrl() }}"  alt="" class="object-cover w-full h-32 rounded-full"  >
								@endif
							</div>
							
							<label 
								for="fileInput"
								type="button"
								class="cursor-pointer inine-flex justify-between items-center focus:outline-none border py-2 px-4 rounded-lg shadow-sm text-left text-gray-600 bg-white hover:bg-gray-100 font-medium"
							>
								<svg xmlns="http://www.w3.org/2000/svg" class="inline-flex flex-shrink-0 w-6 h-6 -mt-1 mr-1" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
									<rect x="0" y="0" width="24" height="24" stroke="none"></rect>
									<path d="M5 7h1a2 2 0 0 0 2 -2a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1a2 2 0 0 0 2 2h1a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2" />
									<circle cx="12" cy="13" r="3" />
								</svg>						
								Browse Photo
							</label>
							@error('profile_photo')
							<span class="text-red-500" style="font-size: 11.5px;">{{ $message }}</span>
							@enderror
			
							<div class="mx-auto w-48 text-gray-500 text-xs text-center mt-1">Click to add profile picture</div>

							<input name="photo" id="fileInput" wire:model = "profile_photo"  class="hidden" type="file"  
								>
						</div>

						<div class="mb-5">
							<label for="profile_nom" class="font-bold mb-1 text-gray-700 block ">Nom</label>
							<input type="text" wire:model = "profile_nom"
								class="w-full px-4 py-3  rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"
								placeholder="Entrer votre nom..." >
								@error('profile_nom') <span class="text-red-500">{{$message}}</span>@enderror

						</div>

						<div class="mb-5">
							<label for="profile_prenom" class="font-bold mb-1 text-gray-700 block">Prenom</label>
							<input type="text" wire:model = "profile_prenom"
								class="w-full px-4 py-3 rounded-lg 	shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"
								placeholder="Entrer votre prenom...">
								@error('profile_prenom') <span class="text-red-500">{{$message}}</span>@enderror

						</div>
						<div class="mb-20">
							<label for="profile_contact" class="font-bold mb-1 text-gray-700 block">Numéro de téléphone</label>
							<input type="tel" wire:model = "profile_contact" pattern="[0-9]{3} [0-9]{2} [0-9]{3} [0-9]{2}"
								class="w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"
								required>
								@error('profile_contact') <span class="text-red-500">{{$message}}</span>@enderror

								<span class="validity"></span>
						</div>
						<div class="fixed bottom-0 left-0 right-0 py-5 bg-white shadow-md" >
							<div class="max-w-3xl mx-auto px-4">
								<div class="flex justify-between">
									
				
									<div class="w-1/2 text-right">
										<button
										wire:click="firstStepSubmit"
											class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium" 
										>Suivant</button>
				
									</div>
								</div>
							</div>
						</div>
					</div>



					<!--À PROPOS-->
					<div class="row setup-content {{ $currentStep != 2 ? 'displayNone' : '' }}" id="step-2"  >

						<div class="border-b-2 py-4">
							<div class="flex flex-col md:flex-row md:items-center md:justify-between">
								<div class="flex-1">
									<div class="text-lg font-bold text-gray-700 leading-tight">Décrivez-vous									
								</div>
							</div>
							</div>
						</div>

					
						<div class="mb-5">
							<label for="a_propos" class="font-bold mb-1 text-gray-700 block">Qui êtes-vous? </label>
							<input wire:model="a_propos" class=" w-full px-4 capitalize py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium" placeholder="ex:Developpeur Backend"
							>
							@error('a_propos') <span class="text-red-500">{{$message}}</span>@enderror

						</div>

						<div class="mb-5">
							<label for="developpeur_etablissement" class="font-bold mb-1 text-gray-700 block">Quel est votre établissement d'origine </label>
							<input wire:model="developpeur_etablissement" class=" w-full px-4 capitalize py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium" placeholder="ex:ENI"
							>
							@error('developpeur_etablissement') <span class="text-red-500">{{$message}}</span>@enderror

						</div>

						<div class="mb-5">
							<label for="competence" class="font-bold mb-1 text-gray-700 block">Selectioner votre compétence</label>

							<div class=" my-5 flex h-auto border-b border-gray-700">
								@foreach($competence_user as $row)
								<span id="badge-dismiss-default" class="inline-flex items-center py-1 px-2 mr-2 text-sm font-medium text-blue-800 bg-blue-100 rounded dark:bg-blue-200 dark:text-blue-800">
									{{$row->competence_label}}
									<button type="button" wire:click = "enleverCompetence({{$row->competence_id}})" class="inline-flex items-center p-0.5 ml-2 text-sm text-blue-400 bg-transparent rounded-sm hover:bg-blue-200 hover:text-blue-900 dark:hover:bg-blue-300 dark:hover:text-blue-900" data-dismiss-target="#badge-dismiss-default" aria-label="Remove">
										<svg aria-hidden="true" class="w-3.5 h-3.5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
										<span class="sr-only">Remove badge</span>
									</button>
								  </span>
									  
								@endforeach
							</div>
							<div class="flex mt-3">
								<div>
									<div class="  mx-2 overflow-y-auto  h-60 w-56  shadow-md sm:rounded-lg">
										<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
											<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
												<tr>
													<th scope="col" class="py-3 px-6">
														Categorie
													</th>
													
												</tr>
											</thead>
											<tbody >
												@foreach($categorie as $categorie)
							
													<tr id="{{$categorie->categorie_id}}" class=" border-b  hover:bg-gray-100 ">
							
															<th  scope="row" class="   py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
																<a href="#" onclick="showCompetence({{$categorie->categorie_id}})"   style="color: black">
																	<span class="flex">
																		<span class="flex-auto" >{{$categorie->categorie_label}}</span> <br>
																	<span class=" float-right">
																		<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
																			<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
																		</svg>
																	</span>
																	</span>
																</a>
																<input type="hidden" wire:model="categorie_id" value={{$categorie->categorie_id}}>
															</th>
													</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
								<div>
									<div class="  mx-2 overflow-y-auto 	 h-60 w-56  shadow-md sm:rounded-lg">
										<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
											<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
												<tr>
													<th scope="" class="py-3 px-6">
														@if($show_competence)
														{{$categorie_label}}
														@else
														Pas de categorie selectionée
														@endif
													</th>
													
												</tr>
											</thead>
											<tbody>
												@if($show_competence)
													@foreach($competence as $row)
								
														<tr  class=" border-b  hover:bg-gray-100 ">
								
																<th  scope="row" class="  py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
																	<a href="#" wire:click.prevent = "selectCompetence({{$row->competence_id}})"  style="color: black">
																		
																		<span class="flex">
																			<span class="flex-auto" >{{$row->competence_label}} <br></span>
																			<span class="float-right text-blue-500">
																				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
																					<path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
																				</svg>
																			</span>
																		</span>
																		  
																	</a>
																</th>
														</tr>
													@endforeach
												@endif
											</tbody>
										</table>
									</div>
								</div>
						
							</div>
						</div>
						<div class="fixed bottom-0 left-0 right-0 py-5 bg-white shadow-md" x-show="step != 'complete'">
							<div class="max-w-3xl mx-auto px-4">
								<div class="flex justify-between">
									<div class="w-1/2">
										<button
											wire:click="back(1)"
											class="w-32 focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border" 
										>Précédent</button>
									</div>
				
									<div class="w-1/2 text-right">
										<button
											wire:click="secondStepSubmit"
											class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium" 
										>Suivant</button>
				
										
									</div>
								</div>
							</div>
						</div>
					</div>


					<!--EXPERIENCE-->
					<div class="row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3"  >

						<div class="border-b-2 py-4">
							<div class="flex flex-col md:flex-row md:items-center md:justify-between">
								<div class="flex-1">
									<div class="text-lg font-bold text-gray-700 leading-tight">Dernier Experience</div>
								</div>
							</div>
						</div>
						
						<span class="text-gray-400 txt-sm mb-2">Remplir par le dernier expérience que vous avez fait. Pour les autres, vous pouvez les remplir dans votre profile après</span>

						<div class="mb-5">
							<div class="flex">
								<div class=" flex-1 mr-3">
									<label for="titre" class="font-bold mb-1  text-gray-700 block">Titre</label>
									<input type="text" wire:model = "experience.titre" id="titre"
									class="w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"
									placeholder="Entrer votre titre">
									@error('titre') <span class="text-red-500">{{$message}}</span>@enderror

								</div>

								<div class=" flex-1">
									<label for="entreprise" class="font-bold mb-1 text-gray-700 block">Entreprise</label>
									<input type="text" wire:model = "experience.entreprise_nom" id="entreprise_nom"
									class="w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"
									placeholder="Entrer le nom de l'entreprise">
									@error('entreprise_nom') <span class="text-red-500">{{$message}}</span>@enderror

								</div>

							</div>
						</div>
						<div class="mb-5 ">
							<div class="flex ">
								<div class="mr-3">
									<label for="experience_debut" class="font-bold mb-1 text-gray-700 block">Debut</label>
									<div class="flex">
										<label
											class="flex-1 justify-start items-center text-truncate rounded-lg bg-white pl-2 pr-2 py-2 shadow-sm mr-4">
											<select id="experience_debut_mois" wire:model = "experience.experience_debut_mois" class="bg-gray-50 border mr-3 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
												<option selected> Sélectionnez un mois</option>
												<option value="1">Janvier</option>
												<option value="2">Février</option>
												<option value="3">Mars</option>
												<option value="4">Avril</option>
												<option value="5">Mai</option>
												<option value="6">Juin</option>
												<option value="7">Juillet</option>
												<option value="8">Août</option>
												<option value="9">Septembre</option>
												<option value="10">Octobre</option>
												<option value="11">Novembre</option>
												<option value="12">Décembre</option>
											</select>

										</label>
										@error('experience_debut_mois') <span class="text-red-500">{{$message}}</span>@enderror


										<label
											class="flex-1 justify-start items-center text-truncate rounded-lg bg-white pl-2 pr-2 py-2 shadow-sm">
											<select id="experience_debut_annee" wire:model = "experience.experience_debut_annee" class="mr-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
												<option selected> Sélectionnez une annee</option>
												@php
													$date = date('Y');
												@endphp
												@for($annee = $date; $annee > 1960; $annee--)
												<option value="{{$annee}}">{{$annee}}</option>
												@endfor
											</select>

										</label>
										@error('experience_debut_annee') <span class="text-red-500">{{$message}}</span>@enderror

									</div>
								</div>

								@if($experience_until_now == false)
								<div class="mx-3">
									<label for="experience_debut" class="font-bold mb-1 text-gray-700 block">Fin</label>
									<div class="flex">
										<label
											class=" justify-start items-center text-truncate rounded-lg bg-white pl-2 pr-2 py-2 shadow-sm mr-4">
											<select id="experience_fin_mois" wire:model = "experience.experience_fin_mois" class="bg-gray-50 border mr-3 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
												<option selected> Sélectionnez un mois</option>
												<option value="1">Janvier</option>
												<option value="2">Février</option>
												<option value="3">Mars</option>
												<option value="4">Avril</option>
												<option value="5">Mai</option>
												<option value="6">Juin</option>
												<option value="7">Juillet</option>
												<option value="8">Août</option>
												<option value="9">Septembre</option>
												<option value="10">Octobre</option>
												<option value="11">Novembre</option>
												<option value="12">Décembre</option>
											</select>

										</label>
										@error('experience_fin_mois') <span class="text-red-500">{{$message}}</span>@enderror


										<label
											class=" justify-start items-center text-truncate rounded-lg bg-white pl-2 pr-2 py-2 shadow-sm">
											<select id="experience_fin_annee" wire:model = "experience.experience_fin_annee" class="mr-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
												<option selected> Sélectionnez une annee</option>
												@php
													$date = date('Y');
												@endphp
												@for($annee = $date; $annee > 1960; $annee--)
												<option value="{{$annee}}">{{$annee}}</option>
												@endfor
											</select>

										</label>
										@error('experience_fin_annee') <span class="text-red-500">{{$message}}</span>@enderror

									</div>
								</div>
								@endif
							</div>

							<div class="flex items-center mt-2">
								<input id="link-checkbox" type="checkbox" wire:model = "experience_until_now" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
								<label for="link-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Jusqu'à maintenant </label>
							</div>

						</div>

						<div class="mb-5">
							<label for="experience" class="font-bold mb-1 text-gray-700 block">Description</label>
							<textarea wire:model = "experience.description" id="description" class=" w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium" placeholder="Decrire votre expérience de travail"
							></textarea>
							@error('description') <span class="text-red-500">{{$message}}</span>@enderror
						</div>

						<div class="fixed bottom-0 left-0 right-0 py-5 bg-white shadow-md" x-show="step != 'complete'">
							<div class="max-w-3xl mx-auto px-4">
								<div class="flex justify-between">
									<div class="w-1/2">
										<button
											wire:click="back(2)"
											class="w-32 focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border" 
										>Précédent</button>
									</div>
				
									<div class="w-1/2 text-right">
										<button
											wire:click="thirdStepSubmit"
											class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium" 
										>Suivant</button>
				
										
									</div>
								</div>
							</div>
						</div>
					</div>

					<!--EDUCATION-->

					<div class="row setup-content {{ $currentStep != 4 ? 'displayNone' : '' }}" id="step-4"  >

						<div class="border-b-2 py-4">
							<div class="flex flex-col md:flex-row md:items-center md:justify-between">
								<div class="flex-1">
									<div class="text-lg font-bold text-gray-700 leading-tight">Education</div>
								</div>

							</div>
						</div>
						<span class="text-gray-400 txt-sm mb-2"> Remplir par le dernier cursus que vous avez fait. Pour les autres, vous pouvez les remplir dans votre profile après
						</span>
						<div class=" mb-5 flex">
							<div class="flex-1">
								<label for="" class="font-bold mb-1 text-gray-700 block">Province</label>
								<label
									class="flex justify-start items-center text-truncate rounded-lg bg-white pl-2 pr-2 py-2 shadow-sm mr-4">
								
									<select id="province" wire:model = "education.province" class="bg-gray-50 border mr-3 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
										<option selected> Sélectionnez un province</option>
										<option value="Antananarivo">Antananarivo</option>
										<option value="Toamasina">Toamasina</option>
										<option value="Mahajanga">Mahajanga</option>
										<option value="Antsinanana">Antsinanana</option>
										<option value="Fianarantsoa">Fianarantsoa</option>
										<option value="Toliara">Toliara</option>
										
									</select>

								</label>
								@error('province') <span class="text-red-500">{{$message}}</span>@enderror

							</div>

							<div class="flex-1">
								<label for="" class="font-bold mb-1 text-gray-700 block">Université</label>
								
									<input type="text" wire:model = "education.universite" id="universite"
									class="w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"
									placeholder="ex.ENI-Université de Fianarantsoa">
									@error('universite') <span class="text-red-500">{{$message}}</span>@enderror

							</div>
						</div>

						<div class="mb-5">
							<label for="diplome" class="font-bold mb-1 text-gray-700 block">Diplôme</label>
							<input type="text" wire:model = 'education.diplome' id="diplome"
							class="w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"
							placeholder="Saisissez votre diplôme ">
							@error('diplome') <span class="text-red-500">{{$message}}</span>@enderror

							
						</div>
						
						<div class="mb-5 flex">
							<div class="mr-3" >
								<label for="education_debut_annee" class="font-bold mb-1 text-gray-700 block">Année de debut</label>
								<label
								class="flex justify-start items-center text-truncate rounded-lg bg-white pl-2 pr-2 py-2 shadow-sm">
									<select id="education_debut_annee" wire:model = "education.education_debut_annee" class="mr-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
										<option selected> Sélectionnez une annee</option>
										@php
											$date = date('Y');
										@endphp
										@for($annee = $date; $annee > 1960; $annee--)
										<option value="{{$annee}}">{{$annee}}</option>
										@endfor
									</select>
								</label>
								@error('education_debut_annee') <span class="text-red-500">{{$message}}</span>@enderror
							</div>
							@if($education_until_now == false )
							<div>
								<label  class="font-bold mb-1 text-gray-700 block">Fin d'année</label>
								<label
								class="flex justify-start items-center text-truncate rounded-lg bg-white pl-2 pr-2 py-2 shadow-sm">
								
									<select  id="education_fin_annee" wire:model = "education.education_fin_annee" class="mr-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
										<option selected> Sélectionnez une annee</option>
										@php
											$date = date('Y');
										@endphp
										@for($annee = $date; $annee > 1960; $annee--)
										<option value="{{$annee}}">{{$annee}}</option>
										@endfor
									</select>
								</label>
								@error('education_fin_annee') <span class="text-red-500">{{$message}}</span>@enderror

							</div>
							@endif
						</div>
						<div class="flex items-center">
							<input id="link-checkbox" type="checkbox" wire:model = "education_until_now" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
							<label for="link-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Jusqu'à maintenant </label>
						</div>
						<div class="fixed bottom-0 left-0 right-0 py-5 bg-white shadow-md" x-show="step != 'complete'">
							<div class="max-w-3xl mx-auto px-4">
								<div class="flex justify-between">
									<div class="w-1/2">
										<button
											wire:click="back(3)"
											class="w-32 focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border" 
										>Précédent</button>
									</div>
				
									<div class="w-1/2 text-right">
										<button
											wire:click="forthStepSubmit"
											class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium" 
										>Suivant</button>
				
										
									</div>
								</div>
							</div>
						</div>
				</div>


				<!--QAULIFICATION-->

				<div class="row setup-content {{ $currentStep != 5 ? 'displayNone' : '' }}" id="step-5"  >

					<div class="border-b-2 py-4">
						<div class="flex flex-col md:flex-row md:items-center md:justify-between">
							<div class="flex-1">
								<div class="text-lg font-bold text-gray-700 leading-tight">Qualification</div>
							</div>
						</div>
					</div>
					<span class="text-gray-400 txt-sm mb-2" >Vous pouver clicker terminer si vous n'avez pas encore de qualification</span>
					
					<div class=" mb-5 flex">
						<div class="flex-1 mr-3">
							<label for="sommaire" class="font-bold mb-1 text-gray-700 block">Certificat professionnel ou récompense</label>
								<input type="text" wire:model = "qualification.certificat" id = "certificat"
								class="w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"
								placeholder="ex. Saisir iun certificat ou une récompense professionnelle">
								@error('certificat') <span class="text-red-500">{{$message}}</span>@enderror
						</div>

						<div class="flex-1">
							<label for="sommaire" class="font-bold mb-1 text-gray-700 block">Organisation conférée</label>
								<input type="text" wire:model = "qualification.organisation" id="organisation"
								class="w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"
								placeholder="ex. Saisir l'organisation conférente">
								@error('organisation') <span class="text-red-500">{{$message}}</span>@enderror
						</div>
					</div>

					<div class="mb-5">
						<label for="sommaire" class="font-bold mb-1 text-gray-700 block">Description</label>
							<textarea wire:model = "qualification.description" id="description" class=" w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium" placeholder="Decrire votre qualification"
							></textarea>
							@error('description') <span class="text-red-500">{{$message}}</span>@enderror
					</div>
					
					<div class="mb-5 flex">
						<div>
							<label for="année" class="font-bold mb-1 text-gray-700 block">Année</label>

							<label
							class="flex justify-start items-center text-truncate rounded-lg bg-white pl-2 pr-2 py-2 shadow-sm">
							 
								<select id="qualification_annee" wire:model = "qualification.qualification_annee" class="mr-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
									<option selected> Sélectionnez une annee</option>
									@php
										$date = date('Y');
									@endphp
									@for($annee = $date; $annee > 1960; $annee--)
									<option value="{{$annee}}">{{$annee}}</option>
									@endfor
								</select>
								@error('qualification_annee') <span class="text-red-500">{{$message}}</span>@enderror
							</label>
						</div>

					</div>

					<div class="fixed bottom-0 left-0 right-0 py-5 bg-white shadow-md" x-show="step != 'complete'">
						<div class="max-w-3xl mx-auto px-4">
							<div class="flex justify-between">
								<div class="w-1/2">
									<button
										wire:click="back(4)"
										class="w-32 focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border" 
									>Précédent</button>
								</div>
			
								<div class="w-1/2 text-right">
									<button
										wire:click="lastStepSubmit"
										class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium" 
									>Terminer</button>
			
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
				<!-- / Step Content -->
		</div>
		
<script>
	function next()
	{
		Livewire.emit('next');
	}
	function showCompetence(categorie_id)
	{
		Livewire.emit('showCompetence',categorie_id);
	}
</script>
</body>
</div>