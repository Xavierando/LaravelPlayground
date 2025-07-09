<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Service = [
            [
                'title' => 'Massaggio Antistress',
                'description' => 'ideale per chi cerca sollievo dalle tensioni quotidiane. Con tecniche dolci e ritmiche, riduce il cortisolo e aumenta le endorfine, promuovendo un profondo rilassamento. Utilizza oli essenziali per nutrire la pelle e migliorare il benessere generale, regalando una sensazione di pace e tranquillità.',
                'timerange' => 5400,
                'price' => '30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Massaggio Linfodrenante Olistico',
                'description' => "stimola il sistema linfatico, favorendo l 'eliminazione di tossine e liquidi in eccesso. Con movimenti leggeri e ritmici, riduce gonfiore e ritenzione idrica, rafforzando il sistema immunitario. L'approccio olistico considera corpo, mente ed energia, promuovendo un benessere completo e armonioso.",
                'timerange' => 5400,
                'price' => '30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Massaggio Lomi Lomi',
                'description' => "originario delle Hawaii, utilizza movimenti fluidi e ritmici con gomiti e avambracci. Basato sulla filosofia dell'Aloha, promuove l'armonia tra corpo, mente e spirito. Con oli naturali e musica tradizionale, offre un'esperienza rigenerante e spirituale, ideale per chi cerca rilassamento profondo e connessione interiore.",
                'timerange' => 3600,
                'price' => '30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Swedish Massage',
                'description' => 'A gentle, full-body massage designed to relax muscles and improve circulation. Uses long strokes, kneading, and deep circular movements to ease tension and promote overall well-being.',
                'timerange' => 3600,
                'price' => '30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Deep Tissue Massage',
                'description' => 'Focuses on deeper layers of muscle and connective tissue. Ideal for chronic aches and pain, it uses slower strokes and more intense pressure to target specific areas of tension.',
                'timerange' => 3600,
                'price' => '30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Hot Stone Massage',
                'description' => 'Smooth, heated stones are placed on specific parts of the body to warm and relax muscles. The therapist may also hold the stones and use them to apply gentle pressure.',
                'timerange' => 3600,
                'price' => '30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        //Service::insert($Service);
        Service::Factory(9)->create();
    }
}
