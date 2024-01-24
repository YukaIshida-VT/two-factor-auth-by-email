<?php

namespace TwoFactorAuthByEmail;

use TwoFactorAuthByEmail\TwoFactorAuthByEmailTable;

/**
 * Class Utility
 * @package TwoFactorAuthByEmail
 */
class TwoFactorAuthByEmail
{
    /**
     * @param  string $email
     * @param  string $from
     * @return bool
     */
    public static function sendAuthCode($email, $from, $title = '【Your App】Two-Factor Authentication Code')
    {
        // 6桁の認証コードを生成
        $code = '';
        for ($i = 0; $i < 6; $i++) {
            $code .= mt_rand(0, 9);
        }

        // 既存の認証コードを削除
        TwoFactorAuthByEmailTable::where('email', $email)->delete();
        // 認証コードをテーブルに保存
        TwoFactorAuthByEmailTable::create([
            'email' => $email,
            'auth_code' => $code,
            'created_at' => now()
        ]);

        try {
            // メール送信
            mb_send_mail(
                $email,
                $title,
                'Your authentication code is: ' . $code,
                'From: ' . $from
            );
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public static function verifyAuthCode($email, $code)
    {
        $table = TwoFactorAuthByEmailTable::firstWhere('email', $email);
        // AuthCode発行から1時間を経過しているか
        $codeExpired = Carbon::parse($table->created_at)->addSeconds(3600)->isPast();

        if ($codeExpired || $code != $table->auth_code) {
            // 1時間を経過しているもしくはauthCodeが一致しない場合
            return false;
        }
        return true;
    }
}