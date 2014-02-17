<?php

class Email extends CComponent {

    public static function sendMail($to,$subject,$message) {

        if ( Yii::app()->params['sendMailType'] == 1 ) {

            $siteName='=?UTF-8?B?'.base64_encode(Yii::app()->name).'?=';
            $adminEmail = Yii::app()->params['adminEmail'];

            $headers =
                "From: {$siteName} <{$adminEmail}>\r\n" .
                "Reply-To: {$adminEmail}\r\n" .
                "MIME-Version: 1.0\r\n" .
                "Content-Type: text/html; charset=\"utf-8\"\r\n" .
                "Content-Transfer-Encoding: 8bit\r\n" .
                "X-Mailer: PHP/" . phpversion();

            //$message = wordwrap($message, 70);
            $message = str_replace("\r\n", "\n", $message);
            $message = str_replace("\n.", "\n..", $message);

            $message = "<html>\n<head><title>{$subject}</title>\n</head>\n<body>\n{$message}</body>\n</html>\n";

            return mail($to,'=?utf-8?B?' . base64_encode($subject) . '?=',$message,$headers, "-f{$adminEmail}");

        } elseif ( Yii::app()->params['sendMailType'] == 2 ) {

            $__smtp= Yii::app()->params['smtp'];

            Yii::app()->mailer->IsSMTP();
            Yii::app()->mailer->Subject = $subject;
            Yii::app()->mailer->Body = $message;

            if ( is_array($to) ) {
                foreach ($to as $value) {
                    Yii::app()->mailer->AddAddress($value);
                }
            } else {
                Yii::app()->mailer->AddAddress($to);
            }

            Yii::app()->mailer->Host = $__smtp['host'];
            Yii::app()->mailer->SMTPDebug = $__smtp['debug'];
            Yii::app()->mailer->SMTPAuth = $__smtp['auth'];
            Yii::app()->mailer->Host = $__smtp['host'];
            Yii::app()->mailer->Port = $__smtp['port'];
            Yii::app()->mailer->Username = $__smtp['username'];
            Yii::app()->mailer->Password = $__smtp['password'];
            Yii::app()->mailer->CharSet = $__smtp['charset'];

            Yii::app()->mailer->From = $__smtp['from'];
            Yii::app()->mailer->FromName = $__smtp['fromname'];

            Yii::app()->mailer->Send();
        }

    }

}