<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Employee
 * 
 * @property int $id
 * @property string $employee_id
 * @property int $department_id
 * @property string $name
 * @property string $address
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Department $department
 * @property Collection|AttendanceHistory[] $attendance_histories
 * @property Collection|Attendance[] $attendances
 *
 * @package App\Models
 */
class Employee extends Model
{
	protected $table = 'employees';

	protected $casts = [
		'department_id' => 'int'
	];

	protected $fillable = [
		'employee_id',
		'department_id',
		'name',
		'address'
	];

	public function department()
	{
		return $this->belongsTo(Department::class);
	}

	public function attendanceHistories()
	{
		return $this->hasMany(AttendanceHistory::class, 'employee_id', 'employee_id');
	}

	public function attendances()
	{
		return $this->hasMany(Attendance::class, 'employee_id', 'employee_id');
	}
}