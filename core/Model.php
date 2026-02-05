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

    public function validate()
    {
        dump('Attr',$this->attributes);
        dump('Rules', $this->rules);

        foreach ($this->attributes as $fieldname => $value) {
            if (isset($this->rules[$fieldname])) {
                $this->check([
                    'fieldname' => $fieldname,
                    'value' => $value,
                    'rules' => $this->rules[$fieldname],
                ]);
            }
        }
    }

    protected function check(array $field): void
    {
        dump($field);
        foreach ($field['rules'] as $rule_name => $rule_value) {
            if(in_array($rule_name, $this->rules_list)){
                if(!call_user_func_array([$this, $rule_name], [$field['value'], $rule_value])){
                    var_dump('Error:', $field['fieldname'] .' - ' . $rule_name);
                }
            }
        }
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