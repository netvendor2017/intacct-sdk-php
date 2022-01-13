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

namespace Intacct\Functions\DataDeliveryService;

use Intacct\Xml\XMLWriter;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Intacct\Functions\DataDeliveryService\DdsObjectDdlRead
 */
class DdsObjectDdlReadTest extends TestCase
{

    public function testDefaultParams(): void
    {
        $expected = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<function controlid="unittest">
    <getDdsDdl>
        <object>GLACCOUNT</object>
    </getDdsDdl>
</function>
EOF;

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $ddl = new DdsObjectDdlRead('unittest');
        $ddl->setObjectName('GLACCOUNT');

        $ddl->writeXml($xml);

        $this->assertXmlStringEqualsXmlString($expected, $xml->flush());
    }
}
