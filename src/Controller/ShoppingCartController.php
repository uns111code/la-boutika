<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\ShoppingCartService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ShoppingCartController extends AbstractController
{
    #[Route('/panier/ajouter/{id}', name: 'shopping_cart_add', methods: ['POST'])]
    public function addToCart(
        Product $product,
        ShoppingCartService $shoppingCartService,
        UserInterface $user
    ): JsonResponse {
        $shoppingCartService->addProductToCart($product, $user);

        return new JsonResponse([
            'success' => true,
            'message' => '✅ Produit ajouté au panier !',
        ]);
    }
    #[Route('/panier', name: 'shopping_cart_index')]
    public function index(ShoppingCartService $shoppingCartService, UserInterface $user): Response
    {
        $cart = $shoppingCartService->getOrCreateCart($user);
        $items = $cart->getShoppingCartProducts(); // ou $cart->getItems() selon ton nom

        return $this->render('shopping_cart/index.html.twig', [
            'cart' => $cart,
            'items' => $items,
        ]);
    }

    #[Route('/panier/compteur', name: 'shopping_cart_count', methods: ['GET'])]
    public function getCartCount(ShoppingCartService $shoppingCartService, UserInterface $user): JsonResponse
    {
        $count = $shoppingCartService->getCartItemCount($user);

        return new JsonResponse(['count' => $count]);
    }

    // #[Route('/panier/supprimer/{id}', name: 'shopping_cart_remove')]
    // public function removeFromCart(
    //     Product $product,
    //     ShoppingCartService $shoppingCartService,
    //     UserInterface $user
    // ): Response {
    //     $shoppingCartService->removeProductFromCart($product, $user);

    //     return $this->redirectToRoute('shopping_cart_index');
    // }
}




// Response {
//         // Ajouter le produit au panier
//         $shoppingCartService->addProductToCart($product, $user);

//         // Ajouter un message flash de succès
//         $this->addFlash('success', '✅ Produit ajouté au panier !');

//         // Rediriger vers la page du produit
//         return $this->redirectToRoute('app_product_show', [
//             'id' => $product->getId(),
//         ]);
//     }