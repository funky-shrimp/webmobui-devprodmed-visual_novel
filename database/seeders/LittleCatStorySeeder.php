<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Story;
use App\Models\Chapter;
use App\Models\Choice;

class LittleCatStorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer l'histoire principale
        $story = Story::create([
            'title' => 'Le petit chat dans le champ',
            'summary' => 'Le périple d’un petit chat qui cherche une bière dans un champ de pâquerettes.',
        ]);

        // Créer les chapitres
        $chapters = [
            1 => Chapter::create([
                'title' => 'Un matin dans le champ',
                'content' => 'Le petit chat se réveille dans un champ de pâquerettes. Il entend parler d’une bière cachée quelque part. Il aperçoit des papillons, une vieille souche d’arbre et un sentier ombragé.',
                'story_id' => $story->id,
                'start' => true, // C'est le chapitre de départ
            ]),

            2 => Chapter::create([
                'title' => 'Le ruisseau',
                'content' => 'Le petit chat arrive près d’un ruisseau. L’eau scintille et il voit des poissons nager. Trois options se présentent : traverser le ruisseau, le suivre ou se désaltérer.',
                'story_id' => $story->id,
                'start' => false,
            ]),

            3 => Chapter::create([
                'title' => 'La clairière mystérieuse',
                'content' => 'En traversant le ruisseau, le chat découvre une clairière. Une odeur étrange de houblon emplit l’air. Au centre, une cachette semble renfermer un trésor.',
                'story_id' => $story->id,
                'start' => false,
            ]),

            4 => Chapter::create([
                'title' => 'La bière retrouvée',
                'content' => 'Le petit chat trouve une bouteille de bière derrière une vieille souche d’arbre. Une étiquette indique "Bièrélion : pour chats courageux".',
                'story_id' => $story->id,
                'start' => false,
            ]),

            5 => Chapter::create([
                'title' => 'Le chat partageur',
                'content' => 'Le petit chat partage la bière avec ses amis félins. Une fête improvisée commence dans le champ de pâquerettes.',
                'story_id' => $story->id,
                'start' => false,
            ]),

            6 => Chapter::create([
                'title' => 'Un doux repos',
                'content' => 'Le petit chat décide de savourer sa bière seul et s’endort paisiblement sous la souche.',
                'story_id' => $story->id,
                'start' => false,
            ]),
        ];

        // Ajouter les choix pour chaque chapitre
        // Chapitre 1
        Choice::create([
            'text' => 'Suivre les papillons.',
            'chapter_id' => $chapters[1]->id,
            'next_chapter_id' => $chapters[2]->id,
        ]);
        Choice::create([
            'text' => 'Explorer la vieille souche.',
            'chapter_id' => $chapters[1]->id,
            'next_chapter_id' => $chapters[4]->id,
        ]);
        Choice::create([
            'text' => 'Prendre le sentier ombragé.',
            'chapter_id' => $chapters[1]->id,
            'next_chapter_id' => $chapters[3]->id,
        ]);

        // Chapitre 2
        Choice::create([
            'text' => 'Traverser le ruisseau.',
            'chapter_id' => $chapters[2]->id,
            'next_chapter_id' => $chapters[3]->id,
        ]);
        Choice::create([
            'text' => 'Suivre le ruisseau.',
            'chapter_id' => $chapters[2]->id,
            'next_chapter_id' => $chapters[4]->id,
        ]);
        Choice::create([
            'text' => 'Se désaltérer et faire demi-tour.',
            'chapter_id' => $chapters[2]->id,
            'next_chapter_id' => null, // Fin de l’histoire ici
        ]);

        // Chapitre 3
        Choice::create([
            'text' => 'Inspecter la cachette.',
            'chapter_id' => $chapters[3]->id,
            'next_chapter_id' => $chapters[4]->id,
        ]);
        Choice::create([
            'text' => 'Se reposer dans la clairière.',
            'chapter_id' => $chapters[3]->id,
            'next_chapter_id' => $chapters[6]->id,
        ]);
        Choice::create([
            'text' => 'Retourner au champ de pâquerettes.',
            'chapter_id' => $chapters[3]->id,
            'next_chapter_id' => null, // Fin de l’histoire ici
        ]);

        // Chapitre 4
        Choice::create([
            'text' => 'Boire la bière.',
            'chapter_id' => $chapters[4]->id,
            'next_chapter_id' => $chapters[6]->id,
        ]);
        Choice::create([
            'text' => 'Partager la bière avec des amis.',
            'chapter_id' => $chapters[4]->id,
            'next_chapter_id' => $chapters[5]->id,
        ]);
        Choice::create([
            'text' => 'Cacher la bière pour plus tard.',
            'chapter_id' => $chapters[4]->id,
            'next_chapter_id' => null, // Fin de l’histoire ici
        ]);

        // Chapitre 5
        Choice::create([
            'text' => 'Danser avec les autres chats.',
            'chapter_id' => $chapters[5]->id,
            'next_chapter_id' => null, // Fin de l’histoire ici
        ]);
        Choice::create([
            'text' => 'Raconter son aventure.',
            'chapter_id' => $chapters[5]->id,
            'next_chapter_id' => null, // Fin de l’histoire ici
        ]);
        Choice::create([
            'text' => 'Faire une sieste après la fête.',
            'chapter_id' => $chapters[5]->id,
            'next_chapter_id' => $chapters[6]->id,
        ]);

        // Chapitre 6
        Choice::create([
            'text' => 'Dormir profondément.',
            'chapter_id' => $chapters[6]->id,
            'next_chapter_id' => null, // Fin de l’histoire ici
        ]);
        Choice::create([
            'text' => 'Rêver d’autres aventures.',
            'chapter_id' => $chapters[6]->id,
            'next_chapter_id' => null, // Fin de l’histoire ici
        ]);
        Choice::create([
            'text' => 'Se réveiller avec de nouvelles idées.',
            'chapter_id' => $chapters[6]->id,
            'next_chapter_id' => null, // Fin de l’histoire ici
        ]);
    }
}
