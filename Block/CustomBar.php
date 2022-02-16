<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Wdevs\CustomBar\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\App\Http\Context as HttpContext;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
/**
 * CustomBar Block Class
 */
class CustomBar extends Template
{
    /**
     * WDEBS_CUSTOMBAR_BAR_TEXT
     */
    const WDEBS_CUSTOMBAR_BAR_TEXT = 'custom_bar/general/bar_text';

    /**
     * ScopeConfigInterface $scopeConfig
     */
    protected $scopeConfig;

    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context  $context
     * @param array $data
     */
    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig,
        HttpContext $httpContext,
        array $data = []
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->httpContext = $httpContext;
        parent::__construct($context, $data);
    }

    /**
     * Render HTML
     */
    public function _toHtml() 
    {
        //Check customer is logged in or not
        if (!(bool)$this->httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH)) {
            return '';
        }
        return parent::_toHtml();
    }

    /**
     * Get custom bar text from config
     */
    public function getTopBarText() 
    {
        $customText = $this->scopeConfig->getValue(self::WDEBS_CUSTOMBAR_BAR_TEXT, ScopeInterface::SCOPE_STORE);
        return (!empty($customText)) ? $customText : __('Hello Developer! This is for testing task : Wdevs_CustomBar');
    }
}