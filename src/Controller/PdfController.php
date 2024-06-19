<?php

namespace App\Controller;

use App\Entity\Entity;
use App\Entity\Manufacturer;
use App\Entity\Model;
use App\Entity\Port;
use App\Service\PdfGenerator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class PdfController extends AbstractController
{
    private PdfGenerator $pdfGenerator;
    private NormalizerInterface $normalizer;

    public function __construct(PdfGenerator $pdfGenerator, NormalizerInterface $normalizer)
    {
        $this->pdfGenerator = $pdfGenerator;
        $this->normalizer = $normalizer;
    }

    #[Route('/ports/pdf', name: 'ports_pdf', methods: ['GET'])]
    public function downloadAllPortsPdf(EntityManagerInterface $entityManager): Response
    {
        return $this->downloadEntitiesPdf($entityManager, Port::class, 'pdf/ports.html.twig', 'ports.pdf');
    }

    #[Route('/models/pdf', name: 'models_pdf', methods: ['GET'])]
    public function downloadAllModelsPdf(EntityManagerInterface $entityManager): Response
    {
        return $this->downloadEntitiesPdf($entityManager, Model::class, 'pdf/models.html.twig', 'models.pdf');
    }

    #[Route('/manufacturers/pdf', name: 'manufacturers_pdf', methods: ['GET'])]
    public function downloadAllManufacturersPdf(EntityManagerInterface $entityManager): Response
    {
        return $this->downloadEntitiesPdf($entityManager, Manufacturer::class, 'pdf/manufacturers.html.twig', 'manufacturers.pdf');
    }

    #[Route('/entities/pdf', name: 'entities_pdf', methods: ['GET'])]
    public function downloadAllEntitiesPdf(EntityManagerInterface $entityManager): Response
    {
        return $this->downloadEntitiesPdf($entityManager, Entity::class, 'pdf/entities.html.twig', 'entities.pdf');
    }

    private function downloadEntitiesPdf(EntityManagerInterface $entityManager, string $class, string $template, string $filename): Response
{
    $entities = $entityManager->getRepository($class)->findAll();
    if (!$entities) {
        throw $this->createNotFoundException('No entities found');
    }

    // Normaliser les entités sans spécifier de groupes
    $normalizedEntities = $this->normalizer->normalize($entities);

    $pdfContent = $this->pdfGenerator->generatePdf($template, ['entities' => $normalizedEntities]);

    return new Response($pdfContent, 200, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'attachment; filename="'.$filename.'"',
    ]);
}
}
