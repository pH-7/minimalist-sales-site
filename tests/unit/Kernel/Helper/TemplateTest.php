<?php
/**
 * (c) Pierre-Henry Soria <hi@ph7.me>
 * MIT License - https://opensource.org/licenses/MIT
 */

declare(strict_types=1);

namespace PHenry\App\Tests\Unit\Kernel\Helper;

use Mustache_Exception_UnknownTemplateException;
use PHenry\App\Kernel\Helper\Template;
use PHPUnit\Framework\TestCase;

final class TemplateTest extends TestCase
{
    public function testRenderToBeString(): void
    {
        $actual = Template::render('homepage/index', ['key' => 'val']);

        $this->assertIsString($actual);
    }

    public function testRenderToThrowAnException(): void
    {
        $this->expectException(Mustache_Exception_UnknownTemplateException::class);

        Template::render('wrongpath', ['key' => 'val']);
    }
}
