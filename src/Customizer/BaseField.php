<?php

namespace IBX\Customizer;

class BaseField {
    public function setSettingID() { $this->setting_id = "{$this->section->getID()}_{$this->id}"; }
    public function setControlID() { $this->control_id = $this->getSettingID() . '_control'; }
    public function getSettingID() { return $this->setting_id; }
    public function getControlID() { return $this->control_id; }
    public function showVars() {
        return $this->description .= "setting_id: " . $this->getSettingID();
    }
}
