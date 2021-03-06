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

namespace Phauthentic\Infrastructure\Storage;

use League\Flysystem\AdapterInterface;

/**
 * FileStorageInterface
 */
interface FileStorageInterface
{
    /**
     * Stores the file in the storage backend and provides the file entity
     * with a path after the file was stored.
     *
     * @param \Phauthentic\Infrastructure\Storage\FileInterface $file File
     * @return \Phauthentic\Infrastructure\Storage\FileInterface
     */
    public function store(FileInterface $file): FileInterface;

    /**
     * Removes a file from the storage backend
     *
     * @param \Phauthentic\Infrastructure\Storage\FileInterface $file File
     * @return \Phauthentic\Infrastructure\Storage\FileInterface
     */
    public function remove(FileInterface $file): FileInterface;

    /**
     * @param \Phauthentic\Infrastructure\Storage\FileInterface $file File
     * @param string $name Name
     * @return \Phauthentic\Infrastructure\Storage\FileInterface
     */
    public function removeVariant(FileInterface $file, string $name): FileInterface;

    /**
     * Gets the storage abstraction to use
     *
     * @param string $storage Storage name to use
     * @return \League\Flysystem\AdapterInterface
     */
    public function getStorage(string $storage): AdapterInterface;
}
