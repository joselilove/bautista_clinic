<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         3.7.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
namespace Cake\TestSuite;

use Cake\Mailer\Email;
use Cake\Mailer\TransportFactory;
use Cake\Mailer\Transport\DebugTransport;

/**
 * TestEmailTransport
 *
 * Set this as the email transport to capture emails for later assertions
 *
 * @see Cake\TestSuite\EmailTrait
 */
class TestEmailTransport extends DebugTransport
{
    private static $emails = [];

    /**
     * Stores email for later assertions
     *
     * @param \Cake\Mailer\Email $email Email
     * @return array
     */
    public function send(Email $email)
    {
        static::$emails[] = $email;

        return parent::send($email);
    }

    /**
     * Replaces all currently configured transports with this one
     *
     * @return void
     */
    public static function replaceAllTransports()
    {
        $configuredTransports = TransportFactory::configured();

        foreach ($configuredTransports as $configuredTransport) {
            $config = TransportFactory::getConfig($configuredTransport);
            $config['className'] = self::class;
            TransportFactory::drop($configuredTransport);
            TransportFactory::setConfig($configuredTransport, $config);
        }
    }

    /**
     * Gets emails sent
     *
     * @return \Cake\Mailer\Email[]
     */
    public static function getEmails()
    {
        return static::$emails;
    }

    /**
     * Clears list of emails that have been sent
     *
     * @return void
     */
    public static function clearEmails()
    {
        static::$emails = [];
    }
}
