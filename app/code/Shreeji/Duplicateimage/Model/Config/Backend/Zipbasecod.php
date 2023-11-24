<?php

namespace Shreeji\Zipbasecod\Model\Config\Backend;

use Magento\Framework\Model\AbstractModel;

/**
 * Backend model for zip base cod CSV importing
 *
 */
class Zipbasecod extends \Magento\Config\Model\Config\Backend\File {

    /**
     * The tail part of directory path for uploading
     * @var string
     */
    const UPLOAD_DIR = 'imported_zipcodes';

    /**
     * @var \Shreeji\Zipbasecod\Model\ZipbasecodFactory
     */
    protected $_zipbasecodFactory;

    /**
     * Uploader object
     *
     * @var Uploader
     */
    private $uploader;

    /**
     * Return path to directory for upload file
     *
     * @return string
     */
    protected function _getUploadDir() {
        return $this->_mediaDirectory->getAbsolutePath($this->_appendScopeInfo(self::UPLOAD_DIR));
    }

    /**
     * Makes a decision about whether to add info about the scope
     *
     * @return boolean
     */
    protected function _addWhetherScopeInfo() {
        return true;
    }

    /**
     * Getter for allowed extensions of uploaded files
     *
     * @return array
     */
    protected function _getAllowedExtensions() {
        return ['csv'];
    }

    /**
     * @return $this
     */
    public function beforeSave() {
        $value = $this->getValue();
        $file = $this->getFileData();
        if (!empty($file)) {
            $uploadType = pathinfo($file['name'], PATHINFO_EXTENSION);
            if ($uploadType != 'csv') {
                throw new \Magento\Framework\Exception\LocalizedException(
                __('Only CSV file allow to import ZIP codes.')
                );
            }                        
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $objectManager->create('Shreeji\Zipbasecod\Model\Zipbasecod')->uploadAndImportZip($this, $file['tmp_name']);
        } else {
            if (is_array($value) && !empty($value['delete'])) {
                $this->setValue('');
            } else {
                $this->unsValue();
            }
        }

        return $this;
    }

}
