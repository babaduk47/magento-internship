<?php

namespace HelloMagento\CustomSidebar\Block;

use Magento\Catalog\Block\Product\Context;
use Magento\Catalog\Block\Product\Image;
use Magento\Catalog\Model\Product;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Phrase;
use Magento\Framework\Pricing\Helper\Data;
use Magento\Framework\View\Element\Template;

class CustomSidebar extends Template
{
    private $imageBuilder;
    protected Data $priceHelper;

    /**
     * @param Context $context
     * @param Data $priceHelper
     * @param array $data
     */
    public function __construct(Context $context, Data $priceHelper, array $data = [])
    {
        $this->imageBuilder = $context->getImageBuilder();
        $this->priceHelper = $priceHelper;

        parent::__construct($context, $data);
    }

    /**
     * Retrieve block title
     *
     * @return Phrase
     */
    public function getTitle()
    {
        return __('Custom sidebar');
    }

    public function getRandomProducts()
    {
        $objectManager =  ObjectManager::getInstance();
        $curCategory = $objectManager->get('Magento\Framework\Registry')->registry('current_category');

        $categoryProducts = $curCategory->getProductCollection()
            ->addAttributeToSelect('*')->setPageSize(3);

        $categoryProducts->getSelect()->orderRand();

        return $categoryProducts->getItems();
    }

    /**
     * Retrieve product image
     *
     * @param Product $product
     * @param string $imageId
     * @param array $attributes
     * @return Image
     */
    public function getImage(Product $product, string $imageId, array $attributes = []): Image
    {
        return $this->imageBuilder->create($product, $imageId, $attributes);
    }

    public function getFormattedPrice($price): float|string
    {
        return $this->priceHelper->currency($price, true, false);
    }
}
