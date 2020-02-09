<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Medication Entity
 *
 * @property int $id
 * @property int $patient_id
 * @property string|null $rec_medication
 * @property string|null $rec_diagnosis
 * @property string|null $rec_bp
 * @property string|null $rec_cr
 * @property string|null $rec_wt
 * @property string|null $rec_status
 * @property \Cake\I18n\FrozenTime $rec_date
 * @property string|null $rec_complains
 * @property string|null $rec_rr
 * @property int|null $rec_qn
 * @property int $user_id
 * @property int $is_deleted
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\Patient $patient
 * @property \App\Model\Entity\User $user
 */
class Medication extends Entity
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
        'patient_id' => true,
        'rec_medication' => true,
        'rec_diagnosis' => true,
        'rec_bp' => true,
        'rec_cr' => true,
        'rec_wt' => true,
        'rec_status' => true,
        'rec_date' => true,
        'rec_complains' => true,
        'rec_rr' => true,
        'rec_qn' => true,
        'user_id' => true,
        'is_deleted' => true,
        'modified' => true,
        'created' => true,
        'patient' => true,
        'user' => true
    ];
}
