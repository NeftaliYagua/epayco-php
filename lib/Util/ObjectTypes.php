<?php

// File generated from our OpenAPI spec

namespace Epayco\Util;

class ObjectTypes
{
    /**
     * @var array Mapping from object types to resource classes
     */
    const mapping = [
        \Epayco\Account::OBJECT_NAME => \Epayco\Account::class,
        \Epayco\AccountLink::OBJECT_NAME => \Epayco\AccountLink::class,
        \Epayco\AlipayAccount::OBJECT_NAME => \Epayco\AlipayAccount::class,
        \Epayco\ApplePayDomain::OBJECT_NAME => \Epayco\ApplePayDomain::class,
        \Epayco\ApplicationFee::OBJECT_NAME => \Epayco\ApplicationFee::class,
        \Epayco\ApplicationFeeRefund::OBJECT_NAME => \Epayco\ApplicationFeeRefund::class,
        \Epayco\Balance::OBJECT_NAME => \Epayco\Balance::class,
        \Epayco\BalanceTransaction::OBJECT_NAME => \Epayco\BalanceTransaction::class,
        \Epayco\BankAccount::OBJECT_NAME => \Epayco\BankAccount::class,
        \Epayco\BillingPortal\Session::OBJECT_NAME => \Epayco\BillingPortal\Session::class,
        \Epayco\BitcoinReceiver::OBJECT_NAME => \Epayco\BitcoinReceiver::class,
        \Epayco\BitcoinTransaction::OBJECT_NAME => \Epayco\BitcoinTransaction::class,
        \Epayco\Capability::OBJECT_NAME => \Epayco\Capability::class,
        \Epayco\Card::OBJECT_NAME => \Epayco\Card::class,
        \Epayco\Charge::OBJECT_NAME => \Epayco\Charge::class,
        \Epayco\Checkout\Session::OBJECT_NAME => \Epayco\Checkout\Session::class,
        \Epayco\Collection::OBJECT_NAME => \Epayco\Collection::class,
        \Epayco\CountrySpec::OBJECT_NAME => \Epayco\CountrySpec::class,
        \Epayco\Coupon::OBJECT_NAME => \Epayco\Coupon::class,
        \Epayco\CreditNote::OBJECT_NAME => \Epayco\CreditNote::class,
        \Epayco\CreditNoteLineItem::OBJECT_NAME => \Epayco\CreditNoteLineItem::class,
        \Epayco\Customer::OBJECT_NAME => \Epayco\Customer::class,
        \Epayco\CustomerBalanceTransaction::OBJECT_NAME => \Epayco\CustomerBalanceTransaction::class,
        \Epayco\Discount::OBJECT_NAME => \Epayco\Discount::class,
        \Epayco\Dispute::OBJECT_NAME => \Epayco\Dispute::class,
        \Epayco\EphemeralKey::OBJECT_NAME => \Epayco\EphemeralKey::class,
        \Epayco\Event::OBJECT_NAME => \Epayco\Event::class,
        \Epayco\ExchangeRate::OBJECT_NAME => \Epayco\ExchangeRate::class,
        \Epayco\File::OBJECT_NAME => \Epayco\File::class,
        \Epayco\File::OBJECT_NAME_ALT => \Epayco\File::class,
        \Epayco\FileLink::OBJECT_NAME => \Epayco\FileLink::class,
        \Epayco\Invoice::OBJECT_NAME => \Epayco\Invoice::class,
        \Epayco\InvoiceItem::OBJECT_NAME => \Epayco\InvoiceItem::class,
        \Epayco\InvoiceLineItem::OBJECT_NAME => \Epayco\InvoiceLineItem::class,
        \Epayco\Issuing\Authorization::OBJECT_NAME => \Epayco\Issuing\Authorization::class,
        \Epayco\Issuing\Card::OBJECT_NAME => \Epayco\Issuing\Card::class,
        \Epayco\Issuing\CardDetails::OBJECT_NAME => \Epayco\Issuing\CardDetails::class,
        \Epayco\Issuing\Cardholder::OBJECT_NAME => \Epayco\Issuing\Cardholder::class,
        \Epayco\Issuing\Dispute::OBJECT_NAME => \Epayco\Issuing\Dispute::class,
        \Epayco\Issuing\Transaction::OBJECT_NAME => \Epayco\Issuing\Transaction::class,
        \Epayco\LineItem::OBJECT_NAME => \Epayco\LineItem::class,
        \Epayco\LoginLink::OBJECT_NAME => \Epayco\LoginLink::class,
        \Epayco\Mandate::OBJECT_NAME => \Epayco\Mandate::class,
        \Epayco\Order::OBJECT_NAME => \Epayco\Order::class,
        \Epayco\OrderItem::OBJECT_NAME => \Epayco\OrderItem::class,
        \Epayco\OrderReturn::OBJECT_NAME => \Epayco\OrderReturn::class,
        \Epayco\PaymentIntent::OBJECT_NAME => \Epayco\PaymentIntent::class,
        \Epayco\PaymentMethod::OBJECT_NAME => \Epayco\PaymentMethod::class,
        \Epayco\Payout::OBJECT_NAME => \Epayco\Payout::class,
        \Epayco\Person::OBJECT_NAME => \Epayco\Person::class,
        \Epayco\Plan::OBJECT_NAME => \Epayco\Plan::class,
        \Epayco\Price::OBJECT_NAME => \Epayco\Price::class,
        \Epayco\Product::OBJECT_NAME => \Epayco\Product::class,
        \Epayco\PromotionCode::OBJECT_NAME => \Epayco\PromotionCode::class,
        \Epayco\Radar\EarlyFraudWarning::OBJECT_NAME => \Epayco\Radar\EarlyFraudWarning::class,
        \Epayco\Radar\ValueList::OBJECT_NAME => \Epayco\Radar\ValueList::class,
        \Epayco\Radar\ValueListItem::OBJECT_NAME => \Epayco\Radar\ValueListItem::class,
        \Epayco\Recipient::OBJECT_NAME => \Epayco\Recipient::class,
        \Epayco\RecipientTransfer::OBJECT_NAME => \Epayco\RecipientTransfer::class,
        \Epayco\Refund::OBJECT_NAME => \Epayco\Refund::class,
        \Epayco\Reporting\ReportRun::OBJECT_NAME => \Epayco\Reporting\ReportRun::class,
        \Epayco\Reporting\ReportType::OBJECT_NAME => \Epayco\Reporting\ReportType::class,
        \Epayco\Review::OBJECT_NAME => \Epayco\Review::class,
        \Epayco\SetupAttempt::OBJECT_NAME => \Epayco\SetupAttempt::class,
        \Epayco\SetupIntent::OBJECT_NAME => \Epayco\SetupIntent::class,
        \Epayco\Sigma\ScheduledQueryRun::OBJECT_NAME => \Epayco\Sigma\ScheduledQueryRun::class,
        \Epayco\SKU::OBJECT_NAME => \Epayco\SKU::class,
        \Epayco\Source::OBJECT_NAME => \Epayco\Source::class,
        \Epayco\SourceTransaction::OBJECT_NAME => \Epayco\SourceTransaction::class,
        \Epayco\Subscription::OBJECT_NAME => \Epayco\Subscription::class,
        \Epayco\SubscriptionItem::OBJECT_NAME => \Epayco\SubscriptionItem::class,
        \Epayco\SubscriptionSchedule::OBJECT_NAME => \Epayco\SubscriptionSchedule::class,
        \Epayco\TaxId::OBJECT_NAME => \Epayco\TaxId::class,
        \Epayco\TaxRate::OBJECT_NAME => \Epayco\TaxRate::class,
        \Epayco\Terminal\ConnectionToken::OBJECT_NAME => \Epayco\Terminal\ConnectionToken::class,
        \Epayco\Terminal\Location::OBJECT_NAME => \Epayco\Terminal\Location::class,
        \Epayco\Terminal\Reader::OBJECT_NAME => \Epayco\Terminal\Reader::class,
        \Epayco\ThreeDSecure::OBJECT_NAME => \Epayco\ThreeDSecure::class,
        \Epayco\Token::OBJECT_NAME => \Epayco\Token::class,
        \Epayco\Topup::OBJECT_NAME => \Epayco\Topup::class,
        \Epayco\Transfer::OBJECT_NAME => \Epayco\Transfer::class,
        \Epayco\TransferReversal::OBJECT_NAME => \Epayco\TransferReversal::class,
        \Epayco\UsageRecord::OBJECT_NAME => \Epayco\UsageRecord::class,
        \Epayco\UsageRecordSummary::OBJECT_NAME => \Epayco\UsageRecordSummary::class,
        \Epayco\WebhookEndpoint::OBJECT_NAME => \Epayco\WebhookEndpoint::class,
    ];
}
