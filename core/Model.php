<?php

namespace PHPFramework;

abstract class Model{

    public array $fillable = ['email', 'content'];
    public array $attributes = [];
    public array $rules = [];

    protected array $errors = [];
    protected array $rules_list = ['required', 'min', 'max', 'email'];
    protected array $messages = [
        'required' => 'The :fieldname: field is required',
        'min' => 'The :fieldname: field must be a minimun :rulevalue: characters',
        'max' => 'The :fieldname: field must be a maximum :rulevalue: characters',
        'email' => 'The :fieldname: field must be a valid email address',
    ];

    public function loadData(): void
    {
        $data = request()->getData();
        foreach ($this->fillable as $v) {
            if (isset($data[$v])) {
                $this->attributes[$v] = $data[$v];
            } else {
                $this->attributes[$v] = '';
            }
        }
    }

    public function isValid(): bool
    {
        foreach ($this->attributes as $field_name => $value) {
            if (isset($this->rules[$field_name])) {
                $this->check([
                    'fieldname' => $field_name,
                    'value' => $value,
                    'rules' => $this->rules[$field_name],
                ]);
            }
        }

        return !$this->hasErrors();
    }
    

    public function getErrors():array{
        return $this->errors;
    }

    protected function check(array $field): void
    {
        foreach ($field['rules'] as $rule_name => $rule_value) {
            if(in_array($rule_name, $this->rules_list)){
                if(!call_user_func_array([$this, $rule_name], [$field['value'], $rule_value])){
                   $this->addError(
                        $field['fieldname'],
                        str_replace(
                            [':fieldname:', ':rulevalue:'],
                            [$field['fieldname'], $rule_value],
                            $this->messages[$rule_name]  
                        )
                    );
                }
            }
        }
        
    }

    protected function addError($field_name, $error): void
    {
        $this->errors[$field_name][] = $error;
       
    }

    protected function hasErrors(): bool{
        return !empty($this->errors);
    }

    protected function required( string $value, string $rule_value): bool
    {
        return !empty(trim($value));
    }

    protected function min( string $value, string $rule_value): bool
    {
        return mb_strlen($value, 'UTF-8') >= (int)$rule_value;
    }

    protected function max( string $value, string $rule_value): bool
    {
         return mb_strlen($value, 'UTF-8') <= (int)$rule_value;
    }  
    
    protected function email( string $value, string $rule_value): bool
    {
         return filter_var($value, FILTER_VALIDATE_EMAIL);
    }  
}