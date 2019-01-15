<?php

declare(strict_types=1);

/*
 * This file is part of DOCtor-RST.
 *
 * (c) Oskar Stark <oskarstark@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Rule;

use App\Handler\RulesHandler;

class PhpPrefixBeforeBinConsole implements Rule
{
    public static function getName(): string
    {
        return 'php_prefix_before_bin_console';
    }

    public static function getGroups(): array
    {
        return [RulesHandler::GROUP_SYMFONY];
    }

    public function check(\ArrayIterator $lines, int $number)
    {
        $lines->seek($number);
        $line = $lines->current();

        if (strstr($line, 'bin/console') && !strstr($line, 'php bin/console') && !strstr($line, '``bin/console') && !strstr($line, '"bin/console')) {
            return 'Please add "php" prefix before "bin/console"';
        }
    }
}