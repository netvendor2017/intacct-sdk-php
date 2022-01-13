<?php

/**
 * Copyright 2021 Sage Intacct, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"). You may not
 * use this file except in compliance with the License. You may obtain a copy
 * of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * or in the "LICENSE" file accompanying this file. This file is distributed on
 * an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either
 * express or implied. See the License for the specific language governing
 * permissions and limitations under the License.
 */

namespace Intacct\Functions\Company;

use Intacct\Xml\XMLWriter;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Intacct\Functions\Company\AllocationCreate
 */
class AllocationCreateTest extends TestCase
{

    public function testConstruct(): void
    {
        $expected = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<function controlid="unittest">
    <create>
        <ALLOCATION>
            <ALLOCATIONID>SPLIT60-40</ALLOCATIONID>
            <TYPE>Percentage</TYPE>
        </ALLOCATION>
    </create>
</function>
EOF;

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $record = new AllocationCreate('unittest');
        $record->setAllocationId('SPLIT60-40');
        $record->setAllocateBy(AbstractAllocation::ALLOCATE_BY_PERCENTAGE);

        $record->writeXml($xml);

        $this->assertXmlStringEqualsXmlString($expected, $xml->flush());
    }

    public function testRequiredId(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Allocation ID is required for create");

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $record = new AllocationCreate('unittest');
        //$record->setAllocationId('SPLIT60-40');
        $record->setAllocateBy(AbstractAllocation::ALLOCATE_BY_PERCENTAGE);

        $record->writeXml($xml);
    }

    public function testRequiredBy(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Allocate By is required for create");

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $record = new AllocationCreate('unittest');
        $record->setAllocationId('SPLIT60-40');
        //$record->setAllocateBy(AllocationCreate::ALLOCATE_BY_PERCENTAGE);

        $record->writeXml($xml);
    }
}
