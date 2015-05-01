<?php
namespace GettyImages\Api\Request\Search\Filters {

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

    class ArchivalEditorialSegmentFilter extends EditorialSegmentFilter {
        function getValue()
        {
            return "archival";
        }
    }

    class EntertainmentEditorialSegmentFilter extends EditorialSegmentFilter
    {
        function getValue()
        {
            return "entertainment";
        }
    }

    class NewsEditorialSegmentFilter extends EditorialSegmentFilter 
    {
        function getValue()
        {
            return "news";
        }
    }

    class PublicityEditorialSegmentFilter extends EditorialSegmentFilter
    {
        function getValue()
        {
            return "publicity";
        }
    }

    class RoyaltyEditorialSegmentFilter extends EditorialSegmentFilter 
    {
        function getValue()
        {
            return "royalty";
        }
    }

    class SportEditorialSegmentFilter extends EditorialSegmentFilter 
    {
        function getValue()
        {
            return "sport";
        }
    }
}