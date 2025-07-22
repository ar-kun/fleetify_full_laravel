<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Attendance
 *
 * @property int $id
 * @property string $employee_id
 * @property string $attendance_id
 * @property Carbon $clock_in
 * @property Carbon $clock_out
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Employee $employee
 * @property Collection|AttendanceHistory[] $attendance_histories
 */
class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';

    protected $casts = [
        'clock_in' => 'datetime',
        'clock_out' => 'datetime',
    ];

    protected $fillable = [
        'employee_id',
        'attendance_id',
        'clock_in',
        'clock_out',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }

    public function attendanceHistories()
    {
        return $this->hasMany(AttendanceHistory::class, 'attendance_id', 'attendance_id');
    }
}
