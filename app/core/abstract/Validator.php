<?php 
namespace App\Core\abstract;


class Validator{
    private static array $errors = [];

    public static function validate($data, $rules) {
        self::$errors = [];
        
        foreach ($rules as $field => $fieldRules) {
            $value = $data[$field] ?? null;
            $rulesArray = explode('|', $fieldRules);
            
            foreach ($rulesArray as $rule) {
                self::applyRule($field, $value, $rule);
            }
        }
        
        return empty(self::$errors);
    }
    
    private static function applyRule($field, $value, $rule) {
        $ruleParts = explode(':', $rule);
        $ruleName = $ruleParts[0];
        $ruleValue = $ruleParts[1] ?? null;
        
        switch ($ruleName) {
            case 'required':
                if (empty($value)) {
                    self::addError($field, "Le champ $field est requis");
                }
                break;
                
            case 'email':
                if (!empty($value) && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    self::addError($field, "Le champ $field doit être un email valide");
                }
                break;
                
            case 'min':
                if (!empty($value) && strlen($value) < $ruleValue) {
                    self::addError($field, "Le champ $field doit contenir au moins $ruleValue caractères");
                }
                break;
                
            case 'max':
                if (!empty($value) && strlen($value) > $ruleValue) {
                    self::addError($field, "Le champ $field ne peut pas dépasser $ruleValue caractères");
                }
                break;
                
            case 'phone':
                if (!empty($value) && !preg_match('/^[0-9]{9}$/', $value)) {
                    self::addError($field, "Le champ $field doit être un numéro de téléphone valide (9 chiffres)");
                }
                break;
                
            case 'cni':
                if (!empty($value) && !preg_match('/^[0-9]{13}$/', $value)) {
                    self::addError($field, "Le champ $field doit être un numéro CNI valide (13 chiffres)");
                }
                break;
        }
    }
    
    public static function getErrors() {
        return self::$errors;
    }
    
    public static function addError(string $key, string $message) {
        self::$errors[$key] = $message;
    }
    
    public static function resetErrors() {
        self::$errors = [];
    }
    
    public static function isValid() {
        return empty(self::$errors);
    }

}