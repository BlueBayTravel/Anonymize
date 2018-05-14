<?php

/*
 * This file is part of Anyomize.
 *
 * (c) Blue Bay Travel <developers@bluebaytravel.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BlueBayTravel\Anonymize;

/**
 * This is the anonymize class.
 * 
 * @author James Brooks <james@bluebaytravel.co.uk>
 */
class Anonymize
{
    /**
     * Netmask for IPv4 addresses.
     * 
     * @var string
     */
    const IPV4_NETMASK = '255.255.255.0';

    /**
     * Netmask for IPv6 addresses.
     * 
     * @var string
     */
    const IPV6_NETMASK = 'ffff:ffff:ffff:ffff:0000:0000:0000:0000';

    /**
     * Anomyize the IP address.
     * 
     * @param string      $address
     * @param string|null $mask
     * 
     * @return string|null
     */
    public function run(string $address, string $mask = null) : ?string
    {
        $packedAddress = inet_pton($address);
        $addressLength = strlen($packedAddress);

        if ($addressLength === 4) {
            return inet_ntop(inet_pton($address) & inet_pton($mask ?? self::IPV4_NETMASK));
        } elseif ($addressLength === 16) {
            return inet_ntop(inet_pton($address) & inet_pton($mask ?? self::IPV6_NETMASK));
        }

        return null;
    }
}
