# PHP Sum Array within Range

This PHP script calculates the sum of array elements that fall within a specified range. It ensures proper validation of input values and handles edge cases effectively.

## Features

-   Calculates the sum of elements in the predefined array: `[10, 20, 30, 40, 50, 60, 70, 80, 90, 100]`.
-   Validates input values for positivity and proper range.
-   Handles scenarios where the specified range is outside the bounds of the array.

## Function Definition

```php
function sumArrayWithinRange($start, $end)
```

-   **Parameters:**
    -   `$start`: The lower bound of the range (inclusive).
    -   `$end`: The upper bound of the range (inclusive).
-   **Returns:**
    -   The sum of elements within the range.
    -   `-1` if either `$start` or `$end` is less than 1.
    -   `0` if the range is invalid or out of bounds.

## Output Example

```
Sum between 1 and 50 is 150
```

## Input Validation

1. **Non-positive values:**

    - If `$start` or `$end` is less than 1, the function returns `-1`.

2. **Invalid range:**

    - If `$start` is greater than `$end`, the function returns `0`.

3. **Out of bounds:**
    - If `$start` is greater than the maximum value in the array, the function returns `0`.

## Example Scenarios

1. **Valid Range:**

    ```php
    sumArrayWithinRange(10, 50); // Returns 150
    ```

2. **Non-positive Input:**

    ```php
    sumArrayWithinRange(-5, 50); // Returns -1
    ```

3. **Invalid Range:**

    ```php
    sumArrayWithinRange(60, 20); // Returns 0
    ```

4. **Out of Bounds:**
    ```php
    sumArrayWithinRange(110, 120); // Returns 0
    ```
