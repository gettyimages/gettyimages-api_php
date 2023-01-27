<?php
/**
 * Exceptions thrown by the GettyImages API Client SDK and supporting classes
 *
 */

namespace GettyImages\Api\Exception {

    class ClientException extends \Exception 
    {
        private $errorCode;

        function __construct($message, $code, $errorCode) 
        {
            parent::__construct($message, $code);
            $this->errorCode = $errorCode;
        }

        function GetErrorCode() 
        {
            return $this->errorCode;
        }
    }

}