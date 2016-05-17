<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 4/7/16
 * Time: 10:52 AM
 */

namespace App\Helpers;

use DB;
use App\Http\Controllers\Controller;

class AchtergrondBord
{
    public  static function calculation($shoort_bord, $lengte_bord, $breedte_bord, $acm_spuiten, $installment_param = null)
    {
        $oppervlakte_val = $lengte_bord * $breedte_bord;
        $omtrek_val = $lengte_bord * 2 + $breedte_bord * 2;

        // Define currency
        //$usd_to_srd = 5.5;
        $usd_to_srd = DB::table('currency')->where('title', 'US$')->pluck('value');
        //$euro_to_srd = 5.85;
        $euro_to_srd = DB::table('currency')->where('title', 'Euro')->pluck('value');

        // This values are in USD
        $lichtbakken_calculator_tab_one_g136 = 4.98;
        $lichtbakken_calculator_tab_one_g137 = 25;

        $materiaal_list = null;

        // G3 Calculation
        if ($shoort_bord == 'acm_mm') {
            $aluminum_composite_material_maxmetal__aantal = AchtergrondBord::floorToFraction($oppervlakte_val / 3, 4);
            $materiaal_list [] = [
                'label' => 'Aluminum Composite Material (MAXMetal)',
                'aantal' => $aluminum_composite_material_maxmetal__aantal,
                'eenheid' => 'st'
            ];
        } else {
            $aluminum_composite_material_maxmetal__aantal = 0;
        }
        $aluminum_composite_material_maxmetal_usd = 50;
        $aluminum_composite_material_maxmetal_srd = $aluminum_composite_material_maxmetal_usd * $usd_to_srd;
        $aluminum_composite_material_maxmetal_subtotal = $aluminum_composite_material_maxmetal__aantal * $aluminum_composite_material_maxmetal_srd;

        // G4 Calculation
        if ($shoort_bord == 'acm_mmhd') {
            $acm_maxmetalhd_aantal = AchtergrondBord::floorToFraction(($oppervlakte_val) / 3, 4);
            $materiaal_list [] = [
                'label' => 'ACM HD (MAXMetal HD)',
                'aantal' => $acm_maxmetalhd_aantal,
                'eenheid' => 'st'
            ];
        } else {
            $acm_maxmetalhd_aantal = 0;
        }
        $acm_maxmetalhd_usd = 74 * 1.4;
        $acm_maxmetalhd_srd = $acm_maxmetalhd_usd * $usd_to_srd;
        $acm_maxmetalhd_subtotal = $acm_maxmetalhd_aantal * $acm_maxmetalhd_srd;

        // G9 calculation
        if ($shoort_bord == 'banner_met_grip') {
            $galvaan_1__25m_x_2__50m_1_mm_aantal = AchtergrondBord::floorToFraction(($omtrek_val / 2.44) / 6, 4);
            $materiaal_list [] = [
                'label' => 'galvaan 1.25m x 2.50m 1 mm',
                'aantal' => $galvaan_1__25m_x_2__50m_1_mm_aantal,
                'eenheid' => 'st'
            ];
        } else {
            $galvaan_1__25m_x_2__50m_1_mm_aantal = 0;
        }
        $galvaan_1__25m_x_2__50m_1_mm_usd = 32.3181818181818;
        $galvaan_1__25m_x_2__50m_1_mm_srd = $galvaan_1__25m_x_2__50m_1_mm_usd * $usd_to_srd;
        $galvaan_1__25m_x_2__50m_1_mm_subtotal = $galvaan_1__25m_x_2__50m_1_mm_aantal * $galvaan_1__25m_x_2__50m_1_mm_srd;

        // G31 calculation
        if ($omtrek_val < 5) {
            $_30_x_30_meubel_galvaan_buis_aantal = AchtergrondBord::floorToFraction((($lengte_bord * 2) + ($breedte_bord * 2)) / 5, 4);
        } elseif ($omtrek_val < 10) {
            $_30_x_30_meubel_galvaan_buis_aantal = AchtergrondBord::floorToFraction((($lengte_bord * 3) + ($breedte_bord * 3)) / 5, 4);
        } else {
            $_30_x_30_meubel_galvaan_buis_aantal = AchtergrondBord::floorToFraction(($oppervlakte_val * 4 / 5), 4);
        }
        if ($omtrek_val > 0) {
            $materiaal_list [] = [
                'label' => '30 x 30 meubel galvaan buis',
                'aantal' => $_30_x_30_meubel_galvaan_buis_aantal,
                'eenheid' => 'st'
            ];
        }
        $_30_x_30_meubel_galvaan_buis_usd = 7.10909090909091;
        $_30_x_30_meubel_galvaan_buis_srd = $_30_x_30_meubel_galvaan_buis_usd * $usd_to_srd;
        $_30_x_30_meubel_galvaan_buis_subtotal = $_30_x_30_meubel_galvaan_buis_aantal * $_30_x_30_meubel_galvaan_buis_srd;

        // G46 calculation
        if ($shoort_bord == 'banner') {
            $rond_10_wapening_aantal = $omtrek_val / 5;
            $materiaal_list [] = [
                'label' => 'rond 10 wapening',
                'aantal' => $rond_10_wapening_aantal,
                'eenheid' => 'st'
            ];
        } else {
            $rond_10_wapening_aantal = 0;
        }
        $rond_10_wapening_usd = 3.63636363636364;
        $rond_10_wapening_srd = $rond_10_wapening_usd * $usd_to_srd;
        $rond_10_wapening_subtotal = $rond_10_wapening_aantal * $rond_10_wapening_srd;

        // G66 calculation
        $m8_houtdraad_bout_aantal = $oppervlakte_val * 2 * 2;
        if ($m8_houtdraad_bout_aantal > 0) {
            $materiaal_list [] = [
                'label' => 'M8 houtdraad bout',
                'aantal' => $m8_houtdraad_bout_aantal,
                'eenheid' => 'st'
            ];
        }
        $m8_houtdraad_bout_usd = 0.0909090909090909;
        $m8_houtdraad_bout_srd = $m8_houtdraad_bout_usd * $usd_to_srd;
        $m8_houtdraad_bout_subtotal = $m8_houtdraad_bout_aantal * $m8_houtdraad_bout_srd;

        // G68 calculation
        $m8_keilbout_aantal = $oppervlakte_val * 2 * 2;
        if ($m8_keilbout_aantal > 0) {
            $materiaal_list [] = [
                'label' => 'M8 Keilbout',
                'aantal' => $m8_keilbout_aantal,
                'eenheid' => 'st'
            ];
        }
        $m8_keilbout_usd = 0.363636363636364;
        $m8_keilbout_srd = $m8_keilbout_usd * $usd_to_srd;
        $m8_keilbout_subtotal = $m8_keilbout_aantal * $m8_keilbout_srd;

        // G77 calculation
        $lijm_montage_kit_bison_aantal = ceil($aluminum_composite_material_maxmetal__aantal + $acm_maxmetalhd_aantal);
        if ($lijm_montage_kit_bison_aantal > 0) {
            $materiaal_list [] = [
                'label' => 'lijm montage kit (bison)',
                'aantal' => $lijm_montage_kit_bison_aantal,
                'eenheid' => 'st'
            ];
        }
        $lijm_montage_kit_bison_usd = 6.36363636363636;
        $lijm_montage_kit_bison_srd = $lijm_montage_kit_bison_usd * $usd_to_srd;
        $lijm_montage_kit_bison_subtotal = $lijm_montage_kit_bison_aantal * $lijm_montage_kit_bison_srd;

        // G78 calculation
        $_4_5_grinder_disc_aantal = ceil($_30_x_30_meubel_galvaan_buis_aantal);
        if ($_4_5_grinder_disc_aantal > 0) {
            $materiaal_list [] = [
                'label' => '4,5" grinder disc',
                'aantal' => $_4_5_grinder_disc_aantal,
                'eenheid' => 'st'
            ];
        }
        $_4_5_grinder_disc_usd = 1.63636363636364;
        $_4_5_grinder_disc_srd = $_4_5_grinder_disc_usd * $usd_to_srd;
        $_4_5_grinder_disc_subtotal = $_4_5_grinder_disc_aantal * $_4_5_grinder_disc_srd;

        // G79 calculation
        $_14_afkort_disc_aantal = ceil($_30_x_30_meubel_galvaan_buis_aantal) / 5;
        if ($_14_afkort_disc_aantal > 0) {
            $materiaal_list [] = [
                'label' => '14" afkort disc',
                'aantal' => $_14_afkort_disc_aantal,
                'eenheid' => 'st'
            ];
        }
        $_14_afkort_disc_usd = 7.18181818181818;
        $_14_afkort_disc_srd = $_14_afkort_disc_usd * $usd_to_srd;
        $_14_afkort_disc_subtotal = $_14_afkort_disc_aantal * $_14_afkort_disc_srd;

        // G80 calculation
        $lasdraad_aantal = AchtergrondBord::floorToFraction(ceil($_30_x_30_meubel_galvaan_buis_aantal + $rond_10_wapening_aantal) / 10, 10);
        if ($lasdraad_aantal > 0) {
            $materiaal_list [] = [
                'label' => 'lasdraad',
                'aantal' => $lasdraad_aantal,
                'eenheid' => 'pk (5 kg)'
            ];
        }
        $lasdraad_usd = 20.9090909090909;
        $lasdraad_srd = $lasdraad_usd * $usd_to_srd;
        $lasdraad_subtotal = $lasdraad_aantal * $lasdraad_srd;

        // G91 calculation
        if ($shoort_bord == 'banner_met_grip'){
            $alligator_grip_voor_banner_aantal = ceil($omtrek_val * 5);
        }else{
            $alligator_grip_voor_banner_aantal = 0;
        }

        if($alligator_grip_voor_banner_aantal > 0){
            $materiaal_list []= [
                'label' => 'Alligator Grip ( voor banner)',
                'aantal' => $alligator_grip_voor_banner_aantal,
                'eenheid' => 'st'
            ];
        }
        $alligator_grip_voor_banner_usd = 3.4;
        $alligator_grip_voor_banner_srd = $alligator_grip_voor_banner_usd * $usd_to_srd;
        $alligator_grip_voor_banner_subtotal = $alligator_grip_voor_banner_aantal * $alligator_grip_voor_banner_srd;

        // G94 calculation
        $sleufplaat_60_cm_x_35_cm_3_mm_aantal = $oppervlakte_val * 2;
        if($sleufplaat_60_cm_x_35_cm_3_mm_aantal > 0){
            $materiaal_list []= [
                'label' => 'Sleufplaat 60 cm x 35 cm    3 mm',
                'aantal' => $sleufplaat_60_cm_x_35_cm_3_mm_aantal,
                'eenheid' => 'st'
            ];
        }
        $sleufplaat_60_cm_x_35_cm_3_mm_usd = 2.72727272727273;
        $sleufplaat_60_cm_x_35_cm_3_mm_srd = $sleufplaat_60_cm_x_35_cm_3_mm_usd * $usd_to_srd;
        $sleufplaat_60_cm_x_35_cm_3_mm_subtotal = $sleufplaat_60_cm_x_35_cm_3_mm_aantal * $sleufplaat_60_cm_x_35_cm_3_mm_srd;


        $materiaal_subtotal = $aluminum_composite_material_maxmetal_subtotal + $acm_maxmetalhd_subtotal + $galvaan_1__25m_x_2__50m_1_mm_subtotal +
            $_30_x_30_meubel_galvaan_buis_subtotal + $rond_10_wapening_subtotal + $m8_houtdraad_bout_subtotal + $m8_keilbout_subtotal +
            $lijm_montage_kit_bison_subtotal + $_4_5_grinder_disc_subtotal + $_14_afkort_disc_subtotal +
            $lasdraad_subtotal + $alligator_grip_voor_banner_subtotal + $sleufplaat_60_cm_x_35_cm_3_mm_subtotal;
        $materiaal = $materiaal_subtotal;

        // G129 calculation
        if($shoort_bord == 'banner' || $shoort_bord == 'banner_met_grip') {
            $banner_aantal = $oppervlakte_val;
        }else{
            $banner_aantal = 0;
        }
        $materiaal_list []= [
            'label' => 'banner',
            'aantal' => $banner_aantal,
            'eenheid' => 'm2'
        ];
        $banner_usd = 35;
        $banner_srd = $banner_usd * $usd_to_srd;
        $banner_subtotal = $banner_aantal * $banner_srd;
        $sticker = $banner_subtotal;

        // G135 calculation
        $spuitwerk_randen_aantal =  $galvaan_1__25m_x_2__50m_1_mm_aantal * 6;

        if($spuitwerk_randen_aantal > 0){
            $materiaal_list []= [
                'label' => 'spuitwerk randen',
                'aantal' => $spuitwerk_randen_aantal,
                'eenheid' => 'set'
            ];
        }
        $spuitwerk_randen_usd = 10;
        $spuitwerk_randen_srd = $spuitwerk_randen_usd * $usd_to_srd;
        $spuitwerk_randen_subtotal = $spuitwerk_randen_aantal * $spuitwerk_randen_srd;


        // G136 calculation
        if($acm_spuiten == 'ja'){
            $spullen_voor_afwerken_srd250_aantal =  $oppervlakte_val;
        }else{
            $spullen_voor_afwerken_srd250_aantal =  0;
        }
        if($spullen_voor_afwerken_srd250_aantal > 0) {
            $materiaal_list [] = [
                'label' => 'spullen voor afwerken (srd250)',
                'aantal' => $spullen_voor_afwerken_srd250_aantal,
                'eenheid' => 'set'
            ];
        }
        $spullen_voor_afwerken_srd250_usd = 45.4545454545455;
        $spullen_voor_afwerken_srd250_srd = $spullen_voor_afwerken_srd250_usd * $usd_to_srd;
        $spullen_voor_afwerken_srd250_subtotal = $spullen_voor_afwerken_srd250_aantal * $spullen_voor_afwerken_srd250_srd;

        // G139 calculation
        $verf_srd250_aantal =  $_30_x_30_meubel_galvaan_buis_aantal / 10;
        if($verf_srd250_aantal > 0) {
            $materiaal_list [] = [
                'label' => 'afwerken spuitwerk randen',
                'aantal' => $verf_srd250_aantal,
                'eenheid' => 'liter'
            ];
        }
        $verf_srd250_usd = 6.59090909090909;
        $verf_srd250_srd = $verf_srd250_usd * $usd_to_srd;
        $verf_srd250_subtotal = $verf_srd250_aantal * $verf_srd250_srd;

        $afwerken = $spuitwerk_randen_subtotal + $spullen_voor_afwerken_srd250_subtotal + $verf_srd250_subtotal;

        $transport_subtotal = 0;
        $transport = $transport_subtotal;

        // G150 calculation
        if(ceil($oppervlakte_val * 2) > 24) {
            $volwas_aantal = ceil($oppervlakte_val * 2);
        }else{
            $volwas_aantal = 0;
        }
        if($volwas_aantal) {
            $materiaal_list [] = [
                'label' => 'volwas',
                'aantal' => $volwas_aantal,
                'eenheid' => 'uren'
            ];
        }
        $volwas_usd = 7;
        $volwas_srd = $volwas_usd * $usd_to_srd;
        $volwas_subtotal = $volwas_aantal * $volwas_srd;

        // G151 calculation
        $halfwas_aantal =  ceil($oppervlakte_val * 2);
        if($halfwas_aantal > 0) {
            $materiaal_list [] = [
                'label' => 'halfwas',
                'aantal' => $halfwas_aantal,
                'eenheid' => 'uren'
            ];
        }
        $halfwas_usd = 5.15;
        $halfwas_srd = $halfwas_usd * $usd_to_srd;
        $halfwas_subtotal = $halfwas_aantal * $halfwas_srd;


        // G152 calculation
        $handlanger_aantal =  ceil($oppervlakte_val * 2);
        if($handlanger_aantal > 0) {
            $materiaal_list [] = [
                'label' => 'handlanger',
                'aantal' => $handlanger_aantal,
                'eenheid' => 'uren'
            ];
        }
        $handlanger_usd = 4.15;
        $handlanger_srd = $handlanger_usd * $usd_to_srd;
        $handlanger_subtotal = $handlanger_aantal * $handlanger_srd;


        $arbeid = $volwas_subtotal + $halfwas_subtotal + $handlanger_subtotal;


        $machine = 0;

        $materiaal_subtotal2 = $materiaal + $materiaal * 0.20;
        $sticker_subtotal2 = $sticker + $sticker * 0.00;
        $afwerken_subtotal2 = $afwerken + $afwerken * 0.20;
        $transport_subtotal2 = $transport + $transport * 0.30;
        $arbeid_subtotal2 = $arbeid + $arbeid * 1.00;
        $machine_subtotal2 = $machine + $machine * 0.30;

        $subtotal2 = $materiaal_subtotal2 + $sticker_subtotal2 + $afwerken_subtotal2 + $transport_subtotal2 + $arbeid_subtotal2 + $machine_subtotal2;

        $winst = $subtotal2 * 0.20;
        $onvoorzien = $subtotal2 * 0.10;
        $moeilijkheidsgraad = $subtotal2 * 0.00;

        $subtotal = ceil($subtotal2 + $winst + $onvoorzien + $moeilijkheidsgraad);

        // Calculations for show
        $prijs_srd = $subtotal;
        $prijs_usd = $prijs_srd / $usd_to_srd ;
        $prijs_euro = $prijs_srd / $euro_to_srd;

        $prijs_srd_tax = $prijs_srd * 0.10;
        $prijs_usd_tax = $prijs_usd * 0.10;
        $prijs_euro_tax = $prijs_euro * 0.10;

        $prijs_srd_subtotal = $prijs_srd + $prijs_srd_tax;
        $prijs_usd_subtotal = $prijs_usd + $prijs_usd_tax;
        $prijs_euro_subtotal = $prijs_euro + $prijs_euro_tax;

        $material_return = [
            'srd' => [
                'price' => $prijs_srd,
                'subtotal' => $prijs_srd_subtotal,
                'tax' => $prijs_srd_tax
            ],
            'usd' => [
                'price' => $prijs_usd,
                'subtotal' => $prijs_usd_subtotal,
                'tax' => $prijs_usd_tax
            ],
            'euro' => [
                'price' => $prijs_euro,
                'subtotal' => $prijs_euro_subtotal,
                'tax' => $prijs_euro_tax
            ]
        ];


        // Installment calculation
        $installment_return = null;
        $final_total = null;
        /*$installment_param = [
            'locatie' => 'Nickerie',
            'achtergrond' => 'beton_natuurtegels_natuursteen',
            'werkhoogte' => 'gt_12m',
            'bracket' => 'small'
        ];*/
        if($installment_param) {
            $installment_arr = [
                'LOCATIE' => [
                    'Maretraite' => [
                        'usd' => 10,
                        'aantal' => 1
                    ],
                    'Lelydorp' => [
                        'usd' => 10,
                        'aantal' => 5
                    ],
                    'Kwatta' => [
                        'usd' => 10,
                        'aantal' => 2
                    ],
                    'Munder' => [
                        'usd' => 10,
                        'aantal' => 2
                    ],
                    'Beekhuizen' => [
                        'usd' => 10,
                        'aantal' => 3
                    ],
                    'Domburg' => [
                        'usd' => 10,
                        'aantal' => 5
                    ],
                    'Leiding' => [
                        'usd' => 10,
                        'aantal' => 3
                    ],
                    'Geyersvlijt' => [
                        'usd' => 10,
                        'aantal' => 1
                    ],
                    'Clevia' => [
                        'usd' => 10,
                        'aantal' => 1
                    ],
                    'Combé' => [
                        'usd' => 10,
                        'aantal' => 1
                    ],
                    'Tourtonne' => [
                        'usd' => 10,
                        'aantal' => 1
                    ],
                    'Morgenstond' => [
                        'usd' => 10,
                        'aantal' => 1
                    ],
                    'Mon Plasir' => [
                        'usd' => 10,
                        'aantal' => 1
                    ],
                    'Centrum' => [
                        'usd' => 10,
                        'aantal' => 1
                    ],
                    'Houttuin' => [
                        'usd' => 10,
                        'aantal' => 4
                    ],
                    'Benispark' => [
                        'usd' => 10,
                        'aantal' => 2
                    ],
                    'Charlesburg' => [
                        'usd' => 10,
                        'aantal' => 1
                    ],
                    'Maikoe' => [
                        'usd' => 10,
                        'aantal' => 1
                    ],
                    'Pad_van_Wanica' => [
                        'usd' => 10,
                        'aantal' => 4
                    ],
                    'Dijkveld' => [
                        'usd' => 10,
                        'aantal' => 4
                    ],
                    'Latour' => [
                        'usd' => 10,
                        'aantal' => 4
                    ],
                    'Zorg_en_Hoop' => [
                        'usd' => 10,
                        'aantal' => 3
                    ],
                    'Uitvlugt' => [
                        'usd' => 10,
                        'aantal' => 3
                    ],
                    'Zanderij' => [
                        'usd' => 10,
                        'aantal' => 6
                    ],
                    'Nickerie' => [
                        'usd' => 10,
                        'aantal' => 9
                    ],
                    'Albina' => [
                        'usd' => 10,
                        'aantal' => 10
                    ]
                ],
                'ACHTERGROND' => [
                    'hout_gips_cementboard_verkast' => [
                        'usd' => 5,
                        'aantal' => 2
                    ],
                    'steen_porceleinen_tegels' => [
                        'usd' => 5,
                        'aantal' => 3
                    ],
                    'beton_natuurtegels_natuursteen' => [
                        'usd' => 5,
                        'aantal' => 4
                    ]
                ],
                'WERKHOOGTE' => [
                    '0m_-_3m' => [
                        'usd' => 5,
                        'aantal' => 1
                    ],
                    '3m_-_12m' => [
                        'usd' => 5,
                        'aantal' => 3
                    ],
                    'gt_12m' => [
                        'usd' => 5,
                        'aantal' => 8
                    ]
                ],
                'BRACKET' => [
                    'small' => [
                        'usd' => 10,
                        'aantal' => 1
                    ],
                    'medium' => [
                        'usd' => 10,
                        'aantal' => 3
                    ],
                    'large' => [
                        'usd' => 10,
                        'aantal' => 8
                    ]
                ],
            ];
            $locatie_materiaal = $installment_param['locatie'];
            $locatie_usdtosrd = $installment_arr['LOCATIE'][$locatie_materiaal]['usd'] * $usd_to_srd;
            $locatie_subtotal = $locatie_usdtosrd * $installment_arr['LOCATIE'][$locatie_materiaal]['aantal'];

            $achtergrond_materiaal = $installment_param['achtergrond'];
            $achtergrond_usdtosrd = $installment_arr['ACHTERGROND'][$achtergrond_materiaal]['usd'] * $usd_to_srd;
            $achtergrond = $achtergrond_usdtosrd * $installment_arr['ACHTERGROND'][$achtergrond_materiaal]['aantal'];
            $achtergrond_subtotal = $achtergrond * $oppervlakte_val;

            $werkhoogte_materiaal = $installment_param['werkhoogte'];
            if($werkhoogte_materiaal == 'gt_12m'){
                $st = 0;
                $werkhoogte_materiaal = '0m_-_3m';
                $werkhoogte_usdtosrd = $installment_arr['WERKHOOGTE'][$werkhoogte_materiaal]['usd'] * $usd_to_srd;
                $werkhoogte = $werkhoogte_usdtosrd * $installment_arr['WERKHOOGTE'][$werkhoogte_materiaal]['aantal'];
                $st = $werkhoogte;

                $werkhoogte_materiaal = '3m_-_12m';
                $werkhoogte_usdtosrd = $installment_arr['WERKHOOGTE'][$werkhoogte_materiaal]['usd'] * $usd_to_srd;
                $werkhoogte = $werkhoogte_usdtosrd * $installment_arr['WERKHOOGTE'][$werkhoogte_materiaal]['aantal'];
                $st += $werkhoogte;

                $werkhoogte_materiaal = 'gt_12m';
                $werkhoogte_usdtosrd = $installment_arr['WERKHOOGTE'][$werkhoogte_materiaal]['usd'] * $usd_to_srd;
                $werkhoogte = $werkhoogte_usdtosrd * $installment_arr['WERKHOOGTE'][$werkhoogte_materiaal]['aantal'];
                $st += $werkhoogte;

                $werkhoogte = $st;
                $werkhoogte_subtotal = $werkhoogte * ($oppervlakte_val);
            }else {
                $werkhoogte_usdtosrd = $installment_arr['WERKHOOGTE'][$werkhoogte_materiaal]['usd'] * $usd_to_srd;
                $werkhoogte = $werkhoogte_usdtosrd * $installment_arr['WERKHOOGTE'][$werkhoogte_materiaal]['aantal'];
                $werkhoogte_subtotal = $werkhoogte  * ($oppervlakte_val);
            }

            /*$bracket_materiaal = $installment_param['bracket'];
            $bracket_usdtosrd = $installment_arr['BRACKET'][$bracket_materiaal]['usd'] * $usd_to_srd;
            $bracket = $bracket_usdtosrd * $installment_arr['BRACKET'][$bracket_materiaal]['aantal'];
            $bracket_subtotal = $bracket * $oppervlakte_val;*/

            $installment_prijs_srd = $locatie_subtotal + $achtergrond_subtotal + $werkhoogte_subtotal ;
            $installment_prijs_usd = $installment_prijs_srd / $usd_to_srd ;
            $installment_prijs_euro = $installment_prijs_srd / $euro_to_srd;

            $installment_prijs_srd_tax = $installment_prijs_srd * 0.08;
            $installment_prijs_usd_tax = $installment_prijs_usd * 0.08;
            $installment_prijs_euro_tax = $installment_prijs_euro * 0.08;

            $installment_prijs_srd_subtotal = $installment_prijs_srd + $installment_prijs_srd_tax;
            $installment_prijs_usd_subtotal = $installment_prijs_usd + $installment_prijs_usd_tax;
            $installment_prijs_euro_subtotal = $installment_prijs_euro + $installment_prijs_euro_tax;

            $installment_return = [
                'srd' => [
                    'price' => $installment_prijs_srd,
                    'subtotal' => $installment_prijs_srd_subtotal,
                    'tax' => $installment_prijs_srd_tax
                ],
                'usd' => [
                    'price' => $installment_prijs_usd,
                    'subtotal' => $installment_prijs_usd_subtotal,
                    'tax' => $installment_prijs_usd_tax
                ],
                'euro' => [
                    'price' => $installment_prijs_euro,
                    'subtotal' => $installment_prijs_euro_subtotal,
                    'tax' => $installment_prijs_euro_tax
                ]
            ];

            $final_total = [
                'srd' => [
                    'price' => $prijs_srd + $installment_prijs_srd,
                    'total' => $prijs_srd_subtotal + $installment_prijs_srd_subtotal,
                    'tax' => $prijs_srd_tax + $installment_prijs_srd_tax
                ],
                'usd' => [
                    'price' => $prijs_usd + $installment_prijs_usd,
                    'total' => $prijs_usd_subtotal + $installment_prijs_usd_subtotal,
                    'tax' => $prijs_usd_tax + $installment_prijs_usd_tax
                ],
                'euro' => [
                    'price' => $prijs_euro + $installment_prijs_euro,
                    'total' => $prijs_euro_subtotal + $installment_prijs_euro_subtotal,
                    'tax' => $prijs_euro_tax + $installment_prijs_euro_tax
                ]
            ];
        }

        return array(
            'materiaal_amount'=>$material_return,
            'materiaal_list_details' => $materiaal_list,
            'installment_amount' => $installment_return,
            'final_amount' => $final_total
        );
    }
    /**
     * @param $n
     * @param int $x
     * @return float
     */
    public static function roundUpToAny($n,$x=5) {
        return (ceil($n)%$x === 0) ? ceil($n) : round(($n+$x/2)/$x)*$x;
    }



    /**
     * @param $number
     * @param int $denominator : 1 for ceil, 2 for .5, 3 for .333, 4 for .25, .5, .75
     * @return float
     */
    public static function floorToFraction($number, $denominator = 1)
    {
        $x = $number * $denominator;
        $x = ceil($x);
        $x = $x / $denominator;
        return $x;
    }

}