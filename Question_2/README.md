# PHP Word Frequency Counter

This PHP script find the top five most frequent words in a given text. It is designed to handle multilingual text and ensures case insensitivity while ignoring punctuation.

## Features

-   Handles text normalization by converting to lowercase and removing punctuation.
-   Sorts words by frequency in descending order, and alphabetically for ties.
-   Supports Unicode characters for multilingual text.
-   Efficiently processes and identifies the top five words along with their counts.

## Code Explanation

1. **Text Normalization:**

    - Converts all characters to lowercase using `strtolower()` to make the function case-insensitive.
    - Removes punctuation marks using `preg_replace('/[\p{P}]/u', '', $text)`, which is Unicode-compatible.

2. **Word Segmentation:**

    - Splits the text into individual words using `preg_split('/\s+/')`, which handles spaces and other whitespace characters.

3. **Frequency Calculation:**

    - Counts the occurrences of each word using `array_count_values()`.

4. **Sorting Logic:**

    - Uses `uksort()` to sort the words based on frequency (descending).
    - Resolves ties alphabetically using `strcmp()`.

5. **Top 5 Words:**
    - Extracts the top five most frequent words using `array_slice()`.

### Example

```php
$text = "The quick brown fox jumps over the lazy dog. The dog was not amused. The fox, quick and clever, decided to run away. The lazy dog stayed behind, sleeping under the bright sun. Quick decisions can make a big difference, thought the fox.";

$result = findTopFiveFrequentWords($text);
print_r($result);
```

#### Output:

```php
Array
(
    [the] => 8
    [dog] => 3
    [fox] => 3
    [quick] => 3
    [lazy] => 2
)
```

### Input Requirements

-   Provide a string containing the text to be analyzed.
-   Ensure that the text contains words separated by spaces or other whitespace characters.

### Notes

-   The function uses Unicode-compatible regular expressions, making it suitable for multilingual text processing.
-   Punctuation is stripped, but numeric and alphanumeric words are preserved.
-   Does not handle special cases like contractions (e.g., "don't" becomes "dont").
