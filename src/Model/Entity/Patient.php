<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Patient Entity
 *
 * @property int $id
 * @property string|null $pat_name
 * @property string|null $pat_address
 * @property string|null $pat_gender
 * @property string|null $pat_occupation
 * @property string|null $pat_contact
 * @property int|null $pat_age
 * @property \Cake\I18n\FrozenDate|null $pat_birthdate
 * @property string|null $pat_fname
 * @property string|null $pat_lname
 * @property int $user_id
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $created
 */
class Patient extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'pat_middle_initial' => true,
        'pat_address' => true,
        'pat_gender' => true,
        'pat_occupation' => true,
        'pat_contact' => true,
        'pat_age' => true,
        'pat_birthdate' => true,
        'pat_fname' => true,
        'pat_lname' => true,
        'user_id' => true,
        'modified' => true,
        'created' => true
    ];
    protected function _getFullName()
    {
        return $this->pat_fname . ' ' . $this->pat_middle_initial . '. ' . $this->pat_lname;
    }
}
