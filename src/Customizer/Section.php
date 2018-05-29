<?php

namespace IBX\Customizer;

use IBX\Customizer\Interfaces\IField;

class Section {
    private $id;
    private $title;
    private $priority;
    private $description;
    private $wp_customize;
    public $show_vars = false;
    private $fields = array();

    public function __construct($w)
    {
        $this->wp_customize = $w;
    }

    public function addField($f)
    {
        if(! $f instanceof IField) {
            throw new \Exception('first parameter must be an instance of IField Interface.');
        }

        $this->fields[] = $f;
    }

    public function display()
    {
        if(! sizeof($this->fields)) {
            throw new \Exception('section must have atleast one (1) field to customize');
        }

        $this->wp_customize->add_section(
            $this->getSectionID(),
            array(
                'title'         => $this->title,
                'priority'      => $this->priority,
                'description'   => $this->description
            )
        );

        foreach($this->fields as $field) {
            $this->wp_customize->add_setting($field->getSettingID($this));
            $this->wp_customize->add_control($field->getControl($this));
        }
    }

    public function showVars() {
        $this->show_vars = true;
        return $this;
    }

    public function devMode() {
        return $this->show_vars;
    }

    public function setID($i) { $this->id = $i; }
    public function setTitle($t) { $this->title = $t; }
    public function setPrio($p) { $this->priority = $p; }
    public function setDesc($d) { $this->description = $d; }
    public function getID() { return $this->id; }
    public function getWPCustomize() { return $this->wp_customize; }
    public function getSectionID() { return $this->id . '_options'; }
}
