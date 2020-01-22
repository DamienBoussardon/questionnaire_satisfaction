<?php
namespace App\Service;

class CustomUserEntry
{

    public function customNameOfQuestion($question)
    {
        // $question = strtolower($question);
        // $question = preg_replace('/[^a-zA-Z éiêàùïç 0-9]/i', ' ', $question);
        // $question = trim($question);
        // $question = ucfirst($question);
        // return $question;
        $questionLow = strtolower($question);
        $questionReplaced = preg_replace('/[^a-zA-Z éiêàùïç 0-9]/i', ' ', $questionLow);
        $questionTrim = trim($questionReplaced);
        $questionCustomize = ucfirst($questionTrim);
        return $questionCustomize;
    }

    public function customCollectionOfAssociatedValue($associatedValues)
    {
        foreach($associatedValues as $key => $value) {
            $associatedValues[$key] = $this->customNameOfQuestion($value);
         }
         return $associatedValues;
    }

}