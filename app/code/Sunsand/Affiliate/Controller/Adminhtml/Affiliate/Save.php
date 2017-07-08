<?php

namespace Sunsand\Affiliate\Controller\Adminhtml\Affiliate;

use Magento\Framework\App\TemplateTypesInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends \Sunsand\Affiliate\Controller\Adminhtml\Affiliate
{
    protected $_fileUploaderFactory;
    /**
    * @var \Magento\Framework\Filesystem
    */
    protected $filesystem;

    /**
     * @var \Magento\Backend\Helper\Js
     */
    protected $_jsHelper;
    protected $_dateFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Backend\Helper\Js $jsHelper,
        \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\Stdlib\DateTime\DateTimeFactory $dateFactory
    )
    {
        $this->_jsHelper = $jsHelper;       
        $this->_fileUploaderFactory = $fileUploaderFactory;
        $this->filesystem = $filesystem;
        $this->_dateFactory = $dateFactory;
        parent::__construct($context,$coreRegistry,$resultPageFactory);
    }   

    /**
     * Image upload
     *
     * @return string
     */
    public function uploadFileAndGetName($input, $destinationFolder, $data)
    {
        try {  
            $media = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA);
            if (isset($data[$input]['delete'])) {
                unlink($media->getAbsolutePath($data[$input]['value']));
            }

            $uploader = $this->_fileUploaderFactory->create(['fileId' => $input]);
            $uploader->setAllowRenameFiles(true);
            $uploader->setFilesDispersion(true);
            $uploader->setAllowCreateFolders(true);
            $path = $media->getAbsolutePath($destinationFolder);
            $result = $uploader->save($path);
            return $destinationFolder.$result['file'];

        } catch (\Exception $e) {
            if ($e->getCode() != \Magento\Framework\File\Uploader::TMP_NAME_EMPTY) {
                throw new LocalizedException($e->getMessage());
            } else {
                if (isset($data[$input]['value'])) {
                    return $data[$input]['value'];
                }
            }
        }
        return '';
    }

    /**
     * Save Newsletter Template
     *
     * @return void
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $request = $this->getRequest();
        if (!$request->isPost()) {
            $this->getResponse()->setRedirect($this->getUrl('*/affiliate'));
        }
   
        $affiliate = $this->_objectManager->create('Sunsand\Affiliate\Model\Affiliate');
        $id = (int)$request->getParam('id');

        if ($id) {
            $affiliate->load($id);
        }

        try {
            $data = $request->getParams();
           
             if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
                try {
                    
                    $data['image'] = $this->uploadFileAndGetName('image', 'affiliate/profile', $data);
                    
                
                } catch (Exception $e) {
                    
                    $data['image'] = $_FILES['image']['name'];
                    
                }
            } else {
                $data['image'] = $data['image']['value'];
            }
                
            
            
            $affiliate->setData('name',
                $request->getParam('name')
            )->setData('image',
                $data['image']
            )->setData('status',
                $request->getParam('status')
            );
            
            if (!$affiliate->getId()) {
                $data['created_at'] = $this->_dateFactory->create()->gmtDate();
            }
            $data['updated_at'] = $this->_dateFactory->create()->gmtDate();
           

            $affiliate->save();

            $this->messageManager->addSuccess(__('The Affiliate Member has been saved.'));
            $this->_getSession()->setFormData(false);

            
        } catch (LocalizedException $e) {
            
            $this->messageManager->addError(nl2br($e->getMessage()));
            $this->_getSession()->setData('affiliate_affiliate_form_data', $this->getRequest()->getParams());
            return $resultRedirect->setPath('*/*/edit', ['id' => $affiliate->getAffiliateaffiliateId(), '_current' => true]);
        } catch (\Exception $e) {
            
            $this->messageManager->addException($e, __('Something went wrong while saving this template.'));
            $this->_getSession()->setData('affiliate_affiliate_form_data', $this->getRequest()->getParams());
            return $resultRedirect->setPath('*/*/edit', ['id' => $affiliate->getAffiliateaffiliateId(), '_current' => true]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}