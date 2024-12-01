<?php

namespace App\Controller;

use App\Repository\SongRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class SongController extends AbstractController
{
    public function __construct(
        private SongRepository $songRepository
    ) {}

    #[Route('/artist/{artistId}/album/{albumId}/song/{songId}', 
        name: 'get_specific_song', 
        methods: ['GET']
    )]
    public function getSpecificSong(int $artistId, int $albumId, int $songId): JsonResponse
    {
        $song = $this->songRepository->find($songId);
        
        if (!$song || 
            $song->getAlbum()->getId() !== $albumId || 
            $song->getAlbum()->getArtist()->getId() !== $artistId
        ) {
            throw $this->createNotFoundException('Chanson non trouvée ou chemin invalide');
        }

        return $this->json($song, 200, [], ['groups' => 'song:read']);
    }
} 