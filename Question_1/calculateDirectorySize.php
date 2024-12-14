<?php

function calculateDirectorySize($directoryPath)
{
    $totalSize = 0;

    if (!is_dir($directoryPath)) {
        return 0;
    }

    $directoryIterator = new RecursiveDirectoryIterator($directoryPath, RecursiveDirectoryIterator::SKIP_DOTS);

    // Create a RecursiveIteratorIterator to traverse the directory recursively
    $iterator = new RecursiveIteratorIterator($directoryIterator);

    // Iterate over each file and accumulate their sizes
    foreach ($iterator as $file) {
        if ($file->isFile()) {
            $totalSize += $file->getSize();
        }
    }

    return $totalSize;
}

$directoryPath = trim(readline('Enter a directory path: '));
echo "Total size: " . calculateDirectorySize($directoryPath) . " bytes\n";

