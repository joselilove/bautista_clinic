<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MedicationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MedicationsTable Test Case
 */
class MedicationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MedicationsTable
     */
    public $Medications;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Medications',
        'app.Patients',
        'app.Users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Medications') ? [] : ['className' => MedicationsTable::class];
        $this->Medications = TableRegistry::getTableLocator()->get('Medications', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Medications);

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
