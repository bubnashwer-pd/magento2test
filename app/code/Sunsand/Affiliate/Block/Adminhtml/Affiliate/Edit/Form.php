<?php

/**
 * Affiliate Edit Form Block
 *
 */
namespace Sunsand\Affiliate\Block\Adminhtml\Affiliate\Edit;

class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var Sunsand\Affiliate\Model\ResourceModel\Affiliate\Grid\Statuslist
     */
    protected $_statusOption;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Sunsand\Affiliate\Model\ResourceModel\Affiliate\Grid\Statuslist $optionData,
        array $data = []
    ) {
       
        $this->_statusOption = $optionData;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Retrieve affiliate object
     *
     */
    public function getModel()
    {
        return $this->_coreRegistry->registry('_affiliate_affiliate');
    }

    /**
     * Prepare form before rendering HTML
     *
     * @return $this
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm()
    {
        $model = $this->getModel();
        

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']]
        );

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('Affiliate Information'), 'class' => 'fieldset-wide']
        );
        $fieldset->addType('background', 'Sunsand\Affiliate\Block\Adminhtml\Affiliate\Helper\Background');
        
       
        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', ['name' => 'id', 'value' => $model->getId()]);
        }

        $fieldset->addField(
            'name',
            'text',
            [
                'name' => 'name',
                'label' => __('Affiliate Name'),
                'title' => __('Affiliate Name'),
                'required' => true,
                'value' => $model->getName()
            ]
        );
        
        $fieldset->addField(
            'status',
            'select',
            [
                'label' => __('Status'),
                'required' => true,
                'name' => 'status',
                'values' => $this->_statusOption->toOptionArray(),
                'value' => $model->getStatus()
            ]
        );

        $fieldset->addField(
            'image',
            'image',
            [
                'name' => 'image',
                'label' => __('Profile Image'),
                'title' => __('Profile Image'),
                'required' => true,
                'value' => $model->getImage()
            ]
        );
        
        $form->setAction($this->getUrl('*/*/save'));
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}