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
 * @coversDefaultClass \Intacct\Functions\GeneralLedger\AccountUpdate
 */
class AccountUpdateTest extends TestCase
{

    public function testConstruct(): void
    {
        $expected = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<function controlid="unittest">
    <update>
        <GLACCOUNT>
            <ACCOUNTNO>1010</ACCOUNTNO>
            <TITLE>hello world</TITLE>
        </GLACCOUNT>
    </update>
</function>
EOF;

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $account = new AccountUpdate('unittest');
        $account->setAccountNo('1010');
        $account->setTitle('hello world');

        $account->writeXml($xml);

        $this->assertXmlStringEqualsXmlString($expected, $xml->flush());
    }

    public function testRequiredAccountNo(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Account No is required for update");

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $account = new AccountUpdate('unittest');
        //$account->setAccountNo('1010');
        $account->setTitle('hello world');

        $account->writeXml($xml);
    }
}
