<?php

namespace Omnipay\Sips\Message;

use Guzzle\Http\ClientInterface;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Sips\Merchant;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * Class SipsBinaryCall
 * Represents a call to a Sips binary
 *
 * @package Omnipay\Sips\Message
 */
abstract class SipsBinaryCall extends AbstractRequest
{
    protected $returnContext;

    /**
     * The merchant
     *
     * @var Merchant
     */
    protected $merchant;

    /**
     * The additional data
     *
     * @var string
     */
    protected $sipsAdditionalData;

    #region merchant setters
    /**
     * The path of the folder containing
     * the Sips files (binaries, params...)
     *
     * @var string
     */
    protected $sipsFolderPath;

    /**
     * Create a new Request
     *
     * @param ClientInterface $httpClient A Guzzle client to make API calls with
     * @param HttpRequest $httpRequest A Symfony HTTP request object
     */
    public function __construct(ClientInterface $httpClient, HttpRequest $httpRequest)
    {
        parent::__construct($httpClient, $httpRequest);
        $this->merchant = new Merchant();
    }

    /**
     * Sets the merchant id
     *
     * @param string $merchantId
     */
    public function setMerchantId($merchantId)
    {
        $this->merchant->setId($merchantId);
    }

    /**
     * Sets additional data
     *
     * @param string $data
     * @return $this
     */
    public function setSipsAdditionalData($sipsAdditionalData)
    {
        $this->sipsAdditionalData = $sipsAdditionalData;

        return $this;
    }

    /**
     * Gets additional data
     *
     * @return string
     */
    public function getSipsAdditionalData()
    {
        return $this->sipsAdditionalData;
    }

    #endregion

    /**
     * Sets the merchant language
     *
     * @param mixed $merchantLanguage
     */
    public function setMerchantLanguage($merchantLanguage)
    {
        $this->merchant->setLanguage($merchantLanguage);
    }

    /**
     * Sets the merchant country
     *
     * @param $merchantCountry
     */
    public function setMerchantCountry($merchantCountry)
    {
        $this->merchant->setCountry($merchantCountry);
    }

    /**
     * Gets the merchant information
     *
     * @return mixed
     */
    public function getMerchant()
    {
        return $this->merchant;
    }

    /**
     * Gets the path of the folder containing
     * the Sips files (binaries, params...)
     *
     * @return string
     */
    public function getSipsFolderPath()
    {
        return $this->sipsFolderPath;
    }

    /**
     * Sets The path of the folder containing
     * the Sips files (binaries, params...)
     *
     * @param string $sipsFolderPath
     */
    public function setSipsFolderPath($sipsFolderPath)
    {
        $this->sipsFolderPath = $sipsFolderPath;
    }

    /**
     * Gets the path to the Sips PathFile
     *
     * @return string
     */
    public function getSipsPathFilePath()
    {
        return $this->sipsFolderPath . "/param/pathfile";
    }

    /**
     * Gets the path to the Sips request binary
     *
     * @return string
     */
    public function getSipsRequestExecPath()
    {
        return $this->sipsFolderPath . '/bin/request';
    }

    /**
     * Gets the path to the Sips response binary
     *
     * @return string
     */
    public function getSipsResponseExecPath()
    {
        return $this->sipsFolderPath . '/bin/response';
    }

    /**
     * @return mixed
     */
    public function getReturnContext()
    {
        return $this->returnContext;
    }

    /**
     * @param mixed $returnContext
     *
     * @return SipsBinaryCall
     */
    public function setReturnContext($returnContext)
    {
        $this->returnContext = $returnContext;

        return $this;
    }

    /**
     * Gets a string representing all the parameters to pass to the Sips binary
     *
     * @return string
     */
    abstract protected function buildRequest();
}
