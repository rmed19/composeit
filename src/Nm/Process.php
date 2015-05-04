<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace NM;

use Nm\Parser\ParserFactory;

/**
 * Description of Process
 *
 * @author mr
 */
class Process
{

    private $sourceReader;
    private $distinationReader;

    public function __construct($sourceFile, $distinationFile)
    {
        $this->sourceReader = new ParserFactory($sourceFile);
        $this->distinationReader = new ParserFactory($distinationFile);
    }

    public function verifIfWasConfigured()
    {
        foreach (array_keys($this->distinationReader->getContent()) as $key) {
            if (array_key_exists($key, $this->sourceReader->getContent())) {
                return true;
            }
        }

        return false;
    }

    public function launchConfiguration($output, $dialog)
    {
        $this->configureParam($this->sourceContent, $output, $dialog);
        $distinationContent = array_merge($this->distinationReader->getContent(),$this->sourceReader->getContent());
    }

    public function configureParam(&$params, $output, $dialog)
    {
        foreach ($params as $key => &$value) {
            if (is_array($value)) {
                $this->configureParam($value, $output, $dialog);
            } else {
                $newValue = $dialog->ask(
                        $output, "Please enter $key value [$value] : ", $value
                );
                if(null !== $newValue) {
                    $value = $newValue;
                }
            }
        }
    }

}
