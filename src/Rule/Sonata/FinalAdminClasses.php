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

namespace App\Rule\Sonata;

use App\Handler\RulesHandler;
use App\Rst\RstParser;
use App\Rule\Rule;

class FinalAdminClasses implements Rule
{
    public static function getName(): string
    {
        return 'final_admin_classes';
    }

    public static function getGroups(): array
    {
        return [RulesHandler::GROUP_SONATA];
    }

    public function check(\ArrayIterator $lines, int $number)
    {
        $lines->seek($number);
        $line = $lines->current();

        $line = RstParser::clean($line);

        if (preg_match('/^class(.*)extends AbstractAdminExtension$/', $line)) {
            return 'Please use "final" for AdminExtension class';
        }

        if (preg_match('/^class(.*)extends AbstractAdmin$/', $line)) {
            return 'Please use "final" for Admin class';
        }
    }
}