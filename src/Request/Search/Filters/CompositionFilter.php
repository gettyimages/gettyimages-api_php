<?php

namespace GettyImages\Api\Request\Search\Filters {

    abstract class CompositionFilter {
        public static function Abstract_() {
            return new AbstractCompositionFilter();
        }

        public static function Candid() {
            return new CandidCompositionFilter();
        }
        
        public static function Close_Up() {
            return new CloseUpCompositionFilter();
        }
        
        public static function Copy_Space() {
            return new CopySpaceCompositionFilter();
        }
        
        public static function Cut_Out() {            
            return new CutOutCompositionFilter();
        }        
        
        public static function Full_Frame() {
            return new FullFrameCompositionFilter();
        }  
        
        public static function Full_Length() {
            return new FullLengthCompositionFilter();
        }  
        
        public static function Headshot() {
            return new HeadshotCompositionFilter();
        }  
        
        public static function Looking_At_Camera() {
            return new LookingAtCameraCompositionFilter();
        }  
        
        public static function Macro() {
            return new MacroCompositionFilter();
        }  
        
        public static function Portrait() {
            return new PortriatCompositionFilter();
        }
        
        public static function Sparse() {
            return new SparseCompositionFilter();
        }     
       
        public static function Still_Life() {
            return new StillLifeCompositionFilter();
        }            
        
        public static function Three_Quarter_Length() {
            return new ThreeQuarterLengthCompositionFilter();
        }     
        
        public static function Waist_Up() {
            return new WaistUpCompositionFilter();
        }                   

        public abstract function getValue(); 
    }

    class AbstractCompositionFilter extends CompositionFilter {
        public function getValue() {
            return "abstract";            
        }
    }
    
    class CandidCompositionFilter extends CompositionFilter {
        public function getValue() {
            return "candid";            
        }
    }
    
    class CloseUpCompositionFilter extends CompositionFilter {
        public function getValue() {
            return "close_up";            
        }
    }
    
    class CopySpaceCompositionFilter extends CompositionFilter {
        public function getValue() {
            return "copy_space";
        }
    }
    
    class CutOutCompositionFilter extends CompositionFilter {
        public function getValue() {
            return "cut_out";            
        }
    }              
    
    class FullFrameCompositionFilter extends CompositionFilter {
        public function getValue() {
            return "full_frame";            
        }
    }  
    
    class FullLengthCompositionFilter extends CompositionFilter {
        public function getValue() {
            return "full_length";
        }
    }
    
    class HeadshotCompositionFilter extends CompositionFilter {
        public function getValue() {
            return "headshot";
        }
    }
    
    class LookingAtCameraCompositionFilter extends CompositionFilter {
        public function getValue() {
            return "looking_at_camera";            
        }
    }  
    
    class MacroCompositionFilter extends CompositionFilter {
        public function getValue() {
            return "macro";            
        }
    }  
    
    class PortriatCompositionFilter extends CompositionFilter {
        public function getValue() {
            return "portrait";
        }
    }
    
    class SparseCompositionFilter extends CompositionFilter {
        public function getValue() {
            return "sparse";            
        }
    }      
    
    class StillLifeCompositionFilter extends CompositionFilter {
        public function getValue() {
            return "still_life";            
        }
    }  
    
    class ThreeQuarterLengthCompositionFilter extends CompositionFilter {
        public function getValue() {
            return "three_quarter_length";            
        }
    }  
    
    class WaistUpCompositionFilter extends CompositionFilter {
        public function getValue() {
            return "waist_up";            
        }
    }      
}