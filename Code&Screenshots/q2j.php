<?php
function lineSum(string $filename, int $lineNumber): int {
    if (!file_exists($filename) || $lineNumber < 1) {
        return 0;
    }
    $handle = fopen($filename, "r");
    if (!$handle) return 0;
    $current = 0;
    $sum = 0;
    while (($line = fgets($handle)) !== false) {
        if (trim($line) === "" || str_starts_with(trim($line), "#")) {
            continue;
        }
        $current++;
        if ($current == $lineNumber) {
            $tokens = preg_split('/\s+/', trim($line));
            foreach ($tokens as $tok) {
                if (ctype_digit($tok)) {
                    $sum += intval($tok);
                }
            }
            fclose($handle);
            return $sum;
        }
    }
    fclose($handle);
}
echo lineSum("sums.txt", 2);
?>