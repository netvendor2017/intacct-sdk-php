<?php

/**
 * In the new RealPage API custom fields are not prefixed or nested like previous versions.
 * They look like regular fields
 */

namespace Intacct\Functions\Traits;

use Intacct\Xml\XMLWriter;

trait CustomFieldsV2Trait
{
    
    /** @var array */
    protected $customFieldsV2 = [];

    /**
     * Get custom fields
     *
     * @return array
     */
    public function getCustomFieldsV2(): array
    {
        return $this->customFieldsV2;
    }

    /**
     * Set custom fields
     *
     * @param array $customFields
     */
    public function setCustomFieldsV2(array $customFields)
    {
        $this->customFieldsV2 = $customFields;
    }

    /**
     * @param XMLWriter $xml
     */
    protected function writeXmlExplicitCustomFieldsV2(XMLWriter &$xml)
    {
        if (count($this->customFieldsV2) > 0) {
            foreach ($this->customFields as $customField) {
                $xml->writeElement($customField['key'], $customField['value'], true);
            }
        }
    }

    /**
     * @param XMLWriter $xml
     */
    protected function writeXmlImplicitCustomFieldsV2(XMLWriter &$xml)
    {
        if (count($this->customFieldsV2) > 0) {
            foreach ($this->customFields as $customField) {
                $xml->writeElement($customField['key'], $customField['value'], true);
            }
        }
    }
}
