<?php

namespace App\Controller;

use App\Entity\Produit;
use Composer\Util\Http\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Stripe\Stripe;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Controller\PanierController;

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

		return new SymfonyResponse($this->render('base_pay.html.twig', [
			//'payments' => $payments,
		]));
	}

	#[Route('/create-session-stripe', name: 'pay_stripe_checkout')]
	public function stripeCheckout(Request $request): RedirectResponse
	{

		$productStripe = [];
		$product = $this->em->getRepository(Produit::class)->find($request->query->get('prodId'));

		//Prend les produits de la commande et les ajoute dans un tableau
			$productStripe[] = [
				'price_data' => [
					'currency' => 'eur',
					'unit_amount' => $product->getPrixProduit() * 100,
					'product_data' => [
						'name' => $product->getTitreProduit(),
					],
				],
				'quantity' => 1,
			];

		//Ajoute les frais de port dans le tableau

		//header('Content-Type: application/json');
		$YOUR_DOMAIN = 'http://127.0.0.1:8000';

		Stripe::setApiKey($this->getParameter('stripe.api_key'));

		$checkout_session = \Stripe\Checkout\Session::create([
			'customer_email' => $this->getUser(),
			'payment_method_types' => ['card'],
			'line_items' => [[
				# Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
				$productStripe
			]],
			'mode' => 'payment',
			'success_url' => $YOUR_DOMAIN . '/success',
			'cancel_url' => $YOUR_DOMAIN . '/failure',
		]);

		return new RedirectResponse($checkout_session->url);
	}

	#[Route('/create-session-stripe-cart', name: 'pay_stripe_checkout_cart')]
	public function stripeCheckoutCart(Request $request): RedirectResponse
	{
		$data = json_decode($request->getContent(), true);
		$idsDuPanier = $data['idsPanier'];
		$productStripe = [];

		$products = $this->em->getRepository(Produit::class)->findBy(['id' => $idsDuPanier]);
		
		foreach ($products as $product) {
			$productStripe[] = [
				'price_data' => [
					'currency' => 'eur',
					'unit_amount' => $product->getPrixProduit() * 100,
					'product_data' => [
						'name' => $product->getTitreProduit(),
					],
				],
				'quantity' => 1,

			];

		//Prend les produits de la commande et les ajoute dans un tableau

		//Ajoute les frais de port dans le tableau

		//header('Content-Type: application/json');
		$YOUR_DOMAIN = 'http://127.0.0.1:8000';

		Stripe::setApiKey($this->getParameter('stripe.api_key'));

		$productStripe[] = [
			'price_data' => [
				'currency' => 'eur',
				'unit_amount' => 0,
				'product_data' => [
					'name' => "Frais de port",
				],
			],
			'quantity' => 1,
		];

		$checkout_session = \Stripe\Checkout\Session::create([
			'customer_email' => $this->getUser(),
			'payment_method_types' => ['card'],
			'line_items' => [[
				# Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
				$productStripe
			]],
			'mode' => 'payment',
			'success_url' => $YOUR_DOMAIN . '/success',
			'cancel_url' => $YOUR_DOMAIN . '/failure',
		]);

		$responce = new RedirectResponse($checkout_session->url);
		$responce->headers->set('Access-Control-Allow-Origin', '*');

		return $responce;
	}

	#[Route('/success', name: 'success_stripe')]
	public function StripeSuccess(): SymfonyResponse
	{
		return $this->render('paySuccess.html.twig');
	}

	#[Route('/failure', name: 'failure_stripe')]
	public function StripeFailure(): SymfonyResponse
	{
		return $this->render('payFailure.html.twig');
	}

	#[Route('/test-session-stripe', name: 'pay_stripe_checkouttest')]
	public function stripeCheckoutTest(Request $request): RedirectResponse
	{
		//header('Content-Type: application/json');
		$YOUR_DOMAIN = 'http://127.0.0.1:8000';
		$prodId = $request->query->get('prodId');
		$productStripe = [];
		$tempProductStripe = [];

		/*//TODO: get product from database
		$order = null;*/

		//TODO: change redirect route when cart is created
		/*if (!$order) {
			return $this->redirectToRoute('cart.index');
		}*/
		//TODO: change values when database is created
		//Prend les produits de la commande et les ajoute dans un tableau
		
			$tempProductStripe[] = [
				'price_data' => [
					'currency' => 'eur',
					'unit_amount' => 30 * 100,
					'product_data' => [
						'name' => "Ahlam",
					],
				],
				'quantity' => 1,
			];

			$tempProductStripe[] = [
				'price_data' => [
					'currency' => 'eur',
					'unit_amount' => 30 * 100,
					'product_data' => [
						'name' => "Magic Aïsha"
					],
				],
				'quantity' => 1,
			];

			$tempProductStripe[] = [
				'price_data' => [
					'currency' => 'eur',
					'unit_amount' => 30 * 100,
					'product_data' => [
						'name' => "Suprème Flower"
					],
				],
				'quantity' => 1,
			];

			$tempProductStripe[] = [
				'price_data' => [
					'currency' => 'eur',
					'unit_amount' => 30 * 100,
					'product_data' => [
						'name' => "Mula Rouge"
					],
				],
				'quantity' => 1,
			];

			$tempProductStripe[] = [
				'price_data' => [
					'currency' => 'eur',
					'unit_amount' => 35 * 100,
					'product_data' => [
						'name' => "Bali"
					],
				],
				'quantity' => 1,
			];

			$tempProductStripe[] = [
				'price_data' => [
					'currency' => 'eur',
					'unit_amount' => 35 * 100,
					'product_data' => [
						'name' => "California"
					],
				],
				'quantity' => 1,
			];
		

		//Ajoute les frais de port dans le tableau
		$productStripe[] = $tempProductStripe[$prodId];

		Stripe::setApiKey($this->getParameter('stripe.api_key'));

		$checkout_session = \Stripe\Checkout\Session::create([
			'customer_email' => $this->getUser(),
			'payment_method_types' => ['card','link'],
			'line_items' => [[
				# Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
				$productStripe
			]],
			'mode' => 'payment',
			'success_url' => $YOUR_DOMAIN . '/success',
			'cancel_url' => $YOUR_DOMAIN . '/failure',
		]);

		return new RedirectResponse($checkout_session->url);
	}
}
