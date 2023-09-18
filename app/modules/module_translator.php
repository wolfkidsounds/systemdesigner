<?php //module_translator.php
class Translator {
    public static function translate($key) {
        $translation_file = Modules::Translator()->getLanguage();
        //out("getLanguage:" . $translation_file);
    
        if (file_exists($translation_file)) {
            //out("translation exists:" . $translation_file);
            $translations = require($translation_file);

            if (isset($translations[$key])) {
                //out("key was set:" . $translations[$key]);
                return out($translations[$key]);

            } else {
                echo "Translation key '$key' not found in file '$translation_file'.";
                return out($key);
            }

        } else {
            echo "Translation file '$translation_file' not found.";
        }
        
        return out($key);
    }

    public static function getLanguage() {
        if (!isset($_SESSION['selected_language'])) {
            $lang = $_SESSION['selected_language'] = 'en';
            //out("Session is not set:" . $lang);
        } else {
            $lang = $_SESSION['selected_language'];
            //out("Session is set:" . $lang);
        }
        //out("getLanguage:" . "app/lang/{$lang}.php");
        return "app/lang/{$lang}.php";
    }

    public static function setLanguage() {
        Functions::startSession();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['selected_language'])) {
                $selectedLanguage = $_POST['selected_language'];
                $_SESSION['selected_language'] = $selectedLanguage;
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }
        }
    }
}