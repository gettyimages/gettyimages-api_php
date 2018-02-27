<?php

namespace GettyImages\Api\Request\Downloads {

    use GettyImages\Api\Request\FluentRequest;
    use GettyImages\Api\Request\WebHelper;

    class Downloads extends FluentRequest {

        protected function getRoute() {
            return "downloads/";
        }

        protected function getMethod() {
            return "get";
        }

        /**
         * @return $this
         */
        public function withCompanyDownloads() {
            $this->requestDetails["company_downloads"] = "true";
            return $this;
        }

        /**
         * @param string $endDate
         * @return $this
         */
        public function withEndDate(string $endDate) {
            $this->requestDetails["end_date"] = $endDate;
            return $this;
        }

        /**
         * @param int $pageNum
         * @return $this
         */
        public function withPage(int $pageNum) {
            $this->requestDetails["page"] = $pageNum;
            return $this;
        }

        /**
         * @param int $pageSize
         * @return $this
         */
        public function withPageSize(int $pageSize) {
            $this->requestDetails["page_size"] = $pageSize;
            return $this;
        }

        /**
         * @param string $productType
         * @return $this
         */
        public function withProductType(string $productType) {
            $this->requestDetails["product_type"] = $productType;
            return $this;
        }

        /**
         * @param string $startDate
         * @return $this
         */
        public function withStartDate(string $startDate) {
            $this->requestDetails["start_date"] = $startDate;
            return $this;
        }

    }
}