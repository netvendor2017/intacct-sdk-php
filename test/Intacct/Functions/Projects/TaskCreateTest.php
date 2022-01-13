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

namespace Intacct\Functions\Projects;

use Intacct\Xml\XMLWriter;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Intacct\Functions\Projects\TaskCreate
 */
class TaskCreateTest extends TestCase
{

    public function testConstruct(): void
    {
        $expected = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<function controlid="unittest">
    <create>
        <TASK>
            <NAME>hello world</NAME>
            <PROJECTID>P1234</PROJECTID>
        </TASK>
    </create>
</function>
EOF;

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $task = new TaskCreate('unittest');
        $task->setTaskName('hello world');
        $task->setProjectId('P1234');

        $task->writeXml($xml);

        $this->assertXmlStringEqualsXmlString($expected, $xml->flush());
    }

    public function testRequiredTaskName(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Task Name is required for create");

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $task = new TaskCreate('unittest');
        //$task->setTaskName('hello world');
        $task->setProjectId('P1234');

        $task->writeXml($xml);
    }

    public function testRequiredProjectId(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Project ID is required for create");

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $task = new TaskCreate('unittest');
        $task->setTaskName('hello world');
        //$task->setProjectId('P1234');

        $task->writeXml($xml);
    }
}
