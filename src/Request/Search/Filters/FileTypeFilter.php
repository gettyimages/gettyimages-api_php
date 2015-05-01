<?php

namespace GettyImages\Api\Request\Search\Filters {

    abstract class FileTypeFilter {

        public static function Eps() {
            return new EpsFileTypeFilter();
        }
        
        public static function Gif() {
            return new GifFileTypeFilter();
        }
        
        public static function Jpg() {
            return new JpgFileTypeFilter();
        }        

        public static function Png() {
            return new PngFileTypeFilter();
        }        
        
        public abstract function getValue(); 
    }
    
    
    class EpsFileTypeFilter extends FileTypeFilter {
        public function getValue() {
            return "eps";            
        }
    }
    
    class GifFileTypeFilter extends FileTypeFilter {
        public function getValue() {
            return "gif";            
        }
    }
    
    class JpgFileTypeFilter extends FileTypeFilter {
        public function getValue() {
            return "jpg";            
        }
    }
    
    class PngFileTypeFilter extends FileTypeFilter {
        public function getValue() {
            return "png";            
        }
    }    
}
