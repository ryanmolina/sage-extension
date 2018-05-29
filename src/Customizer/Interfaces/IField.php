<?php

namespace IBX\Customizer\Interfaces;

interface IField {
    public function __construct($s, $i, $l);
    public function setSettingID();
    public function getSettingID();
    public function setControlID();
    public function getControlID();
    public function getControl();
}
