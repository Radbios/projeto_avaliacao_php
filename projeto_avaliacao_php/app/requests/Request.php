<?php

namespace app\requests;

class Request {
    protected $data;
    protected $error;
    protected function rules() {
        return [
            ''
        ];
    }
    public function validate() {
        $rules = $this->rules();

        foreach ($rules as $field => $rule) {
            if(method_exists($this, $rule)) {
                $this->$rule($field);
            }
            else throw new \Exception("Regra de validação '$rule' não existe");
        }

        return !$this->error;
    }

    protected function required($field) {
        if (empty($this->data[$field])) {
            $this->error = true;;
        }
    }
}