<?php

namespace App\Command;

use App\Entity\WashStation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(
    name: 'app:add-wash-stations',
    description: 'Cette commande permet de récupérer les stations de lavage depuis l\'API de Google Maps',
)]
class GetWashingStationsCommand extends Command
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly HttpClientInterface $client
    ) {
        parent::__construct();
    }

    /**
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $progressBar = $io->createProgressBar();

        $nextPageToken = null;
        do {
            $query = [
                'location' => $_ENV['COORDINATES_API'],
                'radius' => $_ENV['RADIUS_API'],
                'type' => 'car_wash',
                'key' => $_ENV['GOOGLE_API_KEY'],
            ];

            if ($nextPageToken) {
                $query['pagetoken'] = $nextPageToken;
            }

            $response = $this->client->request('GET', 'https://maps.googleapis.com/maps/api/place/nearbysearch/json', [
                'query' => $query,
            ]);

            $data = $response->toArray();

            foreach ($data['results'] as $result) {
                $existingStation = $this->em->getRepository(WashStation::class)->findOneBy([
                    'name' => $result['name'],
                    'address' => $result['vicinity'],
                    'latitude' => $result['geometry']['location']['lat'],
                    'longitude' => $result['geometry']['location']['lng'],
                ]);

                if (!$existingStation instanceof WashStation) {
                    $washStation = new WashStation();
                    $washStation->setName($result['name']);
                    $washStation->setAddress($result['vicinity']);
                    $washStation->setLatitude($result['geometry']['location']['lat']);
                    $washStation->setLongitude($result['geometry']['location']['lng']);

                    $this->em->persist($washStation);
                    $progressBar->advance();
                }
            }

            $this->em->flush();

            $nextPageToken = $data['next_page_token'] ?? null;

            if ($nextPageToken) {
                sleep(2);
            }
        } while ($nextPageToken);

        $progressBar->finish();

        $io->success('Les stations de lavage ont été récupérées avec succès !');

        return Command::SUCCESS;
    }
}
