<?php declare(strict_types=1);

namespace Magmodules\DistanceBasedShippingCost\Test;

use Shopware\Core\Checkout\Customer\Aggregate\CustomerAddress\CustomerAddressEntity;
use Shopware\Core\Checkout\Customer\CustomerEntity;
use Shopware\Core\Checkout\Payment\Cart\PaymentHandler\CashPayment;
use Shopware\Core\Checkout\Test\Payment\Handler\V630\SyncTestPaymentHandler;
use Shopware\Core\Defaults;
use Shopware\Core\Framework\Api\Util\AccessKeyHelper;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepositoryInterface;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\Framework\Test\TestCaseBase\IntegrationTestBehaviour;
use Shopware\Core\Framework\Uuid\Uuid;
use Shopware\Core\System\SalesChannel\Context\SalesChannelContextService;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Core\Test\TestDefaults;

trait CustomerTestBehaviour {

    use IntegrationTestBehaviour;

    protected function createTestCustomer(?string $password, ?string $email, Context $context): ?CustomerEntity
    {
        $customerId = Uuid::randomHex();
        $addressId = Uuid::randomHex();
        $paymentMethodId = $this->getValidPaymentMethodId();

        if ($email === null) {
            $email = Uuid::randomHex() . '@example.com';
        }

        if ($password === null) {
            $password = Uuid::randomHex();
        }

        $this->getContainer()->get('customer.repository')->create([
            [
                'id' => $customerId,
                'salesChannelId' => TestDefaults::SALES_CHANNEL,
                'defaultShippingAddress' => [
                    'id' => $addressId,
                    'firstName' => 'Bat',
                    'lastName' => 'Man',
                    'street' => 'Amtsstraße 21',
                    'city' => 'Schöppingen',
                    'zipcode' => '48624',
                    'salutationId' => $this->getValidSalutationId(),
                    'countryId' => $this->getCountryDeuId($context),
                ],
                'defaultBillingAddressId' => $addressId,
                'defaultPaymentMethodId' => $paymentMethodId,
                'groupId' => TestDefaults::FALLBACK_CUSTOMER_GROUP,
                'email' => $email,
                'password' => $password,
                'firstName' => 'Bat',
                'lastName' => 'Man',
                'guest' => false,
                'salutationId' => $this->getValidSalutationId(),
                'customerNumber' => '12345',
            ],
        ], $context);

        /** @var \Shopware\Core\Checkout\Customer\CustomerEntity $customer */
        $customer = $this->getContainer()->get('customer.repository')->search(new Criteria([$customerId]), $context)->first();

        if(!$customer){
            throw new \RuntimeException('Test: Customer not created');
        }

        /** @var CustomerAddressEntity $defaultShippingAddress */
        $defaultShippingAddress = $this->getContainer()->get('customer_address.repository')->search(new Criteria([$addressId]), $context)->first();
        $customerCountry = $this->getContainer()->get('country.repository')->search(new Criteria([$this->getCountryDeuId($context)]), $context)->first();
        $defaultShippingAddress->setCountry($customerCountry);
        $customer->setDefaultShippingAddress($defaultShippingAddress);

        return $customer;
    }

    protected function getCountryDeuId(Context $context)
    {
        /** @var EntityRepositoryInterface $repository */
        $repository = $this->getContainer()->get('country.repository');

        $criteria = (new Criteria())->setLimit(1)
            ->addFilter(new EqualsFilter('iso', 'DE'));

        return $repository->search($criteria, $context)->first()->getId();

    }

    protected function createSalesChannelContextWithLoggedInCustomer(Context $context): SalesChannelContext
    {
        $paymentMethodId = $this->getValidPaymentMethodId();
        $shippingMethodId = $this->getAvailableShippingMethod()->getId();
        $countryId = $this->getCountryDeuId($context);
        $snippetSetId = $this->getSnippetSetIdForLocale('en-GB');
        $data = [
            'typeId' => Defaults::SALES_CHANNEL_TYPE_STOREFRONT,
            'name' => 'store front',
            'accessKey' => AccessKeyHelper::generateAccessKey('sales-channel'),
            'languageId' => Defaults::LANGUAGE_SYSTEM,
            'snippetSetId' => $snippetSetId,
            'currencyId' => Defaults::CURRENCY,
            'currencyVersionId' => Defaults::LIVE_VERSION,
            'paymentMethodId' => $paymentMethodId,
            'paymentMethodVersionId' => Defaults::LIVE_VERSION,
            'shippingMethodId' => $shippingMethodId,
            'shippingMethodVersionId' => Defaults::LIVE_VERSION,
            'navigationCategoryId' => $this->getValidCategoryId(),
            'countryId' => $countryId,
            'countryVersionId' => Defaults::LIVE_VERSION,
            'currencies' => [['id' => Defaults::CURRENCY]],
            'languages' => [['id' => Defaults::LANGUAGE_SYSTEM]],
            'paymentMethods' => [['id' => $paymentMethodId]],
            'shippingMethods' => [['id' => $shippingMethodId]],
            'countries' => [['id' => $countryId]],
            'domains' => [
                ['url' => 'http://test.com/' . Uuid::randomHex(), 'currencyId' => Defaults::CURRENCY, 'languageId' => Defaults::LANGUAGE_SYSTEM, 'snippetSetId' => $snippetSetId],
            ],
        ];

        return $this->createContext($data, [
            SalesChannelContextService::CUSTOMER_ID => $this->createTestCustomer(null, null, $context)->getId(),
        ]);
    }
}
