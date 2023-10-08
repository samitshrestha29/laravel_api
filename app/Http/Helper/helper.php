
<?php
// Check if the function 'p' does not exist
if (!function_exists('p')) {
    // If it doesn't exist, define the function 'p'
    function p($data)
    {
        // Print the data in a preformatted style
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
}

