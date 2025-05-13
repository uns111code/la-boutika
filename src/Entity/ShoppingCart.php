<?php

namespace App\Entity;

use App\Repository\ShoppingCartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShoppingCartRepository::class)]
class ShoppingCart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;



    /**
     * @var Collection<int, ShoppingCartProduct>
     */
    #[ORM\OneToMany(targetEntity: ShoppingCartProduct::class, mappedBy: 'shoppingCart')]
    private Collection $shoppingCartProducts;

    #[ORM\OneToOne(inversedBy: 'shoppingCart', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    public function __construct()
    {
        $this->shoppingCartProducts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }



    /**
     * @return Collection<int, ShoppingCartProduct>
     */
    public function getShoppingCartProducts(): Collection
    {
        return $this->shoppingCartProducts;
    }

    public function addShoppingCartProduct(ShoppingCartProduct $shoppingCartProduct): static
    {
        if (!$this->shoppingCartProducts->contains($shoppingCartProduct)) {
            $this->shoppingCartProducts->add($shoppingCartProduct);
            $shoppingCartProduct->setShoppingCart($this);
        }

        return $this;
    }

    public function removeShoppingCartProduct(ShoppingCartProduct $shoppingCartProduct): static
    {
        if ($this->shoppingCartProducts->removeElement($shoppingCartProduct)) {
            // set the owning side to null (unless already changed)
            if ($shoppingCartProduct->getShoppingCart() === $this) {
                $shoppingCartProduct->setShoppingCart(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
