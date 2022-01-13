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

namespace Intacct\Functions\CashManagement;

use Intacct\Xml\XMLWriter;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Intacct\Functions\CashManagement\ChargeCardTransactionLineCreate
 */
class ChargeCardTransactionLineCreateTest extends TestCase
{

    public function testDefaultParams(): void
    {
        $expected = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<ccpayitem>
    <glaccountno></glaccountno>
    <paymentamount>76343.43</paymentamount>
</ccpayitem>
EOF;

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $line = new ChargeCardTransactionLineCreate();
        $line->setTransactionAmount(76343.43);

        $line->writeXml($xml);

        $this->assertXmlStringEqualsXmlString($expected, $xml->flush());
    }

    public function testParamOverrides(): void
    {
        $expected = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<ccpayitem>
    <accountlabel>TestBill Account1</accountlabel>
    <description>Just another memo</description>
    <paymentamount>76343.43</paymentamount>
    <departmentid>Department1</departmentid>
    <locationid>Location1</locationid>
    <customerid>Customer1</customerid>
    <vendorid>Vendor1</vendorid>
    <employeeid>Employee1</employeeid>
    <projectid>Project1</projectid>
    <itemid>Item1</itemid>
    <classid>Class1</classid>
    <contractid>Contract1</contractid>
    <warehouseid>Warehouse1</warehouseid>
    <customfields>
        <customfield>
            <customfieldname>customfield1</customfieldname>
            <customfieldvalue>customvalue1</customfieldvalue>
        </customfield>
    </customfields>
</ccpayitem>
EOF;

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $line = new ChargeCardTransactionLineCreate();
        $line->setAccountLabel('TestBill Account1');
        $line->setTransactionAmount(76343.43);
        $line->setMemo('Just another memo');
        $line->setLocationId('Location1');
        $line->setDepartmentId('Department1');
        $line->setProjectId('Project1');
        $line->setCustomerId('Customer1');
        $line->setVendorId('Vendor1');
        $line->setEmployeeId('Employee1');
        $line->setItemId('Item1');
        $line->setClassId('Class1');
        $line->setContractId('Contract1');
        $line->setWarehouseId('Warehouse1');
        $line->setCustomFields([
            'customfield1' => 'customvalue1',
        ]);

        $line->writeXml($xml);

        $this->assertXmlStringEqualsXmlString($expected, $xml->flush());
    }
}
