<?php

// File generated from our OpenAPI spec

namespace Epayco;

/**
 * Client used to send requests to Epayco's API.
 *
 * @property \Epayco\Service\AccountLinkService $accountLinks
 * @property \Epayco\Service\AccountService $accounts
 * @property \Epayco\Service\ApplePayDomainService $applePayDomains
 * @property \Epayco\Service\ApplicationFeeService $applicationFees
 * @property \Epayco\Service\BalanceService $balance
 * @property \Epayco\Service\BalanceTransactionService $balanceTransactions
 * @property \Epayco\Service\BillingPortal\BillingPortalServiceFactory $billingPortal
 * @property \Epayco\Service\ChargeService $charges
 * @property \Epayco\Service\Checkout\CheckoutServiceFactory $checkout
 * @property \Epayco\Service\CountrySpecService $countrySpecs
 * @property \Epayco\Service\CouponService $coupons
 * @property \Epayco\Service\CreditNoteService $creditNotes
 * @property \Epayco\Service\CustomerService $customers
 * @property \Epayco\Service\DisputeService $disputes
 * @property \Epayco\Service\EphemeralKeyService $ephemeralKeys
 * @property \Epayco\Service\EventService $events
 * @property \Epayco\Service\ExchangeRateService $exchangeRates
 * @property \Epayco\Service\FileLinkService $fileLinks
 * @property \Epayco\Service\FileService $files
 * @property \Epayco\Service\InvoiceItemService $invoiceItems
 * @property \Epayco\Service\InvoiceService $invoices
 * @property \Epayco\Service\Issuing\IssuingServiceFactory $issuing
 * @property \Epayco\Service\MandateService $mandates
 * @property \Epayco\Service\OAuthService $oauth
 * @property \Epayco\Service\OrderReturnService $orderReturns
 * @property \Epayco\Service\OrderService $orders
 * @property \Epayco\Service\PaymentIntentService $paymentIntents
 * @property \Epayco\Service\PaymentMethodService $paymentMethods
 * @property \Epayco\Service\PayoutService $payouts
 * @property \Epayco\Service\PlanService $plans
 * @property \Epayco\Service\PriceService $prices
 * @property \Epayco\Service\ProductService $products
 * @property \Epayco\Service\PromotionCodeService $promotionCodes
 * @property \Epayco\Service\Radar\RadarServiceFactory $radar
 * @property \Epayco\Service\RefundService $refunds
 * @property \Epayco\Service\Reporting\ReportingServiceFactory $reporting
 * @property \Epayco\Service\ReviewService $reviews
 * @property \Epayco\Service\SetupAttemptService $setupAttempts
 * @property \Epayco\Service\SetupIntentService $setupIntents
 * @property \Epayco\Service\Sigma\SigmaServiceFactory $sigma
 * @property \Epayco\Service\SkuService $skus
 * @property \Epayco\Service\SourceService $sources
 * @property \Epayco\Service\SubscriptionItemService $subscriptionItems
 * @property \Epayco\Service\SubscriptionScheduleService $subscriptionSchedules
 * @property \Epayco\Service\SubscriptionService $subscriptions
 * @property \Epayco\Service\TaxRateService $taxRates
 * @property \Epayco\Service\Terminal\TerminalServiceFactory $terminal
 * @property \Epayco\Service\TokenService $tokens
 * @property \Epayco\Service\TopupService $topups
 * @property \Epayco\Service\TransferService $transfers
 * @property \Epayco\Service\WebhookEndpointService $webhookEndpoints
 */
class EpaycoClient extends BaseEpaycoClient
{
    /**
     * @var \Epayco\Service\CoreServiceFactory
     */
    private $coreServiceFactory;

    public function __get($name)
    {
        if (null === $this->coreServiceFactory) {
            $this->coreServiceFactory = new \Epayco\Service\CoreServiceFactory($this);
        }

        return $this->coreServiceFactory->__get($name);
    }
}
