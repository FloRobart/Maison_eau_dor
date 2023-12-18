<?php

namespace App\Controller;

use Composer\Util\Http\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Stripe\Stripe;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class PayController extends AbstractController
{
	private EntityManagerInterface $em;

	public function __construct(EntityManagerInterface $em)
	{
		$this->em = $em;
	}

	#[Route('/payment', name: 'payment_list')]
	public function index(): SymfonyResponse
	{
		//$payments = $this->em->getRepository(Payment::class)->findAll();

		return new SymfonyResponse($this->render('payment/index.html.twig', [
			//'payments' => $payments,
		]));
	}

	#[Route('/create-session-stripe', name: 'pay.stripe.checkout')]
	public function stripeCheckout(): RedirectResponse
	{

		$productStripe = [];

		//TODO: get product from database
		$order = null;

		//TODO: change redirect route when cart is created
		if (!$order) {
			return $this->redirectToRoute('cart.index');
		}
		//TODO: change values when database is created
		//Prend les produits de la commande et les ajoute dans un tableau
		foreach ($order->getRecapDetails()->getValues() as $product) {
			$productStripe[] = [
				'price_data' => [
					'currency' => 'eur',
					'unit_amount' => $product->getProduct()->getPrice() * 100,
					'product_data' => [
						'name' => $product->getProduct()->getName(),
						'images' => [$product->getProduct()->getIllustration()],
					],
				],
				'quantity' => $product->getQuantity(),
			];
		}

		//Ajoute les frais de port dans le tableau
		$productStripe[] = [
			'price_data' => [
				'currency' => 'eur',
				'unit_amount' => $order->getCarrierPrice() * 100,
				'product_data' => [
					'name' => $order->getCarrierName(),
					'images' => [$order->getCarrierImg()],
				],
			],
			'quantity' => 1,
		];

		//header('Content-Type: application/json');
		$YOUR_DOMAIN = 'http://127.0.0.1:8000';

		Stripe::setApiKey('sk_test_51ONMaZG2UBG3DZO2CttNYXNE0fspQMIfQafk5BM1dqLOHnTiQW90Qb2ruH37d8ZO9HTWONsjLFnGg5ld7cGURqVW00jGcwgbI6');

		$checkout_session = \Stripe\Checkout\Session::create([
			'customer_email' => $this->getUser(),
			'payment_method_types' => ['card'],
			'line_items' => [[
				# Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
				'price' => '{{PRICE_ID}}',
				'quantity' => 1,
			]],
			'mode' => 'payment',
			'success_url' => $YOUR_DOMAIN . '/success.html',
			'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
		]);

		return new RedirectResponse($checkout_session->url);
	}

	#[Route('/success', name: 'pay.stripe.checkout')]
	public function StripeSuccess(): RedirectResponse
	{
		return $this->render('paySuccess.html.twig');
	}

	#[Route('/failure', name: 'pay.stripe.checkout')]
	public function StripeFailure(): RedirectResponse
	{
		return $this->render('payFailure.html.twig');
	}
}
