<?php

/**
 * Copyright (c) Florian Krämer (https://florian-kraemer.net)
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Florian Krämer (https://florian-kraemer.net)
 * @author    Florian Krämer
 * @link      https://github.com/Phauthentic
 * @license   https://opensource.org/licenses/MIT MIT License
 */

declare(strict_types=1);

namespace Phauthentic\Test\TestCase\PathBuilder;

use Phauthentic\Infrastructure\Storage\FileFactory;
use Phauthentic\Infrastructure\Storage\FileInterface;
use Phauthentic\Infrastructure\Storage\PathBuilder\ConditionalPathBuilder;
use Phauthentic\Infrastructure\Storage\PathBuilder\PathBuilderInterface;
use Phauthentic\Test\TestCase\TestCase;

/**
 * ConditionalPathBuilderTest
 */
class ConditionalPathBuilderTest extends TestCase
{
    /**
     * @return void
     */
    public function testBuilder(): void
    {
        $fixtureFile = $this->getFixtureFile('titus.jpg');
        $file1 = FileFactory::fromDisk($fixtureFile, 'local')
            ->belongsToModel('User', '1');

        $file2 = FileFactory::fromDisk($fixtureFile, 'local')
            ->belongsToModel('Photos', '1');

        $defaultBuilder = $this->getMockBuilder(PathBuilderInterface::class)
            ->getMock();
        $defaultBuilder->expects($this->once())
            ->method('path')
            ->willReturn('');

        $otherPathBuilder = $this->getMockBuilder(PathBuilderInterface::class)
            ->getMock();
        $otherPathBuilder->expects($this->once())
            ->method('path')
            ->willReturn('');

        $conditionalBuilder = new ConditionalPathBuilder($defaultBuilder);

        $conditionalBuilder->addPathBuilder($otherPathBuilder, function (FileInterface $file) {
            return $file->model() === 'User';
        });

        $conditionalBuilder->path($file1);
        $conditionalBuilder->path($file2);
    }
}
