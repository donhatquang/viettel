<?php

/**
 * Created by PhpStorm.
 * User: nhatquang
 * Date: 4/28/2015
 * Time: 3:00 PM
 */
namespace app\models;

class Language
{

    private $Langcode;

    function __construct()
    {
        $Langcode = [
            "Afrikaans" => "af",
            "Albanian" => "sq",
            "Arabic" => "ar",
            "Azerbaijani" => "az",
            "Basque" => "eu",
            "Bengali" => "bn",
            "Belarusian" => "be",
            "Bulgarian" => "bg",
            "Catalan" => "ca",
            "Chinese Simplified" => "zh-CN",
            "Chinese Traditional" => "zh-TW",
            "Croatian" => "hr",
            "Czech" => "cs",
            "Danish" => "da",
            "Dutch" => "nl",
            "English" => "en",
            "Esperanto" => "eo",
            "Estonian" => "et",
            "Filipino" => "tl",
            "Finnish" => "fi",
            "French" => "fr",
            "Galician" => "gl",
            "Georgian" => "ka",
            "German" => "de",
            "Greek" => "el",
            "Gujarati" => "gu",
            "Haitian Creole" => "ht",
            "Hebrew" => "iw",
            "Hindi" => "hi",
            "Hungarian" => "hu",
            "Icelandic" => "is",
            "Indonesian" => "id",
            "Irish" => "ga",
            "Italian" => "it",
            "Japanese" => "ja",
            "Kannada" => "kn",
            "Korean" => "ko",
            "Latin" => "la",
            "Latvian" => "lv",
            "Lithuanian" => "lt",
            "Macedonian" => "mk",
            "Malay" => "ms",
            "Maltese" => "mt",
            "Norwegian" => "no",
            "Persian" => "fa",
            "Polish" => "pl",
            "Portuguese" => "pt",
            "Romanian" => "ro",
            "Russian" => "ru",
            "Serbian" => "sr",
            "Slovak" => "sk",
            "Slovenian" => "sl",
            "Spanish" => "es",
            "Swahili" => "sw",
            "Swedish" => "sv",
            "Tamil" => "ta",
            "Telugu" => "te",
            "Thai" => "th",
            "Turkish" => "tr",
            "Ukrainian" => "uk",
            "Urdu" => "ur",
            "Vietnamese" => "vi",
            "Welsh" => "cy",
            "Yiddish" => "yi"

        ];

        $this->Langcode = $Langcode;
    }

    /**
     * @return mixed
     */
    public function getLangcode()
    {
        return $this->Langcode;
    }

    /**
     * @param mixed $Langcode
     */
    public function setLangcode($Langcode)
    {
        $this->Langcode = $Langcode;
    }
}
