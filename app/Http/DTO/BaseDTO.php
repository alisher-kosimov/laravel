<?php

namespace App\Http\DTO;

use Illuminate\Http\Request;

abstract class BaseDTO
{
    abstract public function build(Request $request): self;

    protected function buildFromRequest(Request $request): self
    {
        $properties = get_class_vars(get_class($this));

        foreach ($request->validated() as $key => $value) {
            if (key_exists($key, $properties)) {
                $this->$key = $value;
            }
        }
        return $this;
    }

    public function buildFromArray(array $data): self
    {
        $properties = get_class_vars(get_class($this));

        foreach ($data as $key => $value) {
            if (key_exists($key, $properties)) {
                $this->$key = $value;
            }
        }
        return $this;
    }

    public function toArray(): array
    {
        $data = [];
        $properties = get_class_vars(get_class($this));

        foreach ($properties as $property => $value) {
            $data[$property] = $this->$property;
        }
        return $data;
    }

}
