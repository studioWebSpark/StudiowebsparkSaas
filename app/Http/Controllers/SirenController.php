<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SirenController extends Controller
{
    public function verify(Request $request)
    {
        try {
            $siren = $request->input('siren');

            Log::info('Vérification SIREN', ['siren' => $siren]);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.insee.token'),
                'Accept' => 'application/json'
            ])->get("https://api.insee.fr/entreprises/sirene/V3.11/siren/{$siren}");

            if ($response->successful()) {
                $data = $response->json();

                if (isset($data['uniteLegale'])) {
                    $uniteLegale = $data['uniteLegale'];
                    $periodeCourante = $uniteLegale['periodesUniteLegale'][0] ?? null;

                    // Construction du nom complet
                    $denomination = '';
                    if (!empty($uniteLegale['prenom1UniteLegale']) && !empty($uniteLegale['nomUniteLegale'])) {
                        $denomination = $uniteLegale['prenom1UniteLegale'] . ' ' . $uniteLegale['nomUniteLegale'];
                    } elseif (!empty($periodeCourante['denominationUniteLegale'])) {
                        $denomination = $periodeCourante['denominationUniteLegale'];
                    } elseif (!empty($periodeCourante['nomUniteLegale'])) {
                        $denomination = $periodeCourante['nomUniteLegale'];
                    }

                    return response()->json([
                        'success' => true,
                        'company' => [
                            'uniteLegale' => [
                                'denominationUniteLegale' => trim($denomination),
                                'siren' => $uniteLegale['siren'],
                                'siret' => $periodeCourante['nicSiegeUniteLegale']
                                    ? $uniteLegale['siren'] . $periodeCourante['nicSiegeUniteLegale']
                                    : null,
                                'dateCreationUniteLegale' => $uniteLegale['dateCreationUniteLegale'],
                                'activitePrincipale' => $periodeCourante['activitePrincipaleUniteLegale'] ?? null
                            ]
                        ]
                    ]);
                }
            }

            return response()->json([
                'success' => false,
                'message' => 'Entreprise non trouvée'
            ], 404);
        } catch (\Exception $e) {
            Log::error('Erreur vérification SIREN', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la vérification'
            ], 500);
        }
    }
}
