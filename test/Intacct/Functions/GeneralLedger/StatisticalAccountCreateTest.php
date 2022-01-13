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

namespace Intacct\Functions\GeneralLedger;

use Intacct\Xml\XMLWriter;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Intacct\Functions\GeneralLedger\StatisticalAccountCreate
 */
class StatisticalAccountCreateTest extends TestCase
{

    public function testConstruct(): void
    {
        $expected = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<function controlid="unittest">
    <create>
        <STATACCOUNT>
            <ACCOUNTNO>9000</ACCOUNTNO>
            <TITLE>hello world</TITLE>
            <ACCOUNTTYPE>forperiod</ACCOUNTTYPE>
        </STATACCOUNT>
    </create>
</function>
EOF;

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $account = new StatisticalAccountCreate('unittest');
        $account->setAccountNo('9000');
        $account->setTitle('hello world');
        $account->setReportType('forperiod');

        $account->writeXml($xml);

        $this->assertXmlStringEqualsXmlString($expected, $xml->flush());
    }

    public function testRequiredAccountNo(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Account No is required for create");

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $account = new StatisticalAccountCreate('unittest');
        //$account->setAccountNo('9000');
        $account->setTitle('hello world');
        $account->setReportType('forperiod');

        $account->writeXml($xml);
    }

    public function testRequiredTitle(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Title is required for create");

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $account = new StatisticalAccountCreate('unittest');
        $account->setAccountNo('9000');
        //$account->setTitle('hello world');
        $account->setReportType('forperiod');

        $account->writeXml($xml);
    }
}
