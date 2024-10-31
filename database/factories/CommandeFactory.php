<?php

namespace Database\Factories;

use App\Models\Rubrique;
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
    public function definition(): array
    {
        return [
            'NUM_COMMANDE'  => fake()->name(),
            'AVIS_ACHAT'  => fake()->name(),
            'TYPE_ACHAT'    => 'Marche',
            'TYPE_BUDGET'    => 'Fonctionnement',
            'OBJET_ACHAT'    => fake()->name(),
            'REFERENCE_RUBRIQUE'    => Rubrique::factory()->create(),
            'FOURNISSEUR'    => fake()->name(),
            'DELAI_LIVRAISON'  => fake()->randomNumber(),
            'GARANTIE'  => 'non',
            'NUM_MARCHE'  => fake()->name(),
            'EXERCICE'  => fake()->randomNumber,
            'DATE_COMMANDE'  => fake()->date(),
            'RESPONSABLE_DOSSIER'  => fake()->name(),
            'STATUT_COMMANDE'  => 'attribuee',

            'DATE_LIVRAISON'  => fake()->date(),
            'STATUT_LIVRAISON'  => 'non livree',
            'LIEU_LIVRAISON'  => fake()->name(),

            'DATE_VERIFICATION_RECEPTION'  => fake()->date(),
            'STATUT_RECEPTION'  => 'non receptionnee',
            'DATE_DEPOT_SL'  => fake()->date(),
            'NUM_FACTURE'  => fake()->randomNumber(),
            'HT'  => fake()->randomNumber(),
            'TTC'  => fake()->randomNumber(),
            'TAUX_TVA'  => fake()->randomNumber(),
            'MONTANT_TVA'  => fake()->randomNumber(),

            'DATE_DEPOT_SC'  => fake()->date(),
            'STATUT_PAIEMENT'  => 'non payee',
            'DATE_PAIEMENT'  => fake()->date(),
            'MONTANT_PAYE'  => fake()->randomNumber(),
        ];
    }
}
