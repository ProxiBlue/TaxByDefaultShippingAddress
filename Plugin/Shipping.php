<?php

declare(strict_types=1);

namespace ProxiBlue\TaxByDefaultShippingAddress\Plugin;

use Magento\Customer\Model\Session;
use \Magento\Customer\Api\CustomerRepositoryInterface;

class Shipping
{
    /**
     * @var Session
     */
    private $customerSession;

    /**
     * @var \Magento\Customer\Api\CustomerRepositoryInterface
     */
    private $customerRepository;


    /**
     * Constructor.
     *
     * @param Session $customerSession
     */
    public function __construct(Session                     $customerSession,
                                CustomerRepositoryInterface $customerRepository
    )
    {
        $this->customerSession = $customerSession;
        $this->customerRepository = $customerRepository;
    }

    public function afterGetAddress(
        $subject,
        $result
    )
    {
        $current = $subject->getData(\Magento\Quote\Model\Shipping::ADDRESS);
        if ($current->getPostcode() == "*") {
            // Check if the customer is logged in
            if ($this->customerSession->isLoggedIn()) {
                $customer = $this->customerRepository->getById($this->customerSession->getCustomerId());
                $addresses = $customer->getAddresses();
                foreach ($addresses as $address) {
                    if ($address->isDefaultShipping()) {
                        // cannot just assign the found address, as the object types differ
                        $current->setPostcode($address->getPostcode());
                        $current->setCountryId($address->getCountryId());
                        $current->setRegionId($address->getRegionId());
                        $current->setRegion($address->getRegion());
                        break;
                    }
                }
            }
        }
        return $current;
    }
}
