<?php

namespace IBX\Customizer\Fields;

use IBX\Customizer\Interfaces\IField;
use IBX\Customizer\BaseField;

class Checkbox extends BaseField implements IField {
    public $id;
    public $section;
    public $setting_id;
    public $control_id;
    public $description = '';
    private $label;
    private $type = 'checkbox';

    public function __construct($s, $i, $l) {
        $this->id = $i;
        $this->label = $l;
        $this->section = $s;
        $this->setSettingID();
        $this->setControlID();
    }

    public function getControl() {
        if($this->section->devMode()) {
            $this->showVars();
        }

        return new \WP_Customize_Control(
            $this->section->getWPCustomize(),
            $this->getControlID(),
            array(
                'label'     => $this->label,
                'section'   => $this->section->getSectionID(),
                'settings'  => $this->getSettingID(),
                'type'      => $this->type,
                'description' => $this->description
            )
        );
    }

}
