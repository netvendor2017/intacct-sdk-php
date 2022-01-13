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

namespace Intacct\Functions\EmployeeExpense;

use Intacct\Xml\XMLWriter;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Intacct\Functions\EmployeeExpense\ExpenseTypeUpdate
 */
class ExpenseTypeUpdateTest extends TestCase
{

    public function testConstruct(): void
    {
        $expected = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<function controlid="unittest">
    <update>
        <EEACCOUNTLABEL>
            <ACCOUNTLABEL>Travel</ACCOUNTLABEL>
            <DESCRIPTION>hello world</DESCRIPTION>
            <GLACCOUNTNO>7000</GLACCOUNTNO>
        </EEACCOUNTLABEL>
    </update>
</function>
EOF;

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $label = new ExpenseTypeUpdate('unittest');
        $label->setExpenseType('Travel');
        $label->setDescription('hello world');
        $label->setGlAccountNo('7000');

        $label->writeXml($xml);

        $this->assertXmlStringEqualsXmlString($expected, $xml->flush());
    }

    public function testRequiredAccountLabel(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Expense Type is required for update");

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $label = new ExpenseTypeUpdate('unittest');
        //$label->setExpenseType('Travel');
        $label->setDescription('hello world');
        $label->setGlAccountNo('7000');

        $label->writeXml($xml);
    }
}
