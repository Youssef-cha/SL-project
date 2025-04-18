<?php

namespace Database\Factories;

use App\Models\Efp;
use App\Models\Fournisseur;
use App\Models\Responsable;
use App\Models\Rubrique;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commande>
 */
class CommandeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    private $id =0;
    public function definition(): array
    {
        return [

            'NUM_COMMANDE'  => $this->id ++,

            'AVIS_ACHAT'  => "...",
            'TYPE_ACHAT'    => 'Marche',
            'TYPE_BUDGET'    => 'Fonctionnement',
            'OBJET_ACHAT'    => "...",
            'rubrique_id'    => Rubrique::factory()->create(),
            'fournisseur_id'    => Fournisseur::factory()->create(),
            'DELAI_LIVRAISON'  => fake()->randomNumber(),
            'GARANTIE'  => 'non',
            'NUM_MARCHE'  => fake()->randomNumber(),
            'EXERCICE'  => 0000,
            'DATE_COMMANDE'  => fake()->date(),
            'user_id'  => User::factory()->create(),
            'STATUT_COMMANDE'  => 'attribuee',

            'DATE_LIVRAISON'  => fake()->date(),
            'STATUT_LIVRAISON'  => 'livree',
            'oz'  => fake()->randomNumber(),
            'LIEU_LIVRAISON'  => "...",

            'DATE_VERIFICATION_RECEPTION'  => fake()->date(),
            'STATUT_RECEPTION'  => 'receptionnee',
            'DATE_DEPOT_SL'  => fake()->date(),
            'NUM_FACTURE'  => fake()->randomNumber(),
            'DATE_FACTURE'  => fake()->date(),
            'HT'  => fake()->randomNumber(),
            'TTC'  => fake()->randomNumber(),
            'TAUX_TVA'  => fake()->randomNumber(),
            'MONTANT_TVA'  => fake()->randomNumber(),

            'efp_id'  => Efp::factory(),
            'DATE_DEPOT_SC'  => fake()->date(),
            'STATUT_PAIEMENT'  => 'non payee',
            'DATE_PAIEMENT'  => fake()->date(),
            'MONTANT_PAYE'  => fake()->randomNumber(),
        ];
    }
}
