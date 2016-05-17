<?php

namespace App\Helpers;

/**
 * Created by PhpStorm.
 * User: Selim Reza
 * Date: 30/3/15
 * Time: 5:19 PM
 */
use DB;
use App\Http\Controllers\Controller;

class Flat
{
    public static function calculation_3d($tekst, $letter_hoogte, $lengte_tekst, $mat_flat, $dikte, $installment_param = array()){
        $tekst = str_replace(' ', '', $tekst);
        $letter_length = strlen($tekst);

        $materiaal_list = null;

        // Define currency
        //$usd_to_srd = 5.5;
        $usd_to_srd = DB::table('currency')->where('title', 'US$')->pluck('value');
        //$euro_to_srd = 5.85;
        $euro_to_srd = DB::table('currency')->where('title', 'Euro')->pluck('value');

        // G4 Calculation
        if($mat_flat == 'aluconbond' && $dikte == 3){
            $acm_hd_mxmetal_hd_aantal = ChannelLetter::floorToFraction( (($letter_hoogte * $lengte_tekst) / 2.98), 4);
        }else{
            $acm_hd_mxmetal_hd_aantal = 0;
        }
        $acm_hd_mxmetal_hd_usd = 74 * 1.4;
        $acm_hd_mxmetal_hd_srd = $acm_hd_mxmetal_hd_usd * $usd_to_srd;
        $acm_hd_mxmetal_hd_subtotal = $acm_hd_mxmetal_hd_aantal * $acm_hd_mxmetal_hd_srd;
        if($acm_hd_mxmetal_hd_aantal > 0) {
            $materiaal_list [] = [
                'label' => 'ACM HD (MAXMetal HD)',
                'aantal' => $acm_hd_mxmetal_hd_aantal,
                'eenheid' => 'st'
            ];
        }


        // G5 calculation. it is only for front and front_back
        if($mat_flat == 'pvc_celtec' && $dikte == 3) {
            $pvc_platen_celtec_3_mm_aantal = ChannelLetter::floorToFraction((($letter_hoogte * $lengte_tekst) / 2.98), 4);
        }else{
            $pvc_platen_celtec_3_mm_aantal = 0;
        }
        $pvc_platen_celtec_3_mm_usd = 35;
        $pvc_platen_celtec_3_mm_srd = $pvc_platen_celtec_3_mm_usd * $usd_to_srd;
        $pvc_platen_celtec_3_mm_subtotal = $pvc_platen_celtec_3_mm_aantal * $pvc_platen_celtec_3_mm_srd;
        if($pvc_platen_celtec_3_mm_aantal > 0) {
            $materiaal_list [] = [
                'label' => 'PVC platen (celtec)               3 mm',
                'aantal' => $pvc_platen_celtec_3_mm_aantal,
                'eenheid' => 'st'
            ];
        }

        // G6 calculation. it is only for front and front_back
        if($mat_flat == 'pvc_celtec' && $dikte == 12) {
            $pvc_platen_celtec_12_mm_aantal = ChannelLetter::floorToFraction((($letter_hoogte * $lengte_tekst) / 2.98), 4);
        }else{
            $pvc_platen_celtec_12_mm_aantal = 0;
        }
        $pvc_platen_celtec_12_mm_usd = 4*35;
        $pvc_platen_celtec_12_mm_srd = $pvc_platen_celtec_12_mm_usd * $usd_to_srd;
        $pvc_platen_celtec_12_mm_subtotal = $pvc_platen_celtec_12_mm_aantal * $pvc_platen_celtec_12_mm_srd;
        if($pvc_platen_celtec_12_mm_aantal > 0) {
            $materiaal_list [] = [
                'label' => 'PVC platen (celtec)             12 mm',
                'aantal' => $pvc_platen_celtec_12_mm_aantal,
                'eenheid' => 'st'
            ];
        }

        // G13 calculation. it is only for front and front_back
        if($mat_flat == 'galvaan') {
            $galvaan_1__22m_x_2__44m_2_mm_aantal = ChannelLetter::floorToFraction((($letter_hoogte * $lengte_tekst) / 2.98), 4);
        }else{
            $galvaan_1__22m_x_2__44m_2_mm_aantal = 0;
        }
        $galvaan_1__22m_x_2__44m_2_mm_usd = 70.2454545454545;
        $galvaan_1__22m_x_2__44m_2_mm_srd = $galvaan_1__22m_x_2__44m_2_mm_usd * $usd_to_srd;
        $galvaan_1__22m_x_2__44m_2_mm_subtotal = $galvaan_1__22m_x_2__44m_2_mm_aantal * $galvaan_1__22m_x_2__44m_2_mm_srd;
        if($galvaan_1__22m_x_2__44m_2_mm_aantal > 0) {
            $materiaal_list [] = [
                'label' => 'galvaan 1.22m x 2.44m          2 mm',
                'aantal' => $galvaan_1__22m_x_2__44m_2_mm_aantal,
                'eenheid' => 'st'
            ];
        }

        // G15 calculation. it is only for front and front_back
        if($mat_flat == 'alluminium' && $dikte == 2) {
            $aluminium_1__22_x_2__44m__2mm_aantal = ChannelLetter::floorToFraction((($letter_hoogte * $lengte_tekst) / 2.98), 4);
        }else{
            $aluminium_1__22_x_2__44m__2mm_aantal = 0;
        }
        $aluminium_1__22_x_2__44m__2mm_usd = 81.818181818181818181818181818182;
        $aluminium_1__22_x_2__44m__2mm_srd = $aluminium_1__22_x_2__44m__2mm_usd * $usd_to_srd;
        $aluminium_1__22_x_2__44m__2mm_subtotal = $aluminium_1__22_x_2__44m__2mm_aantal * $aluminium_1__22_x_2__44m__2mm_srd;
        if($aluminium_1__22_x_2__44m__2mm_aantal > 0) {
            $materiaal_list [] = [
                'label' => 'aluminium 1.22 x 2.44m    2mm',
                'aantal' => $aluminium_1__22_x_2__44m__2mm_aantal,
                'eenheid' => 'st'
            ];
        }

        // G17 calculation. it is only for front and front_back
        if($mat_flat == 'zwart_staal' && $dikte == 4) {
            $zwart_staal_1__22m_x_2__44m_4_mm_aantal = ChannelLetter::floorToFraction((($letter_hoogte * $lengte_tekst) / 2.98), 4);
        }else{
            $zwart_staal_1__22m_x_2__44m_4_mm_aantal = 0;
        }
        $zwart_staal_1__22m_x_2__44m_4_mm_usd = 157.14;
        $zwart_staal_1__22m_x_2__44m_4_mm_srd = $zwart_staal_1__22m_x_2__44m_4_mm_usd * $usd_to_srd;
        $zwart_staal_1__22m_x_2__44m_4_mm_subtotal = $zwart_staal_1__22m_x_2__44m_4_mm_aantal * $zwart_staal_1__22m_x_2__44m_4_mm_srd;
        if($zwart_staal_1__22m_x_2__44m_4_mm_aantal > 0) {
            $materiaal_list [] = [
                'label' => 'zwart staal 1.22m x 2.44m    4 mm',
                'aantal' => $zwart_staal_1__22m_x_2__44m_4_mm_aantal,
                'eenheid' => 'st'
            ];
        }

        // G20 calculation. it is only for front and front_back
        if($mat_flat == 'zwart_staal' && $dikte == 10) {
            $zwart_staal_1__25m_x_2__50m_10_mm_aantal = ChannelLetter::floorToFraction((($letter_hoogte * $lengte_tekst) / 2.98), 4);
        }else{
            $zwart_staal_1__25m_x_2__50m_10_mm_aantal = 0;
        }
        $zwart_staal_1__25m_x_2__50m_10_mm_usd = 405.71;
        $zwart_staal_1__25m_x_2__50m_10_mm_srd = $zwart_staal_1__25m_x_2__50m_10_mm_usd * $usd_to_srd;
        $zwart_staal_1__25m_x_2__50m_10_mm_subtotal = $zwart_staal_1__25m_x_2__50m_10_mm_aantal * $zwart_staal_1__25m_x_2__50m_10_mm_srd;
        if($zwart_staal_1__25m_x_2__50m_10_mm_aantal > 0) {
            $materiaal_list [] = [
                'label' => 'zwart staal 1.25m x 2.50m  10 mm',
                'aantal' => $zwart_staal_1__25m_x_2__50m_10_mm_aantal,
                'eenheid' => 'st'
            ];
        }

        $materiaal_subtotal = $acm_hd_mxmetal_hd_subtotal+ $pvc_platen_celtec_3_mm_subtotal + $pvc_platen_celtec_12_mm_subtotal +
            $galvaan_1__22m_x_2__44m_2_mm_subtotal + $aluminium_1__22_x_2__44m__2mm_subtotal + $zwart_staal_1__22m_x_2__44m_4_mm_subtotal +
            $zwart_staal_1__25m_x_2__50m_10_mm_subtotal;


        $sticker_subtotal = 0;

        $afwerken_subtotal = 0;

        $transport_subtotal = 0;

        // G 152 calculation.
        $volwas_subtotal = 0;

        // G 153 calculation
        $c_30 = 0;
        $halfwas_aantal = ceil($c_30 / 3);
        $halfwas_usd =  5.15;
        $halfwas_srd = $halfwas_usd * $usd_to_srd;
        $halfwas_subtotal = $halfwas_aantal * $halfwas_srd;
        if($halfwas_aantal > 0) {
            $materiaal_list [] = [
                'label' => 'halfwas',
                'aantal' => $halfwas_aantal,
                'eenheid' => 'uren'
            ];
        }

        // G 154 calculation
        $handlanger_aantal = ceil($c_30 / 3);
        $handlanger_usd =  4.15;
        $handlanger_srd = $handlanger_usd * $usd_to_srd;
        $handlanger_subtotal = $handlanger_aantal * $handlanger_srd;
        if($handlanger_aantal > 0) {
            $materiaal_list [] = [
                'label' => 'handlanger',
                'aantal' => $handlanger_aantal,
                'eenheid' => 'uren'
            ];
        }


        $arbeid_subtotal = $volwas_subtotal + $halfwas_subtotal + $handlanger_subtotal;

        // G 157 calculation
        $plasma_subtotal = 0;

        // G 158 calculation
        $router_aantal = ($acm_hd_mxmetal_hd_aantal + $pvc_platen_celtec_3_mm_aantal + $pvc_platen_celtec_12_mm_aantal +
                $galvaan_1__22m_x_2__44m_2_mm_aantal + $aluminium_1__22_x_2__44m__2mm_aantal + $zwart_staal_1__22m_x_2__44m_4_mm_aantal +
                $zwart_staal_1__25m_x_2__50m_10_mm_aantal) * 2;
        $router_usd =  20;
        $router_srd = $router_usd * $usd_to_srd;
        $router_subtotal = $router_aantal * $router_srd;
        if($router_aantal > 0) {
            $materiaal_list [] = [
                'label' => 'router',
                'aantal' => $router_aantal,
                'eenheid' => 'uren'
            ];
        }

        // G 159 calculation
        $accubend_subtotal = 0;

        $machine_subtotal = $plasma_subtotal + $router_subtotal + $accubend_subtotal;

        $materiaal = $materiaal_subtotal + $materiaal_subtotal * 0.20;
        $sticker = $sticker_subtotal + $sticker_subtotal * 0.00;
        $afwerken = $afwerken_subtotal + $afwerken_subtotal * 0.20;
        $transport = $transport_subtotal + $transport_subtotal * 0.30;
        $arbeid = $arbeid_subtotal + $arbeid_subtotal * 1.00;
        $machine = $machine_subtotal + $machine_subtotal * 0.30;
        $subtotal = $materiaal + $sticker + $afwerken + $transport + $arbeid + $machine;

        $winst = $subtotal * 0.20;
        $onvoorzien = $subtotal * 0.10;
        $moeilijkheidsgraad = $subtotal * 0.00;
        $totaal = ceil($subtotal + $winst + $onvoorzien + $moeilijkheidsgraad);

        // Calculations for show
        $prijs_srd = $totaal;
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
            $achtergrond_subtotal = $achtergrond * $letter_length;

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
                $werkhoogte_subtotal = $werkhoogte * $letter_length;
            }else {
                $werkhoogte_usdtosrd = $installment_arr['WERKHOOGTE'][$werkhoogte_materiaal]['usd'] * $usd_to_srd;
                $werkhoogte = $werkhoogte_usdtosrd * $installment_arr['WERKHOOGTE'][$werkhoogte_materiaal]['aantal'];
                $werkhoogte_subtotal = $werkhoogte * $letter_length;
            }

            $bracket_materiaal = $installment_param['bracket'];
            $bracket_usdtosrd = $installment_arr['BRACKET'][$bracket_materiaal]['usd'] * $usd_to_srd;
            $bracket = $bracket_usdtosrd * $installment_arr['BRACKET'][$bracket_materiaal]['aantal'];
            $bracket_subtotal = $bracket * $letter_length;

            $installment_prijs_srd = $locatie_subtotal + $achtergrond_subtotal + $werkhoogte_subtotal + $bracket_subtotal;
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
            'materiaal_amount' => $material_return,
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