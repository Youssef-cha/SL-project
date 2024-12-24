@extends('layouts.app')
@section('content')

    @session('success')
        <div style="background-color: #00000062" id="successModal"
            class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full flex  ">
            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <button
                        class="closeButton text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div
                        class="w-12 h-12 rounded-full bg-green-100 dark:bg-green-900 p-2 flex items-center justify-center mx-auto mb-3.5">
                        <svg aria-hidden="true" class="w-8 h-8 text-green-500 dark:text-green-400" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Success</span>
                    </div>
                    <p class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">{{ $value }}</p>
                    <button
                        class="closeButton py-2 px-3 text-sm font-medium text-center text-white rounded-lg bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:focus:ring-primary-900">
                        Continue
                    </button>
                </div>
            </div>
        </div>
    @endsession
    <!-- numéro de commande -->

    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Créer Une Commande</h2>
        <form method="post" action="{{ route('bonCommandes.store') }}" class="form-container">
            @csrf
            <x-form-fields-container>
                <x-form-input label="Avis Achat" name="AVIS_ACHAT" />
           
                <x-form-select label="Type Budget" name="TYPE_BUDGET">
                    @foreach ($budgetTypes as $budgetType)
                        <option @selected(old('TYPE_BUDGET') == $budgetType) value="{{ $budgetType }}">{{ $budgetType }}</option>
                    @endforeach

                </x-form-select>
                <x-form-text-area label="Objet d'achat" name="OBJET_ACHAT" />
                <x-form-select :half="true" label="Référence Rubrique" name="rubrique_id">
                    @foreach ($rubriques as $rubrique)
                        <option @selected(old('rubrique_id') == $rubrique->id) value="{{ $rubrique->id }}">
                            {{ $rubrique->REFERENCE_RUBRIQUE }}</option>
                    @endforeach
                </x-form-select>
                <x-form-select :half="true" label="fournisseur" name="fournisseur_id">
                    @foreach ($fournisseurs as $fournisseur)
                        <option @selected(old('fournisseur_id') == $fournisseur->id) value="{{ $fournisseur->id }}">
                            {{ $fournisseur->nom_fournisseur }}</option>
                    @endforeach
                </x-form-select>
                <x-form-select :half="true" label="efp" name="efp_id">
                    @foreach ($efps as $efp)
                        <option @selected(old('efp_id') == $efp->id) value="{{ $efp->id }}">
                            {{ $efp->nom_efp }}</option>
                    @endforeach
                </x-form-select>
                <x-form-input :half="true" type="number" min="0" label="Délai de livraison"
                    name="DELAI_LIVRAISON" />
                <div class="flex flex-col  justify-start space-y-1">

                    <label class=" inline-flex items-center cursor-pointer">
                        <input id="garantie" name="GARANTIE" type="checkbox" value="oui" @checked(old('GARANTIE') == 'oui')
                            class="sr-only peer">
                        <div
                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600">
                        </div>
                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Garantie</span>
                    </label>
                    <x-form-input id="retenue" type="number" min="0" name="RETENUE_GARANTIE"
                        placeholder="Retenue Garantie" />

                </div>
                <x-form-input :half="true" type="number" min="" label="Exercice" name="EXERCICE" />
                <x-form-input  type="date" label="Date commande" name="DATE_COMMANDE" />

            </x-form-fields-container>
            <x-form-button route="commandes.index">
                Enregistrer
            </x-form-button>
        </form>
    </div>
@endsection
