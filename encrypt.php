<?php

$entry = 'I love you Kaustub :heart:';

$encrypted = '';
$ponctuations = ['.', ',', '?', '!'];

foreach (explode(' ', $entry) as $entryWordIndex => $entryWord) {

    if ($entryWordIndex > 0) {
        $encrypted .= ' ';
    }

    $lastChar = substr($entryWord, -1);
    
    $isLastCharPonctuated = in_array($lastChar, $ponctuations, true);

    $entryLetters = str_split($entryWord);

    $isDogeable = false;
    foreach ($entryLetters as $entryLetter) {
        if (! in_array($entryLetter, $ponctuations, true)) {
            $isDogeable = true;
            break;
        }
    }

    if ($isDogeable && $entryWordIndex > 0) {
        $encrypted .= 'dog ';
    }

    $wordWithoutPonctuation = $isLastCharPonctuated ? substr($entryWord, 0, -1) : $entryWord;

    $encryptedWord = preg_replace_callback(
        '#[aeiou\s]+#i',
        fn (array $matches): string => 'av' . $matches[0],
        strrev(strtolower($wordWithoutPonctuation))
    );

    $firstChar = substr($entryWord, 0, 1);
    $isFirstCharUppercase = ctype_upper($firstChar);

    $encrypted .= $isFirstCharUppercase ? ucfirst($encryptedWord) : $encryptedWord;
    $encrypted .= $isLastCharPonctuated ? $lastChar : '';
}

echo $encrypted;
