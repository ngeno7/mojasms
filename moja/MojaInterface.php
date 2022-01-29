<?php

namespace Moja;

interface MojaInterface {
    public function getToken();
    public function getBalance();
    public function sendSMS($sms = null, $phone=null);
    public function sendBulkSMS($smses);
}