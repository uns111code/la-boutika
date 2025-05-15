<?php

namespace App\EventSubscriber;

use Twig\Environment;
use App\Repository\BrandRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class GlobalCategorySubscriber implements EventSubscriberInterface
{
    public function __construct(
        private CategoryRepository $categoryRepository,
        private BrandRepository $brandRepository,
        private Environment $twig
    ) {}

    public function onKernelController(ControllerEvent $event): void
    {
        $categories = $this->categoryRepository->findAll();
        $this->twig->addGlobal('categories', $categories);

        $brands = $this->brandRepository->findAll();
        $this->twig->addGlobal('brands', $brands);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
}
