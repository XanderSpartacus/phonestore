<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route('/produits', name: 'app_products')]
    public function index(): Response
    {
        $products = [
            [
                'id' => 1,
                'name' => 'iPhone 13 Pro',
                'image' => 'iphone-13-pro.jpg',
                'price' => 999.00,
                'brand' => 'Apple',
                'model' => 'iPhone 13'
            ],
            [
                'id' => 2,
                'name' => 'Samsung Galaxy S21',
                'image' => 'samsung-s21.jpg',
                'price' => 799.00,
                'brand' => 'Samsung',
                'model' => 'Galaxy S21'
            ],
            [
                'id' => 3,
                'name' => 'Google Pixel 6a',
                'image' => 'pixel-6a.jpg',
                'price' => 459.00,
                'brand' => 'Google',
                'model' => 'Pixel 6a'
            ]];

        return $this->render('product/index.html.twig', [
            'products' => $products
        ]);
    }
}
