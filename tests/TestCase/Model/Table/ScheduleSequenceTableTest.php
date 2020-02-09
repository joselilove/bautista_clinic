<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ScheduleSequenceTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ScheduleSequenceTable Test Case
 */
class ScheduleSequenceTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ScheduleSequenceTable
     */
    public $ScheduleSequence;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ScheduleSequence',
        'app.Medications'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ScheduleSequence') ? [] : ['className' => ScheduleSequenceTable::class];
        $this->ScheduleSequence = TableRegistry::getTableLocator()->get('ScheduleSequence', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ScheduleSequence);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
