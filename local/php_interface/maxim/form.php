<?php

namespace maxim;

class Form 
{
    protected string $formId = '';
	protected string $iblock_id = '';
	protected array $required = [];

    public function __construct(string $formId)
    {
        $this->formId = $formId;
    }

    public function setInfoBlockID(string $iblock_id): void
    {
		if ($this->iblock_id != $iblock_id) {
			$this->iblock_id = $iblock_id;
		}
    }

    public function getInfoBlockID(): string
    {
		return $this->iblock_id;
    }

    public function getRequired(): array
    {
		return $this->required;
    }

    public function addRequired(string $code): void
    {
		if (!in_array($code, $this->required)) {
			$this->required[] = $code;
		}
    }

    public function removeRequired(string $code): void
    {
		if (in_array($code, $this->required)) {
			$key = array_search($code, $this->required);
			array_splice($this->required, $key, 1);
		}
    }
}