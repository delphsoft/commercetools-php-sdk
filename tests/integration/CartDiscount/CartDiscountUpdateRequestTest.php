<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\CartDiscount;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\CartDiscount\CartDiscount;
use Commercetools\Core\Model\CartDiscount\CartDiscountTarget;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\MoneyCollection;
use Commercetools\Core\Model\CartDiscount\CartDiscountDraft;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\CartDiscount\CartDiscountValue;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeCartPredicateAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeIsActiveAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeNameAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeRequiresDiscountCodeAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeSortOrderAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeTargetAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeValueAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountSetDescriptionAction;
use Commercetools\Core\Request\CartDiscounts\CartDiscountCreateRequest;
use Commercetools\Core\Request\CartDiscounts\CartDiscountDeleteRequest;
use Commercetools\Core\Request\CartDiscounts\CartDiscountUpdateRequest;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountSetValidFromAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountSetValidUntilAction;

class CartDiscountUpdateRequestTest extends ApiTestCase
{
    public function testChangeValue()
    {
        $draft = $this->getDraft('change-value');
        $cartDiscount = $this->createCartDiscount($draft);


        $value = CartDiscountValue::of()->setType('absolute')->setMoney(
            MoneyCollection::of()
                ->add(
                    Money::ofCurrencyAndAmount('EUR', 200)
                )
        );
        $request = CartDiscountUpdateRequest::ofIdAndVersion(
            $cartDiscount->getId(),
            $cartDiscount->getVersion()
        )
            ->addAction(CartDiscountChangeValueAction::ofCartDiscountValue($value))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(CartDiscount::class, $result);
        $this->assertSame(
            $value->getMoney()->current()->getCentAmount(),
            $result->getValue()->getMoney()->current()->getCentAmount()
        );
        $this->assertNotSame($cartDiscount->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf(CartDiscount::class, $result);
    }

    public function testChangeCartPredicate()
    {
        $draft = $this->getDraft('change-predicate');
        $cartDiscount = $this->createCartDiscount($draft);


        $predicate = '2=2';
        $request = CartDiscountUpdateRequest::ofIdAndVersion(
            $cartDiscount->getId(),
            $cartDiscount->getVersion()
        )
            ->addAction(
                CartDiscountChangeCartPredicateAction::ofCartPredicate($predicate)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(CartDiscount::class, $result);
        $this->assertSame($predicate, $result->getCartPredicate());
        $this->assertNotSame($cartDiscount->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf(CartDiscount::class, $result);
    }

    public function testChangeTarget()
    {
        $draft = $this->getDraft('change-predicate');
        $cartDiscount = $this->createCartDiscount($draft);


        $target = CartDiscountTarget::of()->setType('lineItems')->setPredicate('2=2');
        $request = CartDiscountUpdateRequest::ofIdAndVersion(
            $cartDiscount->getId(),
            $cartDiscount->getVersion()
        )
            ->addAction(
                CartDiscountChangeTargetAction::ofTarget($target)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(CartDiscount::class, $result);
        $this->assertSame($target->getPredicate(), $result->getTarget()->getPredicate());
        $this->assertNotSame($cartDiscount->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf(CartDiscount::class, $result);
    }

    public function testChangeIsActive()
    {
        $draft = $this->getDraft('change-is-active');
        $cartDiscount = $this->createCartDiscount($draft);


        $isActive = true;
        $request = CartDiscountUpdateRequest::ofIdAndVersion(
            $cartDiscount->getId(),
            $cartDiscount->getVersion()
        )
            ->addAction(
                CartDiscountChangeIsActiveAction::ofIsActive($isActive)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(CartDiscount::class, $result);
        $this->assertSame($isActive, $result->getIsActive());
        $this->assertNotSame($cartDiscount->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf(CartDiscount::class, $result);
    }

    public function testChangeName()
    {
        $draft = $this->getDraft('change-name');
        $cartDiscount = $this->createCartDiscount($draft);


        $name = LocalizedString::ofLangAndText('en', $this->getTestRun() . '-new-name');
        $request = CartDiscountUpdateRequest::ofIdAndVersion(
            $cartDiscount->getId(),
            $cartDiscount->getVersion()
        )
            ->addAction(CartDiscountChangeNameAction::ofName($name))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(CartDiscount::class, $result);
        $this->assertSame($name->en, $result->getName()->en);
        $this->assertNotSame($cartDiscount->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf(CartDiscount::class, $result);
    }

    public function testSetDescription()
    {
        $draft = $this->getDraft('set-description');
        $cartDiscount = $this->createCartDiscount($draft);


        $description = LocalizedString::ofLangAndText('en', $this->getTestRun() . '-new-description');
        $request = CartDiscountUpdateRequest::ofIdAndVersion(
            $cartDiscount->getId(),
            $cartDiscount->getVersion()
        )
            ->addAction(CartDiscountSetDescriptionAction::of()->setDescription($description))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(CartDiscount::class, $result);
        $this->assertSame($description->en, $result->getDescription()->en);
        $this->assertNotSame($cartDiscount->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf(CartDiscount::class, $result);
    }

    public function testChangeSortOrder()
    {
        $draft = $this->getDraft('change-sort-order');
        $cartDiscount = $this->createCartDiscount($draft);


        $sortOrder = '0.90' . trim((string)mt_rand(1, 1000), '0');
        $request = CartDiscountUpdateRequest::ofIdAndVersion(
            $cartDiscount->getId(),
            $cartDiscount->getVersion()
        )
            ->addAction(CartDiscountChangeSortOrderAction::ofSortOrder($sortOrder))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(CartDiscount::class, $result);
        $this->assertSame($sortOrder, $result->getSortOrder());
        $this->assertNotSame($cartDiscount->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf(CartDiscount::class, $result);
    }

    public function testChangeRequiresDiscountCode()
    {
        $draft = $this->getDraft('change-requires-discount-code');
        $cartDiscount = $this->createCartDiscount($draft);


        $requiresDiscountCode = true;
        $request = CartDiscountUpdateRequest::ofIdAndVersion(
            $cartDiscount->getId(),
            $cartDiscount->getVersion()
        )
            ->addAction(CartDiscountChangeRequiresDiscountCodeAction::ofRequiresDiscountCode($requiresDiscountCode))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(CartDiscount::class, $result);
        $this->assertEquals($requiresDiscountCode, $result->getRequiresDiscountCode());
        $this->assertNotSame($cartDiscount->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf(CartDiscount::class, $result);
    }

    public function testSetValidFrom()
    {
        $draft = $this->getDraft('set-valid-from');
        $cartDiscount = $this->createCartDiscount($draft);


        $validFrom = new \DateTime();
        $request = CartDiscountUpdateRequest::ofIdAndVersion(
            $cartDiscount->getId(),
            $cartDiscount->getVersion()
        )
            ->addAction(CartDiscountSetValidFromAction::of()->setValidFrom($validFrom))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(CartDiscount::class, $result);
        $this->assertEquals($validFrom, $result->getValidFrom()->getDateTime());
        $this->assertNotSame($cartDiscount->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf(CartDiscount::class, $result);
    }

    public function testSetValidUntil()
    {
        $draft = $this->getDraft('set-valid-from');
        $cartDiscount = $this->createCartDiscount($draft);


        $validFrom = new \DateTime();
        $request = CartDiscountUpdateRequest::ofIdAndVersion(
            $cartDiscount->getId(),
            $cartDiscount->getVersion()
        )
            ->addAction(CartDiscountSetValidUntilAction::of()->setValidUntil($validFrom))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(CartDiscount::class, $result);
        $this->assertEquals($validFrom, $result->getValidUntil()->getDateTime());
        $this->assertNotSame($cartDiscount->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf(CartDiscount::class, $result);
    }
    /**
     * @param $name
     * @return CartDiscountDraft
     */
    protected function getDraft($name)
    {
        $draft = CartDiscountDraft::ofNameValuePredicateTargetOrderActiveAndDiscountCode(
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-' . $name),
            CartDiscountValue::of()->setType('absolute')->setMoney(
                MoneyCollection::of()->add(Money::ofCurrencyAndAmount('EUR', 100))
            ),
            '1=1',
            CartDiscountTarget::of()->setType('lineItems')->setPredicate('1=1'),
            '0.9' . trim((string)mt_rand(1, 1000), '0'),
            false,
            false
        );

        return $draft;
    }

    protected function createCartDiscount(CartDiscountDraft $draft)
    {
        $request = CartDiscountCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $cartDiscount = $request->mapResponse($response);
        $this->cleanupRequests[] = CartDiscountDeleteRequest::ofIdAndVersion(
            $cartDiscount->getId(),
            $cartDiscount->getVersion()
        );

        return $cartDiscount;
    }

}
