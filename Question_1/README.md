# PHP Directory Size Calculator

This PHP script calculates the total size of all files within a given directory, including its subdirectories, and outputs the total size in bytes.

## Features

-   Recursively traverses directories to include all files in the size calculation.
-   Skips directories and counts only file sizes.
-   Optimize performance by minimizing unnecessary filesystem calls.
-   Provides an easy-to-use interface to specify a directory path.

## How to Use

1. Open a terminal and navigate to the directory containing the file.
2. Run the script using the PHP command:
    ```bash
    php calculateDirectorySize.php
    ```
3. When prompted, enter the path to the directory whose size you want to calculate.
4. The script will output the total size in bytes.

## Code Explanation

### Function: `calculateDirectorySize($directoryPath)`

This function calculates the total size of all files in the specified directory.

#### Parameters

-   `$directoryPath`: The path to the directory whose size you want to calculate.

#### Process

1. **Check if the path is valid:**

    - Uses `is_dir()` to confirm that the provided path is a valid directory.
    - If invalid, the function returns `0`.

2. **Set up Iterators:**

    - A `RecursiveDirectoryIterator` is created to traverse the directory.
    - A `RecursiveIteratorIterator` is used to recursively iterate through all files.

3. **File Size Accumulation:**

    - For each file, `getSize()` retrieves the file size in bytes.
    - The sizes are accumulated in the `$totalSize` variable.

4. **Return the Total Size:**
    - After processing all files, the total size is returned.

### Input

-   The script uses `readline()` to take input from the user for the directory path.

### Output

-   Displays the total size of the directory in bytes.

## Example

```bash
Enter a directory path: /path/to/directory
Total size: 123456 bytes
```

## Notes

-   Ensure the script has appropriate permissions to access the specified directory and its contents.
