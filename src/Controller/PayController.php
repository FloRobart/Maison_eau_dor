<?php

namespace App\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Stripe\Stripe;

class PayController extends AbstractController
{
	private EntityManagerInterface $em;

	public function __construct(EntityManagerInterface $em)
	{
		$this->em = $em;
	}

	#[Route('/order/create-session-stripe', name: 'pay.stripe.checkout')]
	public function stripeCheckout(): RedirectResponse
	{

		Stripe::setApiKey('sk_test_51ONMaZG2UBG3DZO2CttNYXNE0fspQMIfQafk5BM1dqLOHnTiQW90Qb2ruH37d8ZO9HTWONsjLFnGg5ld7cGURqVW00jGcwgbI6');
		//header('Content-Type: application/json');

		$YOUR_DOMAIN = 'http://127.0.0.1:8000';
		

		$checkout_session = \Stripe\Checkout\Session::create([
			'line_items' => [[
				# Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
				'price' => '{{PRICE_ID}}',
				'quantity' => 1,
			]],
			'mode' => 'payment',
			'success_url' => $YOUR_DOMAIN . '/success.html',
			'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
		]);
	}
}
