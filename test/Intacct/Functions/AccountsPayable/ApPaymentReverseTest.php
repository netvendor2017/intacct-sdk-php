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

namespace Intacct\Functions\AccountsPayable;

use DateTime;
use Intacct\Xml\XMLWriter;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Intacct\Functions\AccountsPayable\ApPaymentReverse
 */
class ApPaymentReverseTest extends TestCase
{

    public function testConstruct(): void
    {
        $expected = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<function controlid="unittest">
    <reverse_appayment key="1234">
        <datereversed>
            <year>2015</year>
            <month>06</month>
            <day>30</day>
        </datereversed>
    </reverse_appayment>
</function>
EOF;

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $record = new ApPaymentReverse('unittest');
        $record->setRecordNo(1234);
        $record->setReverseDate(new DateTime('2015-06-30'));

        $record->writeXml($xml);

        $this->assertXmlStringEqualsXmlString($expected, $xml->flush());
    }

    public function testRequiredId(): void
    {
        $this->expectExceptionMessage("Record No is required for reverse");
        $this->expectException(InvalidArgumentException::class);
        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $record = new ApPaymentReverse('unittest');

        $record->writeXml($xml);
    }

    public function testRequiredDate(): void
    {
        $this->expectExceptionMessage("Reverse Date is required for reverse");
        $this->expectException(InvalidArgumentException::class);
        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $record = new ApPaymentReverse('unittest');
        $record->setRecordNo(1234);

        $record->writeXml($xml);
    }
}
