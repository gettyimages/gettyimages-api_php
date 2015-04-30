<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 9/17/14
 * Time: 11:44 AM
 */

namespace GettyImages\ApiClient\Request\Search\Filters\EditorialSegment {

    require_once("EntertainmentEditorialSegment.php");
    require_once("NewsEditorialSegment.php");
    require_once("PublicityEditorialSegment.php");
    require_once("RoyaltyEditorialSegment.php");
    require_once("SportEditorialSegment.php");
    require_once("ArchivalEditorialSegment.php");

    abstract class EditorialSegmentFilter {

        public static function Archival() {
            return new ArchivalEditorialSegmentFilter();
        }

        public static function Entertainment() {
            return new EntertainmentEditorialSegmentFilter();
        }

        public static function News() {
            return new NewsEditorialSegmentFilter();
        }

        public static function Publicity() {
            return new PublicityEditorialSegmentFilter();
        }

        public static function Royalty() {
            return new RoyaltyEditorialSegmentFilter();
        }

        public static function Sport() {
            return new SportEditorialSegmentFilter();
        }

        abstract function getValue();
    }
}

