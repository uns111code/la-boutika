<?php

namespace App\Controller;

use App\Entity\ProductImage;
use App\Form\ProductImageForm;
use App\Repository\ProductImageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/product/image')]
final class ProductImageController extends AbstractController
{
    #[Route(name: 'app_product_image_index', methods: ['GET'])]
    public function index(ProductImageRepository $productImageRepository): Response
    {
        return $this->render('product_image/index.html.twig', [
            'product_images' => $productImageRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_product_image_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $productImage = new ProductImage();
        $form = $this->createForm(ProductImageForm::class, $productImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($productImage);
            $entityManager->flush();

            return $this->redirectToRoute('app_product_image_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('product_image/new.html.twig', [
            'product_image' => $productImage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_product_image_show', methods: ['GET'])]
    public function show(ProductImage $productImage): Response
    {
        return $this->render('product_image/show.html.twig', [
            'product_image' => $productImage,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_product_image_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProductImage $productImage, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProductImageForm::class, $productImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_product_image_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('product_image/edit.html.twig', [
            'product_image' => $productImage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_product_image_delete', methods: ['POST'])]
    public function delete(Request $request, ProductImage $productImage, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productImage->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($productImage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_product_image_index', [], Response::HTTP_SEE_OTHER);
    }
}
