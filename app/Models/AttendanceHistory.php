<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AttendanceHistory
 * 
 * @property int $id
 * @property string $employee_id
 * @property string $attendance_id
 * @property Carbon $date_attendance
 * @property int $attendance_type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Attendance $attendance
 * @property Employee $employee
 *
 * @package App\Models
 */
class AttendanceHistory extends Model
{
	use HasFactory;

	protected $table = 'attendance_histories';

	protected $casts = [
		'date_attendance' => 'datetime',
		'attendance_type' => 'int'
	];

	protected $fillable = [
		'employee_id',
		'attendance_id',
		'date_attendance',
		'attendance_type'
	];

	public function attendance()
	{
		return $this->belongsTo(Attendance::class, 'attendance_id', 'attendance_id');
	}

	public function employee()
	{
		return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
	}
}