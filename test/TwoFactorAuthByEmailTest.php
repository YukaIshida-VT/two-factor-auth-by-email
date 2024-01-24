<?php

namespace TwoFactorAuthByEmail;

use TwoFactorAuthByEmail\TwoFactorAuthByEmail;
use PHPUnit\Framework\TestCase;

// Mock mb_send_mail function in the same namespace
function mb_send_mail($to, $subject, $message)
{
    // You can return a fixed value or use PHPUnit's assertions here
    TestCase::assertEquals('expected@example.com', $to);
    TestCase::assertEquals('Subject', $subject);
    TestCase::assertEquals('Message', $message);
    return true;
}

class TwoFactorAuthByEmailTest extends TestCase
{
    public function testSendAuthCode()
    {
      $res = TwoFactorAuthByEmail::sendAuthCode('to_address@example.com', 'from_address');
      $this->assertTrue($res);
    }
}