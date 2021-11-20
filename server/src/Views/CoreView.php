<?php

namespace MusicRating\Views;

class CoreView
{
    private $template;
    private $mainFolder;
    private $fileBaseExtension;

    public function __construct(?string $mainFolder = null, ?string $mainTemplate = null, ?string $fileBaseExtension = 'php') {
        
        $this->mainFolder = $mainFolder ?? dirname(__FILE__);
        $template = $mainTemplate !== null ? $mainTemplate : '/_template.php';
        $this->fileBaseExtension = $fileBaseExtension;
        
        $this->template = file_get_contents("{$this->mainFolder}{$template}");

    }

    public function render(?string $section, ?array $variables = null) {

        $this->setSectionInTemplate($section);

        if($variables) {
            $this->setValuesInHtml($variables);
        }
        
        return $this->template;
    }

    private function setValuesInHtml(array $variables) {
        foreach($variables as $key => $value) {
            if(is_array($value)) {
                echo 'fudeu';    
                continue;
            }

            $this->template =  str_replace("{{ {$key} }}", $value, $this->template);
        }
    }

    private function setSectionInTemplate(string $sectionFileName) {

        $section = file_get_contents("{$this->mainFolder}/{$sectionFileName}.{$this->fileBaseExtension}");
        $this->template = str_replace("{{ @content }}", $section, $this->template);
                    
        if(substr_count($this->template, "@folder->") > 0) {

            $templateArr = explode("{{ @folder", $this->template);
    
            foreach($templateArr as $elementString) {
                 $folderSectionElements[] = $this->getStringBetween($elementString, "->", " }}");
            }
    
            array_shift($folderSectionElements);
            
            foreach($folderSectionElements as $folderSectionElement) {
                $folderFiles[] = file_get_contents("{$this->mainFolder}/{$folderSectionElement}.{$this->fileBaseExtension}");
            }

            foreach($folderFiles as $key => $value) {
                $this->template = str_replace("{{ @folder->{$folderSectionElements[$key]} }}", $value, $this->template);
            }
        }


    }

    private function getStringBetween($string, $start, $end){
        
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;

        return substr($string, $ini, $len);
    }
}