<?php
/**
 * (c) Pierre-Henry Soria <hi@ph7.me>
 * MIT License - https://opensource.org/licenses/MIT
 */

declare(strict_types=1);

namespace PHenry\Test\Unit\App\Kernel\Helper;

use PHenry\App\Kernel\Helper\Template;
use PHPUnit\Framework\TestCase;

class TemplateTest extends TestCase
{
    public function testRenderToBeString(): void
    {
        $actual = Template::render('homepage/index', ['key' => 'val']);

        $this->assertIsString($actual);
    }
}
