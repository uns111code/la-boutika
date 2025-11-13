<?php 
namespace App\Service;

use App\Entity\Product;
use App\Entity\ShoppingCart;
use App\Entity\ShoppingCartProduct;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class ShoppingCartService
{
    public function __construct(private EntityManagerInterface $em) {}

    public function getOrCreateCart(User $user): ShoppingCart
    {
        $cart = $this->em->getRepository(ShoppingCart::class)->findOneBy(['user' => $user]);

        if (!$cart) {
            $cart = new ShoppingCart();
            $cart->setUser($user);
            $cart->setCreatedAt(new \DateTimeImmutable());

            $this->em->persist($cart);
            $this->em->flush();
        }

        return $cart;
    }

    public function addProductToCart(Product $product, User $user): void
    {
        $cart = $this->getOrCreateCart($user);

        $cartItem = $this->em->getRepository(ShoppingCartProduct::class)
            ->findOneBy([
                'shoppingCart' => $cart,
                'product' => $product
            ]);

        if (!$cartItem) {
            $cartItem = new ShoppingCartProduct();
            $cartItem->setShoppingCart($cart);
            $cartItem->setProduct($product);
            $cartItem->setQuantity(1);
        } else {
            $cartItem->setQuantity($cartItem->getQuantity() + 1);
        }

        $this->em->persist($cartItem);
        $this->em->flush();
    }

    public function getCartItemCount(User $user): int
{
    $cart = $this->getOrCreateCart($user);
    $count = 0;

    foreach ($cart->getShoppingCartProducts() as $item) {
        $count += $item->getQuantity();
    }

    return $count;
}
}
